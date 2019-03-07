<?php
$query = ( $GLOBALS['ff-query']);
?>

<!-- ABOUT US SECTION
================================================== -->

<section class="section-about about"<?php ff_print_section_id(); ?>>

	<div class="container">
		<div class="sixteen columns">
			<h1><?php echo ff_wp_kses( $query->get('title') ); ?></h1>
		</div>
		<div class="sixteen columns">
			<div class="sub-text-line"></div>
		</div>
		<div class="sixteen columns">
			<div class="sub-text link-svgline"><?php echo ff_wp_kses( $query->get('description') ); ?></div>
		</div>
		<div class="clear"></div>
		<div class="four columns">
			<?php
				$timerDelay = 0.3;
				foreach( $query->get('one-item-left') as $oneItem ) {
					$timerDelay += 0.2;

					echo '<div class="about-box1" data-scroll-reveal="enter left move 300px over 1s after '.$timerDelay.'s">';
						// TODO ICON
						echo '<div class="about-box-icon"><i class="'.$oneItem->get('icon').'"></i></div>';
						echo '<h5>'.$oneItem->get('title').'</h5>';
						echo '<p>'.$oneItem->get('description').'</p>';
					echo '</div>';
				}
			?>
		</div>
		<div class="eight columns remove-bottom" data-scroll-reveal="enter bottom move 400px over 1s after 0.1s">
			<img src="<?php echo esc_url( $query->getImage('center-image')->url ); ?>" alt=""/>
		</div>
		<div class="four columns">
		<?php
				$timerDelay = 0.3;
				foreach( $query->get('one-item-right') as $oneItem ) {
					$timerDelay += 0.2;

					echo '<div class="about-box" data-scroll-reveal="enter right move 300px over 1s after '.$timerDelay.'s">';
						// TODO ICON
						echo '<div class="about-box-icon"><i class="'.$oneItem->get('icon').'"></i></div>';
						echo '<h5>'.ff_wp_kses( $oneItem->get('title') ).'</h5>';
						echo '<p>'.ff_wp_kses( $oneItem->get('description') ).'</p>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</section>

