<?php

class ffElColumn extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'column');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, '1/3');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		$this->_addDropzoneBlacklistedElement('column');

		$this->_addTab('Advanced', array($this, '_advancedTab'));
	}

	protected function _getElementGeneralOptions( $s ) {

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$breakpoints = array(
				'xs' => 'Phone (XS)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
				'sm' => 'Tablet (SM)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
				'md' => 'Laptop (MD)&nbsp;&nbsp;&nbsp;',
				'lg' => 'Desktop (LG)&nbsp;&nbsp;',
			);

			/////////////////////////////////////////////////////////////////////////////////////
			// Width
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Column Width' );

				$default_values = array(
					'xs' => '12' ,
					'sm' => 'unset' ,
					'md' => '4' ,
					'lg' => 'unset' ,
				);

				foreach( $breakpoints as $bp => $bp_title ){

					$opt = $s->addOption(ffOneOption::TYPE_SELECT, $bp, $bp_title, $default_values[$bp] );
					if ( 'xs' != $bp ){
						$opt->addSelectValue($prev_bp, 'unset');
					}
					$opt->addSelectNumberRange(1,12);
					
					$s->addElement(ffOneElement::TYPE_HTML, '', ' / 12');
					// if ( 'md' == $bp ){
					// 	$s->addElement(ffOneElement::TYPE_HTML, '', '<sup> *</sup>');
					// }
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					// $prev_bp = 'Inherit from ' . strtoupper($bp);
					$prev_bp = 'Inherit';

				}

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'You can change the Laptop (MD) column width directly in the page builder by clicking on the left and right arrows in the Column element.');

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Center Content
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Center Content' );
				$s->addOption(ffOneOption::TYPE_CHECKBOX,'is-centered','Vertically center the content inside this column',0);
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Only works when the parent Row/Section element is set to equalize the height of all child Columns or if you manually set a fixed height for this column (in pixels).');
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Information
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Information');
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'All breakpoint related settings will be applied for that particular breakpoint and every other breakpoint that is larger. So for example the same Column Width applied on the Tablet (SM) breakpoint will be applied on the Laptop (MD) and Desktop (LG) breakpoints as well, but not on the Phone (XS) breakpoint. If you want to change this behaviour you can simply overwrite it by specifying a different value in the larger breakpoint.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Column <strong>Offset</strong> uses left padding to offset the Column.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Column <strong>Pull</strong> and <strong>Push</strong> allows you to change the order of your Columns for different breakpoints.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'More detailed information about the Bootstrap Grid can be found here: <a target="_blank" href="http://getbootstrap.com/css/#grid">http://getbootstrap.com/css/#grid</a>');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement(ffOneElement::TYPE_HTML, '', '–––––––––');
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '* This will apply "clearfix" after this Column to reset the floating. So the next Column after this one will be pushed onto a new line.');
				
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);


		$s->addElement( ffOneElement::TYPE_TABLE_END );



	}


	/**
	 * @param $s ffThemeBuilderOptionsExtender
	 */
	protected function _advancedTab( $s ) {	

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$breakpoints = array(
				'xs' => 'Phone (XS)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
				'sm' => 'Tablet (SM)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
				'md' => 'Laptop (MD)&nbsp;&nbsp;&nbsp;',
				'lg' => 'Desktop (LG)&nbsp;&nbsp;',
			);

			/////////////////////////////////////////////////////////////////////////////////////
			// Last Column
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Last Column' );

				$default_values = array(
					'xs' => 'no' ,
					'sm' => 'unset' ,
					'md' => 'unset' ,
					'lg' => 'unset' ,
				);

				foreach( $breakpoints as $bp => $bp_title ){

					$opt = $s->addOption(  ffOneOption::TYPE_SELECT, $bp.'-last', $bp_title, $default_values[$bp] );
					if ( 'xs' != $bp ){
						$opt->addSelectValue($prev_bp, 'unset');
					}
					$opt->addSelectValue('No', 'no');
					$opt->addSelectValue('Yes', 'yes');
					
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					// $prev_bp = 'Inherit from ' . strtoupper($bp);
					$prev_bp = 'Inherit';

				}

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'This will apply "clearfix" after this Column to reset the floating. So the next Column after this one will be pushed onto a new line.');

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Offset
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Column Offset' );

				$default_values = array(
					'xs' => '0' ,
					'sm' => 'unset' ,
					'md' => 'unset' ,
					'lg' => 'unset' ,
				);

				foreach( $breakpoints as $bp => $bp_title ){

					$opt = $s->addOption(  ffOneOption::TYPE_SELECT, $bp.'-offset', $bp_title, $default_values[$bp] );
					if ( 'xs' != $bp ){
						$opt->addSelectValue($prev_bp, 'unset');
						$opt->addSelectValue('0', '0');
					} else {
						$opt->addSelectValue('0', 'unset');
					}
					$opt->addSelectNumberRange(1,12);
					
					$s->addElement(ffOneElement::TYPE_HTML, '', ' / 12');
					
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					// $prev_bp = 'Inherit from ' . strtoupper($bp);
					$prev_bp = 'Inherit';

				}

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Offset uses left padding to offset the Column.');

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Pull
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Column Pull' );

				$default_values = array(
					'xs' => '0' ,
					'sm' => 'unset' ,
					'md' => 'unset' ,
					'lg' => 'unset' ,
				);

				foreach( $breakpoints as $bp => $bp_title ){

					$opt = $s->addOption(  ffOneOption::TYPE_SELECT, $bp.'-pull', $bp_title, $default_values[$bp] );
					if ( 'xs' != $bp ){
						$opt->addSelectValue($prev_bp, 'unset');
						$opt->addSelectValue('0', '0');
					} else {
						$opt->addSelectValue('0', 'unset');
					}
					$opt->addSelectNumberRange(1,12);
					
					$s->addElement(ffOneElement::TYPE_HTML, '', ' / 12');
					
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					// $prev_bp = 'Inherit from ' . strtoupper($bp);
					$prev_bp = 'Inherit';

				}

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Pull allows you to change the order of your Columns for different breakpoints.');

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Push
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Column Push' );

				$default_values = array(
					'xs' => '0' ,
					'sm' => 'unset' ,
					'md' => 'unset' ,
					'lg' => 'unset' ,
				);

				foreach( $breakpoints as $bp => $bp_title ){

					$opt = $s->addOption(  ffOneOption::TYPE_SELECT, $bp.'-push', $bp_title, $default_values[$bp] );
					if ( 'xs' != $bp ){
						$opt->addSelectValue($prev_bp, 'unset');
						$opt->addSelectValue('0', '0');
					} else {
						$opt->addSelectValue('0', 'unset');
					}
					$opt->addSelectNumberRange(1,12);
					
					$s->addElement(ffOneElement::TYPE_HTML, '', ' / 12');
					
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					// $prev_bp = 'Inherit from ' . strtoupper($bp);
					$prev_bp = 'Inherit';

				}

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Push allows you to change the order of your Columns for different breakpoints.');

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

			/////////////////////////////////////////////////////////////////////////////////////
			// Information
			/////////////////////////////////////////////////////////////////////////////////////

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Information');
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'All breakpoint related settings will be applied for that particular breakpoint and every other breakpoint that is larger. So for example the same Column Width applied on the Tablet (SM) breakpoint will be applied on the Laptop (MD) and Desktop (LG) breakpoints as well, but not on the Phone (XS) breakpoint. If you want to change this behaviour you can simply overwrite it by specifying a different value in the larger breakpoint.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Column <strong>Offset</strong> uses left padding to offset the Column.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Column <strong>Pull</strong> and <strong>Push</strong> allows you to change the order of your Columns for different breakpoints.');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'More detailed information about the Bootstrap Grid can be found here: <a target="_blank" href="http://getbootstrap.com/css/#grid">http://getbootstrap.com/css/#grid</a>');
				// $s->addElement( ffOneElement::TYPE_NEW_LINE );
				// $s->addElement(ffOneElement::TYPE_HTML, '', '–––––––––');
				// $s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '* This will apply "clearfix" after this Column to reset the floating. So the next Column after this one will be pushed onto a new line.');
				
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);


		$s->addElement( ffOneElement::TYPE_TABLE_END );

	}

	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {
		$multiAttrHelper->addParam('class', 'ffb-element-col-4');
	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {

		$classes = array();
		$clearfix_classes = array();
		$hasClearfix = false;
		$lastClearfix = 'no';

		foreach (array('xs', 'sm', 'md', 'lg') as $bp) {
			$col = $query->get($bp);
			if ($col != 'unset') {
				$classes[] = 'col-' . $bp . '-' . $col;
			}
			$offset = $query->get($bp . '-offset');
			if ($offset != 'unset') {
				$classes[] = 'col-' . $bp . '-offset-' . $offset;
			}
			$pull = $query->get($bp . '-pull');
			if ($pull != 'unset') {
				$classes[] = 'col-' . $bp . '-pull-' . $pull;
			}
			$push = $query->get($bp . '-push');
			if ($push != 'unset') {
				$classes[] = 'col-' . $bp . '-push-' . $push;
			}

			switch ( $query->get($bp . '-last') ) {
				case 'unset':
					if ( 'no' == $lastClearfix ) {
						break;
					}
				case 'yes':
					$hasClearfix = true;
					$clearfix_classes[] = 'visible-' . $bp;
					$lastClearfix = 'yes';
					break;
				case 'no':
					$lastClearfix = 'no';
					break;
			}

		}

		echo '<div class="fg-col ' . esc_attr(implode(' ', $classes)) . '">';

			if($query->get('is-centered')){
				echo '<div class="fg-vcenter-wrapper">';
					echo '<div class="fg-vcenter">';
			}
				
				echo $this->_doShortcode( $content );

			if($query->get('is-centered')){
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
		if($hasClearfix){
				echo '<div class="clearfix '.esc_attr( implode(' ', $clearfix_classes) ).'"></div>';
			}

	}

	protected function _renderContentInfo_JS() {
		?>
		<script data-type="ffscript">
			function ( query, options, $elementPreview, $element, blocks, elementModel, elementView ) {

				var getColumnValueForBreakpoint = function( breakpoint ) {
					if( breakpoint == undefined ) {
						breakpoint = 'md';
					}

					var optionsString = $element.attr('data-options');
					var options = JSON.parse( optionsString );

					return options.o.gen[breakpoint];
				};

				var setColumnValueForBreakpoint = function( value, breakpoint ) {
					if( breakpoint == undefined ) {
						breakpoint = 'md';
					}

					var optionsString = $element.attr('data-options');
					var options = JSON.parse( optionsString );

					options.o.gen[breakpoint] = value;

					var optionsNewString = JSON.stringify( options );

					$element.attr('data-options', optionsNewString );
				};

				var changeColumnAppearance = function( value ) {
					setColumnValueForBreakpoint( value );
					changeColumnName( value )

					elementView.canvasChanged()

					for( var i = 1; i <= 12; i++ ) {
						$element.removeClass('ffb-element-col-' + i);
					}

					$element.addClass( 'ffb-element-col-' + value );
				};

				var changeColumnName = function( value ) {
					var $header = $element.find('.ffb-header-name:first');
					$header.html( value + ' / 12');
				};


				$element.find('.action-column-smaller:first').off('click').click(function() {
					var currentValue = parseInt(getColumnValueForBreakpoint());

					if( currentValue == 1 ) {
						return false;
					}

					// Animate In

					$element.addClass('ffb-element-column-anim-width');
			        $element.one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(){
			            $element.removeClass('ffb-element-column-anim-width');
			        });

					currentValue--;
					changeColumnAppearance( currentValue );
				});

				$element.find('.action-column-bigger:first').off('click').click(function() {
					var currentValue = parseInt(getColumnValueForBreakpoint());

					if( currentValue == 12 ) {
						return false;
					}

					// Animate In

					$element.addClass('ffb-element-column-anim-width');
			        $element.one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(){
			            $element.removeClass('ffb-element-column-anim-width');
			        });

					currentValue++;
					changeColumnAppearance( currentValue );
				});

				//action-column-smaller //action-column-smaller


				changeColumnAppearance( query.get('md') );


			}
		</script data-type="ffscript">
		<?php
	}
}