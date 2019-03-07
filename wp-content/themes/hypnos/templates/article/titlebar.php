<?php

if ( defined('FF_VIEW') ) {

	switch( FF_VIEW ){

		case '404':
			echo '<div class="sixteen columns"><h1>404</div>';
			echo '<div class="sixteen columns"><div class="sub-text-line"></div></div><div class="sixteen columns"><div class="sub-text">';
			echo ffThemeOptions::getQuery('translation 404_Title');
			echo '</div></div>';
			break;

		case 'author':
			the_post();
			echo '<div class="sixteen columns"><h1>';
			printf( __( 'All posts by %s', 'default' ), get_the_author() );
			echo '</h1></div>';
			rewind_posts();
			break;

		case 'date':
			echo '<div class="sixteen columns"><h1>';
			if ( is_day() ) {
				printf( __( 'Daily Archives: %s', 'default' ), get_the_date() );
			} elseif ( is_month() ) {
				printf( __( 'Monthly Archives: %s', 'default' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'default' ) ) );
			} elseif ( is_year() ) {
				printf( __( 'Yearly Archives: %s', 'default' ), get_the_date( _x( 'Y', 'yearly archives date format', 'default' ) ) );
			} else {
				_e( 'Archives', 'default' );
			}
			echo '</h1></div>';
			break;

		case 'home':
			if( ! is_front_page() ){
				echo '<div class="sixteen columns"><h1>';
				echo get_the_title( get_option('page_for_posts') );
				echo '</h1></div>';
				echo '<div class="sixteen columns"><div class="sub-text-line"></div></div><div class="sixteen columns"><div class="sub-text">';
				echo get_bloginfo('description');
				echo '</div></div>';
			}else{
				echo '<div class="sixteen columns"><h1>';
				echo get_bloginfo('name');
				echo '</h1></div>';
				echo '<div class="sixteen columns"><div class="sub-text-line"></div></div><div class="sixteen columns"><div class="sub-text">';
				echo get_bloginfo('description');
				echo '</div></div>';
			}
			break;

		case 'search':
			echo '<div class="sixteen columns"><h1>';
			echo get_search_query();
			echo '</h1></div>';
			echo '<div class="sixteen columns"><div class="sub-text-line"></div></div><div class="sixteen columns"><div class="sub-text">';
			echo sprintf(ffThemeOptions::getQuery('translation Search_Results_for'), get_search_query() );
			echo '</div></div>';
			break;

		case 'category':
		case 'tag':
			echo '<div class="sixteen columns"><h1>';
			single_term_title( '' );
			echo '</h1></div>';
			echo '<div class="sixteen columns"><div class="sub-text-line"></div></div><div class="sixteen columns"><div class="sub-text">';
			echo strip_tags( category_description() );
			echo '</div></div>';
			break;

		case 'single':
		default:
			echo '<div class="sixteen columns"><h1>';
			the_title();
			echo '</h1></div>';
			break;

	}

}

