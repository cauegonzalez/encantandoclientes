<?php
$query = ( $GLOBALS['ff-query']);
$align = $query->get('align');
?>
<section class="parallax-section section-parallax-gallery-item" <?php ff_print_section_id(); ?>>
	<div
		class="parallax-1"
		style="background-image:url('<?php echo esc_url( $query->getImage('background-image')->url ); ?>')"
		data-parallax-speed="<?php echo esc_attr( $query->get('parallax_speed') ); ?>"
	></div>

	<div class="just_pattern_parallax"></div>
	<div class="container z-index-pages">
		<div class="sixteen columns" data-scroll-reveal="enter left move 400px over 1.2s after 0.1s">
			<div class="text-<?php echo esc_attr( $align ); ?>">
				<h2><?php echo ff_wp_kses( $query->get('title') ); ?></h2>
			</div>
		</div>
		<div class="sixteen columns" data-scroll-reveal="enter left move 400px over 1.2s after 0.3s">
			<div class="text-<?php echo esc_attr( $align ); ?>">
				<p><?php echo ff_wp_kses( $query->get('description') ); ?></p>
			</div>
		</div>
		<div class="sixteen columns" data-scroll-reveal="enter left move 400px over 1.2s after 0.5s">
			<div class="more-<?php echo esc_attr( $align ); ?> big-image" data-image="<?php echo esc_url( $query->getImage('background-image')->url ); ?>" data-title="<?php echo esc_attr( $query->get('title') ); ?>"></div>
		</div>
	</div>
</section>