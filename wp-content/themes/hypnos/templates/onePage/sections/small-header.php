<?php
$query = ( $GLOBALS['ff-query']);
?>


	<!-- FEATURED SECTION
    ================================================== -->

	<section class="section-small-header">

		<a href="<?php echo esc_url( $query->get('link') ); ?>" data-gal="m_PageScroll2id" data-ps2id-offset="65">
			<div class="scroll-to-contact">
				<div class="container">
					<div class="sixteen columns">
						<h6><?php echo ff_wp_kses( $query->get('title') ); ?></h6>
					</div>
					<div class="sixteen columns">
						<div class="sub-text-line"></div>
					</div>
					<div class="sixteen columns">
						<div class="link-svgline-getintouch"><p><?php echo ff_wp_kses( $query->get('description') ); ?><svg class="link-svgline-getintouch"><use xlink:href="#svg_line"></use></svg></p></div>
					</div>
				</div>
			</div>
		</a>
	</section>