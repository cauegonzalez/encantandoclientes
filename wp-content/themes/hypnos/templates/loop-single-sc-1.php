<?php

if( !defined( 'FF_LAYOUT' ) ) exit;

the_post();

get_header();

get_template_part( 'templates/header/navigation');

?>

	<!-- BLOG
    ================================================== -->

	<div class="blog-wrapper" id="blog">
		<div class="container">
			<div class="five columns">
				<div class="post-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>

			<div class="eleven columns">
				<?php get_template_part( 'templates/article/single', FF_POST_TYPE); ?>
			</div>
		</div>
	</div>

<?php

get_footer();
