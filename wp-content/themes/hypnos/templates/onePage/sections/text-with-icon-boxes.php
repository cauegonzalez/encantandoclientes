<?php
$query = ( $GLOBALS['ff-query']);
?>
<!-- SERVICES SECTION
    ================================================== -->

<section class="section-text-with-icon-boxes services"<?php ff_print_section_id(); ?>>

	<div class="services-icons-wrapper">
		<div class="container">
			<?php foreach( $query->get('item') as $oneItem) { ?>
				<div class="one-third column services-icon-padding<?php if( '' != $oneItem->get('overlay') ) { echo ' tipped'; } ?>"
					data-title="<?php echo esc_attr( $oneItem->get('overlay') ); ?>"
					data-tipper-options='{"direction":"top","follow":"true"}'
					data-scroll-reveal="enter <?php echo esc_attr( $oneItem->get('animation') ); ?> move 300px over 1s after 0.1s">
					<div class="icon-services"><span class="<?php echo esc_attr( $oneItem->get('icon') ); ?>"></span></div>
					<h5><?php echo ff_wp_kses( $oneItem->get('title') ); ?></h5>
					<p><?php echo ff_wp_kses( $oneItem->get('description') ); ?></p>
				</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>

	<div class="clear"></div>


</section>

