<div id="post-<?php the_ID(); ?>" <?php post_class("post-content"); ?> data-scroll-reveal="enter bottom move 300px over 1s after 0.007s">
	<h5 class="post-title">
		<a href="<?php the_permalink() ?>">
			<?php the_title(); ?>
		</a>
	</h5>

	<?php the_content(); ?>
	<?php get_template_part( 'templates/article/pagination-single'); ?>
</div>

<?php comments_template(); ?>




