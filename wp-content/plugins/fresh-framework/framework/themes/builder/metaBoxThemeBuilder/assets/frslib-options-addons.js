(function($) {

    frslib.provide('frslib.options.themebuilder');
    frslib.provide('frslib.options.themebuilder');

/**********************************************************************************************************************/
/* INIT TABS
/**********************************************************************************************************************/

	/*----------------------------------------------------------*/
	/* INIT TABS
	/*----------------------------------------------------------*/
    frslib.options.themebuilder.initTabs = function( $options ) {
        $options.find('.ffb-modal__tabs').each(function(){

            //ffb-modal__tab-header--active
            //ffb-modal__tab-content--active

			// return;

            var $contents = $(this).children('.ffb-modal__tab-contents');
            var $headers = $(this).children('.ffb-modal__tab-headers');


            // copy headers from content to the header part
            var $headersToCopy = $contents.children('.ffb-modal__tab-header');
            $headersToCopy.appendTo(  $headers );


            var activateTabFromHeader = function ( $header ) {

                var index = $header.index();

                $headers.children('.ffb-modal__tab-header').removeClass('ffb-modal__tab-header--active');
                $header.addClass('ffb-modal__tab-header--active');

                $contents.children('.ffb-modal__tab-content').removeClass('ffb-modal__tab-content--active');
                $contents.children('.ffb-modal__tab-content').eq( index).addClass('ffb-modal__tab-content--active');

            };

            $headers.find('.ffb-modal__tab-header').click(function(){

                activateTabFromHeader( $(this) );

            });



        });
    };
    frslib.callbacks.addCallback( 'initOneOptionSet', frslib.options.themebuilder.initTabs );

	/*----------------------------------------------------------*/
	/* INIT COLOR WITH LIB
	/*----------------------------------------------------------*/
	frslib.options.themebuilder.initColorWithLib = function( $options ) {

        // SPECTRUM - START

        var self = this;
        // var colorLibrary = this.vent.o.dataManager.getColorLibrary();

        /*----------------------------------------------------------*/
        /* GENERATE THE HTML CODE FOR THE LIBRARY
        /*----------------------------------------------------------*/
        var generateColorPickerHTML = function() {
            var input = '';
            input += '<div class="fftm__option-type--color-picker__window fftm__option-type--color-picker__picker-tab--active--picker clearfix">';
                input += '<div class="fftm__option-type--color-picker__header clearfix">';
                    input += '<div class="fftm__option-type--color-picker__library-tabs clearfix"><label><input class="fftm__option-type--color-picker__use-library" type="checkbox"> Use Color Library</label></div>';
                    input += '<div class="fftm__option-type--color-picker__picker-tabs clearfix">';
                        input += '<div class="fftm__option-type--color-picker__picker-tab fftm__option-type--color-picker__picker-tab__picker">Picker</div>';
                        input += '<div class="fftm__option-type--color-picker__picker-tab fftm__option-type--color-picker__picker-tab__palette">Palette</div>';
                    input += '</div>';
                input += '</div>';
                input += '<input type="text" class="fftm__option-type--color-picker__picker" />';
                input += '<div class="fftm__option-type--color-picker__library clearfix">';
                    input += '<div class="fftm__option-type--color-picker__library-colors clearfix">';

						var colorLibrary = window.ffbuilder.appInstance.colorLibrary;
			
                        // for( var letter = 65; letter < (65 + 8); letter++ ) {
                            for( var number = 1; number <= 50; number++ ) {
                                // var sign = String.fromCharCode(letter) + number;

								var color = colorLibrary[ number ];
								var value = color[ 'color' ];

                                if( value == null ) {
                                    value = '#f5f5f5';
                                }

                                input += '<div class="fftm__option-type--color-picker__library-color fftm__option-type--color-picker__library-color-'+ number +'" data-color-position="'+number+'" data-color-name="" data-color-tooltip="">';
                                    input += '<div style="background-color:'+value+';" class="fftm__option-type--color-picker__library-color-preview"></div>';
                                input += '</div>';

                            }
                        // }

                    input += '</div>';
                    input += '<div class="fftm__option-type--color-picker__library-color-position">49</div>';
                    input += '<input type="text" class="fftm__option-type--color-picker__library-color-name" placeholder="Color label" />';
                    input += '<div class="fftm__option-type--color-picker__no-library-text"></div>';
                input += '</div>';
                input += '<div class="fftm__option-type--color-picker__palette">';

                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #ffffff;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #f5f5f5;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #cccccc;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #444444;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #000000;"></div>';
                    
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #ff3300;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #E91E63;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #9C27B0;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #673AB7;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #3F51B5;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #2196F3;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #03A9F4;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #00BCD4;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #009688;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #4CAF50;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #8BC34A;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #CDDC39;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFEB3B;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFC107;"></div>';
                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FF9800;"></div>';

                    input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FF5722;"></div>';

                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #795548;"></div>';


                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #795548;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #5D4037;"></div>';


                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #9E9E9E;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #607D8B;"></div>';


                    
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #1abc9c;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #2ecc71;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #3498db;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #9b59b6;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #34495e;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #16a085;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #27ae60;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #2980b9;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #8e44ad;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #2c3e50;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #f1c40f;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #e67e22;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #e74c3c;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #ecf0f1;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #95a5a6;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #f39c12;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #d35400;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #c0392b;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #bdc3c7;"></div>';


                    
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #ffcdd2;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #F8BBD0;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #E1BEE7;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #D1C4E9;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #C5CAE9;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #BBDEFB;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #B3E5FC;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #B2EBF2;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #B2DFDB;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #C8E6C9;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #DCEDC8;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #F0F4C3;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFF9C4;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFECB3;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFE0B2;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FFCCBC;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #D7CCC8;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #F5F5F5;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #CFD8DC;"></div>';


                    
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #b71c1c;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #880E4F;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #4A148C;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #311B92;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #1A237E;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #0D47A1;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #01579B;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #006064;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #004D40;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #1B5E20;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #33691E;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #827717;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #F57F17;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #FF6F00;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #E65100;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #BF360C;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #3E2723;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #212121;"></div>';
                    // input += '<div class="fftm__option-type--color-picker__palette-color" style="background-color: #263238;"></div>';





                input += '</div>';
            input += '</div>';

            return input;
        };



        $options.find('.fftm__option-type--color-picker').each(function(){

            var $this = $(this);
            var $dataInput = $(this).find('.fftm__option-type--input');
			var $previewColor = $(this).find('.fftm__option-type--color-picker__select-preview-color');

			var colorSelected = $dataInput.val();


			// console.log( colorSelected );
			//
            // Change QTIP z-index, needs to be done before calling .qtip();
            $.fn.qtip.zindex = 999999; // Non-modal z-index
            $.fn.qtip.modal_zindex = 999800; // Modal-specific z-index

            $(this).find('.fftm__option-type--color-picker__select').qtip({
                content: {
                    text: function(){
						var $input = $(generateColorPickerHTML());

						var colorPickerViewObject = Backbone.View.extend({

							$el : null,

							$dataInput : null,

							$previewColor : null,

							/**
							 * Selected color from library
							 */
							$selectedColor: null,

							bindActions: function() {
								var self = this;
								var $el = this.$el;

								$el.find('.fftm__option-type--color-picker__picker-tab__picker').on('click', function(){
									$el.removeClass('fftm__option-type--color-picker__picker-tab--active--palette').addClass('fftm__option-type--color-picker__picker-tab--active--picker');
								});

								$el.find('.fftm__option-type--color-picker__picker-tab__palette').on('click', function(){
									$el.removeClass('fftm__option-type--color-picker__picker-tab--active--picker').addClass('fftm__option-type--color-picker__picker-tab--active--palette');
								});

								$el.find('.fftm__option-type--color-picker__library-color').on('click', function(){
									var colorNumber = $(this).attr('data-color-position');

									self.applyColorFromLibrary( colorNumber );
								});

								$el.find('.fftm__option-type--color-picker__use-library').on('click', function(){
									if( $(this).prop('checked') ) {
										self.enableColorLibrary();
										self.applyColorFromLibrary('1');
									} else {
										$el.removeClass('fftm__option-type--color-picker--library-color-is-active');
										self.disableColorLibrary();
									}
								});


								$el.find('.fftm__option-type--color-picker__library-color-name').on('keypress', function(){
									var colorPosition = this.getCurrentColorPosition();
									var newName = $(this).val();
									// console.log( $(this).val() );

									this.setColorNameToLibrary( colorPosition, newName );
								});
							},

							initialize: function( params ) {
								this.$el = params.$el;
								this.$dataInput = params.$dataInput;
								this.$previewColor = params.$previewColor;
								// alert( params.$dataInput.val());
								this.bindActions();

								this.initColorPicker( this.getColorValueFromInput() );

								if( this.isColorValueInLibrary() ) {
									this.enableColorLibrary();
									this.applyColorFromLibrary( this.getColorValueFromInput() );
								}
							},

							applyColorFromLibrary: function( libraryPosition ) {
								if( libraryPosition.indexOf('[') != -1 ) {
									libraryPosition = libraryPosition.replace('[', '').replace(']', '');
								}


								var colorObject=  this.getColorObjectFromLibrary( libraryPosition );

								var color = colorObject.color;

								// change the name and description first
								this.$el.find('.fftm__option-type--color-picker__library-color-name').val( colorObject.name + 'ds');
								this.$el.find('.fftm__option-type--color-picker__library-color-position').html( libraryPosition );

								this.$el.find('.fftm__option-type--color-picker__library-color').removeClass('fftm__option-type--color-picker__library-color--active');
								this.$el.find('.fftm__option-type--color-picker__library-color-' + libraryPosition).addClass('fftm__option-type--color-picker__library-color--active');

								this.$selectedColor = this.$el.find('.fftm__option-type--color-picker__library-color-' + libraryPosition);


								this.setColorPickerColor( color );
								this.setColorValueToInput( color );
								// console.log( colorObject );
							},

							initColorPicker: function( colorSelected ) {
								var self = this;

								if( colorSelected.indexOf('[') != -1 ) {
									colorSelected = this.getColorObjectFromLibrary( colorSelected ).color;


								}

								this.$el.find('.fftm__option-type--color-picker__picker').spectrum({
								    // color: getHiddenInputValue( true ),
								    color: colorSelected,
								    flat: true,
								    showAlpha: true,
								    showInput: true,
								    showInitial: true,
								    // allowEmpty:true,
								    preferredFormat: "hex",
									move: function( color ){
										self.colorPickerChanged( color );
									}
								    // move: function( color ){
								    //     if( $actualColorLib == null ) {
								    //         setVisibleInputPreviewValue( color );
								    //         setHiddenInputValue( color );
								    //         self.submitForm();
								    //     } else {
								    //         var libraryPosition = $actualColorLib.attr('data-color-position');

								    //         $actualColorLib.find('.fftm__option-type--color-picker__library-color-preview').css('background-color', color.toString());
								    //         changeColorInLibrary( libraryPosition, color );
								    //         setVisibleInputPreviewValue( color );
								    //         setHiddenInputValue( 'lib-' + libraryPosition);
								    //         self.submitForm();
								    //         // self.vent.trigger('picopico');
								    //     }
								    // }
								});
							},

							enableColorLibrary: function() {
								this.$el.addClass('fftm__option-type--color-picker--library-color-is-active');
								this.$el.find('.fftm__option-type--color-picker__use-library').prop('checked', 'checked');

								// this.applyColorFromLibrary( 1 );
							},

							disableColorLibrary: function() {
								this.$el.removeClass('fftm__option-type--color-picker--library-color-is-active');
								this.$el.find('.fftm__option-type--color-picker__use-library').prop('checked', '');
								var currentColorPosition = this.$selectedColor.attr('data-color-position');

								var currentColor = this.getColorValueFromLibrary( currentColorPosition );
								this.$selectedColor = null;
								this.setColorValueToInput( currentColor );
							},

							setColorPickerColor : function( color ) {
							    $input.find('.fftm__option-type--color-picker__picker').spectrum('set', color );
							    $input.find('.fftm__option-type--color-picker__picker').spectrum('reflow');
							},


							colorPickerChanged: function( color ) {
								var colorString = color.toString();
								this.setColorValueToInput( colorString );

								if( this.$selectedColor != null ) {
									this.$selectedColor.children().css('background', colorString );
									// this.$selectedColor.attr
									this.setColorValueToLibrary(this.$selectedColor.attr('data-color-position'), colorString );
								}
							},

							getColorLibrary: function() {
								return window.ffbuilder.appInstance.colorLibrary;
							},

							getColorValueFromLibrary: function( position ) {
								return this.getColorObjectFromLibrary( position ).color;
							},

							getColorObjectFromLibrary: function( position ) {

								if( position.indexOf('[') != -1 ) {
									position = position.replace('[', '').replace(']', '');
								}

								return this.getColorLibrary() [ position ];
							},

							setColorValueToLibrary: function( position, color ) {
								window.ffbuilder.appInstance.colorLibrary[position]['color'] = color;
							},

							setColorNameToLibrary: function( position, name ) {
								window.ffbuilder.appInstance.colorLibrary[position]['name'] = name;
							},

							isColorValueInLibrary: function() {
								var colorValue = this.getColorValueFromInput();
								if( colorValue.indexOf('[') != -1 ) {
									return true;
								} else {
									return false;
								}
							},

							getCurrentColorPosition: function () {
								if( this.$selectedColor != null ) {
									return this.$selectedColor.attr('data-color-position');
								} else {
									return this.$selectedColor;
								}
							},

							getColorValueFromInput: function() {
								return this.$dataInput.val();
							},

							setColorValueToInput: function( color ) {
								if( this.$selectedColor != null ) {
									var colorPosition = this.$selectedColor.attr('data-color-position');
									this.$dataInput.val( '[' + colorPosition + ']' );
								} else {
									this.$dataInput.val( color );
								}

								this.$previewColor.css('background', color);
							},

						});


						var colorPickerView = new colorPickerViewObject({$el : $input, $dataInput : $dataInput, $previewColor: $previewColor});

						return $input;






                        var $self = $(this);

                        var $actualColorLib = null;
						var $useLibraryCheckbox = $input.find('.fftm__option-type--color-picker__use-library');


						$input.find('.fftm__option-type--color-picker__picker-tab__picker').on('click', function(){
							$input.removeClass('fftm__option-type--color-picker__picker-tab--active--palette').addClass('fftm__option-type--color-picker__picker-tab--active--picker');
						});

						$input.find('.fftm__option-type--color-picker__picker-tab__palette').on('click', function(){
							$input.removeClass('fftm__option-type--color-picker__picker-tab--active--picker').addClass('fftm__option-type--color-picker__picker-tab--active--palette');
						});


						// var enableColorLibrary = function() {
						// 	$useLibraryCheckbox.prop('checked')
						//
						// }



						$input.find('.fftm__option-type--color-picker__library-color').on('click', function(){
							alert('click');
						});


						var changeColorInInput = function( color, libraryPosition ) {
							$dataInput.val( color );
							$previewColor.css('background', color).css('color', frslib.colors.contrast(color) ).html('49');
						}


						var colorPickerChanged = function( color ) {

							var colorString = color.toString();
							// change input value
							// change color preview
							// change color library

							changeColorInInput( colorString );

						}

                        /*----------------------------------------------------------*/
                        /* COLOR LIB SELECTION
                        /*----------------------------------------------------------*/
                        // var selectColorLib = function( position ) {
                        //     if( position != undefined ) {
                        //         $actualColorLib = $input.find('.fftm__option-type--color-picker__library-color[data-color-position="'+ position +'"]')

                        //     }
                        //     position = 'lib-' + $actualColorLib.attr('data-color-position');
                        //     var color = getColorFromLibraryField();

                        //     $input.find('.fftm__option-type--color-picker__library-color').removeClass('fftm__option-type--color-picker__library-color--active');
                        //     $actualColorLib.addClass('fftm__option-type--color-picker__library-color--active');

                        //     setSpectrumColor( color );
                        //     setVisibleInputPreviewValue( color );
                        //     setHiddenInputValue( position );

                        //     self.submitForm();
                        // };

                        // var deselectColorLib = function() {
                        //     $actualColorLib.removeClass('fftm__option-type--color-picker__library-color--active');
                        //     $actualColorLib = null;
                        // };

                        // $input.find('.fftm__option-type--color-picker__library-color').click(function(){
                        //     if( $(this).hasClass('fftm__option-type--color-picker__library-color--active') ) {
                        //         deselectColorLib();
                        //     } else {
                        //         $actualColorLib = $(this);
                        //         selectColorLib();
                        //     }
                        // });

                        /*----------------------------------------------------------*/
                        /* COLOR LIB
                        /*----------------------------------------------------------*/
                        // var changeColorInLibrary = function( position, newColor ) {
                        //     return self.vent.o.dataManager.setColorToLibrary(position, newColor.toString() );
                        // };

                        // var getColorFromLibrary = function( position ) {
                        //     return self.vent.o.dataManager.getColorFromLibrary(position );
                        // };

                        // var makeSureItsHTMLColor = function( color ) {
                        //     if( color.indexOf('lib-') != -1 ) {
                        //         var position = color.replace('lib-', '');

                        //         return getColorFromLibrary( position );
                        //     } else {
                        //         return color;
                        //     }
                        // };

                        // var getColorFromLibraryField = function() {
                        //     var position = $actualColorLib.attr('data-color-position');

                        //     return getColorFromLibrary( position );
                        // };

                        /*----------------------------------------------------------*/
                        /* HIDDEN SELECT
                        /*----------------------------------------------------------*/
                        // var getHiddenInputValue = function( shouldBeColorNotLibrary ) {
                        //     var value = $self.find('.fftm__option-type--input').val();
                        //     if( shouldBeColorNotLibrary == true ) {
                        //         makeSureItsHTMLColor( value );
                        //     } else {
                        //         return value;
                        //     }

                        // };
                        // var setHiddenInputValue = function( value ) {
                        //     $self.find('.fftm__option-type--input').val( value );
                        // };

                        /*----------------------------------------------------------*/
                        /* VISIBLE PREVIEW
                        /*----------------------------------------------------------*/
                        // var setVisibleInputPreviewValue = function( value ) {
                        //     $self.find('.fftm__option-type--color-picker__select-preview-color').css('background', value );
                        // };


                        // var setSpectrumColor = function( color ) {
                        //     $input.find('.fftm__option-type--color-picker__picker').spectrum('set', color );
                        //     $input.find('.fftm__option-type--color-picker__picker').spectrum('reflow');
                        // };
						//
						// console.log( colorSelected );
						//
                        // $input.find('.fftm__option-type--color-picker__picker').spectrum({
                        //     // color: getHiddenInputValue( true ),
                        //     color: colorSelected,
                        //     flat: true,
                        //     showAlpha: true,
                        //     showInput: true,
                        //     showInitial: true,
                        //     // allowEmpty:true,
                        //     preferredFormat: "hex",
							// move: colorPickerChanged
                        //     // move: function( color ){
                        //     //     if( $actualColorLib == null ) {
                        //     //         setVisibleInputPreviewValue( color );
                        //     //         setHiddenInputValue( color );
                        //     //         self.submitForm();
                        //     //     } else {
                        //     //         var libraryPosition = $actualColorLib.attr('data-color-position');
						//
                        //     //         $actualColorLib.find('.fftm__option-type--color-picker__library-color-preview').css('background-color', color.toString());
                        //     //         changeColorInLibrary( libraryPosition, color );
                        //     //         setVisibleInputPreviewValue( color );
                        //     //         setHiddenInputValue( 'lib-' + libraryPosition);
                        //     //         self.submitForm();
                        //     //         // self.vent.trigger('picopico');
                        //     //     }
                        //     // }
                        // });

                        // var initColorPicker = function() {
                        //     var hiddenInput = getHiddenInputValue( false );

                        //     // is color from library
                        //     if( hiddenInput.indexOf('lib-') != -1 ) {
                        //         selectColorLib( hiddenInput.replace('lib-', '') );
                        //     }

                        // };

                        // initColorPicker();

                        return $input;

                    }
                },
                show: {
                    event: 'click',
                    effect: false, // disable fading animation
                    modal: {
                        on: true, // turn on modal plugin
                        effect: false, // disable fading animation
                        blur: true, // hide tooltip by clicking backdrop
                        escape: true // hide tooltip when ESC pressed
                    }
                },
                hide: {
                    event: 'unfocus',
                    effect: false, // disable fading animation
                },
                position: {
                    target: 'mouse',
                    adjust: {
                        mouse: false // not following the mouse
                    },
                    viewport: $(window) // force tooltip to stay inside viewport
                },
                style: {
                    tip: {
                        corner: false
                    },
                    classes: ''
                },
                events: {
                    render: function(event, api) {
                        // Grab the overlay element
                        var elem = api.elements.overlay;
                        // Add class
                        elem.find('div').addClass('qtip-overlay-minimal');
                    },

                    show: function( event, api ) {
						setTimeout( function(){
							$(event.target).find('.fftm__option-type--color-picker__picker').spectrum('reflow');
						}, 200);
                    },
                }
            });
        });

        // SPECTRUM - END

		$options.find('.ffb-modal__tabs').each(function(){

		});
	};
	frslib.callbacks.addCallback( 'initOneOptionSet', frslib.options.themebuilder.initColorWithLib );


    $(document).on('click', '.ffb-modal-opener-button', function() {

        $(this).parent().children('.ffb-modal').css('display', 'block');

    });

    $(document).on('click', '.ffb-modal__action-done', function(e) {
        if(e.target != this) return;
        $(this).parents('.ffb-modal:first').css('display', 'none');
        $(this).parents('.ff-repeatable-item:first').removeClass('ff-repeatable-item-closed__open-popup');
    });

    $(document).on('click', '.ff-show-advanced-tools', function(e){

        var $parent = $(this).parents('.ff-repeatable-item:first');

        if( $parent.hasClass('ff-repeatable-item-closed') ) {
            $parent.addClass('ff-repeatable-item-closed__open-popup');
        }

        e.stopPropagation();

        $(this).parents('.ff-repeatable-item:first').find('.ff-advanced-options:first').find('.ffb-modal:first').css('display','block');

        return false;

    });


})(jQuery);