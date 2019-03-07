<?php

class ffThemeContainer extends ffThemeContainerAbstract {

	const OPTIONS_HOLDER    = 'ffThemeOptionsHolder';
	const OPTIONS_PREFIX    = 'ff_options';
	const OPTIONS_NAMESPACE = 'theme_hypnos';
	const OPTIONS_NAME      = 'theme_options';

	/**
	 * @var ffThemeContainer
	 */
	private static $_instance = null;

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffThemeContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffThemeContainer($container, $pluginDir);
		}
		return self::$_instance;
	}

	protected function _registerFiles() {

		$this->_registerThemeFile('ffAdminScreenThemeOptions', '/framework/adminScreens/ThemeOptions/class.ffAdminScreenThemeOptions.php');
		$this->_registerThemeFile('ffAdminScreenThemeOptionsViewDefault', '/framework/adminScreens/ThemeOptions/class.ffAdminScreenThemeOptionsViewDefault.php');


		$this->_registerThemeFile('ffComponent_Theme_OnePageNavigation', '/framework/components/class.ffComponent_Theme_OnePageNavigation.php');
		$this->_registerThemeFile('ffComponent_Theme_OnePageOptions', '/framework/components/class.ffComponent_Theme_OnePageOptions.php');


		$this->_registerThemeFile('ffMetaBoxPortfolio', '/framework/adminScreens/metaBoxes/metaBoxPortfolio/class.ffMetaBoxPortfolio.php');
		$this->_registerThemeFile('ffMetaBoxPortfolioView', '/framework/adminScreens/metaBoxes/metaBoxPortfolio/class.ffMetaBoxPortfolioView.php');
		$this->_registerThemeFile('ffComponent_Theme_MetaboxPortfolio', '/framework/components/class.ffComponent_Theme_MetaboxPortfolio.php');

		$this->_registerThemeFile('ffMetaBoxOnePage', '/framework/adminScreens/metaBoxes/metaBoxOnePage/class.ffMetaBoxOnePage.php');
		$this->_registerThemeFile('ffMetaBoxOnePageView', '/framework/adminScreens/metaBoxes/metaBoxOnePage/class.ffMetaBoxOnePageView.php');

		$this->_registerThemeFile('ffMetaBoxOnePageNavigation', '/framework/adminScreens/metaBoxes/metaBoxOnePageNavigation/class.ffMetaBoxOnePageNavigation.php');
		$this->_registerThemeFile('ffMetaBoxOnePageNavigationView', '/framework/adminScreens/metaBoxes/metaBoxOnePageNavigation/class.ffMetaBoxOnePageNavigationView.php');

		$this->_registerThemeFile('ffThemeOptionsHolder', '/framework/core/class.ffThemeOptionsHolder.php');


		$this->_registerThemeFile('ffThemeOptions', '/framework/core/class.ffThemeOptions.php');
		$this->getFrameworkContainer()->getClassLoader()->loadClass( 'ffThemeOptions' );


		$this->_registerThemeFile( 'ffWidgetVideo', '/framework/components/widgets/video/class.ffWidgetVideo.php');
		$this->_registerThemeFile( 'ffComponent_Video_OptionsHolder', '/framework/components/widgets/video/class.ffComponent_Video_OptionsHolder.php');
		$this->_registerThemeFile( 'ffComponent_Video_Printer', '/framework/components/widgets/video/class.ffComponent_Video_Printer.php');


		// $this->_registerThemeFile('AuthorSocialLinks', '/framework/core/class.AuthorSocialLinks.php');
		// $this->getFrameworkContainer()->getClassLoader()->loadClass( 'AuthorSocialLinks' );


		$this->_registerThemeFile('freshizer', '/framework/core/freshizer.php');
		$this->getFrameworkContainer()->getClassLoader()->loadClass( 'freshizer' );


		// $this->_registerThemeFile('ffWidgetLatestPosts', '/framework/widgets/class.ffWidgetLatestPosts.php');

		// $this->_registerThemeFile('ffComponent_LatestPosts_OptionsHolder', '/framework/components/class.ffComponent_LatestPosts_OptionsHolder.php');
		// $this->_registerThemeFile('ffComponent_LatestPosts_Printer', '/framework/components/class.ffComponent_LatestPosts_Printer.php');

		$this->_registerThemeFile('ffThemeAssetsIncluder', '/framework/theme/class.ffThemeAssetsIncluder.php');

	}

}