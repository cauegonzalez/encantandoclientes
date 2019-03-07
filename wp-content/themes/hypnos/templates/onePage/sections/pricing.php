<?php
$query = ( $GLOBALS['ff-query']);
?>

<section class="section-pricing services"<?php ff_print_section_id(); ?>>
	<div class="price-wrapper">
		<div class="container">
			<div class="sixteen columns">
				<h4><?php echo ff_wp_kses( $query->get('title') ); ?></h4>
			</div>
			<div class="clear"></div>
			<?php foreach( $query->get('one-table') as $oneTable ) { ?>
				<div class="four columns">
					<div class="price-wrap">
						<div class="icon-price <?php
							if( $oneTable->get( 'highlight' ) ){
								echo 'featured-price';
							}else{
								echo 'normal-price';
							}
						?>"><i class="<?php echo esc_attr( $oneTable->get('icon') ); ?>"></i></div>
						<h6<?php
							if($oneTable->get( 'highlight' )){
								echo ' class="featured-price"';
							}
						?>><?php echo ff_wp_kses( $oneTable->get('title') ); ?></h6>
						<h5><?php echo ff_wp_kses( $oneTable->get('price') ); ?></h5>
						<?php
							foreach( $oneTable->get('one-line') as $oneLine ) {
								echo '<p>' . ff_wp_kses( $oneLine->get('text') ) . '</p>';
							}
						?>
						<div class="link-svgline <?php
							if( $oneTable->get( 'highlight' ) ){
								echo 'featured-price';
							}else{
								echo 'normal-price';
							}
						?>"><a href="<?php echo esc_url( $oneTable->get('button href') ); ?>"><?php echo ff_wp_kses( $oneTable->get('button text') ); ?><svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a></div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="clear"></div>

</section>
