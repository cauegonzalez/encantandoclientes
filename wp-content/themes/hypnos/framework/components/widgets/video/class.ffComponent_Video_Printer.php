<?php

class ffComponent_Video_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query, $twitterFeeder) {

		extract( $args );

		echo $before_widget;

		$title = trim( $query->get('latest-video title') );
		if( !empty($title) ){
			echo $before_title . ff_wp_kses( $title ) . $after_title;
		}

		$postGetter = ffContainer::getInstance()->getPostLayer()->getPostGetter();
		$postGetter->setNumberOfPosts( 1 );
		$postGetter->filterByTaxonomy( 'post-format-video', 'post_format' );
		$post = $postGetter->getPost('post');

		foreach ( explode( "\n", $post->getContent() ) as $key => $value) {
			$featured_video = wp_oembed_get( $value );
			if( ! empty($featured_video) ) break;
		}

		// HTML generated video by WP by wp_oembed_get() function
		echo $featured_video;

		echo $after_widget;
	}
}