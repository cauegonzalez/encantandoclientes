<?php

define( 'FF_LAYOUT', ffThemeOptions::getQuery('layout post_page' ) );
define( 'FF_VIEW', 'home' );
define( 'FF_POST_TYPE', 'post' );

get_template_part( 'templates/' . FF_LAYOUT );
