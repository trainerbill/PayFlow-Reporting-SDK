<?php
namespace PayFlowReportingSDK\TransactionSummaryReport;
require_once(__DIR__.'/../../src/Reports/TransactionSummaryReport.php');

class CustomReportTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstructionConfigIsArray()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport::__construct: Config must be an array');
		$report = new TransactionSummaryReport('test');
	}
	
	
	public function testObjectConstructionStartDate() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport::__construct: You must set start_date in config');
		$report = new TransactionSummaryReport(array('templateName' => 'OK'));
	}
	
	public function testObjectConstructionEndDate() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport::__construct: You must set end_date in config');
		$report = new TransactionSummaryReport(array('start_date' => 'March 3 2014'));
	}
	
	public function testObjectConstructionPageNumber() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport::__construct: You must set pageSize in config');
		$report = new TransactionSummaryReport(array('start_date' => 'March 3 2014', 'end_date' => 'March 4 2014'));
	}
	
	public function testObjectDateCheck() {
		$this->setExpectedException('Exception','PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport::__construct: StartDate is greater than EndDate');
		$report = new TransactionSummaryReport(array('start_date' => 'March 5 2014', 'end_date' => 'March 4 2014', 'pageSize'=>50));
	}
	
	public function testObjectConstructionSuccess() {
		$config = array(
				'start_date' => '2014-03-01 00:00:00',
				'end_date' => '2014-03-24 23:59:59',
				'pageSize' => 50,
		);
		$report = new TransactionSummaryReport($config);
	}
	
	public function testExecuteCall()
	{
		$config = array(
				'start_date' => '2014-03-01 00:00:00',
				'end_date' => '2014-03-24 23:59:59',
				'pageSize' => 50,
				
		);
		$report = new TransactionSummaryReport($config);
		$report->executeCall();
		
		$this->assertEquals((string)$report->getCallResponseDecoded()->baseResponse->responseCode,'100');
		
	}
}