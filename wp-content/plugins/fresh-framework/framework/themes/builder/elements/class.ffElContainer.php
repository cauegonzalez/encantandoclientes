<?php

class ffElContainer extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'container');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Container');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		$this->_addDropzoneWhitelistedElement('row');
	}


	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _getElementGeneralOptions( $s ) {
		$s->addElement( ffOneElement::TYPE_TABLE_START );
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Container Settings');
				$s->addOptionNL(ffOneOption::TYPE_SELECT,'type','Container Size: ','fg-container-large')
					->addSelectValue('Full Width','container-fluid')
					->addSelectValue('Small','fg-container-small')
					->addSelectValue('Medium','fg-container-medium')
					->addSelectValue('Large','fg-container-large')
				;
				$s->addOption(ffOneOption::TYPE_CHECKBOX,'no-h-padding','Remove horizontal padding',0);
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);
		$s->addElement(ffOneElement::TYPE_TABLE_END);
	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {


		$gutter = '';
		if($query->get('no-h-padding')){
			$gutter = 'fg-container-no-h-padding';
		}
		echo '<div class="fg-container container '.$query->get('type').' '.$gutter.'">';
			echo $this->_doShortcode( $content );
		echo '</div>';


	}



		protected function _renderContentInfo_JS() {
	?>
		<script data-type="ffscript">
			function ( query, options, $elementPreview, $element ) {


//                var content = query.get('select');

//                $elementPreview.html( 'sdsdsds' );


			}
		</script data-type="ffscript">
	<?php
	}

}