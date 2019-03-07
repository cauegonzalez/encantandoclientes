<?php
/**
 * Pixel8es Header 1
 *
 * Header 1 Template
 *
 * @author 		Theme Innwit
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$composer_prefix = composer_get_prefix();

if ( $composer_prefix != '' ) {

	$composer_id = get_the_ID();

	${'composer_'.$composer_prefix.'display_menu'} = composer_get_meta_value( $composer_id, '_amz_display_menu', 'default', 'display_menu', 'show' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

}

?>

<header class="header">
	<div class="container">
		<div id="inner-header" class="wrap col3 clearfix">
			<div class="main-nav-left">
				<nav class="main-nav">
					<?php 
					composer_main_left_nav(); 
					?>
				</nav>
				<div class="widget-right">
					<?php
						$center_sorter = array( 
							"left" => array (
								"placebo" 		=> "placebo", //REQUIRED!
							),
							"right" => array (
								"placebo" 		=> "placebo", //REQUIRED!
							)
						);

						$center_sorter_left = composer_get_option_array_value('center_sorter','left', $center_sorter['left'] );

						foreach ( $center_sorter_left as $key => $value ) {
							composer_display_header_elements( $key, 'default-header-lang', 'page-top-main' );
						}
					?>
				</div>
			</div>

			<?php echo composer_get_logo(); ?>

			<?php if( ${'composer_'.$composer_prefix.'display_menu'} != 'hide' ) { ?>
				<div class="pix-menu">
					<div class="pix-menu-trigger">
						<span class="mobile-menu"><?php esc_html_e( 'Menu', 'composer' ); ?></span>
					</div>
				</div>
			<?php } ?>

			<div class="main-nav-right">
				<nav class="main-nav">
					<?php 
					composer_main_right_nav(); 
					?>
				</nav>
				<div class="widget-right">
					<?php
						$center_sorter = array( 
							"left" => array (
								"placebo" 		=> "placebo", //REQUIRED!
							),
							"right" => array (
								"placebo" 		=> "placebo", //REQUIRED!
							)
						);

						$center_sorter_right = composer_get_option_array_value('center_sorter','right', $center_sorter['right'] );

						foreach ( $center_sorter_right as $key => $value ) {
							composer_display_header_elements( $key, 'default-header-lang', 'page-top-main' );
						}
					?>
				</div>
			</div>

		</div>
	</div>
</header>