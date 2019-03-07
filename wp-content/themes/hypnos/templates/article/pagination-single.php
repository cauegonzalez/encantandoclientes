<?php

$links = wp_link_pages( array(
	'before'           => '<ul class="pagination clearfix"><li>',
	'after'            => '</li></ul>',
	'link_before'      => '<span>',
	'link_after'       => '</span>',
	'separator'        => '</li><li>',
	'echo'             => 0
) );

$links = str_replace('<li></li>', '', $links);
$links = str_replace('<li><span>', '<li><span>', $links);

if ( $links ) {

	// Output from wp_link_pages()
	echo $links;

}

