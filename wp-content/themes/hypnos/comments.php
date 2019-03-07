<?php
if( ! post_password_required() ) {

	if ( get_comments_number() > 0 ) {
		get_template_part( 'templates/article/comments-list');
	}

	if ( comments_open() ) {
		get_template_part( 'templates/article/comments-form');
	}

}
