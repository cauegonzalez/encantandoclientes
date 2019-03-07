<?php
$query = ( $GLOBALS['ff-query']);
?>


	<!-- FEATURED SECTION
    ================================================== -->

	<section class="section-featured featured"<?php ff_print_section_id(); ?>>

		<div class="container">
			<div class="sixteen columns">
				<h4><?php echo ff_wp_kses( $query->get('title') ); ?></h4>
			</div>
			<div class="sixteen columns">
				<div class="cl-effect"><a href="<?php echo esc_url( $query->get('button-link') ); ?>" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo ff_wp_kses( $query->get('button-title-hover') ); ?>"><?php echo ff_wp_kses( $query->get('button-title') ); ?></span></a></div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="slideshow-featured">
			<div class="ff_film_roll_container">
				<?php
					foreach( $query->get('projects') as $oneProject) {
						echo '<div>';
							echo '<a href="'.esc_url($oneProject->get('link')).'" target="_blank" data-gal="m_PageScroll2id" data-ps2id-offset="65">';
								echo '<div class="slide-featured">';
									echo '<img src="'.esc_url( $oneProject->getImage('image')->url ).'" alt="">';
									echo '<div class="mask"></div>';
									echo '<p><span>'.ff_wp_kses( $oneProject->get('title') ).'</span></p>';
								echo '</div>';
							echo '</a>';
						echo '</div>';
					}
				?>
			</div>
		</div>

	</section>
	<div class="clear"></div>