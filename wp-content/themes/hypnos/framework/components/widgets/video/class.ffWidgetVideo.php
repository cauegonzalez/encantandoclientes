<?php
/**
 * Tester widget, please note that we overloaded _printWidget method since
 * we need to add some dependencies ( TesterFeeder ).
 *
 * @author FRESHFACE
 */

class ffWidgetVideo extends ffWidgetDecoratorAbstract {
	protected $_widgetAdminTitle =       "Video Custom Widget";
	protected $_widgetAdminDescription = "Video from the latest post with post format: video.";
	protected $_widgetWrapperClasses =   "";
	protected $_widgetName = 'Video';
	//protected $_widgetFormSize =         //frameworkWidget::WIDGET_FORM_SIZE_WIDE;

	/**
	 * Overloaded method to set custom dependencies ( Tester feeder )
	 * @see ffWidgetDecoratorAbstract::_printWidget()
	 * @param $widgetPrinter ffWidgetTester_Printer
	 */
	protected function _printWidget($args, ffOptionsQuery $query, $widgetPrinter) {
		$widgetPrinter->printComponent($args, $query, $widgetPrinter );
	}
}