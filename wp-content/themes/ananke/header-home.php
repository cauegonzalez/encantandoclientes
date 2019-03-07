<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $theme_option; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!-- Favicons
	================================================== -->
	<?php if($theme_option['favicon'] !=''){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($theme_option['favicon']['url']); ?>" type="image/png">
	<?php } ?>
	<?php if($theme_option['apple_icon'] !=''){ ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url($theme_option['apple_icon']['url']); ?>">
	<?php } ?>
	<?php if($theme_option['apple_icon_72'] !=''){ ?>
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($theme_option['apple_icon_72']['url']); ?>">
	<?php } ?>
	<?php if($theme_option['apple_icon_114'] !=''){ ?>
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($theme_option['apple_icon_114']['url']); ?>">
	<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	<div class="page-overlay"></div>
	<div id="menu-wrap" class="menu-back cbp-af-header">
		<div class="container">
			<div class="twelve columns">				
				<a href="<?php echo esc_url(home_url('/')); ?>" class="logo" ></a>				
				<?php
					$primarymenu = array(
						'theme_location'  => 'primary',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'slimmenu homemenu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
						'walker'          => new wp_bootstrap_navwalker(),
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
					);
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( $primarymenu );
					}
				?>
			</div>
		</div>
	</div>	