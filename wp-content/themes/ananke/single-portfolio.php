<?php 
	while(have_posts()) :the_post(); 
	$link_out = get_post_meta(get_the_ID(),'_cmb_link_project', true); 
?>
	<div id="project-single-slider">
		<div class="clear"></div>
		<div id="last-work">
			<div class="container">
				<div class="twelve columns">
					<h3><?php the_title(); ?></h3>
					<?php if($link_out) { ?>
					<a class="view-live" href="<?php echo esc_url($link_out);?>"><?php global $theme_option; echo esc_attr($theme_option['portfolio_live']); ?></a>
					<?php } ?>	
				</div>				
			</div>
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile;?>