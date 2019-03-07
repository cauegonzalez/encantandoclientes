<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );
	$layout = composer_get_meta_value( $id, '_amz_layout', 'default', $prefix.'sidebar', 'right-sidebar' );

	$date     = composer_get_option_value( $prefix.'date', 'show' );
    $like     = composer_get_option_value( $prefix.'like', 'show' );
    $comment  = composer_get_option_value( $prefix.'comment', 'show' );
    $author   = composer_get_option_value( $prefix.'author', 'show' );

	global $post;

	if( 'style1' == $style ) :

		$meta_class = ( 'right-sidebar' == $layout ) ? 'right' : 'left';
		?>

		<div class="post-author <?php echo esc_attr( $meta_class ); ?>">

			<?php if( 'show' == $author ) :

				if ( function_exists( 'coauthors_posts_links' ) ) : ?>

					<p class="author-name"><?php esc_html_e( 'By ', 'composer' ). coauthors_posts_links( null, null, null, null, false ); ?></p>
				
				<?php else :
					$author_id = $post->post_author;
					?>

					<div class="author-img">
						<?php echo get_avatar( $author_id, '65' ); ?>
					</div>

					<p class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></p>

				<?php endif;
			endif;

			if( 'show' == $date || 'show' == $like || 'show' == $comment ) :

				if( 'show' == $date ) : ?>
					<p class="date"><?php echo esc_html( get_the_time( get_option('date_format') ) ); ?></p>
				<?php endif;

				if( 'show' == $like || 'show' == $comment ) : ?>

					<p class="like-comment">

						<?php if( 'show' == $like ) :

							$like_count = get_post_meta( $id, '_pix_like_me', true );
							$like_count = ( '' == $like_count ) ? 0 : $like_count;
							
							$like_class = isset( $_COOKIE['pix_like_me_'. $id ] ) ? 'liked' : '';

							?>

							<a href="#void" class="pix-like-me <?php echo esc_attr( $like_class ); ?>" data-id="<?php echo esc_attr( $id ); ?>"><i class="pixicon-heart-2"></i><span class="like-count"><?php echo esc_html( $like_count ); ?></span></a>
						
						<?php endif;

						if( 'show' == $comment ) : ?>

							<a href="<?php echo esc_url( get_comments_link( $id ) ); ?>"><span class="pix-blog-comments"><i class="pixicon-comment-1"></i><?php echo esc_html( get_comments_number() ); ?></span></a>

						<?php endif; ?>

					</p>

				<?php endif;

			endif;

			// Share icons
			get_template_part( 'templates/single-blog/includes/element', 'share' ); 
			?>
		
		</div> <!-- .post-author -->

	<?php elseif( 'style2' == $style || 'style3' == $style ) :

		if( 'show' == $date || 'show' == $author || 'show' == $comment ) : ?>

			<div class="post-meta">

				<?php if( 'show' == $author ) :

					if ( function_exists( 'coauthors_posts_links' ) ) : ?>

						<p class="author-name"><?php echo esc_html__( 'By ', 'composer' ). coauthors_posts_links( null, null, null, null, false ); ?></p>

					<?php else:

						// Author info
						global $post;
						$author_id = $post->post_author;
						?>
						<p class="author-name"><?php echo esc_html__( 'By ', 'composer' ) . esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></p>
					
					<?php endif;
					
				endif;

				if( 'show' == $date ) : ?>

					<p class="date"><?php echo esc_html( get_the_time( get_option('date_format') ) ); ?></p>

				<?php endif;

				if( 'show' == $comment ) : ?>

					<p class="comment"><a href="<?php echo esc_url( get_comments_link( $id ) ); ?>"><span class="pix-blog-comments"><i class="pixicon-comment-1"></i><?php echo esc_html( get_comments_number() ); ?></span></a></p>

				<?php endif; ?>
			
			</div> <!-- .post-meta -->

		<?php endif;

	endif;