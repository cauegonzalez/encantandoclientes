<?php

define( 'FF_LAYOUT', ffThemeOptions::getQuery('layout archives' ) );
if( is_category() ){
	define( 'FF_VIEW', 'category' );
}else if( is_tag() ){
	define( 'FF_VIEW', 'tag' );
}else if( is_date() ){
	define( 'FF_VIEW', 'date' );
}else if( is_author() ){
	define( 'FF_VIEW', 'author' );
}else{
	define( 'FF_VIEW', NULL );
}
define( 'FF_POST_TYPE', 'post' );

get_template_part( 'templates/' . FF_LAYOUT );
