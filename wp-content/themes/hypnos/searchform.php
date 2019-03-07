<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input name="s" id="s" type="text" placeholder="<?php echo ffThemeOptions::getQuery('translation Type_to_search'); ?>"  value="<?php echo get_search_query(); ?>"/>
	<button><?php echo ffThemeOptions::getQuery('translation Search_button'); ?></button>
</form>
