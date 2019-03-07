<?php

class ffMetaBoxOnePageNavigationView extends ffMetaBoxView {

	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	}

	public function requireModalWindows() {
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryColor();
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}

	protected function _render( $post ) {
		ffContainer::getInstance()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);

		$fwc = ffContainer::getInstance();

		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_OnePageNavigation')->getOptions();//createStructure('portfolio');

		$value = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOption('onepagenavigation');
		$value = unserialize( base64_decode( $value ));
		$printer = $fwc->getOptionsFactory()->createOptionsPrinterBoxed( $value, $s );
		$printer->setNameprefix('onepagenavigation');
		$printer->walk();

	}

	protected function _save( $postId ) {

		$fwc = ffContainer::getInstance();
		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );

		$value = $fwc->getOptionsFactory()->createOptionsPostReader()->getData( 'onepagenavigation');

		$valueNew = base64_encode(( serialize( $value ) ) );

		$saver->setOption( 'onepagenavigation' , $valueNew );

	}
}