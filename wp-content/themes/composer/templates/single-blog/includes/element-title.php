<?php

	$prefix = composer_get_prefix();

	// Title tag
    $title_tag     = composer_get_option_value( $prefix.'title_tag', 'h2' );
    
    the_title( '<'. composer_title_tag( $title_tag ) .' class="title">', '</'. composer_title_tag( $title_tag ) .'>' );