<?php

	$id = get_the_id();

	$terms = composer_get_the_term_list( $id, 'pix_categories',' ','&ensp;/&ensp;');
	
    if( !empty( $terms ) ) : ?>
        <p class='portfolio-terms'><?php echo strip_tags( $terms ); ?></p>
    <?php endif;