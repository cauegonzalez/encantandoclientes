<?php

class ffAdminScreenThemeOptionsViewDefault extends ffAdminScreenView {

	public function actionSave( ffRequest $request ) {

	}
	
	protected function _render() {
		echo '<div class="wrap">';
		echo '<form method="post">';

		echo '<h2>Theme Options</h2>';

		echo '<h2 class="nav-tab-wrapper">';

		echo '<a href="#ff-theme-mix-admin-tab-layout" class="nav-tab nav-tab-active" data-for="ff-theme-mix-admin-tab-layout">Layout</a>';
		echo '<a href="#ff-theme-mix-admin-tab-sidebars" class="nav-tab" data-for="ff-theme-mix-admin-tab-sidebars">Sidebars</a>';
		echo '<a href="#ff-theme-mix-admin-tab-skins" class="nav-tab" data-for="ff-theme-mix-admin-tab-skins">Skins</a>';
		echo '<a href="#ff-theme-mix-admin-tab-fonts" class="nav-tab" data-for="ff-theme-mix-admin-tab-fonts">Fonts</a>';
		echo '<a href="#ff-theme-mix-admin-tab-header" class="nav-tab" data-for="ff-theme-mix-admin-tab-header">Header</a>';
		echo '<a href="#ff-theme-mix-admin-tab-footer" class="nav-tab" data-for="ff-theme-mix-admin-tab-footer">Footer</a>';
		echo '<a href="#ff-theme-mix-admin-tab-translations" class="nav-tab" data-for="ff-theme-mix-admin-tab-translations">Translations</a>';
		echo '<a href="#ff-theme-mix-admin-tab-gapi" class="nav-tab" data-for="ff-theme-mix-admin-tab-gapi">Google API</a>';
		echo '</h2>';

		$this->_renderOptions(
			  ffThemeContainer::OPTIONS_HOLDER
			, ffThemeContainer::OPTIONS_PREFIX
			, ffThemeContainer::OPTIONS_NAMESPACE
			, ffThemeContainer::OPTIONS_NAME
		);

		echo '</form>';
		echo '</div>';

		?>
			<script>
			jQuery(document).ready(function( $ ){
				$(".ff-theme-layout-changer label").click(function(){
					$( this ).parents('fieldset').find('label').removeClass('selected');
					$( this ).addClass('selected');
				});

				$(".ff-theme-layout-changer label input[checked=checked]").each(function(){
					$(this).parents('label').click();
				});

			});

			jQuery(document).ready(function( $ ){
				$(".nav-tab").click(function(){
					$(".ff-theme-mix-admin-tab-content").hide();
					$("." + $(this).attr("data-for")).show();
					$(".nav-tab-active").removeClass("nav-tab-active");
					$(this).addClass("nav-tab-active");
				});
			});

			jQuery(document).ready(function( $ ){

				if( -1 == document.URL.indexOf('#') ){
					$(".nav-tab-active").click();
					return;
				}

				var _id;
				_id = document.URL.split('#');
				_id = "" + _id[1];
				if( _id.length < 1 ) {
					return null;
				}

				if( $( 'a[href=#' + _id + ']' ).size() < 1 ){
					$(".nav-tab-active").click();
					return;
				}

				$( 'a[href=#' + _id + ']' ).click();
			});
			</script>


		<?php
	}

	public function requireModalWindows() {
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryColor();
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}

	protected function _requireAssets() {
		ffContainer::getInstance()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);
	}

	protected function _setDependencies() {

	}

	public function ajaxRequest( ffAdminScreenAjax $ajax ) {

	}
}