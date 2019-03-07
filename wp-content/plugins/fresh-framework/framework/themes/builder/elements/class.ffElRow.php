<?php

class ffElRow extends ffThemeBuilderElementBasic {
	protected function _initData() {
		$this->_setData( ffThemeBuilderElement::DATA_ID, 'row');

		$this->_setData( ffThemeBuilderElement::DATA_NAME, 'Row');
		$this->_setData( ffThemeBuilderElement::DATA_HAS_DROPZONE, true);

		$this->_addDropzoneWhitelistedElement('column');

		$this->_addParentWhitelistedElement('section');
	}

	protected function _getElementGeneralOptions( $s ) {
		$s->addElement( ffOneElement::TYPE_TABLE_START );
		$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Row Settings');
			$s->addOptionNL(ffOneOption::TYPE_CHECKBOX,'no-gutter','Remove horizontal spacing between Columns',0);
			$s->addOptionNL(ffOneOption::TYPE_CHECKBOX,'match-col','Equalize the height of all Columns (calculated from the tallest one)',0);
		$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);
		$s->addElement(ffOneElement::TYPE_TABLE_END);

	}

	protected function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData ) {

	}

	protected function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {

		$gutter = '';
		if($query->get('no-gutter')){
			$gutter = 'fg-row-no-gutter';
		}
		$match_col = '';
		if($query->get('match-col')){
			$match_col = 'fg-row-match-cols';
		}

		echo '<div class="fg-row row '.$gutter.' '.$match_col.'">';
			echo $this->_doShortcode( $content );
		echo '</div>';

	}

	protected function _renderContentInfo_JS() {
	?>
		<script data-type="ffscript">
			function ( query, options, $elementPreview, $element ) {

//                $element.find('.ffb-header-name:first').html('Normal Row - hovno');
//                $elementInfo.html('sdsdsdsd');
//                $elementInfo.html( '<h3>Text value:</h3>' + query.get('text') );


			}
		</script data-type="ffscript">
	<?php
	}


//    protected function _renderAdmin( ffOptionsQueryDynamic $query, $content, $data ) {
//        $id = $this->getID();
//
//        $dataCoded = htmlspecialchars(json_encode( $data ));
//        echo '<div class="ffb-element ffb-element-'.$id.' clearfix ffb-element--position--block" data-options="'.$dataCoded.'" data-element-id="'.$id.'">';
//
//            echo '<div class="ffb-header clearfix">';
//                echo '<div class="ffb-header-name">'.$id.'</div>';
//                echo '<div class="ffb-header__button action-toggle-context-menu dashicons dashicons-admin-generic"></div>';
//                echo '<div class="ffb-header__button action-edit-element dashicons dashicons-admin-customizer"></div>';
//            echo '</div>';
//
//            echo '<div class="ffb-element-info">';
//
//            echo '</div>';
//
//            echo '<div class="ffb-dropzone clearfix">';
//                echo do_shortcode( $content );
//            echo '</div>';
//
//        echo '</div>';
//    }

}