<?php
namespace PayFlowReportingSDK\DailyActivityReport;
require_once(__DIR__.'/../../src/Reports/DailyActivityReport.php');

class DailyActivityReportTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstructionConfigIsArray()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\DailyActivityReport\DailyActivityReport::__construct: Config must be an array');
		$report = new DailyActivityReport('test');
	}
	
	public function testObjectConstructionStartDate() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\DailyActivityReport\DailyActivityReport::__construct: You must set report_date in config');
		$report = new DailyActivityReport(array());
	}
	
	
	public function testObjectConstructionPageNumber() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\DailyActivityReport\DailyActivityReport::__construct: You must set pageSize in config');
		$report = new DailyActivityReport(array('report_date' => 'March 3 2014'));
	}
	
	
	public function testObjectConstructionSuccess() {
		$config = array(
				
				'report_date' => 'April 2 2014',				
				'pageSize' => 50,
				
		);
		$report = new DailyActivityReport($config);
	}
	
	public function testExecuteCall()
	{
		$config = array(
				
				'report_date' => 'April 2 2014',				
				'pageSize' => 50,
				
		);
		$report = new DailyActivityReport($config);
		$report->executeCall();
		
		$this->assertEquals((string)$report->getCallResponseDecoded()->baseResponse->responseCode,'100');
		
	}
}