<?php 
global $theme_option;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post" data-scroll-reveal="enter bottom move 100px over 0.5s after 0.1s">	
		<?php $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);?>
		<?php if($link_audio !=''){?>
			<div class="audio-player">
				<iframe height="166" scrolling="no" frameborder="no" src="<?php echo esc_url(get_post_meta(get_the_ID(), "_cmb_link_audio", true));?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
			</div>
		<?php }?>
		<div class="blog-text-wrap">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
			<div class="blog-text-name"><?php the_author_posts_link(); ?></div>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="blog-text-date"><?php the_date(get_option( 'date_format' )); ?></div>
			<p><?php echo ananke_blog_excerpt($theme_option['blog_excerpt']); ?>
				<a href="<?php the_permalink(); ?>">
					<span>
					<?php if($theme_option['read_more']) { echo esc_attr($theme_option['read_more']); }else{ echo '<i class="fa fa-long-arrow-right"></i>'; }?>
					</span>
				</a>
			</p>
		</div>
	</div>
</article>	
	
