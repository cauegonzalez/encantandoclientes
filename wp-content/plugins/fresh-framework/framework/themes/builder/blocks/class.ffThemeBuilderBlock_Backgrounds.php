<?php

class ffThemeBuilderBlock_Backgrounds extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
//	const PARAM_RETURN_AS_STRING = 'return_as_string';
//	const PARAM_WRAP_BY_MODAL = 'wrap_by_modal';
//	const PARAM_CSS_CLASS = 'css_class';
/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	protected function _init() {
		$this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'backgrounds');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'bg');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAP_AUTOMATICALLY, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, true);
	}
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/
//	public function wrapByModal() {
//		$this->setParam( ffThemeBuilderBlock_AdvancedTools::PARAM_WRAP_BY_MODAL, true );
//		return $this;
//	}
/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	protected function _render( $query ) {

//		if($this->_queryIsEmpty()){
//			return;
//		}

		$allBackgrounds = array();

		$breakpoints = array('xs','sm','md','lg');
		if( $query->queryExists('bg') ) {

			foreach ($query->get('bg') as $oneLayer) {
				$oneBackground = array();
				switch ($oneLayer->getVariationType()) {
					case 'color':
						$oneBackground['type'] = 'color';
						$oneBackground['opacity'] = $oneLayer->getWithoutComparationDefault('opacity', 1);
						$oneBackground['color'] = $oneLayer->getWithoutComparationDefault('bg-color', '#24e2e2');
						foreach ($breakpoints as $bp) {
							if ($oneLayer->getWithoutComparationDefault($bp)) {
								$oneBackground['hidden_' . $bp] = 'yes';
							}
						}
						if ($oneLayer->getWithoutComparation('hover-only', 0)) {
							$oneBackground['hover_only'] = 'yes';
						}
						break;

					case 'image':
						$oneBackground['type'] = 'image';
						$oneBackground['opacity'] = $oneLayer->getWithoutComparationDefault('opacity', '1');
						$oneBackground['url'] = $oneLayer->getImage('image')->url;
						$oneBackground['size'] = $oneLayer->getWithoutComparationDefault('size', 'cover');
						$oneBackground['repeat'] = $oneLayer->getWithoutComparationDefault('repeat', 'no-repeat');
						$oneBackground['attachment'] = $oneLayer->getWithoutComparationDefault('attachment', 'fixed');

						foreach ($breakpoints as $bp) {
							if ($oneLayer->getWithoutComparationDefault($bp)) {
								$oneBackground['hidden_' . $bp] = 'yes';
							}
						}
						$oneBackground['position'] = $oneLayer->getWithoutComparationDefault('bgpos', 'center center');
						if ($oneLayer->getWithoutComparation('hover-only', 0)) {
							$oneBackground['hover_only'] = 'yes';
						}
						break;

					case 'video':
						$oneBackground['type'] = 'video';
						$oneBackground['opacity'] = $oneLayer->getWithoutComparationDefault('opacity', '1');
						$oneBackground['variant'] = $oneLayer->getWithoutComparationDefault('variant', 'youtube');
						$oneBackground['url'] = $oneLayer->getWithoutComparationDefault('url');
						$oneBackground['width'] = $oneLayer->getWithoutComparationDefault('width', '16');
						$oneBackground['height'] = $oneLayer->getWithoutComparationDefault('height', '9');

						foreach ($breakpoints as $bp) {
							if ($oneLayer->getWithoutComparationDefault($bp)) {
								$oneBackground['hidden_' . $bp] = 'yes';
							}
						}
						if ($oneLayer->getWithoutComparation('hover-only', 0)) {
							$oneBackground['hover_only'] = 'yes';
						}
						if ($oneLayer->getWithoutComparationDefault('shield-on', 0)) {
							$oneBackground['shield'] = 'on';
						}
						break;

					case 'slant':
						$oneBackground['type'] = 'slant';
						$oneBackground['opacity'] = $oneLayer->getWithoutComparationDefault('opacity', '1');
						$oneBackground['color'] = $oneLayer->getWithoutComparationDefault('slant-color', '#24e2e2');
						$oneBackground['edge'] = $oneLayer->getWithoutComparationDefault('edge', 'top');
						$oneBackground['direction'] = $oneLayer->getWithoutComparationDefault('direction', 'up');
						$oneBackground['angle'] = $oneLayer->getWithoutComparationDefault('angle', '15');

						foreach ($breakpoints as $bp) {
							if ($oneLayer->getWithoutComparationDefault($bp)) {
								$oneBackground['hidden_' . $bp] = 'yes';
							}
						}
						if ($oneLayer->getWithoutComparation('hover-only', 0)) {
							$oneBackground['hover_only'] = 'yes';
						}
						break;

					case 'parallax':
						$oneBackground['type'] = 'parallax';
						$oneBackground['url'] = $oneLayer->getImage('image')->url;
//						$size = fImg::getImgSize($oneLayer->getImage('image')->url);
						$size = array(100,100);
						$oneBackground['opacity'] = $oneLayer->getWithoutComparationDefault('opacity', '1');
						$oneBackground['width'] = '' . $size[0] . '';
						$oneBackground['height'] = '' . $size[1] . '';
						$oneBackground['speed'] = $oneLayer->getWithoutComparationDefault('speed', '50');
						$oneBackground['size'] = $oneLayer->getWithoutComparationDefault('size', 'cover');
						
						$oneBackground['offset_h'] = $oneLayer->getWithoutComparationDefault('h', '50');
						$oneBackground['offset_v'] = $oneLayer->getWithoutComparationDefault('v', '50');

						foreach ($breakpoints as $bp) {
							if ($oneLayer->getWithoutComparationDefault($bp)) {
								$oneBackground['hidden_' . $bp] = 'yes';
							}
						}
						if ($oneLayer->getWithoutComparation('hover-only', 0)) {
							$oneBackground['hover_only'] = 'yes';
						}
						break;
				}
				$allBackgrounds[] = $oneBackground;
			}
		}

		$allBackgrounds = apply_filters('ffb-backgrounds', $allBackgrounds );

		if( !empty( $allBackgrounds ) ) {

			$element = $this->_getAssetsRenderer()->getElementHelper();
			$backgroundsJson = json_encode($allBackgrounds);

			$element->setAttribute('data-fg-bg', htmlspecialchars($backgroundsJson) );
		}
	}


	protected function _renderContentInfo_JS() {
		?>
		<script data-type="ffscript">
			function ( query ) {
				console.log('backgroundBlock');
			}
		</script data-type="ffscript">
		<?php
	}


	protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Backgrounds');

			$s->startSection('bg', ffOneSection::TYPE_REPEATABLE_VARIABLE )
				->addParam('can-be-empty', true)
				->addParam('work-as-accordion', true)
				->addParam('all-items-opened', true)
			;

				$s->startSection('color', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', 'Color');

					$s->addOptionNL( ffOneOption::TYPE_COLOR_PICKER_WP, 'bg-color', '', '#24e2e2');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', 1)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Opacity of this background layer'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Opacity can be between <code>0</code> and <code>1</code>, with a step of <code>0.01</code>. Valid example: <code>0.57</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'hover-only', 'Show this layer only on mouse hover', 0);
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'xs', 'Hide on Phone (XS)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'sm', 'Hide on Tablet (SM)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'md', 'Hide on Laptop (MD)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'lg', 'Hide on Desktop (LG)', 0);

				$s->endSection();


				$s->startSection('image', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', 'Image');

					$s->addOptionNL( ffOneOption::TYPE_IMAGE, 'image', 'Background image', '');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', 1)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Opacity of this background layer'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Opacity can be between <code>0</code> and <code>1</code>, with a step of <code>0.01</code>. Valid example: <code>0.57</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'size', '', 'cover')
						->addSelectValue('cover', 'cover')
						->addSelectValue('auto', 'auto')
						->addSelectValue('contain', 'contain')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Background size')
					;

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'bgpos', '', 'center center')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Background position'))
					;

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'repeat', '', 'no-repeat')
						->addSelectValue('no-repeat', 'no-repeat')
						->addSelectValue('repeat', 'repeat')
						->addSelectValue('repeat-x', 'repeat-x')
						->addSelectValue('repeat-y', 'repeat-y')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Background repeat')
					;

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'attachment', '', 'scroll')
						->addSelectValue('scroll', 'scroll')
						->addSelectValue('fixed', 'fixed')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Background attachment')
					;
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'hover-only', 'Show this layer only on mouse hover', 0);
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'xs', 'Hide on Phone (XS)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'sm', 'Hide on Tablet (SM)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'md', 'Hide on Laptop (MD)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'lg', 'Hide on Desktop (LG)', 0);
				$s->endSection();

				$s->startSection('video', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', 'Video');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'variant', '', 'youtube')
						->addSelectValue('YouTube', 'youtube')
						->addSelectValue('Local file (.mp4, .webm)', 'html')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Video source')
					;

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'url', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('URL path of your YouTube or local video'))
					;
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', 1)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Opacity of this background layer'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Opacity can be between <code>0</code> and <code>1</code>, with a step of <code>0.01</code>. Valid example: <code>0.57</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'width', '', 16)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Aspect ratio width of your video'))
						->addParam('short', true)
					;
					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'height', '', 9)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Aspect ratio height of your video'))
						->addParam('short', true)
					;
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'shield-on', 'Prevent clicking on/interacting with the video', 1);

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'hover-only', 'Show this layer only on mouse hover', 0);
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'xs', 'Hide on Phone (XS)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'sm', 'Hide on Tablet (SM)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'md', 'Hide on Laptop (MD)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'lg', 'Hide on Desktop (LG)', 0);

				$s->endSection();

				$s->startSection('slant', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', 'Slant');

					$s->addOptionNL( ffOneOption::TYPE_COLOR_PICKER_WP, 'slant-color', '', '#24e2e2');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', 1)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Opacity of this background layer'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Opacity can be between <code>0</code> and <code>1</code>, with a step of <code>0.01</code>. Valid example: <code>0.57</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'edge', '', 'top')
						->addSelectValue('Top', 'top')
						->addSelectValue('Right', 'right')
						->addSelectValue('Bottom', 'bottom')
						->addSelectValue('Left', 'left')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Edge')
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Choose the edge of the Element on which you want the Slant to be');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'direction', '', 'up')
						->addSelectValue('Up', 'up')
						->addSelectValue('Down', 'down')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Direction')
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Choose if you want the Slant to be an upwards or downwards slope');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'angle', '', 15)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Angle'))
					;					
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','The angle of the Slant, must be between <code>0</code> and <code>90</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'hover-only', 'Show this layer only on mouse hover', 0);
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'xs', 'Hide on Phone (XS)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'sm', 'Hide on Tablet (SM)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'md', 'Hide on Laptop (MD)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'lg', 'Hide on Desktop (LG)', 0);

				$s->endSection();

				$s->startSection('parallax', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', 'Parallax');

					$s->addOptionNL( ffOneOption::TYPE_IMAGE, 'image', 'Background image', '');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', 1)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('Opacity of this background layer'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Opacity can be between <code>0</code> and <code>1</code>, with a step of <code>0.01</code>. Valid example: <code>0.57</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'speed', 'Parallax speed', 50)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('%'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Must be between <code>0</code> and <code>100</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'size', '', 'cover')
						->addSelectValue('cover', 'cover')
						->addSelectValue('auto', 'auto')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'Background size')
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Use <code>cover</code> if you want the image to cover the whole space. But if you want a non-resized standalone image that can be moved around using the position settings below then use <code>auto</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'h', 'Horizontal position', 50)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('%'))
					;
					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'v', 'Vertical position', 50)
						->addParam('short', true)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ('%'))
					;
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Position will be used only when the <strong>"Background size"</strong> option above is set to <code>auto</code>. Must be between <code>0</code> and <code>100</code>');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'hover-only', 'Show this layer only on mouse hover', 0);
					$s->addElement(ffOneElement::TYPE_NEW_LINE,'');

					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'xs', 'Hide on Phone (XS)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'sm', 'Hide on Tablet (SM)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'md', 'Hide on Laptop (MD)', 0);
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'lg', 'Hide on Desktop (LG)', 0);
				$s->endSection();

			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);
	}

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}