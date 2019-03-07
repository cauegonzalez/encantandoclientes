<?php

// Don't print empty markup if there's only one page.
if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'type'     => 'array',
	) );

	if ( $links ) {
		?>
		<div class="text-center">
			<ul class="pagination clearfix">
				<?php
					foreach ($links as $value) {
						if( FALSE !== strpos($value, 'current') ){
							echo '<li class="active">';
						}else if( FALSE !== strpos($value, 'dots') ){
							echo '<li>';
						}else{
							echo '<li>';
						}

						// Output from paginate_links()
						echo $value;

						echo '</li>';
					}
				?>
			</ul>
		</div>
		<?php
	}
}