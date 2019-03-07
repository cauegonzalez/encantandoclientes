<?php
$query = ( $GLOBALS['ff-query']);

$fw_twitter = $query->get('fw_twitter');
$username = $fw_twitter->get('username');

$twitterFeeder = ffContainer::getInstance()->getLibManager()->createTwitterFeeder();
ffContainer::getInstance()->getClassLoader()->loadClass('ffOptionsHolder_Twitter');

$tweetsCollection = ($twitterFeeder->getTwitterFeed( $query->get(ffOptionsHolder_Twitter::SECTION_NAME) ));

?>

<section class="section-twitter parallax-section"<?php ff_print_section_id(); ?>>
	<div class="clear"></div>
	<div
		class="parallax-1"
		style="background-image:url('<?php echo esc_url( $query->getImage('background-image')->url ); ?>')"
		data-parallax-speed="<?php echo esc_attr( $query->get('parallax_speed') ); ?>"
	></div>
	<div class="just_pattern_parallax"></div>

	<div class="container z-index-pages">
		<div class="sixteen columns" data-scroll-reveal="enter top move 300px over 1s after 0.1s">
			<div class="twitter-wrap">
			<?php

				$tweetsText = '';
				$buttonsText = '';

				if( ! $tweetsCollection->valid() ){
						$tweetsText .= '<div class="item">';
							$tweetsText .= '<p style="font-size:40px">Oops!</p>';
							$tweetsText .= '<p>Bad Twitter account data!</p>';
						$tweetsText .= '</div>';
				}else{
					foreach( $tweetsCollection as $oneTweet ) {
						$tweetsText .= '<div class="item">';
							$tweetsText .= '<p>';
								$tweetsText .= '<a href="'.esc_url( 'http://twitter.com/'.$username ).'">';
									$tweetsText .= '@'.ff_wp_kses( $username );
								$tweetsText .= '</a>';
								$tweetsText .= ': ';
								$tweetsText .= ff_wp_kses( $oneTweet->text );
							$tweetsText .= '</p>';
						$tweetsText .= '</div>';

						$time = ( strtotime($oneTweet->date) );

						$timeFormat = 'g:i A - j M Y';
						$date = date( $timeFormat, $time);

						$buttonsText .= '<div class="item">';
							$buttonsText .= '<p>';
								$buttonsText .= $date;
							$buttonsText .= '</p>';
						$buttonsText .= '</div>';
					}
				}

			?>

				<div id="sync3" class="owl-carousel">
					<?php

						// Generated HTML output
						echo $tweetsText;

					?>
				</div>

				<div id="sync4" class="owl-carousel">
					<?php

						// Generated HTML output
						echo $buttonsText;

					?>
				</div>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</section>




