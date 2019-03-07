<?php

	$prefix = composer_get_prefix();
	
	// Tags
	$tags = composer_get_option_value( $prefix.'tags', 'show' );

	if( 'show' == $tags ) : ?>
	
		<div class="tags style1">
			<div>
				<?php the_tags( '<p>'. esc_html__( 'Tags: ', 'composer' ), ', ', '</p>' ); ?>
			</div>
		</div>

	<?php endif;