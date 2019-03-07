<?php
global $theme_option;
$thumbnail1 = $theme_option['blog_thumbnail'];
get_header(); ?>
	
	<section class="blog" id="blog">
		<div class="parallax-section">	
			<div class="parallax-blog" <?php if($thumbnail1['url'] != ''){ ?> style="background-image: url('<?php echo esc_url($thumbnail1['url']); ?>');" <?php } ?> ></div>
			<div class="overlay-blog"></div>
			<div class="container z-index-pages">
				<div class="twelve columns">
					<?php the_archive_title( '<h1>', '</h1>' );?>
				</div>
				<div class="twelve columns">
					<?php the_archive_description( '<div class="sub-text">', '</div>' ); ?>
				</div>
			</div>
		</div>	
	</section>

	<section class="blog-post-wrapper <?php if (isset($theme_option['blog_layout']) and $theme_option['blog_layout'] == 'wsb' || $theme_option['blog_layout'] == 'wsbl') { echo "blog-sidebar";}?>">
		<div class="container">
			<?php if (isset($theme_option['blog_layout']) and $theme_option['blog_layout'] == 'wsbl') { ?>
				<div class="four columns">
					<?php get_sidebar();?>
				</div>
			<?php } ?>	

			<div class="<?php if(isset($theme_option['blog_layout']) and $theme_option['blog_layout'] != 'fw' ){echo 'eight';}else{echo 'twelve';}?> columns">
				<?php if(have_posts()) : ?>	
					<?php while(have_posts()) : the_post(); ?>		
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

			<?php if (isset($theme_option['blog_layout']) and $theme_option['blog_layout'] == 'wsb') { ?>
				<div class="four columns">
					<?php get_sidebar();?>
				</div>
			<?php } ?>
		</div>
	</section>				
					
<?php get_footer();
