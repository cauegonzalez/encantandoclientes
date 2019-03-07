<?php

	$prefix = 'single_porfolio_';

	// Project details
	$project_detail_title = composer_get_option_value( $prefix.'project_detail_title', esc_html( 'Project Details', 'composer' ) );

	$client_name = composer_get_meta_value( $id, '_amz_client_name', '' );
	$client_title = composer_get_option_value( $prefix.'client_title', esc_html( 'Client', 'composer' ) );

	$skills = composer_get_meta_value( $id, '_amz_skills', '' );
	$skill_title = composer_get_option_value( $prefix.'skill_title', esc_html( 'Skills', 'composer' ) );

	$tasks = composer_get_meta_value( $id, '_amz_tasks');
	$task_title = composer_get_option_value( $prefix.'task_title', esc_html( 'Tasks', 'composer' ) );

	$project_url = composer_get_meta_value( $id, '_amz_project_url', '' );                
    $target = composer_get_meta_value( $id, '_amz_target', '_blank');
    $launch_btn_text = composer_get_option_value( $prefix.'launch_btn_text', esc_html( 'Launch Project', 'composer' ) );

    if( ! empty( $client_name ) || ! empty( $skills ) || ! empty( $tasks ) ) :
	?>

		<h2 class="side-title"><?php echo esc_html( $project_detail_title ); ?></h2>

	    <ul>
			<?php
	        // Author Name        
	        if( ! empty( $client_name ) ) : ?>
	            <li>
	            	<span class="portfolio-info-title"><?php echo esc_html( $client_title ); ?></span>
	            	<span class="portfolio-info-content author"><?php echo esc_html( $client_name ); ?></span>
	            </li>
	        <?php endif;

	        // Skills         
	        if( ! empty( $skills ) ) : ?>            
	            <li>
		            <span class="portfolio-info-title"><?php echo esc_html( $skill_title ); ?></span>
		            <span class="portfolio-info-content skills"><?php echo esc_html( $skills ); ?></span>
	            </li>
	        <?php endif;

	        // Tasks        
	        if( ! empty( $tasks ) ) : ?>            
	            <li>
	            	<span class="portfolio-info-title"><?php echo esc_html( $task_title ); ?></span>
	            	<span class="portfolio-info-content skills"><?php echo esc_html( $tasks ); ?></span>
	            </li>
			<?php endif; ?>

	    </ul>
		
		<?php 
	    // Project Launch Button
	    if( !empty( $project_url ) ) : ?>

	        <a href="<?php echo esc_url( $project_url ); ?>" target="<?php echo esc_attr( $target ); ?>" class="clear btn btn-outline btn-hover-solid single-portfolio-btn btn-md color"><?php echo esc_html( $launch_btn_text ); ?></a>

	    <?php endif;

	endif;