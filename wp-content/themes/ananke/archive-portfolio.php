<?php 
/*
 *  The template for displaying Category pages
 */
global $theme_option;
$show1 = (!empty($theme_option['archive_number']) ? $theme_option['archive_number'] : 8);
get_header();?>

<section class="blog" id="archive-portfolio">
	<div class="parallax-section">	
		<div class="parallax-blog" <?php if($theme_option['archive_portfolio_thumbnail']['url'] != ''){ ?> style="background-image: url('<?php echo esc_url($theme_option['archive_portfolio_thumbnail']['url']); ?>');" <?php } ?> ></div>
		<div class="overlay-blog"></div>
		<div class="container z-index-pages">
			<div class="twelve columns">
				<h1><?php echo esc_attr($theme_option['archive_title']); ?></h1>
			</div>
			<div class="twelve columns">
				<div class="sub-text"><?php echo esc_attr($theme_option['archive_stitle']);  ?></div>
			</div>
		</div>
	</div>	
</section>

<!--Portfolio section-->
<section class="tCenter paddtop-20">
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
		<div class="container">
			<div class="twelve columns">
				<div id="portfolio-filter">
					<ul id="filter">
						<li><a href="#" class="current" data-filter="*" title=""><?php echo esc_attr($theme_option['archive_showall']); ?></a></li>
						<?php 
							$categories = get_terms('categories');   
							foreach( (array)$categories as $categorie){
								$cat_name = $categorie->name;
								$cat_slug = $categorie->slug;
						?>
							<li><a href="#" data-filter=".<?php echo esc_attr($cat_slug); ?>"><?php echo esc_attr($cat_name); ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<ul class="portfolio-wrap">
			<?php 
				global $post;					
				$args = array(   
					'post_type' => 'portfolio',
					'posts_per_page' => $show1,
				);  
				$wp_query = new WP_Query($args);					
				while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
				$cates = get_the_terms(get_the_ID(),'categories');
				$cate_name ='';
				$cate_slug = '';
					  foreach((array)$cates as $cate){
						if(count($cates)>0){
							$cate_name .= $cate->name.' ' ;
							$cate_slug .= $cate->slug .' ';     
						} 
				} 
				$format = get_post_format($post->ID);
				$link_video = get_post_meta(get_the_ID(),'_cmb_portfolio_video', true);
			?>
			<li class="portfolio-box <?php echo esc_attr($cate_slug); ?>">	
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