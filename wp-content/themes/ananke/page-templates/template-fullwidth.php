<?php
/**
 * Template Name: Full Width
 */
$image_header = get_post_meta(get_the_ID(),'_cmb_page_image', true);
get_header(); ?>
	
	<section class="blog" id="blog">
		<div class="parallax-section">	
			<div class="parallax-blog" <?php if($image_header != ''){ ?> style="background-image: url('<?php echo esc_url($image_header); ?>');" <?php } ?> ></div>
			<div class="overlay-blog"></div>
			<div class="container z-index-pages">
				<div class="twelve columns">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="twelve columns">
					<div class="sub-text"><?php echo esc_attr(get_post_meta(get_the_ID(),'_cmb_page_sub_title', true));  ?></div>
				</div>
			</div>
		</div>	
	</section>				
	
	<section class="blog-post-wrapper">
		<div class="container">
			<div class="twelve columns">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
				<div class="blog-post" id="blog-single" data-scrollreveal="enter bottom and move 50px over 1s">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
						<?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail(); ?>
						<?php }?>
						<?php the_content();?>
						
						<?php wp_link_pages(); ?>
					</div>
				</div>
				<?php endwhile; ?>					
			</div>
		</div>	
	</section>		
<?php
get_footer();
