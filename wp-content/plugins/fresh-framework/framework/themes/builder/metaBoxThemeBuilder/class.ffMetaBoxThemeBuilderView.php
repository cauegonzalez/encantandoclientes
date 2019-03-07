<?php

class ffMetaBoxThemeBuilderView extends ffMetaBoxView {


    /**
     * Handle ajax request - junction
     * @param ffAjaxRequest $ajaxRequest
     */
    public function ajaxRequest( ffAjaxRequest $ajaxRequest ) {

        switch( $ajaxRequest->getData('action') ) {
            case 'getElementsData':
                    $this->_ajaxGetElementsData( $ajaxRequest );
                break;

	        case 'saveAjax':
		            $this->_saveAjax( $ajaxRequest );
		        break;
        }
    }

	private function _saveAjax( ffAjaxRequest $ajaxRequest ) {
		$postId = $ajaxRequest->getData('postId');
		$content = $ajaxRequest->getData('content');
		$colorLibraryData = $ajaxRequest->getData('colorLibrary');
		
		$colorLibrary = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderColorLibrary();
		$colorLibrary->setLibrary( $colorLibraryData )->saveLibrary();

		wp_update_post( array('ID'=>$postId, 'post_content'=>$content));
		$this->_savePostContentCached( $postId, $content );

//		echo $content;
	}

    /**
     * Generate JSON with datas about ALL our elements, important for builder
     * @param ffAjaxRequest $ajaxRequest
     */
    private function _ajaxGetElementsData( ffAjaxRequest $ajaxRequest ) {

        $themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
        $themeBuilderManager->setIsEditMode( true );

        $themeBlockManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderBlockManager();
        $themeBlockManager->setIsEditMode(true);

        $elementManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderElementManager();

        $data = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderElementManager()->getElementsData();
	    $data['color_library'] = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderColorLibrary()->getLibrary();
        echo json_encode( $data );

    }

	/**
	 * Now we have to render cached elements to post meta, for faster rendering
	 * @param $postId
	 * @param $postContent
	 */
	protected function _savePostContentCached( $postId, $postContent ) {
		$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
		$postMeta = ffContainer()->getDataStorageFactory()->createDataStorageWPPostMetas();

		$themeBuilderManager->setIsCachingMode( true );
		$postContentCached = $themeBuilderManager->renderButNotPrint( $postContent );
		$postContentCss = $themeBuilderManager->getRenderedCss();

		$postMeta->setOption( $postId, 'ffb-content-cached', $postContentCached );
		$postMeta->setOption( $postId, 'ffb-content-css', $postContentCss );

	}

