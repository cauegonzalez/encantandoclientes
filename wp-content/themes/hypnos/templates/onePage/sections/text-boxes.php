<?php
$query = ( $GLOBALS['ff-query']);
?>
<section class="section-text-boxes text-boxes"<?php ff_print_section_id(); ?>>

	<div class="con-detal-wrapper">
		<div class="container">
			<?php foreach( $query->get('item') as $oneItem) { ?>
			<div class="one-third column"
				data-scroll-reveal="enter <?php echo esc_attr( $oneItem->get('animation') ); ?> move 200px over 1s after 0.2s">
				<h5><?php echo ff_wp_kses( $oneItem->get('title') ); ?></h5>
				<p><?php echo ff_wp_kses( $oneItem->get('description') ); ?></p>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="clear"></div>

</section>
