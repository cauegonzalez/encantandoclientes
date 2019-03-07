<?php

/**
 * Class ffElColumn
 */
class ffElContentBlock extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'content-block');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Content Block');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		$this->_addDropzoneBlacklistedElement('column');
	}

	protected function _getElementGeneralOptions( $s ) {

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Content Block' );

				$s->addOption(ffOneOption::TYPE_POST_SELECTOR,'content-block','Content Block','')
					->addParam('post_type', 'ff-content-block-a')
					->addParam('load-dynamic', true)
				;

			$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);

		$s->addElement( ffOneElement::TYPE_TABLE_END );
	}

	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {
		$contentBlockId = $query->get('content-block');

		$contentBlock = $this->_getWPLayer()->get_post( $contentBlockId );
//		echo $contentBlock->post_content;
		echo $this->_doShortcode( $contentBlock->post_content );
//		return $this->_doShortcode( $contentBlock->post_content );
	}

	protected function _renderContentInfo_JS() {
		?>
		<script data-type="ffscript">
			function ( query, options, $elementPreview, $element, blocks, elementModel, elementView ) {

			}
		</script data-type="ffscript">
		<?php
	}
}