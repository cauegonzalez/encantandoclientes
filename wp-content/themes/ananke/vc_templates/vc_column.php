<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $wap_class
 * @var $wap_id
 * @var $title
 * @var $column_effect
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = $wap_class = $wap_id = $title = $column_effect = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$effect_col = '';
if($column_effect == 'bottommove'){
	$effect_col = 'data-scroll-reveal="enter bottom move 100px over 0.5s after 0.1s"';
}elseif($column_effect == 'topmove'){
	$effect_col = 'data-scroll-reveal="enter top move 100px over 0.5s after 0.1s"';
}else{
	$effect_col = '';
}

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $wap_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $wap_id ) . '"';
}

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . htmlspecialchars_decode( $effect_col ) . '>';
$output .= '<div class="ak_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper ' . esc_attr( $wap_class ) . '">';
if($title!=""){
	$output .='<h5>' . esc_attr( $title ) . '</h5>';
}
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
