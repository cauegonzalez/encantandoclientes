<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="amz-addons-wrap">

	<!-- <h2 class="title"><?php esc_html_e( 'Welcome to Composer!', 'composer' ); ?></h2>
	<p class="sub-title"><?php _e( 'Thank you for purchasing Composer. If you need help or have any suggestions, please contact us via Support Forum.', 'composer' ); ?></p>

	<h2 class="nav-tab-wrapper">
		<?php
			$tab = isset( $_GET['page'] ) ? $_GET['page'] : 'welcome';
		?>
	    <a href="?page=system-status" class="nav-tab <?php echo 'welcome' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Welcome', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'registration' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Registration', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'support' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Support', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'faq' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'FAQ', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'demo' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Demo', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'plugins' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Plugins', 'composer' ); ?></a>
	    <a href="?page=system-status" class="nav-tab <?php echo 'system-status' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'System Status', 'composer' ); ?></a>
	    <a href="?page=theme-options" class="nav-tab <?php echo 'theme-options' == $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Theme Options', 'composer' ); ?></a>
	</h2> -->
	
	<?php //if( 'system-status' == $tab ) : ?>
		<div class="system-status">

			<h3 class="main-title"><?php esc_html_e( 'WordPress Environment', 'composer' ); ?></h3>

			<div class="content">
				<p class="title"><?php esc_html_e( 'Home URL:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Theme Home Url', 'composer' ); ?></span> <span class="tooltip-content"><?php esc_html_e( 'Theme Home Url', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><span class="success"><?php echo esc_url( home_url() ); ?></span></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'Site URL:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Theme Site Url', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_url( site_url() ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'WP Version:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Install WordPress Version', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( get_bloginfo( 'version' ) ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'WP Multisite:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Is this WordPress Multisite?', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>

				<?php if( is_multisite() ) { ?>
					<p class="url-content"><?php esc_html_e( 'Yes', 'composer' ) ?></p>
				<?php } else { ?>
					<p class="url-content"><?php esc_html_e( 'No', 'composer' ); ?></p>
				<?php } ?>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'WP Memory Limit:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Theme Memory Limit', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( composer_let_to_num( WP_MEMORY_LIMIT )/( 1024 ) ); ?>MB</p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'WP Memory Limit Status:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Theme Memory Limit Status', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				
				<?php if( composer_let_to_num( WP_MEMORY_LIMIT )/( 1024 ) >= 64 ) { ?>
					<p class="content success"><?php esc_html_e( 'OK', 'composer' ); ?></p>
				<?php } else { ?>
					<p class="content error"><?php esc_html_e( 'Not OK - Recommended Memory Limit is 64MB', 'composer' ); ?></p>
				<?php } ?>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'WP DEBUG:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Is the Debug is enabled?', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<?php if( WP_DEBUG ) { ?>
					<p class="content"><?php esc_html_e( 'Yes', 'composer' ); ?></p>
				<?php } else { ?>
					<p class="content"><?php esc_html_e( 'No', 'composer' ); ?></p>
				<?php } ?>
			</div>

			

			<h3 class="main-title"><?php esc_html_e( 'PHP Configuration', 'composer' ); ?></h3>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Version:', 'composer' ); ?></p>
				<p class="tooltip"><span class="tooltip-content"><?php esc_html_e( 'Installed PHP Version', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( PHP_VERSION ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Post Max Size:', 'composer' ); ?></p>
				<p class="tooltip" ><span class="tooltip-content"><?php esc_html_e( 'Assigned Post Maximum Size', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( ini_get( 'post_max_size' ) ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Time Limit:', 'composer' ); ?></p>
				<p class="tooltip" ><span class="tooltip-content"><?php esc_html_e( 'Assigned Maximum Execution Time Limit', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( ini_get( 'max_execution_time' ) ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Max Input Vars:', 'composer' ); ?></p>
				<p class="tooltip" ><span class="tooltip-content"><?php esc_html_e( 'Assigned Maximum Input Vars', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( ini_get( 'max_input_vars' ) ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Memory Limit:', 'composer' ); ?></p>
				<p class="tooltip" ><span class="tooltip-content"><?php esc_html_e( 'Assigned Memory Limit', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></p>
			</div>

			<div class="content">
				<p class="title"><?php esc_html_e( 'PHP Upload Max Size:', 'composer' ); ?></p>
				<p class="tooltip" ><span class="tooltip-content"><?php esc_html_e( 'Assigned Maximum Filesize', 'composer' ); ?></span><img src="<?php echo esc_url( COMPOSER_FRAMEWORK_URI. '/composer/assets/img/info2.png' ); ?>"></p>
				<p class="url-content"><?php echo esc_html( ini_get( 'upload_max_filesize' ) ); ?></p>
			</div>

		</div> <!-- .system-status -->

	<?php //endif; ?>

</div> <!-- .amz-addons-wrap -->

<?php	
	
	function composer_let_to_num( $v ) {
		$l   = substr( $v, -1 );
		$ret = substr( $v, 0, -1 );

		switch ( strtoupper( $l ) ) {
			case 'P': // fall-through
			case 'T': // fall-through
			case 'G': // fall-through
			case 'M': // fall-through
			case 'K': // fall-through
				$ret *= 1024;
				break;
			default:
				break;
		}

		return $ret;
	}