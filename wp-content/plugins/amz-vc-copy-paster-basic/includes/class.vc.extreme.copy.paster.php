<?php 

/**
 * Extreme Addon main class.
 *
 * @since 1.0
 */

class AmzVcCopyPaster {

	protected $dir;
	public $default_templates = array();

	/** Refers to a single instance of this class. */
	private static $instance = null;

	private function __construct( $dir ) {
		$this->dir = $dir;
		$this->plugin_dir = basename ( $this->dir );

		//Load Text Domain
		add_action( 'init', array( $this, 'amz_vc_copy_paster_translation') );

		/* Register VC Backend Custom Views */
		add_action( 'vc_backend_editor_render',  array( $this, 'amz_vc_backend_extend' ) );
		add_action( 'wp_ajax_amz_insert_template', array( $this, 'amz_backend_load_template' ) );

		/* FrontEnd VC Custom Views */
		add_action( 'vc_frontend_editor_render',  array( $this, 'amz_vc_frontend_extend' ) );
		add_action( 'wp_ajax_amz_frontend_load_template', array( $this, 'amz_frontend_load_template' ) );

	}

	public function amz_vc_copy_paster_translation() {
		load_plugin_textdomain( 'amz-vc-copy-paster', false, basename( $this->dir ) . '/locale' ); 
	}
	
	public function amz_vc_backend_extend() {
		wp_enqueue_style( 'amz-vc-custom-views', VC_COPY_PASTE_DIR_URL . 	 '/assets/css/amz-vc-custom-views.css', array(), AMZ_VC_CP_VERSION, 'all' );

		$this->render_template_dialog();

		wp_enqueue_script( 'amz-templates-js', VC_COPY_PASTE_DIR_URL . 		 '/assets/js/amz-templates.js', array(), AMZ_VC_CP_VERSION, true );
		wp_enqueue_script( 'amz-vc-custom-views-js', VC_COPY_PASTE_DIR_URL . '/assets/js/amz-vc-custom-views.js', array(), AMZ_VC_CP_VERSION, true );
		
	}

	public function amz_vc_frontend_extend() {
		wp_enqueue_style( 'amz-vc-custom-views', VC_COPY_PASTE_DIR_URL . 	 '/assets/css/amz-vc-custom-views.css', array(), AMZ_VC_CP_VERSION, 'all' );

		$this->render_template_dialog( true );

		// wp_enqueue_script( 'amz-templates-js', VC_COPY_PASTE_DIR_URL . 		 '/assets/js/amz-templates.js', array(), AMZ_VC_CP_VERSION, true );
		wp_enqueue_script( 'amz-vc-frontend-templates-js', VC_COPY_PASTE_DIR_URL . '/assets/js/amz-vc-frontend-templates.js', array(), AMZ_VC_CP_VERSION, true );
		
	}

