(function($){
	if( window.ffbuilder == undefined ) {
		window.ffbuilder = {};
	}


/**********************************************************************************************************************/
/* ELEMENT VIEW
/**********************************************************************************************************************/
	/**
	 * Element View, taking care about rendering the element and manipulating with it
	 */
	window.ffbuilder.ElementView = Backbone.View.extend({
		model : null,
		query: null,
		elementModels: null,
		elementPickerView: null,

		initialize: function() {
		},

		test : function() {
			this.$el.css('opacity', 0.5);
		},

		/**
		 * Render option form and set it as a content in the modal window
		 */
		renderOptionsForm: function() {

			var self = this;

			var html = '';
			html += '<div class="ff-options-js-wrapper " data-print-copy-and-paste="false">';
			html += '<div class="ff-options-js-data-wrapper" style="display:none;">';
				html += '<textarea class="ff-options-structure-js"></textarea>';
				html += '<textarea class="ff-options-data-js"></textarea> ';
				html += '<div class="ff-options-prefix">elementData</div>';
			html += '</div>';
			html += '<div class="ff-options-js">';
				//html += '<span class="spinner"></span>';
			html += '</div>';
			html += '</div>';

			var $html = $(html);

			$html.find('.ff-options-data-js').data('data-json',  this.getOptionsData() );
			$html.find('.ff-options-structure-js').data('data-json',  JSON.stringify( this.model.get('optionsStructure') ) );
			$html.find('.ff-options-structure-js').data('data-block-callback', function( uniqueHash){

				return (self.vent.d.blocksData[ uniqueHash ]);
			});

			frslib.options.functions.initOneOptionSet( $html, true )

			this.renderOptionsFormCssClasses( $html );
			this.markAdvancedTools( $html );

			this.vent.f.modalSetContent( $html );
			var self = this;
			$html.on('opt-changed', function(){
				self.renderOptionsFormCssClasses( $html );
			});

			$html.on('click', '.ffb-modal__action-done', function(){
				self.markAdvancedTools( $html );
			});


		},

		getSystemSectionNames: function() {
			var systemSections = new Array();

			systemSections.push('cc');
			systemSections.push('b-m');
			systemSections.push('a-t');

			return systemSections;
		},

		markAdvancedTools: function( $html ) {

			var $form = $html.find('.ff-options-js');
			var data = frslib.options.template.functions.normalizeFast( $form, undefined, undefined, undefined, true );
			var diff = this.getOptionsWithDifferencies( data.elementData );

			var newQuery = this.getOptionsQuery(diff);
			var systemSections = this.getSystemSectionNames();


			function markAdvancedTools_recursive( $options, query, routeDeduction ) {



				$options.findButNotInside('.ff-repeatable-js').each(function(){

					var route = $(this).attr('data-current-section-route');


					if( routeDeduction != undefined ) {


						// console.log( route );
						// console.log( routeDeduction );
						// console.log( route.split( routeDeduction)  );
						// console.log( query  );
						// console.log( '------------');


						// route = route.replace( routeDeduction + ' ', '' );


						route = route.split( routeDeduction ).pop();

					}

					// ignore system repeatable sections
					for( var i in systemSections ) {
						var oneSection = systemSections[ i ];

						if( route != undefined && route.indexOf( oneSection + ' ') != - 1 ) {
							return;
						}
					}


					var $this = $(this);

					// console.log( route );


					var newQuery = query.get( route );

					if( newQuery == undefined ) {
						console.log( 'TODO OSETRIT KURVA');
						// console.log( '-/-/-/--/-//-/-/-/-/-');
						// console.log( route);
						// console.log( query );
						// console.log( '-/-/-/--/-//-/-/-/-/-');
						return null;
					}

					newQuery.each(function(query, a, b){
						var $node = $this.children().eq(b);

						var hasBeenChanged = false;
						// ignore system repeatable sections
						for( var i in systemSections ) {
							var oneSection = systemSections[ i ];

							if( query.getWithoutComparationDefault(oneSection, null) != null ) {
								hasBeenChanged = true;
							}
						}

						if( hasBeenChanged == true ) {
							$node.find( '.ff-show-advanced-tools:first').css('color', 'red');
						} else {
							$node.find( '.ff-show-advanced-tools:first').css('color', '');
						}

						var newRouteDeduction = route + ' ' + $node.attr('data-section-id');

						markAdvancedTools_recursive( $node, query, newRouteDeduction );
					});

				});

			}

			markAdvancedTools_recursive($html, newQuery );
		},

		renderOptionsFormCssClasses: function( $html ) {

			var elementId = this.getUniqueId();
			var level = 0;
			var currentLevel = 0;
			var counters = new Array();
			var classes = new Array();
			var systemSections = this.getSystemSectionNames();


			$html.find('.ff-insert-unique-css-class').html( '.ffb-id-' + elementId );

			$html.find('.ff-repeatable-js, .ff-repeatable-item-js').each(function(){


				if( $(this).hasClass('ff-insert-unique-css-class') ) {
					// var css =  '.ffb-id-' + elementId + classes.join(' .');

					// $(this).html(css);
				} else {
					var route = $(this).attr('data-current-section-route');

					// ignore system repeatable sections
					for( var i in systemSections ) {
						var oneSection = systemSections[ i ];

						if( route != undefined && route.indexOf( oneSection + ' ') != - 1 ) {
							return;
						}
					}

					if( $(this).hasClass('ff-repeatable-item-js') ) {
						var id = $(this).attr('data-section-id');

						if( id == undefined ) {
							return ;
						}

						var $parent = $(this).parent();
						var dataCurrentLevel = $parent.attr('data-current-level');

						if( dataCurrentLevel > currentLevel ) {
							level++;

						} else if (dataCurrentLevel < currentLevel )  {
							level--;
						}

						currentLevel = dataCurrentLevel

						if( counters[ level] == undefined ) {
							counters[level] = 0;
						}

						counters[ level ] ++;

						counters.splice( level + 1);
						classes.splice( level + 1 );

						var newCssClass = ( 'ffb-' + id + counters.join('-') );
						classes[ level ] = newCssClass;

						$(this).find('.ff-insert-unique-css-class').html('.ffb-id-' + elementId + classes.join(' .'));
					}
				}
			});

		},

		lastGeneratedId: null,

		generateUniqueId: function() {
			var number = new Date().getTime() -  new Date('2016-01-01').getTime();
			// this.lastGeneratedId = number;
			if( this.lastGeneratedId != null && this.lastGeneratedId >= number ) {
				number = this.lastGeneratedId + 1;
			}
			var newId = number.toString( 32 );
			this.lastGeneratedId = number;
			return newId;


		},

		generateUniqueIdClass: function( uniqueId ) {
			if( uniqueId == undefined ) {
				uniqueId = this.generateUniqueId();
			}

			return 'ffb-id-' + uniqueId;
		},

		createElementBackendHtml: function() {
			var self = this;
			var elementId = this.currentElementId;

			var itemId = elementId;
			var newItemModel = self.elementModels[ itemId ];

			var $newItemHTML = $(newItemModel.get('defaultHtml'));

			var uniqueId = self.generateUniqueId();
			var uniqueIdClass = self.generateUniqueIdClass( uniqueId );

			//self.$el.find('.ffb-dropzone:first').append( $newItemHTML);

			$newItemHTML.appendTo( self.$el.find('.ffb-dropzone:first') );

			$newItemHTML.attr('data-unique-id', uniqueId );
			$newItemHTML.addClass(uniqueIdClass);

			return $newItemHTML;
		},


        renderAddForm: function( insertElementCallback ) {
			var self = this;

			var called = false;
			this.elementPickerView.callback_ItemSelected = function( $item ) {
				var itemId = $item.attr('data-id');
				var newItemModel = self.elementModels[ itemId ];

				var $newItemHTML = $(newItemModel.get('defaultHtml'));

				var uniqueId = self.generateUniqueId();
				var uniqueIdClass = self.generateUniqueIdClass( uniqueId );

				//self.$el.find('.ffb-dropzone:first').append( $newItemHTML);

				if( insertElementCallback != undefined ) {
					insertElementCallback( $newItemHTML );
				} else {
					$newItemHTML.appendTo( self.$el.find('.ffb-dropzone:first') );
				}



				$newItemHTML.attr('data-unique-id', uniqueId );
				$newItemHTML.addClass(uniqueIdClass);

				self.vent.f.modalHide();

				//console.log( $newItemHTML, newItemModel.get('defaultHtml') );

				//setTimeout(function(){
				//    console.log( $newItemHTML);
				self.vent.f.connectElement($newItemHTML);
				//}, 1000);
				called = true;

				// Animate In

				$newItemHTML.slideUp(0);

				$newItemHTML.animateCSS('zoomIn');

				if ( $newItemHTML.is('.ffb-element-column') ){
					$newItemHTML.show(301);
				} else {
					$newItemHTML.slideDown(301);
				}
				
			};



			var $addElementHtml = this.elementPickerView.renderAddFormHtml( this );

			if( !called ) {


				this.vent.f.modalSetContent( $addElementHtml );
				this.vent.f.modalShow();

				$('.ffb-filterable-library__search').focus();


			}




        },


/**********************************************************************************************************************/
/* CONTEXT MENU
/**********************************************************************************************************************/
		deleteElement: function() {
			var self = this;
			var confirmation = confirm('Do you really want to delete this element and everything inside it?');

			if( confirmation ) {
			
				// Animate Out

				var $thisEl = this.$el;

				$thisEl.animateCSS('zoomOut');

				if ( $thisEl.is('.ffb-element-column') ){
					$thisEl.hide(301);
				} else {
					$thisEl.slideUp(301);
				}

				setTimeout(function(){

					$thisEl.remove();
					self.vent.f.canvasChanged();
				}, 301)



			}

		},

		pasteElement: function() {
			var elementValue = frslib.clipboard.pasteFrom();

			var $element = $(elementValue);
			this.$el.after( $element );
			
			// Animate In

			$element.slideUp(0);

			$element.animateCSS('zoomIn');

			if ( $element.is('.ffb-element-column') ){
				$element.show(301);
			} else {
				$element.slideDown(301);
			}

		},


		copyElement: function() {
			var self = this;
			var $newElement = this.$el.clone();

			this.$el.addClass('ffb-element-anim-copy').animateCSS('tada');

	        this.$el.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function(){
	            $(this).removeClass('ffb-element-anim-copy');
	        });

			this.normalizeElementAfterCopyAndDuplication( $newElement );

			frslib.clipboard.copyTo( $('<div></div>').append( $newElement ).html() );
			// this.$el.before( $('<div></div>').append( $newElement ).html());
		},

		duplicateElement: function() {
			var self = this;
			var $newElement = this.$el.clone();

			this.normalizeElementAfterCopyAndDuplication( $newElement );

			this.$el.after( $newElement );
			this.vent.f.connectElement( $newElement );
			
			// Animate In
			
			$newElement.slideUp(0);

			$newElement.animateCSS('zoomIn');

			if ( $newElement.is('.ffb-element-column') ){
				$newElement.show(301);
			} else {
				$newElement.slideDown(301);
			}
		},

		normalizeElementAfterCopyAndDuplication: function( $element ) {
			var self = this;
			$element.find('.ffb-element').addBack('.ffb-element').each(function(){
				var newUniqueId = self.generateUniqueId();
				$(this).attr('data-unique-id', newUniqueId );
			});

			$element.removeClass('action-toggle-context-menu-opened');
			$element.find('.context-menu-active').removeClass('context-menu-active');
		},

		canvasChanged: function(){
			this.vent.f.canvasChanged();
		},

		/**
		 * saveOptionsForm
		 * Saves the form into element data-attr directly
		 */
		saveOptionsForm: function() {
			var $form = $('.ffb-modal').find('.ff-options-js');

			//function( $form, returnForm, deleteOriginalForm, ignoreDefaultValues )
			var data = frslib.options.template.functions.normalizeFast( $form, undefined, undefined, undefined, true );
			var dataString = JSON.stringify(data.elementData);
			this.$el.attr('data-options', dataString);

			var query = this.getOptionsQuery().get('o gen');

			var renderContentInfo = this.model.get('functions.renderContentInfo_JS');

			var previewObject = this.getPreviewObject( query );
			previewObject.$el = this.$el;
			renderContentInfo(query, data.elementData, this.$el.children('.ffb-element-preview'), this.$el, this.vent.d.blocksCallbacks,  previewObject, this );
			previewObject.render();

			this.vent.trigger(this.vent.a.canvasChanged);
		},



		getOptionsWithDifferencies: function( data ) {
			var self = this;
			var walker = frslib.options.walkers.toScContentConvertor();
			walker.useContentParams = false;
			walker.setDataJSON( data );


			walker.setStructureJSON( this.model.get('optionsStructure'));
			walker.walker.callbackGetBlockItem = function( uniqueHash ) {
				return (self.vent.d.blocksData[ uniqueHash ]);
			};
			return walker.walk();
		},

		/**
		 * convertOptionsToShortcodes
		 * Some of the options are meant to be printed as a content. This is because of search and UTF8 characters.
		 * This function divides the data to the data-attr part and content part
		 * @returns {{}}
		 */
		convertOptionsToShortcodes: function() {
			var self = this;
			var walker = frslib.options.walkers.toScContentConvertor();
			walker.setDataJSON( this.getOptionsDataJSON() );
			walker.setStructureJSON( this.model.get('optionsStructure'));
			walker.walker.callbackGetBlockItem = function( uniqueHash ) {
				return (self.vent.d.blocksData[ uniqueHash ]);
			};
			var toReturn = {};
			toReturn.options = ( walker.walk());
			toReturn.shortcodes = walker.contentOutput;

			return toReturn;
		},

		/**
		 * Each element has option to render content preview, containing some important data
		 */
		renderContentPreview: function() {
			var query = this.getOptionsQuery().get('o gen');
			var data = this.getOptionsDataJSON();

			var renderContentInfo = this.model.get('functions.renderContentInfo_JS');
			var previewObject = this.getPreviewObject( query );
			previewObject.$el = this.$el;
			renderContentInfo(query, data.elementData, this.$el.children('.ffb-element-preview'), this.$el, this.vent.d.blocksCallbacks,  previewObject, this );
			previewObject.render();
		},

		clearOptionsForm: function() {
			this.vent.f.modalSetContent('');
		},

		getPreviewObject: function( query ) {
			var previewViewClass = Backbone.View.extend({

				html : '',

				addHeadingLg: function( heading ) {
					this.html += '<div class="ffb-preview-heading-lg">' + heading + '</div>';
				},

				addHeadingSm: function( heading ) {
					this.html += '<div class="ffb-preview-heading-sm">' + heading + '</div>';
				},

				addText: function( text ){
					this.html += '<div class="ffb-preview-text">' + text + '</div>';
				},

				addLink: function( text ){
					this.html += '<div class="ffb-preview-button">' + text + '</div>';
				},

				addVideo: function( text ){
					this.html += '<div class="ffb-preview-video">' + text + '</div>';
				},

				addImage: function( src ){
					this.html += '<img class="ffb-preview-image" src="' + src + '" />';
				},

				addIcon: function( icon ){
					this.html += '<i class="ffb-preview-icon ' + icon + '"></i>';
				},

				addPlainText: function( plainText ) {
					this.html += plainText;
				},

				render : function() {
					// this.$el.css('opacity', 0.5);
					if( this.html.length > 0 ) {
						this.$el.children('.ffb-element-preview').html( this.html );
					}
				}

			});

			var preview = new previewViewClass({ $el : this.$el });


			frslib.options.getNewEmptyQueryObject = function() {
				var _ = {};
				_.addHeadingLg = function( query ) {
					var value = _.get( query );
					preview.addHeadingLg (value);
				};

				_.addHeadingSm = function( query ) {
					var value = _.get( query );
					preview.addHeadingSm (value);
				};

				_.addText = function( query ) {
					var value = _.get( query );
					preview.addText (value);
				};

				_.addLink = function( query ) {
					var value = _.get( query );
					preview.addLink (value);
				};

				_.addVideo = function( query ) {
					var value = _.get( query );
					preview.addVideo (value);
				};

				_.addImage = function( query ) {
					var value = _.get( query );
					preview.addImage (value);
				};

				_.addIcon = function( query ) {
					var value = _.get( query );
					preview.addIcon (value);
				};

				_.addPlainText = function( text ) {
					preview.addPlainText( text );
				}


				return _;
			}

			query.addHeadingLg = function( query ) {
				var value = this.get( query );
				preview.addHeadingLg (value);
			};

			query.addHeadingSm = function( query ) {
				var value = this.get( query );
				preview.addHeadingSm (value);
			};

			query.addText = function( query ) {
				var value = this.get( query );
				preview.addText (value);
			};

			query.addLink = function( query ) {
				var value = this.get( query );
				preview.addLink (value);
			};

			query.addVideo = function( query ) {
				var value = this.get( query );
				preview.addVideo (value);
			};

			query.addImage = function( query ) {
				var value = this.get( query );
				preview.addImage (value);
			};

			query.addIcon = function( query ) {
				var value = this.get( query );
				preview.addIcon (value);
			};

			query.addPlainText = function( text ) {
				preview.addPlainText( text );
			}


			return preview;
		},


		/**
		 * Get the options query object and inject proper data to it
		 * @returns {*}
		 */
		getOptionsQuery: function( data ) {
			var query = null;
			if( data == undefined ) {
				query = frslib.options.query( this.getOptionsDataJSON() );            // create options query
			} else {
				query = frslib.options.query( data );            // create options query
			}
			var structure = {};
			structure.data = _.extend({},this.model.get('optionsStructure'));

			query.setOptionsStructure(  structure ); // set options structure, in case we would need to get some default data
			return query;
		},

		/**
		 * get just the DATA attribute
		 * @returns {*}
		 */
		getOptionsData: function() {
			var data = this.$el.attr('data-options');


			//data = data.split('&amp;ffblt;').join("&lt;");
			//data = data.split('&amp;ffbgt;').join("&gt;");

			return data;
		},

		getOptionsDataJSON: function() {
			return JSON.parse( this.getOptionsData() );
		},

		getUniqueId: function() {
			return this.$el.attr('data-unique-id');
		},

		getElementId: function() {
			return this.$el.attr('data-element-id');
		}



	});

/**********************************************************************************************************************/
/* ELEMENT MODEL
/**********************************************************************************************************************/
	/**
	 * Element Model - having data about the element inside, including options structure and JS functions and all this stuff
	 */
	window.ffbuilder.ElementModel = Backbone.DeepModel.extend({
		/**
		 * functions are saved as strings, we create a functions from them
		 */
		processFunctions: function(){
			var self = this;
			$.each( this.get('functions'), function(key, value){

				var f = null; // temporary function holder

				eval('f = ' + value );
				self.set('functions.'+key, f);

			});
		}
	});



})(jQuery);