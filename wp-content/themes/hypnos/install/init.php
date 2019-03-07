<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ffThemeFrameworkInstaller {

	private $_installedVersion = null;

	public function installFramework( $zipFilePath ) {
		$frameworkIsInstalled = $this->_isFrameworkInstalled();

		if( $frameworkIsInstalled ) {
			$this->_updateFramework();
			if( get_option('ff_first_time_fw_activation', false) == false) {
				activate_plugin( $this->_getPluginDir() . '/fresh-framework/freshplugin.php');
				update_option('ff_first_time_fw_activation', true);
				header("Refresh:0");
				die();
			}

		} else {
			$this->_installFrameworkForFirstTime( $zipFilePath );
		}


	}



	/**********************************************************************************************************************/
	/* UPDATE
	/**********************************************************************************************************************/

	private function _updateFramework() {
		if( !$this->_isFrameworkActive() ) {
			return false;
		}

		$versionManager =  ffFrameworkVersionManager::getInstance();

		$latestInstalledVersion = $versionManager->getLatestInstalledVersion();
		$newFrameworkVersion = $this->_getFrameworkVersion();

		$pluginInstaller = ffContainer()->getPluginInstaller();

		if(version_compare( $newFrameworkVersion, $latestInstalledVersion, '>')) {
			if( $pluginInstaller->installPluginFromZipFile( get_template_directory() .'/install/fresh-framework.zip', false, true )   ) {
				header("Refresh:0");
				die();
			} else {
				return;
			}
		} else {
			return;
		}
	}

	private function _getFrameworkVersion() {
		require_once get_template_directory().'/install/fresh-framework-version.php';

		return( $fresh_framework_version  );
	}
	/**********************************************************************************************************************/
	/* INSTALL
	/**********************************************************************************************************************/
	private function _installFrameworkForFirstTime( $zipFilePath ) {
		$fileSystem = $this->_getFileSystem();

		if( $fileSystem == false ) {
			return false;
		}

		$pluginDir = $this->_getPluginDir();

		$unzipFileResult = unzip_file( $zipFilePath, $pluginDir );


		if( $unzipFileResult instanceof WP_Error ) {
			$notificationText = __('Fresh Framework requires wp-content/plugins folder, to be writable, in order to install itself, ', 'sonic');
			$notificationText .= __('this could be achieved by setting 775 or 777 permissions to wp-content/plugins folder, ', 'sonic');
			$notificationText .= __('please install Fresh Framework plugin, otherwise our theme will not work<br><br>', 'sonic');
			$notificationText .= __('Plugin could be found here: ', 'sonic').get_template_directory().'/install/fresh-framework.zip';

			$this->_addNotification( $notificationText );
		} else {

			require_once ABSPATH .'/wp-admin/includes/plugin.php';
			activate_plugin( $pluginDir . '/fresh-framework/freshplugin.php');
			header("Refresh:0");
			die();
		}
	}

	private function _getPluginDir() {
		if( defined( 'WP_PLUGIN_DIR' ) ) {
			return WP_PLUGIN_DIR;
		} else {
			echo 'wp plugin dir not defined';
		}
	}

	/**
	 * @return WP_Filesystem_Direct
	 */
	private function _getFileSystem() {
		if( !function_exists('get_filesystem_method') ) {
			require_once ABSPATH .'/wp-admin/includes/file.php';
			$fileSystem = WP_Filesystem();
		} else {
			global $wp_filesystem;
			$fileSystem = $wp_filesystem;
		}
		$method = get_filesystem_method();

		if( $method != 'direct' ) {
			$notificationText = __('Fresh Framework requires File System Direct to install itself. If you cant achieve this, ','sonic');
			$notificationText .= __('please install Fresh Framework plugin, otherwise our theme will not work<br><br>','sonic');
			$notificationText .= __('Plugin could be found here: ','sonic').get_template_directory().'/install/fresh-framework.zip';

			$this->_addNotification( $notificationText );

			return false;
		}

		return $fileSystem;

	}

	private $_notificationText = null;
	private function _addNotification( $text ) {
		if( !is_admin() ) {
			echo '<span style="color:red; font-size:30px;">';
			echo  $text;
			echo '</span>';
			die();
		} else {
			$this->_notificationText = $text;
			add_action( 'admin_notices', array( $this, 'printAdminNotification') );
		}
	}

	public function printAdminNotification() {
		echo '<div class="error">';
		echo  $this->_notificationText;
		echo '</div>';
	}

	/**********************************************************************************************************************/
	/* IS FRAMEWORK INSTALLED
	/**********************************************************************************************************************/
	private function _isFrameworkInstalled() {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
		$installedPlugins = get_plugins();

		foreach( $installedPlugins as $file => $info ) {
			if( strpos($file, 'fresh-framework') !== false ) {
				$this->_installedVersion = $info['Version'];

				return true;
			}
		}

		return false;
	}

	private function _isFrameworkActive() {
		if( class_exists('ffContainer') ) {
			return true;
		} else {
			return false;
		}
	}
}

function ff_themeInstallFramework() {
	if( !file_exists( get_template_directory().'/install/fresh-framework.zip' ) ) {
		return false;
	}
	$installer = new ffThemeFrameworkInstaller();

	$installer->installFramework( get_template_directory().'/install/fresh-framework.zip' );
}
ff_themeInstallFramework();