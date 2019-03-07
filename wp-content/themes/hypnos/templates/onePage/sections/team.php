<?php
$query = ( $GLOBALS['ff-query']);
?>
	<section class="section-team team"<?php ff_print_section_id(); ?>>
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
				<div class="sixteen columns">
				<?php
					$items = $query->get('one-item');

					foreach( $items as $oneItem ) {

					$imageUrl = fImg::resize($oneItem->getImage('image')->url, 240,240,true );
				?>

					<article>
						<img src="<?php echo esc_url( $imageUrl ); ?>" alt=""/>
						<h6><?php echo ff_wp_kses( $oneItem->get('name') ); ?></h6>
						<p><span><?php echo ff_wp_kses( $oneItem->get('position') ); ?></span></p>
						<p><?php echo ff_wp_kses( $oneItem->get('description') ); ?></p>
						<div class="social-team">
							<ul class="list-social">

							<?php
								$links = $oneItem->get('social-links');
								$links = trim($links);

								if( !empty($links) ){

									locate_template('templates/helpers/class.ffSocialFeeder.php', true, true);
									$socialFeeder = new ffSocialFeeder( $links );

									if( !empty( $socialFeeder->items ) ) {
										foreach( $socialFeeder->items as $oneItem ) {
											echo '<li class="icon-soc">';
											echo '<a href="'.$oneItem->link.'">';

											echo '<i class="ff-font-awesome4 icon-'.$oneItem->type.'"></i>';

											echo '</a>';
											echo '</li>';
										}
									}
								}
							?>
							</ul>
						</div>
					</article>
				<?php
					}
				?>
				</div>
			</div>
		</section> 
		
