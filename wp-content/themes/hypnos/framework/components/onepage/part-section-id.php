<?php

$s->startSection('custom-id');
$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Custom Section ID');
	$s->addOption(ffOneOption::TYPE_CHECKBOX, 'enable', 'Enable ID especially for this section', 0);
	$s->addElement(ffOneElement::TYPE_NEW_LINE);
	$s->addOption(ffOneOption::TYPE_TEXT, 'new-id', 'Your new ID', '#new-id');
$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
$s->endSection();