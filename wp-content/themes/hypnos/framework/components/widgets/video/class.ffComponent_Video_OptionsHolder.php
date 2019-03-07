<?php

class ffComponent_Video_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'latest-video-structure' );
		$s->startSection('latest-video', 'Latest Video');
			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'title', 'Title', 'Latest Video');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );
		$s->endSection();
		return $s;
	}
}

