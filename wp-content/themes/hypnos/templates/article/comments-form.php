<?php

///////////////////////////////////////////////////////////////////////////////////////////////////
// Add wrappers to comment input fields
///////////////////////////////////////////////////////////////////////////////////////////////////

function ff_tidy_comment_field( $field ){
	$field = str_replace('comment-form', 'form-group comment-form', $field);
	$field = str_replace('<p ', '<div ', $field);
	$field = str_replace('/p>', '/div>', $field);
	$field = str_replace('<input ', '<input class="" ', $field);
	$field = str_replace('<textarea ', '<textarea class="" ', $field);
	return $field;
}

// Author

function ff_comment_form_field_author( $field ) {
	$content =  ff_tidy_comment_field($field);
	$content = str_replace('form-group', 'form-group col-xs-6', $content);

	return $content;
//col-xs-6
}
add_filter( 'comment_form_field_author', 'ff_comment_form_field_author' );

// Email

function ff_comment_form_field_email( $field ) {
	$content =  ff_tidy_comment_field($field);
	$content = str_replace('form-group', 'form-group col-xs-6', $content);

	return $content;
 }
add_filter( 'comment_form_field_email', 'ff_comment_form_field_email' );



// Site

function ff_comment_form_field_url( $field ) { return ff_tidy_comment_field($field); }
add_filter( 'comment_form_field_url', 'ff_comment_form_field_url' );

// Comment text

function ff_comment_form_field_comment( $field ) { return ff_tidy_comment_field($field); }
add_filter( 'comment_form_field_comment', 'ff_comment_form_field_comment' );

// Submit

function ff_comment_form_field_submit( $field ) { return ff_tidy_comment_field($field); }
add_filter( 'comment_form_field_submit', 'ff_comment_form_field_submit' );

if( comments_open() ){
	wp_enqueue_script( "comment-reply" );
	ob_start();

	$commentsTrans = ffThemeOptions::getQuery('translation comment_form');

	$fields =  array(

		'author' =>
			'<input id="author" name="author" type="text" required="required" placeholder="' .
				esc_attr( $commentsTrans->get('name') ) .
			'" size="30"' . ' />',

		'email' =>
			'<input id="email" name="email" type="text" required="required" placeholder="' .
				esc_attr( $commentsTrans->get('email') ) .
			'" size="30"' . ' />',

		'url' =>
			'<input id="url" name="url" type="text" placeholder="' .
				esc_attr( $commentsTrans->get('website') ) .
			'" size="30"' . ' />',
	);

	$commentField = '<textarea placeholder="'.$commentsTrans->get('comment').'" required="required" id="comment" name="comment" aria-required="true"></textarea>';

	comment_form(
		array(
			'comment_notes_after' => '',
			'fields' => $fields,
			'comment_field' => $commentField,
			'label_submit' => $commentsTrans->get('send_button'),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply' => $commentsTrans->get('title'),
		)
	);

	$content = ob_get_contents();
	ob_end_clean();

	$content = str_replace(array( '<h3','</h3>'), array('<h6','</h6>'), $content);
	$content = str_replace('class="comment-respond"', 'class="comment-respond leave-reply" data-scroll-reveal="enter bottom move 300px over 1s after 0.007s"', $content);

	// Print modified comment form
	echo $content;

}
