<?php

ff_Featured_Area::setIgnoreFirstFeatured( false );
$featured_img = ff_Featured_Area::getFeaturedImage();
list( $featured_img_w, $featured_img_h  ) = ff_Featured_Area::getFeaturedImageSizes();

switch ( get_post_format() ) {
	case 'audio':
		$featured_primary_html = ff_Featured_Area::getFeaturedAudio();
		break;

	case 'video':
		$featured_primary_html = ff_Featured_Area::getFeaturedVideo();
		break;

	case 'gallery':
		ff_Featured_Area::setFeaturedPrinter( 'ff_Gallery_BXSlider' );
		$featured_primary_html = get_post_gallery( get_the_ID() );
		ff_Featured_Area::setFeaturedPrinter( false );
		break;

	default:
		$featured_primary_html = '';
		break;
}

global $featured_height;

if( ! empty( $featured_primary_html ) ){

	// HTML with wrapped featured area
	echo $featured_primary_html;

	ff_Featured_Area::setIgnoreFirstFeatured( true );
}else if( ! empty( $featured_img ) ) {
	echo '<div class="slider-image-post">';
	echo '<img ';
		echo 'src="'.esc_url( $featured_img ).'" ';
		echo 'width="' . $featured_img_w . '" ';
		echo 'height="' . $featured_img_h . '"alt="">';
	echo '</div>';
}
