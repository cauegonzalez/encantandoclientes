<?php
$query = ( $GLOBALS['ff-query']);
?>
<!-- SERVICES SECTION
    ================================================== -->

<section class="section-services services"<?php ff_print_section_id(); ?>>

	<div class="container">
		<div class="sixteen columns">
			<h1><?php echo ff_wp_kses( $query->get('center-title') ); ?></h1>
		</div>
		<div class="sixteen columns">
			<div class="sub-text-line"></div>
		</div>
		<div class="sixteen columns">
			<div class="sub-text link-svgline"><?php echo ff_wp_kses( $query->get('center-description') ); ?></div>
		</div>
		<div class="clear"></div>
		<div class="nine columns">
			<h4><?php echo ff_wp_kses( $query->get('left-title') ); ?></h4>
			<p class="general-subtext"><?php echo ff_wp_kses( $query->get('left-description') ); ?></p>
		</div>	
		<div class="seven columns">
			<div class="services-top-text">
				<?php foreach( $query->get('right-item') as $oneItem) { ?>
				<p><span>&#x2022;</span><?php echo ff_wp_kses( $oneItem->get('text') ); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

