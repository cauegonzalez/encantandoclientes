<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $theme_option; 
?>
/* Color Theme - Amethyst /Violet/

color - <?php echo esc_attr( $theme_option['main-color'] ); ?>

/* 01 MAIN STYLES
****************************************************************************************************/
a {
  color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
::selection {
  color: #fff;
  background: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
::-moz-selection {
  color: #fff;
  background: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

/**** Custom Preload ****/
#royal_preloader.logo .loader {
    width: <?php echo esc_attr( $theme_option['prelogo_width'] ); ?>px;
    height: <?php echo esc_attr( $theme_option['prelogo_height'] ); ?>px;    
    margin: -<?php $height = $theme_option['prelogo_height'] / 2; echo esc_attr($height); ?>px 0px 0px -<?php $width = $theme_option['prelogo_width'] / 2; echo esc_attr($width); ?>px;    
}

/**** Custom logo - header ****/
<?php if($theme_option['bgheader'] != ''){ ?>.menu-back {background-color:<?php echo esc_attr( $theme_option['bgheader'] ); ?>;} <?php } ?>
<?php if($theme_option['bgheader_scroll'] != ''){ ?>.cbp-af-header.cbp-af-header-shrink {background-color:<?php echo esc_attr( $theme_option['bgheader_scroll'] ); ?>;} <?php } ?>
<?php if($theme_option['colormenu'] != ''){ ?> .menu-back.cbp-af-header ul.slimmenu li a {color:<?php echo esc_attr( $theme_option['colormenu'] ); ?>;} <?php } ?>
<?php if($theme_option['colormenu_scroll'] != ''){ ?> .cbp-af-header.cbp-af-header-shrink ul.slimmenu li a {color:<?php echo esc_attr( $theme_option['colormenu_scroll'] ); ?>;} <?php } ?>
.menu-back.cbp-af-header ul.slimmenu li a.mPS2id-highlight, 
.cbp-af-header.cbp-af-header-shrink ul.slimmenu li a.mPS2id-highlight {
  color:<?php echo esc_attr( $theme_option['main-color'] ); ?>;
  border-bottom: 0px solid <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
.menu-back ul.slimmenu > li.current-menu-item > a, 
.menu-back ul.slimmenu > li.current-menu-ancestor > a{color:<?php echo esc_attr( $theme_option['main-color'] ); ?>;}
.menu-back ul.slimmenu li.current-menu-ancestor ul li.current-menu-item a {
  color:<?php echo esc_attr( $theme_option['main-color'] ); ?>;
  border-bottom: 1px solid <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

/**** Custom logo ****/
.logo{      
  width: <?php echo esc_attr($theme_option['logo_width']); ?>;  
  height: <?php echo esc_attr($theme_option['logo_height']); ?>;   
  background:url('<?php echo esc_url($theme_option['logo']['url']); ?>') no-repeat center center;       
  background-size: <?php echo esc_attr($theme_option['logo_width']); ?> <?php echo esc_attr($theme_option['logo_height']); ?>; 
}
.cbp-af-header.cbp-af-header-shrink .logo{  
  width: <?php echo esc_attr($theme_option['logo_widths']); ?>;  
  height: <?php echo esc_attr($theme_option['logo_heights']); ?>; 
  background:url('<?php echo esc_url($theme_option['logo_scroll']['url']); ?>') no-repeat center center;        
  background-size: <?php echo esc_attr($theme_option['logo_widths']); ?> <?php echo esc_attr($theme_option['logo_heights']); ?>;
}
@media only screen and (max-width: 800px) {  
  .logo{    
    width: <?php echo esc_attr($theme_option['logo_width_mobile']); ?>;  
    height: <?php echo esc_attr($theme_option['logo_height_mobile']); ?>;        
    background-size: <?php echo esc_attr($theme_option['logo_width_mobile']); ?> <?php echo esc_attr($theme_option['logo_height_mobile']); ?>;
  }  
  .cbp-af-header.cbp-af-header-shrink .logo{      
    width: <?php echo esc_attr($theme_option['logo_width_mobile']); ?>;  
    height: <?php echo esc_attr($theme_option['logo_height_mobile']); ?>;        
    background-size: <?php echo esc_attr($theme_option['logo_width_mobile']); ?> <?php echo esc_attr($theme_option['logo_height_mobile']); ?>;    
   }
}
.logo, .cbp-af-header.cbp-af-header-shrink .logo {top: <?php echo esc_attr( $theme_option['logo_margin_top'] ); ?>;}

/**** Custom Main Color ****/
#royal_preloader.text .loader,
.big-text, .big-text span,
.cl-effect-5 a span::before,
.list-social li.icon-soc a,
.icon-left1,
.text-over-video, 
.team-social li:hover.icon-team a,
.portfolio-box .fancybox-button,
#filter li .current ,
.portfolio-box h4,
.plans-offer-gold h3,  
.plans-offer-gold h3 span, 
.plans-offer-gold h6,
.plans-offer-gold a,
.plans-offer a,
.link-work a,
.facts-wrap-num,
form #button-con input,
form #button-con input:hover,
.button-map:hover,
.blog-post p span,
.contact-wrap i, 
.icon-footer,
.icon-test,
#footer .back-top,
.blog-text-name a, #footer i,
.pagination ul li a.current, .pagination ul li span.current, 
.pagination ul li a:hover,
.blog-post .post h6 a, .widget_meta abbr,
.search_form:hover:before, .view-live:hover, .widget_categories ul li a:hover, .widget_archive ul li a:hover, .widget_meta ul li a:hover,
.widget_meta ul li:before, .widget_categories ul li:before, .widget_archive ul li:before{
	color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
ul.slimmenu li a:hover {
    border-bottom: 1px solid <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
ul.slimmenu li ul li a:hover {
    border-bottom:1px solid <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
.team-line{
	background: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
} 
.slideshow > nav span.current, .tag11:hover, .wp-tag-cloud li:hover, .widget_recent_entries ul li:hover {
	background-color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
.flat-filled .icon > path {
    fill: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}
.flat-filled .icon > .lightning {
    fill: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

/* Customize footer css */
#footer{
  background-color:<?php echo esc_attr( $theme_option['background_footer'] ); ?>;
  color:<?php echo esc_attr( $theme_option['color_footer'] ); ?>;
}