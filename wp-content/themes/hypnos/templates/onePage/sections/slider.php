<?php
	if( !function_exists('putRevSlider') ) {
		return;
	}

	$query = ( $GLOBALS['ff-query']);

?>

<section class="section-slider home" <?php ff_print_section_id(); ?>
	<?php if($query->get('background-image image') ) { ?>
		style="background-image: url('<?php echo esc_url( $query->getImage('background-image image')->url ); ?>'); background-size: cover;"
	<?php } ?>
	>
<?php

	if( $query->get('background-video show') ){ ?>
		<video
			id="video_background"
			preload="auto"
			autoplay="true"
			loop="loop"
			muted="muted"
			volume="0"
			>

			<?php if($query->get('background-video webm') ) { ?>
				<source src="<?php echo esc_url( $query->get('background-video webm') ); ?>" type="video/webm">
			<?php } ?>

			<?php if($query->get('background-video mp4') ) { ?>
				<source src="<?php echo esc_url( $query->get('background-video mp4') ); ?>" type="video/mp4">
			<?php } ?>

			<?php if($query->get('background-video ogg') ) { ?>
				<source src="<?php echo esc_url( $query->get('background-video ogg') ); ?>" type="video/ogg">
			<?php } ?>

		</video>
	<?php } else if( $query->get('background-image show') ){ ?>
		<div class="image_background <?php
			if( 'parallax' == $query->get('background-image effect') ){
				echo 'parallax-1';
				echo '" data-parallax-speed="'.esc_attr( $query->get('background-image parallax_speed') );
			}else if( 'pattern' == $query->get('background-image effect') ){
				echo 'slider-pattern';
			}
		?>" style="background-image:url('<?php
			echo esc_url( $query->getImage('background-image image' )->url );
		?>')"></div>
	<?php }

	putRevSlider( $query->get('id') );
?>
</section>