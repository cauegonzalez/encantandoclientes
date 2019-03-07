<?php
$query = ( $GLOBALS['ff-query']);

$wrapWithSection = $query->get('wrap-with-section');

if( $wrapWithSection ) {
	echo  '<section class="section-map"';
	ff_print_section_id();
	echo '>';
}

// Special section, that enable user to insert any HTML
echo do_shortcode( $query->get('html') );

if( $wrapWithSection ) {
	echo '</section>';
}
