<?php

define( 'FF_LAYOUT', ffThemeOptions::getQuery('layout 404' ) );
define( 'FF_VIEW', '404' );
define( 'FF_POST_TYPE', '404' );

get_template_part( 'templates/'. FF_LAYOUT );