<?php
	$query = ( $GLOBALS['ff-query']);
	$videoUrl = $query->get('video');

	$videoUrl = str_replace('//vimeo.com/', '//player.vimeo.com/video/', $videoUrl);
	$videoUrl = str_replace('//www.youtube.com/watch?v=', '//www.youtube.com/embed/', $videoUrl);

	$title = trim( $query->get('title') );
	if( !empty($title) ){
		$title = "<h4>".ff_wp_kses( $title )."</h4>";
	}

	$description = trim( $query->get('description') );
	if( !empty($description) ){
		$description = "<p>".ff_wp_kses( $description )."</p>";
	}

?>
<div class="section-video services-video-wrapper"<?php ff_print_section_id(); ?>>
	<div class="services-video-wrap">
		<div class="video-container">
			<iframe src="<?php echo esc_url( $videoUrl ); ?>" width="940" height="450" ></iframe>
		</div>
	</div>
	<div class="services-video-wrap">
		<div class="video-text">
			<?php echo ff_wp_kses( $title ); ?>
			<?php echo ff_wp_kses( $description ); ?>
		</div>
	</div>
</div>
