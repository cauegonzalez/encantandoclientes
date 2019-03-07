<?php

class ffThemeBuilderOptionsExtender extends ffBasicObject {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
	/**
	 * @var ffThemeBuilderBlockFactory
	 */
	private $_themeBuilderBlockFactory = null;

	/**
	 * @var ffThemeBuilderBlockManager
	 */
	private $_themeBuilderBlockManager = null;

	/**
	 * @var ffOneStructure
	 */
	private $_s = null;
/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

	public function getData() {
		return $this->_s->getData();
	}
	public function setStructure( ffOneStructure $s ) {
		$this->_s = $s;
	}

    public function startRepVariableSection( $id  ) {
		$this->_s->startSection($id,ffOneSection::TYPE_REPEATABLE_VARIABLE)
			->addParam('work-as-accordion', true)
			->addParam('all-items-opened', true)
		;
	}
	

	public function endRepVariableSection() {
		$s = $this->_s;

		$this->startRepVariationSection('html', 'Html')->addParam('hide-default', true);
			$this->_getBlock(ffThemeBuilderBlock::HTML)->injectOptions( $this );
		$this->endRepVariationSection();
//
		$s->endSection();
	}

	public function startRepVariationSection( $id, $name ) {
		$s = $this->_s;
		$section = $s->startSection($id, ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', $name )->addParam('show-advanced-tools', true);
			$this->startModal('Advanced Options', 'ff-advanced-options');
				$this->startTabs();
					$this->startTab('Box Model', true);
						$this->_getBlock( ffThemeBuilderBlock::BOX_MODEL)->injectOptions( $this );
					$this->endTab();

					$this->startTab('Colors');
						$this->_getBlock( ffThemeBuilderBlock::COLORS)->injectOptions( $this );
					$this->endTab();

					$this->startTab('Extra');
						$this->_getBlock( ffThemeBuilderBlock::ADVANCED_TOOLS )->injectOptions( $this );
					$this->endTab();

					$this->startTab('Custom Codes');
						$this->_getBlock( ffThemeBuilderBlock::CUSTOM_CODES )->injectOptions( $this );
					$this->endTab();
				$this->endTabs();
			$this->endModal();
		return $section;
	}

	public function endRepVariationSection() {
		$this->_s->endSection();
	}
	

	public function startReferenceSection( $id, $type = null ) {
		return $this->_s->startReferenceSection( $id, $type );
	}

	public function endReferenceSection() {
		return $this->_s->endReferenceSection();
	}

	public function addElement($type, $id = NULL, $name = NULL){
		$this->_s->addElement( $type, $id, $name );
	}

	public function addOption($type, $id = NULL, $label = NULL, $content = NULL){
		return $this->_s->addOption( $type, $id, $label, $content );
	}

	public function addOptionNL($type, $id = NULL, $label = NULL, $content = NULL){
		return $this->_s->addOptionNL( $type, $id, $label, $content );
	}


	public function startSection($id, $type = NULL){
		return $this->_s->startSection( $id, $type );
	}

	public function endSection(){
		$this->_s->endSection();
	}




    public function startTabs() {
		$s = $this->_s;

        // start tab
        $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__tabs">');

            // empty header, will be added lately
            $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__tab-headers clearfix">');
            $s->addElement(ffOneElement::TYPE_HTML,'', '</div>');

            // start tab content
            $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__tab-contents clearfix">');
    }

    public function endTabs() {
		$s = $this->_s;

            // end contents
            $s->addElement(ffOneElement::TYPE_HTML,'', '</div>');

        // end tabs
        $s->addElement(ffOneElement::TYPE_HTML,'', '</div>');
    }


    public function startTab( $name, $isActive = false ) {

		$s = $this->_s;

        $headerActive = '';
        $contentActive = '';

        if( $isActive ) {
            $headerActive = ' ffb-modal__tab-header--active';
            $contentActive = ' ffb-modal__tab-content--active';
        }

        // Header



        $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__tab-header '.$headerActive.'" data-tab-header-name="'.$name.'">'.$name.'</div>');

        // Content
        $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__tab-content '.$contentActive.'" data-tab-content-name="'.$name.'">');
            $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ffb-modal__content--options ffb-options">');


    }

    public function endTab() {
			$this->_s->addElement(ffOneElement::TYPE_HTML,'', '</div>'); // end content--options
		$this->_s->addElement(ffOneElement::TYPE_HTML,'', '</div>'); // end content
    }


    public function startModal( $modalName, $modalClass ) {

        $html = '';

        $html .= '<div class="ffb-modal-holder '.$modalClass.'">';

        $html .= '<div class="ffb-modal-opener-button"></div>';

        $html .='<div class="ffb-modal ffb-modal-nested">';
            $html .='<div class="ffb-modal__vcenter-wrapper">';

                $html .='<div class="ffb-modal__vcenter ffb-modal__action-done">';
                    $html .='<div class="ffb-modal__box">';
                        $html .='<div class="ffb-modal__header">';
                            $html .='<div class="ffb-modal__name">';
                                $html .=$modalName;
                            $html .='</div>';
                        $html .='</div>';
                        $html .='<div class="ffb-modal__body">';
                            // $html .='<div class="ffb-modal__content--options ffb-options">';

		$this->_s->addElement(ffOneElement::TYPE_HTML,'', $html); // end content--options
    }

    public function endModal() {
        $html = '';

                            // $html .='</div>';
                        $html .='</div>';
                        $html .='<div class="ffb-modal__footer">';
	                        $html .= '<a href="#" class="ffb-modal__button-save_all ffb-modal__action-save-all">Save All</a>';
                            $html .='<a href="#" class="ffb-modal__button-save ffb-modal__action-done">Done</a>';
                        $html .='</div>';
                    $html .='</div>';
                $html .='</div>';
            $html .='</div>';
        $html .='</div>';

        $html .='</div>';

        $this->_s->addElement(ffOneElement::TYPE_HTML,'', $html); // end content--options
    }

	public function getStructure() {
		return $this->_s;
	}
/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/
	protected function _getBlock( $blockClassName ) {
		return $this->_getThemeBuilderBlockManager()->getBlock( $blockClassName );
	}
/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	/**
	 * @return ffThemeBuilderBlockFactory
	 */
	private function _getThemeBuilderBlockFactory()
	{
		if( $this->_themeBuilderBlockFactory == null ) {

			$this->_themeBuilderBlockFactory = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderBlockFactory();
		}
		return $this->_themeBuilderBlockFactory;
	}

	/**
	 * @return ffThemeBuilderBlockManager
	 */
	private function _getThemeBuilderBlockManager() {
		if( $this->_themeBuilderBlockManager == null ) {
			$this->_themeBuilderBlockManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderBlockManager();
		}

		return $this->_themeBuilderBlockManager;
	}
/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS 
/**********************************************************************************************************************/
}