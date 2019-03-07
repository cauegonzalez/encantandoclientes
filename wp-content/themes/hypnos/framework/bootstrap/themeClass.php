<?php

class ffTheme extends ffThemeAbstract {

	protected function _setDependencies() { }

	protected function _registerAssets() {
		$fwc = $this->_getContainer()->getFrameworkContainer();
		$fwc->getAdminScreenManager()->addAdminScreenClassName('ffAdminScreenThemeOptions');
		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxPortfolio');
		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxOnePageNavigation');
//		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxOnePage');

		$fwc->getWidgetManager()->addWidgetClassName('ffWidgetVideo');

	}

	protected function _run() { }

	protected function _ajax() { }
}