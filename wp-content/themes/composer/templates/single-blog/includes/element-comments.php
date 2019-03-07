<?php
	
	$comment_template = composer_get_option_value( 'single_comment_template', 'show' );

	if( 'show' == $comment_template ) {
		comments_template();
	}