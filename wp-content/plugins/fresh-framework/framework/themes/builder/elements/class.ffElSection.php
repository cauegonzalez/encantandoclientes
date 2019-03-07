<?php

class ffElSection extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'section');
		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Section');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		$this->_addDropzoneWhitelistedElement('row');
		$this->_addDropzoneWhitelistedElement('container');
	}


	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _getElementGeneralOptions( $s ) {
		$s->addElement( ffOneElement::TYPE_TABLE_START );
			$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Section Settings');
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

		$gutterContainer = '';
		if($query->get('no-gutter')){
			$gutterContainer = 'fg-container-no-gutter';
		}

		$gutterRow = '';
		if($query->get('no-gutter')){
			$gutterRow = 'fg-row-no-gutter';
		}
		$match_col = '';
		if($query->get('match-col')){
			$match_col = 'fg-row-match-cols';
		}


		echo '<section class="fg-section" data-test="testik" id="xx" >';
			echo '<div class="fg-container container '.$query->get('type').' '.$gutterContainer.'">';
				echo '<div class="fg-row row '.$gutterRow.' '.$match_col.'">';
					echo $this->_doShortcode( $content );
				echo '</div>';
			echo '</div>';
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