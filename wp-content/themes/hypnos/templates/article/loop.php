<div id="post-<?php the_ID(); ?>" <?php post_class("post-content"); ?> data-scroll-reveal="enter bottom move 300px over 1s after 0.007s">
	<?php get_template_part( 'templates/article/thumbnail', get_post_format()); ?>

	<?php if ( 'quote' == get_post_format() ){ ?>

		<blockquote>
			<p><?php the_title(); ?></p>
		</blockquote>

	<?php } else if ( 'link' == get_post_format() ){ ?>

		<?php // no title for link post format ?>

	<?php } else { ?>

		<h5 class="post-title">
			<a href="<?php the_permalink() ?>">
				<?php the_title(); ?>
			</a>
		</h5>

	<?php } ?>

	<?php get_template_part( 'templates/article/post-meta'); ?>
	<?php the_content(); ?>
	<?php get_template_part( 'templates/article/pagination-single'); ?>
	<div class="read-more">
		<p>
			<a href="<?php the_permalink() ?>">
				<?php echo ffThemeOptions::getQuery('translation posts Excerpt_More'); ?>
			</a>
		</p>
		<span><?php
			printf( ffThemeOptions::getQuery('translation posts posted_by') , ffContainer::getInstance()->getThemeFrameworkFactory()->getPostMetaGetter()->getPostAuthorName() ); // @todo, get_the_author() is NOT working
		?></span>
	</div>
</div>


