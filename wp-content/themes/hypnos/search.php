<?php

define( 'FF_LAYOUT', ffThemeOptions::getQuery('layout search' ) );
define( 'FF_VIEW', 'search' );
define( 'FF_POST_TYPE', NULL );

get_template_part( 'templates/' . FF_LAYOUT );
