<?php

define( 'FF_LAYOUT', ffThemeOptions::getQuery('layout single_post') );
define( 'FF_VIEW', 'single' );
define( 'FF_POST_TYPE', 'post' );

get_template_part( 'templates/' . FF_LAYOUT );