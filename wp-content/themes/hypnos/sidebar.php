<?php

if( is_active_sidebar( 'sidebar-content' ) ){
	dynamic_sidebar( 'sidebar-content' );
}else{
	get_search_form();
}
