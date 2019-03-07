<div class="post-content-com-top" data-scroll-reveal="enter bottom move 300px over 1s after 0.007s">
	<p><?php
		$query = ffThemeOptions::getQuery('translation comment_list');
		comments_number(
			  $query->get('comments_zero')
			, $query->get('comments_one')
			, $query->get('comments_more')
		);
	?></p>
</div>
<?php

function ff_comments_callback($comment, $args, $depth) { ?>
<div class="post-content-comment<?php
	if( $depth > 1 ) echo ' reply-in';
	echo ' depth-'.$depth;
?>" id="comment-<?php comment_ID()?>" data-scroll-reveal="enter bottom move 300px over 1s after 0.007s">
	<?php echo get_avatar( get_comment_author_email(), '80'); ?>
	<div class="comment">

		<?php if( ffThemeOptions::getQuery('layout commentsmeta-date-show') ) { ?>

			<div class="comment-age">
				<?php echo get_comment_time( ffThemeOptions::getQuery('layout commentsmeta-date-format') ); ?>
			</div>

		<?php } ?>

		<h6><?php comment_author(); ?></h6>
		<div class="comment-text"><?php echo ff_wp_kses(get_comment_text()); ?></div>
		<div class="reply"><?php
			$replyText = ffThemeOptions::getQuery('translation comment_list reply');
			comment_reply_link(array_merge( $args, array('reply_text' => $replyText, 'depth' => $depth, 'max_depth' => $args['max_depth'])));
		?></div>
	</div>
</div>
<?php }

function ff_comments_callback_end(){
	return;
}

if( get_comments_number() > 0 ){
	wp_list_comments(
			array(
				'style' => 'div',
				'callback' => 'ff_comments_callback',
				'end-callback' => 'ff_comments_callback_end',
			));

	next_comments_link('<span class="button pag_com_link">' . ('comment next') . '</span>');
	previous_comments_link('<span class="button pag_com_link">' . ('comment prev') . '</span>');

}

