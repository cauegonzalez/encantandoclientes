<?php

class ffComponent_Theme_OnePageNavigation extends ffOptionsHolder {
	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( 'aaa');

		$s->startSection('menu');
			$s->addOption(ffOneOption::TYPE_CHECKBOX, 'use_custom_menu', 'Use custom menu for this Page', 0);
			$menu_select = $s->addOption(ffOneOption::TYPE_SELECT, 'nav_menu', '', '')
				->addSelectValue('Default Global Menu', '');

			foreach (get_terms('nav_menu') as $menu) {
				$menu_select->addSelectValue($menu->name, $menu->term_id);
			}

		$s->endSection();

		return $s;
	}
}