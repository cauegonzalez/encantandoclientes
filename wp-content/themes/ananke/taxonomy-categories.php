<?php 
/*
 *  The template for displaying Category pages
 */
get_header();?>
<section class="blog" id="archive-portfolio">
	<div class="parallax-section">	
		<div class="parallax-blog" <?php if($theme_option['archive_portfolio_thumbnail']['url'] != ''){ ?> style="background-image: url('<?php echo esc_url($theme_option['archive_portfolio_thumbnail']['url']); ?>');" <?php } ?> ></div>
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

<!--Portfolio section-->
<section class="tCenter">
	<!-- Works list -->
	<div class="works clearfix ">
		<!--Portfolio-->
		<div class="clear"></div>
	    <div class="portfolio"></div>
		<div class="expander-wrap relative">
			<div id="expander-wrap">
				<p class="cls-btn"><a class="close">X</a></p>
				<div class="expander-inner"></div>
			</div>
		</div>	
		<div class="clear"></div>
		<ul class="portfolio-wrap">
			<?php 
				global $post;					
				while(have_posts()) : the_post();
				$format = get_post_format($post->ID);
				$link_video = get_post_meta(get_the_ID(),'_cmb_portfolio_video', true);
			?>
			<li class="portfolio-box">	
				<a class="expander" href="<?php the_permalink(); ?>" title="">
					<?php $params = array( 'width' => 600, 'height' => 375 );
					$image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
					<img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>"/>	
					<div class="mask"></div>
					<h4><?php the_title(); ?></h4>
				</a>	
				<?php if($format=='video'){ ?>
					<a class="fancybox-media fancybox.iframe" href="<?php echo esc_url( $link_video ); ?>" title="">
						<div class="fancybox-button">&#xf106;</div>
					</a>	
				<?php }else{ ?>
					<a class="fancybox-effects-d" href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" title="">
						<div class="fancybox-button">&#xf106;</div>
					</a>
				<?php } ?>	
			</li>
			<?php endwhile;?>
		</ul>
		<!--End portfolio-->
	</div>
	<!-- End works list -->

</section>
<!--End portfolio section-->
<?php get_footer();?>