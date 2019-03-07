(function($){
    if( window.ffbuilder == undefined ) {
        window.ffbuilder = {};
    }


/**********************************************************************************************************************/
/* APP
/**********************************************************************************************************************/
    window.ffbuilder.App = Backbone.View.extend({

        /**
         * Element Picker View
         */
        elementPickerView: null,

        /**
         * All menu items
         */
        menuItems: null,

        /**
         * This variable contains data about every element
         */
        elementModels: null,

        /**
         * Currently selected (opened options) element view
         */
        selectedElementView: null,

		/**
		 * Canvas View
		 */
		canvasView: null,

		/**
		 * Color library - contains array[ colorID ] => array ( color, name );
		 */
		colorLibrary: null,



        /*----------------------------------------------------------*/
        /* BIND ACTIONS
        /*----------------------------------------------------------*/
        /**
         * All dynamic actions binding and interaction with dome
         */
        bindActions: function() {
            var $el = this.$el;
            var self = this;

			/*----------------------------------------------------------*/
			/* EDIT BUTTON
			/*----------------------------------------------------------*/
            $el.on('click','.action-edit-element, .ffb-element-preview.action-edit-element *, .ffb-dropzone:empty, .ffb-header, .ffb-header-name', function(e){
                if(e.target != this) return;

                self.selectedElementView = self._createElementViewFromElement( $(this) );
                self.selectedElementView.renderOptionsForm();

                self.vent.f.modalShow();
            });

			/*----------------------------------------------------------*/
			/* CANCEL MODAL
			/*----------------------------------------------------------*/
            $(document).on('click', '.ffb-modal__action-cancel', function(e){
                if(e.target != this) return;
                
                self.selectedElementView = null;
                self.vent.f.modalHide();
                self.vent.f.modalSetContent('');

                return false;
            });



			/*----------------------------------------------------------*/
			/* SAVE MODAL
			/*----------------------------------------------------------*/
			$(document).on('click', '.ffb-modal__action-save-all', function(){
				self.selectedElementView.saveOptionsForm();
				self.saveAjax();
			});

            $(document).on('click', '.ffb-modal__action-save', function() {
                self.vent.f.modalHide();
                self.selectedElementView.saveOptionsForm();
                self.selectedElementView.clearOptionsForm();
                self.selectedElementView = null;

                return false;
            });

			$(document).on('click', '.ffb-canvas__add-section-item', function(){

				if( $(this).hasClass('ffb-canvas__add-section-item__grid-bs') ) {

					var view = self._createElementViewFromId( 'section' );
					var $html= view.createElementBackendHtml();

					$('.ffb-canvas').children('.ffb-dropzone').append( $html );

					self.vent.f.connectElement( $html );

					// var element var view = this._createElementViewFromId( elementId );
					// var lastElement = self.$el.children('')
				} else if( $(this).hasClass('ffb-canvas__add-section-item__element') ) {
					var view = self._createElementViewFromId( 'section' );

					view.renderAddForm(function( $newElement ){

						$('.ffb-canvas').children().append( $newElement );

					});
				}

			});

			this.bindContextMenu();

			/*----------------------------------------------------------*/
			/* ADD ELEMENT
			/*----------------------------------------------------------*/
            $(document).on('click', '.action-add-element', function(){

                self.selectedElementView = self._createElementViewFromElement( $(this) );
                self.selectedElementView.renderAddForm();

            });

			$(document).on('click', '.ffb-save-ajax', function(){

				self.saveAjax();

				return false;
			});

            // when canvas is changed, convert to shortcodes and fill it into WP editor
            this.vent.listenTo(this.vent, this.vent.a.canvasChanged, function(){
                self.writeCanvasToPostContentArea();
            });

            // when all elements data are loaded, we are going to refresh the canvas
            // to render the preview of all elements
            this.vent.listenTo(this.vent, this.vent.a.elementsDataLoaded, function(){
                self.refreshElementsPreview( self.$el );
                self.elementPickerView = new window.ffbuilder.ElementPickerView({vent: self.vent, elementModels: self.elementModels, menuItems: self.menuItems});
            });
        },

		bindContextMenu: function(){
			var self = this;
			/*----------------------------------------------------------*/
			/* CONTEXT MENU
			 /*----------------------------------------------------------*/
			/**
			 * Copy, Paste, Delete, Duplicate and other stuff is handled here
			 */
			$(document).off('click', '.action-toggle-context-menu');
			$.contextMenu({
				selector: ".action-toggle-context-menu",
				className: 'ffb-canvas-contextmenu',
				trigger: 'left',
				animation: {duration: 0, show: 'show', hide: 'hide'},
				position: function(opt, x, y) {
					opt.$menu.position({
						my: 'left top',
						at: 'left bottom',
						of: opt.$trigger
					});
				},
				callback: function( key, options ) {
					self.selectedElementView = self._createElementViewFromElement( $(this).parents('.ffb-element:first') );

					switch( key ) {
						case 'delete':
							self.selectedElementView.deleteElement();
							break;

						case 'duplicate':
							self.selectedElementView.duplicateElement();
							break;

						case 'copy':
							self.selectedElementView.copyElement();
							break;

						case 'paste':
							self.selectedElementView.pasteElement();
							break;
					}
				},

				events: {
					show : function(options){
						this.closest('.ffb-element').addClass('action-toggle-context-menu-opened');
					},
					hide : function(options){
						this.closest('.ffb-element').removeClass('action-toggle-context-menu-opened');
					}
				},

				items: {
					'copy': {name: "Copy" },
					'paste': {name: "Paste" },
					'duplicate': {name: "Duplicate"},
					'delete': {name: "Delete"}
				}
			});

		},


        /*----------------------------------------------------------*/
        /* INITIALIZE - constructor
        /*----------------------------------------------------------*/
        /**
         * First initialization
         */
        initialize: function() {
            this.vent = this._getVent();
            this.$el = $('.ffb-canvas');


            this.init();
            this.bindActions();
        },

        /*----------------------------------------------------------*/
        /* INIT
        /*----------------------------------------------------------*/
        /**
         * First call - after loading the builder, we need to initialise every js functions, connect JS things with the
         * canvas and all other stuff
         */
        init: function(){
            this.loadElementsData();
            this.connectElements( this.$el );

        },

        refreshElementsPreview: function ( $elements ) {
            var self = this;

            if( $elements.hasClass('ffb-element' ) ) {
                self._createElementViewFromElement( $elements ).renderContentPreview();
            }
            $elements.find('.ffb-element').each(function(){
                self._createElementViewFromElement( $(this) ).renderContentPreview();
            });
        },

		saveAjax: function() {
			var shortcodesContent = this.convertToShortcodes( this.$el );
			var data = {};
			data.content = shortcodesContent;
			data.postId = $('#post_ID').val();
			data.colorLibrary = this.colorLibrary;


			this._metaBoxAjax( 'saveAjax', data, function(response){
				frslib.messages.broadcast({'command' : 'refresh', 'post_id': $('#post_ID').val() })
			});
		},


        /*----------------------------------------------------------*/
        /* LOAD ELEMENTS DATA
        /*----------------------------------------------------------*/
        /**
         * load data about all builder elements and create backboneJS models from them, for better rendering and
         * everything next time
         * @param $elements
         */
        loadElementsData :function() {
            var self = this;
            this.elementModels = [];
            this.menuItems = null;
            this._metaBoxAjax( this.vent.ajax.getElementsData, {}, function( response ){
                var data = JSON.parse( response );

				/*----------------------------------------------------------*/
				/* MENU ITEMS
				/*----------------------------------------------------------*/
                // information about all menu items in the "Add" section
                self.menuItems = data.menuItems;

				/*----------------------------------------------------------*/
				/* ELEMENTS DATA
				/*----------------------------------------------------------*/
                var elementsData = data.elements;
                var key = null;
                for( key in elementsData ) {
                    var oneElement = elementsData[ key ];
                    var elementModel = new window.ffbuilder.ElementModel();

                    for( var attr in oneElement ) {
                        elementModel.set( attr, oneElement[attr]);
                    }

                    elementModel.set('optionsStructure', JSON.parse( elementModel.get('optionsStructure') ) );
                    elementModel.processFunctions();

                    self.elementModels[ key ] = elementModel;



                }

				/*----------------------------------------------------------*/
				/* BLOCKS DATA
				/*----------------------------------------------------------*/
                var blocksDataUnpacked = data.blocks;
				var blocksData = {};
				for( key in blocksDataUnpacked ) {
					blocksData[ key ] = JSON.parse(blocksDataUnpacked[ key ]);
				}

                // console.log(data.blocks_functions)

				var blocksCallbacksModel = Backbone.DeepModel.extend({
					render: function( blockName, query, params ) {
						return this.get(blockName)(query, params);
					}
				});
				self.vent.d.blocksCallbacks = new blocksCallbacksModel();

				$.each( data.blocks_functions, function(key, value){

					var f = null; // temporary function holder

					eval('f = ' + value );


					self.vent.d.blocksCallbacks.set(key, f);
				});



				/*----------------------------------------------------------*/
				/* COLOR LIBRARY
			 	/*----------------------------------------------------------*/
				self.colorLibrary = data.color_library;

				self.vent.d.blocksData = blocksData;

                self.vent.trigger(self.vent.a.elementsDataLoaded);


            });

            ;
        },



        /*----------------------------------------------------------*/
        /* writeCanvasToPostContentArea
        /*----------------------------------------------------------*/
        /**
         * Converts all our shortcodes to canvas and then write it
         * to post content area
         */
        writeCanvasToPostContentArea: function() {
            var canvasShortcodeNotation = this.convertToShortcodes( this.$el.children('.ffb-dropzone') );

            this._setTinyMCEContent( canvasShortcodeNotation );
        },




        /*----------------------------------------------------------*/
        /* convertToShortcodes
        /*----------------------------------------------------------*/
        /**
         * Convert given elements to ShortCodes notation
         * @param $elements
         */
        convertToShortcodes_data: '',
        convertToShortcodes_depth: 0,

        convertToShortcodes: function ( $data ) {
            this.convertToShortcodes_depth = 0;
            this.convertToShortcodes_data = '';
            if( $data.hasClass('ffb-canvas') ) {
				var $elements = $data.children('.ffb-dropzone').children('.ffb-element');

				var self = this;

				$elements.each(function(){
					self.convertToShortcodes_Element( $(this) );
				});
            } else if ($data.hasClass('ffb-dropzone') ) {
				var $elements = $data.children('.ffb-element');

				var self = this;

				$elements.each(function(){
					self.convertToShortcodes_Element( $(this) );
				});

            } else {
                var $elements = $data.children('.ffb-element');
                var self = this;

                $elements.each(function(){
                    self.convertToShortcodes_Element( $(this) );
                });
            }

            var toReturn = this.convertToShortcodes_data;
            this.convertToShortcodes_data = '';
            return toReturn;
        },

        convertToShortcodes_encodeAttribute: function( attribute ) {

            attribute = encodeURI( attribute );

            attribute = attribute.split('%20').join(' ');


            return attribute;
        },

        convertToShortcodes_Element: function( $element ) {
            var self = this;

            var elementId = $element.attr('data-element-id');
            //var dataString = $element.attr('data-options');


            var elementModel = this._createElementViewFromElement($element );
            var elementData = elementModel.convertOptionsToShortcodes();

            // options, shortcodes

            var dataString = JSON.stringify( elementData.options );

            //var walker = frslib.options.walkers.toScContentConvertor();
            //walker.setDataJSON( data );
            //walker.setStructureJSON( this.model.get('optionsStructure'));
            //console.log( walker.walk());

            //console.log( dataString );
            var data = this.convertToShortcodes_encodeAttribute( dataString );
            if( data == 'null' ) {
                data = '';
            }
            var dataAttr = 'data="' + data + '"';

            var uniqueID = $element.attr('data-unique-id');


            this.convertToShortcodes_data += '[ffb_' + elementId +'_' + this.convertToShortcodes_depth + ' unique_id="' + uniqueID + '" ' + dataAttr + ']';
                this.convertToShortcodes_data += elementData.shortcodes;
                $element.children('.ffb-dropzone').each(function(){
                    self.convertToShortcodes_Dropzone( $(this) );
                });

            this.convertToShortcodes_data += '[/ffb_' + elementId +'_' + this.convertToShortcodes_depth + ']';

        },

        convertToShortcodes_Dropzone: function( $dropzone ) {
            var self = this;
            this.convertToShortcodes_depth++;
            $dropzone.children('.ffb-element').each(function(){
                self.convertToShortcodes_Element( $(this) );
            });
            this.convertToShortcodes_depth--;
        },

        /*----------------------------------------------------------*/
        /* CONNECT ELEMENTS
        /*----------------------------------------------------------*/
        /**
         * function called on every new element, which wants to be added into the canvas - do some js hooks
         * @param $elements
         */
        connectElements: function( $elements ) {

            var $dropzones = $elements.find('.ffb-dropzone');

            if( $dropzones.size() > 0 ) {
                this.initSortableOnDropzones( $dropzones );
            }
        },

        reInitSortableOnDropzones: function( $dropzones)  {
            this.initSortableOnDropzones( $dropzones );
            this.$el.find('.ffb-dropzone').sortable('refresh');
        },

        initSortableOnDropzones: function( $dropzones ) {
            var self = this;

            $dropzones.each(function(){
                var $this = $(this);
                var $element = $(this).parents('.ffb-element:first');
                var connectWith = '.ffb-dropzone';

                $(this).sortable({
                connectWith: connectWith,
                cursor: 'move',
                tolerance: 'pointer',
                    //items: function(a,b,c){
                    //  alert('s');
                    //},
                // helper: 'clone',
                cursorAt: { left: -5, top: -5 },

                placeholder: {
                    element: function($currentItem ) {


                        var $placeholder = $currentItem.clone().html('').addClass('ui-sortable-placeholder').css('position','').css('width','');

                        $placeholder.attr( 'data-element-id', $currentItem.attr('data-element-id') );
                        // if( $currentItem.hasClass('ffb-element--position--block') ) {
                        //     $placeholder.addClass('ffb-element-sortable-placeholder--position--block');
                        // } else if ( $currentItem.hasClass('ffb-element--position--float') ) {
                        //     $placeholder.addClass('ffb-element-sortable-placeholder--position--float');
                        // }
                        // $placeholder.addClass('ffb-element-sortable-placeholder--position--float');
                        return $placeholder;

                     },
                     update: function( event, $placeholder) {

                        

                         // var $parent = $placeholder.parents('.ffb-element:first');

                         // var canBeDropped = self.canBeDropped( $parent, $placeholder );

                         // if( canBeDropped ) {
                         //     // $placeholder.removeClass('ui-sortable-placeholder--cant-be-dropped');
                         //     // $placeholder.css('display', 'block');

                         // } else {
                         //     // $placeholder.addClass('ui-sortable-placeholder--cant-be-dropped');
                         //     // $placeholder.css('display', 'none');

                         // }
                         // return false;

                     }
                },

                // helper: {
                //     element: function($currentItem ) {
                //         var $helper = $currentItem.clone().html('').addClass('ui-sortable-placeholder').css('position','').css('width','');
                //         return $helper;

                //      }
                // },,
                 helper:  function(event, $element) {
                    // this event fires before start
                    // console.log('---helper');
					// var elementId = $


                    // if ( $(this).hasClass('ffb-dropzone-row') ){
                    //     $(this).sortable( "option", "connectWith", ".ffb-element-section > .ffb-dropzone" );
                    //     console.log(1);
                    //     var connectWith = $(this).sortable( "option", "connectWith" );
                    //     console.log(connectWith);
                    // }
					//
                    // $(this).sortable( "refresh" );

                    return $element;
                    
                },


               start: function (event, ui) {


            },



               stop: function (event, ui) {

                   // var $droppedElement = ui.item;
                   // var $elementWithDropzone = $droppedElement.parents('.ffb-element:first');

                   // if( self.canBeDropped( $elementWithDropzone,$droppedElement )  ) {
                       self.vent.trigger(self.vent.a.canvasChanged);
                   // } else {
                   //     $this.sortable('cancel');
                   // }
                   console.log('---stop');

                    // Animate In

                    ui.item.slideUp(0);

                    ui.item.animateCSS('zoomIn');

                    if ( ui.item.is('.ffb-element-column') ){
                        ui.item.show(151);
                    } else {
                        ui.item.slideDown(151);
                    }

                    // ui.item.css('animation-duration', '0.3s').animateCSS('zoomIn');

                    // setTimeout(function(){
                    //     ui.item.css('animation-duration', '');
                    // }, 350);

                    // if ( ui.item.is('.ffb-element-column') ){
                    //     ui.item.animateCSS('bounceIn');
                    // } else {
                    //     ui.item.animateCSS('bounceIn');
                    // }

                    // if ( ui.item.is('.ffb-element-column') ){
                    //     ui.item.show(500);
                    // } else {
                    //     ui.item.slideDown(500);
                    // }

               }
            });


            });
//            $dropzones.
        },

        canBeDropped: function( $elementWithDropzone, $droppedElement ) {
            var droppedElementId = $droppedElement.attr('data-element-id');
            var dropzoneMode = $elementWithDropzone.attr('data-dropzone-mode');

            if( dropzoneMode == undefined ) {
                return true;
            }

            var dropzoneList = JSON.parse($elementWithDropzone.attr('data-dropzone-list'));


            if( dropzoneMode == 'whitelist' ) {

                if ( $.inArray( droppedElementId, dropzoneList ) != -1) {
                    return true;
                } else {
                    return false;
                }

            } else if (dropzoneMode == 'blacklist') {
                if ( $.inArray( droppedElementId, dropzoneList ) == -1) {
                    return true;
                } else {
                    return false;
                }
            }
        },

        /*----------------------------------------------------------*/
        /* EVENTS
        /*----------------------------------------------------------*/
        /**
         * Generate our event class, which stores all event names as as "pseudo constants"
         * This class is basically backbone of our eventing system
         * @private
         */
        _getVent: function() {
            var self = this;
            var vent = _.extend({}, Backbone.Events);

            vent.ajax = {};
            vent.ajax.getElementsData = 'getElementsData';

            vent.a = {};
            vent.a.canvasChanged = 'canvasChanged';
            vent.a.elementsDataLoaded = 'elementsDataLoaded';

			vent.d = {};
			vent.d.blocksData = {};
			vent.d.modalOpened = false;

            vent.f = {};

            vent.f.connectElement = function( $element ) {
                self.connectElements( $element );
                self.refreshElementsPreview( $element );
                self.writeCanvasToPostContentArea();
				self.bindContextMenu();
            };

			vent.f.canvasChanged = function() {
				vent.trigger( vent.a.canvasChanged );
			}

            vent.f.modalShow = function(){
				if( vent.d.modalOpened ) {
					return;
				}

				vent.d.modalOpened = true;
                $.scrollLock();
                $('.ffb-modal-origin').css('display', 'block');
            };

            vent.f.modalHide = function() {

				if( !vent.d.modalOpened ) {
					return;
				}

				vent.d.modalOpened = false;

                $.scrollLock();
                $('.ffb-modal-origin').css('display','none');
            };

            vent.f.modalSetContent = function( content ) {
                $('.ffb-modal-origin').find('.ffb-modal__body').html( content);
            };



            return vent;
        },

        _setTinyMCEContent: function( content ) {
            var activeEditor = tinyMCE.get(wpActiveEditor);

            if( activeEditor ==undefined ) {
                $('.wp-editor-area').val( content );
            } else {
                activeEditor.setContent(content);
            }

                ///wp-editor-area
            //console.log( wpActiveEditor, tinyMCE,  tinyMCE.get(wpActiveEditor) );
            //tinyMCE.get(wpActiveEditor).setContent(content);
        },

        /*----------------------------------------------------------*/
        /* metaBoxAjax
        /*----------------------------------------------------------*/
        /**
         * Ajax request to our meta box "Theme Builder"
         * @param action
         * @param data
         * @param callback
         * @private
         */
        _metaBoxAjax: function( action, data, callback ) {
            data.action = action;
            var specification = {};
			specification.metaboxClass = 'ffMetaBoxThemeBuilder';
            frslib.ajax.frameworkRequest( 'ffMetaBoxManager', specification, data, function( response ) {
                callback( response );
            });
        },

        _createElementViewFromElement: function( $element ) {

            if( !$element.hasClass('ffb-element') ) {
                $element = $element.parents('.ffb-element:first');
            }

            var elementId = $element.attr('data-element-id');


            var view = this._createElementViewFromId( elementId );
            view.$el = $element;

            return view;
        },

        _createElementViewFromId: function( elementId ) {
            var view = new window.ffbuilder.ElementView();
            view.elementPickerView = this.elementPickerView;
            view.model = this._createElementModelFromId( elementId );
            view.vent = this.vent;
            view.elementModels = this.elementModels;
			view.currentElementId = elementId;

            return view;
        },

        _createElementModelFromId: function( elementId ) {
            var model = this.elementModels[ elementId ];
            var modelCopy = model.clone();
            modelCopy.vent = this.vent;

            return modelCopy;
        },

    });


    $(document).ready(function(){
        window.ffbuilder.appInstance = new window.ffbuilder.App();
    });

    // HOVER OVER FFB ELEMENTS STYLE - START

    /*

    DO NOT DELETE!

    $(document).ready(function(){

        $(document).on('mouseover', '.ffb-element', function(e){
            $(this).addClass('ffb-element-is-hovered').parents().removeClass('ffb-element-is-hovered');
            e.stopPropagation();
        });

        $(document).on('mouseout', '.ffb-element', function(e){
            $(this).removeClass('ffb-element-is-hovered');
        });

    });

    */

    // HOVER OVER FFB ELEMENTS STYLE - END

    // ADD SECTION BUTTON - START

    $.fn.extend({
        animateCSS: function (animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            $(this).addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
        }
    });

    $(document).on('click', '.action-add-section', function(e){
        e.preventDefault();
        $(this).fadeOut(300, function(){
            $(this).closest('.ffb-canvas__add-section-button-wrapper').addClass('action-add-section-triggered');
            $('.ffb-canvas__add-section-item').animateCSS('fadeInDown');
        });
    });

    $(document).on('click', '.ffb-canvas__add-section-item, .ffb-canvas__add-section-item__cancel', function(e){
        e.preventDefault();

        var $thisSection = $(this).closest('.ffb-canvas__add-section-button-wrapper');

        // $thisSection.addClass('anim-back');

        $thisSection.find('.ffb-canvas__add-section-item').animateCSS('fadeOutUp');
        $thisSection.find('.ffb-canvas__add-section-item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).css('opacity', '0');
        });
        $thisSection.find('.ffb-canvas__add-section-item:last-child').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $thisSection.find('.ffb-canvas__add-section-item').css('opacity','');
            $thisSection.removeClass('action-add-section-triggered');
            $thisSection.find('.action-add-section').fadeIn(300);
            // $thisSection.removeClass('anim-back');
        });

    });

    // ADD SECTION BUTTON - END

    // COLLAPSE ELEMENT TOGGLE - START

    $(document).on('click', '.action-toggle-collapse', function(e){
        e.preventDefault();

        var $thisEl = $(this).closest('.ffb-element');

        if ( $thisEl.is('.ffb-element-dropzone-yes') ){
            $thisEl.find('.ffb-dropzone').toggle();          
        } else {
            $thisEl.find('.ffb-element-preview').toggle();
        }

        $(this).toggleClass('action-is-collapsed');
        $thisEl.toggleClass('ffb-element-is-collapsed');
    });

    // COLLAPSE ELEMENT TOGGLE - END

    // TOOLTIP - START

    $('[data-ffb-tooltip]').qtip({
        content: {
            attr: 'data-ffb-tooltip'
        },
        style: {
            tip: {
                corner: false
            },
            classes: 'ffb-tooltip'
        },
        position: {
            // target: 'mouse',
            my: 'bottom center',  // tooltip
            at: 'top center' // container
        },
        show: {
            delay: 0,
            // effect: false, // disable fading animation
        },
        hide: {
            effect: false, // disable fading animation
        }
    });


    // TOOLTIP - END



})(jQuery);









