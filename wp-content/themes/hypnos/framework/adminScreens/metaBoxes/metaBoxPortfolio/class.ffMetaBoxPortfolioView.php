<?php

class ffMetaBoxPortfolioView extends ffMetaBoxView {
	
	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	/*	$pluginUrl = ffPluginFreshCustomCodeContainer::getInstance()->getPluginUrl();
		ffContainer::getInstance()->getScriptEnqueuer()->addScript('ff-custom-code-metabox-helper', $pluginUrl.'/assets/js/customCodeMetaboxHelper.js');
		ffContainer::getInstance()->getStyleEnqueuer()->addStyle('ff-custom-code-less', $pluginUrl.'/assets/css/customCode.less');*/
	}
	
	protected function _render( $post ) {
		$fwc = ffContainer::getInstance();
		
		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_MetaboxPortfolio')->getOptions();//createStructure('portfolio');
		
		/*
		 * Image
		 * Title
		 * Sub Title
		 * 
		 * big nadpis <h2>video project</h2>	
		 * left nadpis <h4>Stunning design with powerfull code</h4>
		 * left text <p class="general-subtext">We believe in coming up with original ideas and turning them into digital work that is both innovative and measurable. We tackle business problems with intelligence.</p>
		 * right list line Ipsum has been the industry's standard. Simply dummy text of the printing.
		 */
		
		
		$value = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOption('portfolio_options');
		
		$printer = $fwc->getOptionsFactory()->createOptionsPrinterBoxed( $value, $s );
		$printer->setNameprefix('portfolio_options');
		$printer->walk();
	/*
 
		$fwc = ffContainer::getInstance();
		$s = $fwc->getOptionsFactory()->createStructure('code');
		
	
		
		$s->startSection('code');			
			$s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-editor-before"><div class="ff-editor-before-inner"></div><div class="ff-editor-before-text-holder">&lt;script type="text/javascript"&gt;</div></div>');
			$s->addOption(ffOneOption::TYPE_CODE, 'code');
			$s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-editor-after"><div class="ff-editor-after-inner"></div><div class="ff-editor-after-text-holder">&lt;/script&gt;</div></div>');
		$s->endSection();
		
		
		$value = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOption('customcode_code');
		
		
		$printer = $fwc->getOptionsFactory()->createOptionsPrinterBoxed( $value, $s );
		$printer->setNameprefix('customcode_code');
		$printer->walk();*/
	}
 
	
	protected function _save( $postId ) {
		$fwc = ffContainer::getInstance();
		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );
		
		$value = $fwc->getOptionsFactory()->createOptionsPostReader()->getData( 'portfolio_options');
		
		$saver->setOption( 'portfolio_options' , $value );
		/*$fwc = ffContainer::getInstance();
		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );

		
		$typeArray =  $fwc->getOptionsFactory()->createOptionsPostReader()->getData( 'customcode_type');
		
		
		
		$type = $typeArray['radio']['type'];
		
		$value = $fwc->getOptionsFactory()->createOptionsPostReader()->getData( 'customcode_code');
	
		if( $type == 'less' ) {
			$compiledFile = $this->_compileLessFiles( $value['code']['code'] );
			$saver->setOption('customcode_less', $compiledFile);
		} else {
			$saver->deleteOption('customcode_less');
		}
		
		$saver->setOption( 'customcode_code' , $value );*/
	}
}