<?php
/**
 * Template Name: Blog With Sidebar
 */
 global $theme_option;
 $image_header = get_post_meta(get_the_ID(),'_cmb_page_image', true);
get_header(); ?>

	<section class="blog" id="blog">
		<div class="parallax-section">	
			<div class="parallax-blog" <?php if($image_header != ''){ ?> style="background-image: url('<?php echo esc_url($image_header); ?>');" <?php } ?> ></div>
			<div class="overlay-blog"></div>
			<div class="container z-index-pages">
				<div class="twelve columns">
					<h1><?php echo esc_attr($theme_option['blog_title']); ?></h1>
				</div>
				<div class="twelve columns">
					<div class="sub-text"><?php echo esc_attr($theme_option['blog_subtitle']); ?></div>
				</div>
			</div>
		</div>	
	</section>	

	<section class="blog-post-wrapper blog-sidebar">
		<div class="container">
			<div class="eight columns">
				<?php if(have_posts()) : ?>	
				<?php 
					$args = array(    
						'paged' => $paged,
						'post_type' => 'post',
						);
					$wp_query = new WP_Query($args);
					while ($wp_query -> have_posts()): $wp_query -> the_post(); 
				?> 		
					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
				<?php endwhile;?> 
			
				<?php else: ?>
					<h1><?php _e('Nothing Found Here!', 'ananke'); ?></h1>
				<?php endif; ?>	
				<?php
					global $wp_query;
					if($wp_query->max_num_pages>0){
				?>
				<div class="pagination">
					<?php ananke_pagination();?>
				</div>
				<?php } ?>
			</div>		
			<div class="four columns">
				<?php get_sidebar();?>
			</div>
		</div>	
	</section>				
    <?php
get_footer();
