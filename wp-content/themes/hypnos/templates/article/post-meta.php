<?php 
$showPostMeta = !ffThemeOptions::getQuery('layout disable-postmeta');
if ( 'link' != get_post_format() && $showPostMeta ){ 
	echo '<div class="post-tags-categ">';

	
		
	
		$showDate = ffThemeOptions::getQuery('layout postmeta-date-show');
		$showCategories = ffThemeOptions::getQuery('layout postmeta-categories-show');
		$showTags = ffThemeOptions::getQuery('layout postmeta-tags-show');
		
		$postMetaGetter = ffContainer::getInstance()->getThemeFrameworkFactory()->getPostMetaGetter();
	
		$postMetaArray = array();
		
		if( $showDate ) {
			$postDateFormat = ffThemeOptions::getQuery('layout postmeta-date-format');
			$date = $postMetaGetter->getPostDate($postDateFormat);
			$postMetaArray[] = $date;
		}
		
		if( $showCategories ) {
			$categoriesTranslation = ffThemeOptions::getQuery('layout postmeta-categories-format');
			$categoriesHtml = $postMetaGetter->getPostCategoriesHtml();
			
			$postMetaArray[] = str_replace('%s', $categoriesHtml, $categoriesTranslation);
		}
		
		if( $showTags ) {
			$tagsTranslation = ffThemeOptions::getQuery('layout postmeta-tags-format');
			$tagsHtml = $postMetaGetter->getPostTagsHtml();
			
			if( !empty( $tagsHtml) ) {
				$postMetaArray[] = str_replace('%s', $tagsHtml, $tagsTranslation);
				
			}
		}
		
		
		
		$divider = '<span class="post-meta-separator">|</span>';
		$postMetaString = implode( $divider, $postMetaArray );
		
		if( !empty( $postMetaString ) ) {
			
			echo '<p>'.$postMetaString.'</p>';
			
		}
	echo '</div>';
}