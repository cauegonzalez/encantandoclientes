	<!-- MENU
    ================================================== -->

	<nav id="menu-wrap" class="menu-back cbp-af-header">
		<div class="container">
			<div class="sixteen columns">

				<div class="logo-holder">
					<div class="header-vcenter-wrapper">
						<div class="header-vcenter">
							<!-- Your Logo -->
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="scroll logo "><?php
								$logo = ffThemeOptions::getQuery('header' )->getImage('logo_image_url');
								if( ffThemeOptions::getQuery('header logo_use_image') and !empty( $logo ) ){
									echo '<img class="logo-image-1__image" ';
									echo 'src="'.$logo->url.'" ';
									echo 'alt="'.esc_attr(get_bloginfo('name')).'" />';
								}else{
									echo ffThemeOptions::getQuery('header logo_text');
								}
							?></a>
						</div>
					</div>
				</div>

				<div class="menu-holder">
					<div class="header-vcenter-wrapper">
						<div class="header-vcenter">

							<?php

								locate_template('templates/helpers/class.ffNavigationMenu.php', true, true);

								if( isset($GLOBALS['_ff_special_one_page_custom_menu'] ) ){
									wp_nav_menu( array(
										'menu'           => $GLOBALS['_ff_special_one_page_custom_menu'],
										'depth'          => 4,
										'container'      => false,
										'menu_class'     => '',
										'items_wrap'     => '<ul role="menu" id="%1$s" class="%2$s slimmenu">%3$s</ul>',
										'walker'         => new ffNavigationMenu(),
										'fallback_cb'    => 'ffNavigationMenu_fallback',
									) );
								}else{
									wp_nav_menu( array(
										'theme_location' => 'main-nav',
										'depth'          => 4,
										'container'      => false,
										'menu_class'     => '',
										'items_wrap'     => '<ul role="menu" id="%1$s" class="%2$s slimmenu">%3$s</ul>',
										'walker'         => new ffNavigationMenu(),
										'fallback_cb'    => 'ffNavigationMenu_fallback',
									) );
								}
							?>
 
						</div>
					</div>
				</div>

			</div>
		</div>
	</nav>

	<div class="svg-wrap">
		<svg viewBox="0 0 400 20" xmlns="http://www.w3.org/2000/svg">
			<path id="svg_line" d="m 1.986,8.91 c 55.429038,4.081 111.58111,5.822 167.11781,2.867 22.70911,-1.208 45.39828,-0.601 68.126,-0.778 28.38173,-0.223 56.76079,-1.024 85.13721,-1.33 24.17379,-0.261 48.42731,0.571 72.58115,0.571"></path>
		</svg>
	</div>