	public function render_template_dialog( $frontend = false ){

		if( $frontend ) {
			$frontclass = ' amz-frontend-template-dialog';
		} else {
			$frontclass = '';
		}

		do_action( 'amz_load_default_templates_action' );
		$templates =  amz_group_by( $this->default_templates, 'group' );
		$categories = array_keys( $templates );

		$amz_template_nonce = wp_create_nonce("amz_template_nonce");
		?>

		<div class="<?php echo $frontclass; ?>" id="amz-templates-dialog" data-amz-template-nonce="<?php echo $amz_template_nonce; ?>" style="display:none">
			<div class="amz-templates-dialog-wrap">
			<div class="amz-templates-dialog-inner">

				<!-- param window header-->
				<div class="tab-group-wrap">
					<ul class="amz-tab-group">
						<?php
							$first = true;
							
							foreach ( $categories as $category ) {
								echo '<li class="amz-tabs-control ' . ( $first ? ' vc_active' : '' ) . '">'. $category . '<span class="count">' . count( $templates[$category] ) . '</span></li>';
								$first = false;
							}
						?>
					</ul>
				</div>

				<!-- param window footer-->
				<div class="tab-content-wrap">

					<div class="amz-panel-header">
						<h3 class="amz-panel-heading"><?php _e( '<b>Composer</b> Templates', 'js_composer' ) ?></h3>
						<div class="amz-search-box">
							<input type="text" id="amz_templates_name_filter" placeholder="Search template by name">
							<span class="amz_templates_name_filter_close">x</span>							
						</div>
						<span class="amz-close-dialog"><i class="vc_ui-icon-pixel vc_ui-icon-pixel-close"></i></span>
					</div>

					<div class="amz-tabs-content">
						<?php

						$first = true;
						foreach ($templates as $key => $group ) :
							echo '<div class="tab-content' . ( $first ? ' vc_active' : '' ) . '">';
								// var_dump( $group );
							if( array_key_exists( 'sub_group', $group[0] ) ) {

								$sub_group = amz_group_by ( $group, 'sub_group' );
								$sub_group_tabs = array_keys( $sub_group );

								echo '<div class="tab-sub-group-wrap">';

								echo '<div class="amz-sub-tab-group">';
								echo '<ul class="amz-sub-tabs">';
								foreach ( $sub_group_tabs as $tab ) {
									echo '<li class="amz-sub-tab" data-tab="'. strtolower( str_replace(' ', '-', $tab ) )  .'">'. $tab . '</li>';
								}
								echo '</ul>';
								echo '</div>';

								echo '<div class="tab-sub-content-wrap">';

								echo '<div class="amz-sub-tabs-content">';


								foreach ( $sub_group as $key => $sub_templates ) {

									$sub_first = true;

									echo '<div class="'. strtolower( str_replace(' ', '-', $key ) ) .' sub-tab-content' . ( $first ? ' vc_active' : '' ) . '">';

									foreach ( $sub_templates as $key => $sub_template ) {

										$sub_template_tags = isset( $sub_template['tag'] ) ? ' data-tag="' . esc_attr( $sub_template['tag'] ) . '"' : 'data-tag=""';

										$sub_template_con_class = isset( $sub_template['class'] ) ? ' ' . $sub_template['class'] : '';

										echo '<div class="amz-template-con' . $sub_template_con_class . '" data-template-id="' . $sub_template['id'] . '"'. $sub_template_tags .'>';

										echo '<div class="amz-template-content">';
										echo  isset( $sub_template['image_path'] ) ? '<div class="amz-temp-img"><img width="283px" height="215px" data-src="' . esc_url( $sub_template['image_path'] ) . '" alt="' . esc_attr( $sub_template['name'] ) . '"></div>' : '';

										if( ! isset( $sub_template['hide_title'] ) ) {
											echo '<h4 class="amz-template-title">' . esc_html( $sub_template['name'] ) . '</h4>';
										}

										echo '</div>';

										echo '<div class="amz-template-importing"><div class="amz-template-importing-inner"><svg class="amz-spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
												<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
											</svg>

											<div class="checkmark-circle">
												<div class="checkmark draw"></div>
											</div>

										</div></div>';

										echo '</div>';

									}

									$sub_first = false;

									echo '</div>';

								}

								echo '</div>';

								echo '</div>';
								echo '</div>';
							} else {

								foreach ( $group as $key => $template ) {

									$template_con_class = isset( $template['class'] ) ? ' ' . $template['class'] : '';

									$template_tags = isset( $template['tag'] ) ? ' data-tag="' . esc_attr( $template['tag'] ) . '"' : 'data-tag=""';

									echo '<div class="amz-template-con ' . $template_con_class . '" data-template-id="' . $template['id'] . '"'. $template_tags .'>';

									echo '<div class="amz-template-content">';
									echo  isset( $template['image_path'] ) ? '<div class="amz-temp-img"><img width="283px" height="215px" data-src="' . esc_url( $template['image_path'] ) . '" alt="' . esc_attr( $template['name'] ) . '"></div>' : '';

									if( ! isset( $template['hide_title'] ) ){
										echo '<h4 class="amz-template-title">' . esc_html( $template['name'] ) . '</h4>';
									}

									echo '</div>';

										echo '<div class="amz-template-importing"><div class="amz-template-importing-inner"><svg class="amz-spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
										<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
									</svg>

									<div class="checkmark draw"></div>

									</div></div>';

									echo '</div>';
								}

							}

							echo '</div>';
							$first = false;
						endforeach; 

						?>
					</div>

				</div> <!-- #end of .amz-tabs-content -->
			</div> <!-- #end of .amz-templates-dialog-inner -->
			</div> <!-- #end of .amz-templates-dialog-wrap -->
		</div> <!-- #end of .amz-templates-dialog -->

<!--/ temp content --><?php
}

/* Load default template hook */
public function addDefaultTemplates( $data ) {
	if ( is_array( $data ) && ! empty( $data ) ) {
		if ( ! is_array( $this->default_templates ) ) {
			$this->default_templates = array();
		}

		$this->default_templates[] = $data;

		return true;
	}

	return false;
}

/* Backend Template inserter */
public function amz_backend_load_template() {

	if ( ! wp_verify_nonce( $_REQUEST['amz_template_nonce'], "amz_template_nonce" ) ) {
		exit("No naughty business please!");
	}

	$id = $_REQUEST['id'];

	if ( ! is_array( $this->default_templates ) ) {
		$this->default_templates = array();
	}

	do_action( 'amz_load_default_templates_action' );

	$key = array_search($id, array_column( $this->default_templates, 'id') );

	echo trim( $this->default_templates[$key]['content'] );

	die();

}

/* Frontend Template inserter */
function amz_frontend_load_template() {

	if ( ! wp_verify_nonce( $_REQUEST['amz_template_nonce'], "amz_template_nonce" ) ) {
		exit("No naughty business please!");
	}

	add_filter( 'vc_frontend_template_the_content', array(
		&$this,
		'frontendDoTemplatesShortcodes',
		) );

	$id = $_REQUEST['id'];
	if ( ! is_array( $this->default_templates ) ) {
		$this->default_templates = array();
	}

	add_action( 'wp_print_scripts', array(
		&$this,
		'addFrontendTemplatesShortcodesCustomCss',
		) );

	if ( '' === $id ) {
		die( 'Error: Vc_Templates_Panel_Editor::renderFrontendTemplate:1' );
	}
	WPBMap::addAllMappedShortcodes();
	do_action( 'amz_load_default_templates_action' );

	$key = array_search($id, array_column( $this->default_templates, 'id') );

	$data = $this->default_templates[$key];
	if ( ! $data ) {
		die( 'Error: Vc_Templates_Panel_Editor::renderFrontendDefaultTemplate:1' );
	}
	vc_frontend_editor()->setTemplateContent( trim( $data['content'] ) );
	vc_frontend_editor()->enqueueRequired();
	vc_include_template( 'editors/frontend_template.tpl.php', array(
		'editor' => vc_frontend_editor(),
		) );
	die();
}

	/**
	 * Calls do_shortcode for templates.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function frontendDoTemplatesShortcodes( $content ) {
		return do_shortcode( $content );
	}

	/**
	 * Add custom css from shortcodes from template for template editor.
	 *
	 * Used by action 'wp_print_scripts'.
	 *
	 * @todo move to autoload or else some where.
	 * @since 4.4.3
	 *
	 * @return string
	 */
	public function addFrontendTemplatesShortcodesCustomCss() {
		$output = $shortcodes_custom_css = '';
		$shortcodes_custom_css = visual_composer()->parseShortcodesCustomCss( vc_frontend_editor()->getTemplateContent() );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			$output .= $shortcodes_custom_css;
			$output .= '</style>';
		}
		echo $output;
	}

	/**
     * Creates or returns an instance of this class.
     *
     * @return  A single instance of this class.
     */
	public static function get_instance( $dir = false ) {

		if ( null == self::$instance ) {
			self::$instance = new self( $dir );
		}

		return self::$instance;

	}

}

function amz_add_default_templates( $data ) {
	AmzVcCopyPaster::get_instance()->addDefaultTemplates( $data );
}

