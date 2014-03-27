<?php
namespace PayFlowReportingSDK\CustomReport;
require_once(__DIR__.'/../../src/Reports/CustomReport.php');

class CustomReportTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstructionConfigIsArray()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: Config must be an array');
		$report = new CustomReport('test');
	}
	
	public function testObjectConstructionTemplateName() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: You must set templateName in config');
		$report = new CustomReport(array('tst'));
	}
	
	public function testObjectConstructionStartDate() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: You must set start_date in config');
		$report = new CustomReport(array('templateName' => 'OK'));
	}
	
	public function testObjectConstructionEndDate() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: You must set end_date in config');
		$report = new CustomReport(array('templateName' => 'OK','start_date' => 'March 3 2014'));
	}
	
	public function testObjectConstructionPageNumber() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: You must set pageSize in config');
		$report = new CustomReport(array('templateName' => 'OK','start_date' => 'March 3 2014', 'end_date' => 'March 4 2014'));
	}
	
	public function testObjectConstructionOptions() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\CustomReport\CustomReport::__construct: You must set pageSize in config');
		$report = new CustomReport(array('templateName' => 'OK','start_date' => 'March 3 2014', 'end_date' => 'March 4 2014'));
	}
	
	public function testObjectConstructionSuccess() {
		$config = array(
				'templateName' => 'MyTestReport',
				'start_date' => '2014-03-01 00:00:00',
				'end_date' => '2014-03-24 23:59:59',
				'pageSize' => 50,
				'options' => array(
						'show_amount' => 'true'
				)
		);
		$report = new CustomReport($config);
	}
	
	public function testExecuteCall()
	{
		$config = array(
				'templateName' => 'MyTestReport',
				'start_date' => '2014-03-01 00:00:00',
				'end_date' => '2014-03-24 23:59:59',
				'pageSize' => 50,
				'options' => array(
						'show_amount' => 'true'
				)
		);
		$report = new CustomReport($config);
		$report->executeCall();
		
		$this->assertEquals((string)$report->getCallResponseDecoded()->baseResponse->responseCode,'100');
		
	}
}