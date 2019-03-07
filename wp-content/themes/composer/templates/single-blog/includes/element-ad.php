<?php

	$ad = composer_get_option_value( 'ad1', '' );
		
	if( !empty( $ad ) ) : ?>
	
		<div>
			<?php echo $ad; 
			if( 'show' == $show_text ) : ?>
				<p><?php esc_html_e( 'Advertisement', 'composer' ); ?></p>
			<?php endif; ?>
		</div>

	<?php endif;