<?php

class ffComponent_Theme_MetaboxPortfolio extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'aaa');
		
		$s->startSection('small');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Small Image Section');
		
					$s->addOption( ffOneOption::TYPE_IMAGE, 'image', 'Image', '');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Item Title', 'Holy <span>Sadie</span>');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$description = 'Sadie never took her eyes off me. <br>She had a dark soul.';
					$s->addOption( ffOneOption::TYPE_TEXT, 'description', 'Description', $description);
					
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		
		
		
		
		$s->startSection('big');
		
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Big Image Section');
		
					$s->addOption( ffOneOption::TYPE_TEXT, 'big-title', 'Big Title', 'Slider Project');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Item Title', 'Stunning design with powerfull code');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					
					
					$description = 'We believe in coming up with original ideas and turning them into digital work that is both innovative and measurable. We tackle business problems with intelligence.';
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', $description);
					
					
					$s->startSection( 'list', ffOneSection::TYPE_REPEATABLE_VARIABLE );
						$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIATION )->addParam('section-name', 'One Line');
						
							$s->addOption( ffOneOption::TYPE_TEXTAREA, 'text', 'One line', 'Ipsum has been the industry\'s standard. Simply dummy text of the printing.');
						
						$s->endSection();
					$s->endSection();
					
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		
		
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Showcase Section');
				
					$s->startSection( 'images', ffOneSection::TYPE_REPEATABLE_VARIABLE );
					
						$s->startSection('one-image', ffOneSection::TYPE_REPEATABLE_VARIATION )->addParam('section-name', 'Images');
							
							$s->addOption( ffOneOption::TYPE_IMAGE, 'image', 'Image');
		
						$s->endSection();
				
					$s->endSection();
					
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'video', 'Video url', '');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					
					$s->addOption(ffOneOption::TYPE_SELECT, 'type', 'Type', 'gallery')
						->addSelectValue('Gallery', 'gallery')
						->addSelectValue('Slider', 'slider')
						->addSelectValue('Video', 'video');
						
					
					
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		/*
		<div class="nine columns">
		<h4>Stunning design with powerfull code</h4>
		<p class="general-subtext">We believe in coming up with original ideas and turning them into digital work that is both innovative and measurable. We tackle business problems with intelligence.</p>
		</div>
		<div class="seven columns">
		<div class="ajax-project-top-text">
		<p><span>• </span>Ipsum has been the industry's standard. Simply dummy text of the printing.</p>
						<p><span>• </span>Nascetur ridiculus mus. Penatibus et magnis dis parturient montes.</p>
						<p><span>• </span>Sed ut perspiciatis unde omnis nihil. Dummy text ever since. Cum sociis.</p>
						<p><span>• </span>Simply dummy text of the printing. Ipsum has been the industry's standard.</p>
								<p><span>• </span>Dummy text ever since. Cum sociis natoque. Sed ut perspiciatis unde omnis.</p>
								<p><span>• </span>Penatibus et magnis dis parturient montes. Nascetur ridiculus mus.</p>
								</div>
								</div>*/
		
	/*	
		$s->startSection('small-info');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'General');
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Item Title', 'work image');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'description', 'Item Sub-Title', 'Design');
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
				
	 	
		$s->startSection('type');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Layout');
					$s->addElement(ffOneElement::TYPE_HTML, '','Portfolio Single Layout ');
					$s->addOption( ffOneOption::TYPE_SELECT,'type')
					->addSelectValue('Fullwidth', 'fullwidth')
					->addSelectValue('Sidebar', 'sidebar');
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		
		
	 	$s->startSection('gallery');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Image Gallery');
					$s->startSection('gallery-items', ffOneSection::TYPE_REPEATABLE_VARIABLE);
						$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Image');
							$s->addOption(ffOneOption::TYPE_IMAGE, 'image', 'Image ', '');
						$s->endSection();
					$s->endSection();
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		
		$s->startSection('video-section' );
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Video');
					$s->addOption( ffOneOption::TYPE_TEXT, 'video', 'Video URL (link to YouTube / Vimeo)');
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
 
		
		$s->startSection('project-details');
			
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', 'Project Details');

					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Project Details');
					$s->addElement(ffOneElement::TYPE_NEW_LINE);
					$s->addElement(ffOneElement::TYPE_NEW_LINE);

					$s->startSection('project-details-items', ffOneSection::TYPE_REPEATABLE_VARIABLE);
						$s->startSection('one-detail', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Detail');
							$s->addOption(ffOneOption::TYPE_TEXT, 'type', 'Title ', 'Client');
							$s->addElement(ffOneElement::TYPE_NEW_LINE);
							$s->addOption(ffOneOption::TYPE_TEXT, 'description', 'Description ', 'Envato');
						$s->endSection();
					$s->endSection();
					$s->addElement(ffOneElement::TYPE_NEW_LINE);
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection(); */
	 
		
		return $s;
	}
}