    /**
     * Render just the post id, the rest of the options will be loaded trough ajax call
     * @param $post
     */
    protected function _render( $post ) {
        echo '<div class="ff-temporary-options-holder"></div>';
        $builderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
        $builderManager->setIsEditMode( true);
//	    $builderManager->setIsCachingMode( true );

        $content = $post->post_content;

//	    var_dump( $content );
		echo '<input type="submit" value="Save Ajax" class="ffb-save-ajax">';
        echo '<div class="ffb-canvas">';
	    echo '<div class="ffb-dropzone">';

        ( $builderManager->render( $content ) );

	    echo '</div>';
	    echo '</div>';

		echo '<div class="ffb-canvas__add-section-button-wrapper">';
            echo '<a href="" class="ffb-canvas__add-section-button action-add-section"></a>';
            echo '<div class="ffb-canvas__add-section-items">';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__library" data-ffb-tooltip="Pre-made Section"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__grid-1" data-ffb-tooltip="Blank Section with 1 Column"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__grid-2" data-ffb-tooltip="Blank Section with 2 Columns"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__grid-3" data-ffb-tooltip="Blank Section with 3 Columns"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__grid-4" data-ffb-tooltip="Blank Section with 4 Columns"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__grid-bs" data-ffb-tooltip="Advanced Bootstrap Section"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__element" data-ffb-tooltip="Element"></a>';
                echo '<a href="" class="ffb-canvas__add-section-item ffb-canvas__add-section-item__cancel" data-ffb-tooltip="Cancel"></a>';
            echo '</div>';
        echo '</div>';
        ffContainer()->getWPLayer()->add_action('admin_footer-post.php', array($this,'addFreshBuilderModal'), 1);
		ffContainer()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);
    }

	protected function _requireAssets() {
        $scriptEnqueuer = ffContainer()->getScriptEnqueuer();
        $styleEnqueuer = ffContainer()->getStyleEnqueuer();

        $scriptEnqueuer->getFrameworkScriptLoader()->requireFfAdmin()->requireFrsLibOptions()->requireBackboneDeepModel();
        $scriptEnqueuer->addScript('backbone');
        $scriptEnqueuer->addScript('underscore');
        $styleEnqueuer->addStyleFramework('ffb-builder-context-menu', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.contextMenu/jquery.contextMenu.min.css');
        $styleEnqueuer->addStyleFramework('ffb-builder-animate-css', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/animate.css/animate.min.css');
        $styleEnqueuer->addStyleFramework('ffb-builder-qtip', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.qtip/jquery.qtip.css');
        // $styleEnqueuer->addStyleFramework('ffb-builder-qtip-modal', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.qtip/jquery.qtip.modal.css');
        $styleEnqueuer->addStyleFramework('ffb-builder-spectrum', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.spectrum/jquery.spectrum.css');
        $styleEnqueuer->addStyleFramework('ffb-builder-style', '/framework/themes/builder/metaBoxThemeBuilder/assets/style.css');
        
        $scriptEnqueuer->addScriptFramework('ffb-builder-scroll-lock', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.scrollLock.min.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-jquery-ui-position', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.contextMenu/jquery.ui.position.min.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-context-menu', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.contextMenu/jquery.contextMenu.min.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-qtip', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.qtip/jquery.qtip.min.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-spectrum', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.spectrum/jquery.spectrum.min.js');
        // $scriptEnqueuer->addScriptFramework('ffb-builder-qtip-viewport', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.qtip/jquery.qtip.viewport.min.js');
        // $scriptEnqueuer->addScriptFramework('ffb-builder-qtip-modal', '/framework/themes/builder/metaBoxThemeBuilder/assets/extern/jquery.qtip/jquery.qtip.modal.min.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-frslib-options-addons', '/framework/themes/builder/metaBoxThemeBuilder/assets/frslib-options-addons.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-toScContentConvertor', '/framework/themes/builder/metaBoxThemeBuilder/assets/frslib-options-walkers-toScContentConvertor.js');

        $scriptEnqueuer->addScriptFramework('ffb-builder-element-view-and-model', '/framework/themes/builder/metaBoxThemeBuilder/assets/elementViewAndModel.js');
		$scriptEnqueuer->addScriptFramework('ffb-builder-element-picker', '/framework/themes/builder/metaBoxThemeBuilder/assets/elementPicker.js');
        $scriptEnqueuer->addScriptFramework('ffb-builder-script', '/framework/themes/builder/metaBoxThemeBuilder/assets/main.js');
	}



    function addFreshBuilderModal() {
        ?>
        <div class="ffb-modal ffb-modal-origin">
            <div class="ffb-modal__vcenter-wrapper">
                <div class="ffb-modal__vcenter ffb-modal__action-cancel">
                    <div class="ffb-modal__box">
                        <div class="ffb-modal__header">
                            <div class="ffb-modal__name clearfix">
                                <span>Slider Navigation</span>
                                <a href="" class="ffb-modal__header-icon ffb-modal__header-icon-preview ff-font-simple-line-icons icon-eye">
                                    <div class="ffb-modal__header-icon-preview-content">
                                        <img src="<?php echo ffContainer()->getWPLayer()->getFrameworkUrl(); ?>/framework/themes/builder/metaBoxThemeBuilder/assets/images/element-preview-example.jpg">
                                    </div>
                                </a>
                                <a href="" class="ffb-modal__header-icon ffb-modal__header-icon-close ffb-modal__action-cancel ff-font-simple-line-icons icon-close"></a>
                            </div>
                        </div>
                        <div class="ffb-modal__body">
                            <div class="ffb-modal__tabs">
                                <div class="ffb-modal__tab-headers clearfix"></div>
                                <div class="ffb-modal__tab-contents clearfix">
                                    <div class="ffb-modal__tab-header" data-tab-header-name="General">General</div>
                                    <div class="ffb-modal__tab-content" data-tab-content-name="General">
                                        <div class="ffb-modal__content--options ffb-options">GGGGGGGGGeneral</div>
                                    </div>
                                    <div class="ffb-modal__tab-header" data-tab-header-name="Advanced">Advanced</div>
                                    <div class="ffb-modal__tab-content" data-tab-content-name="Advanced">
                                        <div class="ffb-modal__content--options ffb-options">AAAAAAAAAdvanced</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ffb-modal__footer">
	                        <a href="#" class="ffb-modal__button-save_all ffb-modal__action-save-all">Save All</a>
                            <a href="#" class="ffb-modal__button-save ffb-modal__action-save">Save Changes</a>
                            <a href="#" class="ffb-modal__button-cancel ffb-modal__action-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }


	public function requireModalWindows() {
        $fwc = ffContainer();

        $fwc->getModalWindowFactory()->printModalWindowManagerLibraryColor();
		$fwc->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}

	protected function _save( $postId ) {
		$content = $_POST['content'];
		$content = stripslashes( $content );
		$this->_savePostContentCached( $postId, $content );

//		echo( stripslashes($content) );
		//die();

	}
}