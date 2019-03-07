<?php

class ffElWrapper extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'wrapper');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Wrapper');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		//$this->_addDropzoneWhitelistedElement('row');
		//$this->_addDropzoneWhitelistedElement('container');
	}


	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _getElementGeneralOptions( $s ) {
		$s->addElement( ffOneElement::TYPE_TABLE_START );
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Wrapper Settings');
				$s->addOption(ffOneOption::TYPE_TEXT,'text','Text','Text');
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);
		$s->addElement(ffOneElement::TYPE_TABLE_END);

	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {

		echo '<div class="fg-wrapper">';
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