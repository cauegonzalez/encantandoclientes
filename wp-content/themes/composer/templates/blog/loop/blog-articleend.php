<?php
	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();
	
	$type = composer_get_option_value( $prefix.'styles', 'normal' );

	?>
	
	</article>
	
	<?php

		get_template_part( 'blog/loop/blog' , 'animationend' );

		if( 'masonry' == $type || 'grid' == $type ) : ?>

	        </div>

	    <?php endif;

	    if( 'masonry' != $type && 'grid' != $type ) : ?>

	    	</div> <!-- .load-element -->

	    <?php endif;