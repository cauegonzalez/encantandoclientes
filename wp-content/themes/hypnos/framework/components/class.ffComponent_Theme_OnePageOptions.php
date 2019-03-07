<?php

class ffComponent_Theme_OnePageOptions extends ffOptionsHolder {
	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( 'aaa');

		$s->startSection('sections', ffOneSection::TYPE_REPEATABLE_VARIABLE)
			->addParam('section-picker', 'advanced')
			;

		require dirname(__FILE__).'/onepage/section-about.php';
		require dirname(__FILE__).'/onepage/section-blog.php';
		require dirname(__FILE__).'/onepage/section-contact.php';
		require dirname(__FILE__).'/onepage/section-facts.php';
		require dirname(__FILE__).'/onepage/section-featured.php';
		require dirname(__FILE__).'/onepage/section-map.php';
		require dirname(__FILE__).'/onepage/section-parallax-gallery-item.php';
		require dirname(__FILE__).'/onepage/section-pricing.php';
		require dirname(__FILE__).'/onepage/section-portfolio.php';
		require dirname(__FILE__).'/onepage/section-services.php';
		require dirname(__FILE__).'/onepage/section-slider.php';
		require dirname(__FILE__).'/onepage/section-small-header.php';
		require dirname(__FILE__).'/onepage/section-team.php';
		require dirname(__FILE__).'/onepage/section-testimonials.php';
		require dirname(__FILE__).'/onepage/section-text-boxes.php';
		require dirname(__FILE__).'/onepage/section-text-with-icon-boxes.php';
		require dirname(__FILE__).'/onepage/section-twitter.php';
		require dirname(__FILE__).'/onepage/section-video.php';
		require dirname(__FILE__).'/onepage/section-html.php';

		$s->endSection();

		return $s;
	}
}