<?php

if( !defined( 'FF_LAYOUT' ) ) exit;

get_header();

get_template_part( 'templates/header/navigation');

?>

	<!-- BLOG
    ================================================== -->

	<div class="blog-wrapper" id="blog">
		<div class="container">
			<?php get_template_part( 'templates/article/titlebar'); ?>

			<div class="eleven columns">

<?php
if (have_posts()) {
	while (have_posts()){
		the_post();
		get_template_part( 'templates/article/loop', FF_POST_TYPE);
	}
	get_template_part( 'templates/article/pagination-archive');
}else{
	get_template_part( 'templates/article/single-404');
}

?>

			</div>

			<div class="five columns">
				<div class="post-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>

<?php

get_footer();
