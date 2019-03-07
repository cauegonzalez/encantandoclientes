<?php

class ffElSectionBootstrap extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'section-bootstrap');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Section (Bootstrap)');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		/*$this->_addDropzoneWhitelistedElement('row');
		$this->_addDropzoneWhitelistedElement('container');*/
	}


	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _getElementGeneralOptions( $s ) {
		$s->addElement( ffOneElement::TYPE_TABLE_START );
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Section Settings');
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Only works when the parent Row/Section element is set to equalize the height of all child Columns or if you manually set a fixed height for this column (in pixels).');
				$s->addOptionNL(ffOneOption::TYPE_SELECT,'type','Container Size: ','fg-container-large')
					->addSelectValue('Full Width','container-fluid')
					->addSelectValue('Small','fg-container-small')
					->addSelectValue('Medium','fg-container-medium')
					->addSelectValue('Large','fg-container-large')
				;
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);
		$s->addElement(ffOneElement::TYPE_TABLE_END);

	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {

		echo '<section class="fg-section" data-test="testik" id="xx" >';
			echo $this->_doShortcode( $content );
		echo '</section>';

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