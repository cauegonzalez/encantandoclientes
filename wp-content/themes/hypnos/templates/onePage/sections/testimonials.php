<?php
$query = ( $GLOBALS['ff-query']);
?>


<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section"<?php ff_print_section_id(); ?>>

	<div
		class="parallax-1"
		style="background-image:url('<?php echo esc_url( $query->getImage('background-image')->url ); ?>')"
		data-parallax-speed="<?php echo esc_attr( $query->get('parallax_speed') ); ?>"
	></div>

	<div class="just_pattern_parallax"></div>

	<div class="container z-index-pages">
		<div class="sixteen columns">
			<div class="clients-carousel-wrap">

			<?php
				$imagesBuffer = '';
				$textBuffer = '';

				foreach ($query->get('one-item') as $oneItem ) {
					$textBuffer .= '<div class="item">';
					$textBuffer .=	'<p>' . ff_wp_kses( $oneItem->get('testimonial') );
					$textBuffer .=	'<h6>' . ff_wp_kses( $oneItem->get('author') ) . '<span>'.ff_wp_kses( $oneItem->get('position') ).'</span></h6>';
					$textBuffer .= '</div>';

					$imagesBuffer .= '<div class="item">';
					$imagesBuffer .=	'<img src="'.esc_attr( $oneItem->getImage('image')->url ).'" alt=""/>';
					$imagesBuffer .= '</div>';
				}
			?>

				<div id="sync1" class="owl-carousel">
					<?php

						// Generated HTML output
						echo $textBuffer;

					?>
				</div>

				<div id="sync2" class="owl-carousel">
					<?php

						// Generated HTML output
						echo $imagesBuffer;

					?>
				</div>

			</div>
		</div>
	</div>

</section>
