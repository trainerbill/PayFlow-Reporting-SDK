<?php
namespace PayFlowReportingSDK;
require_once(__DIR__.'/../../src/Reports/GetReportResults.php');
require_once(__DIR__.'/../../src/Reports/CustomReport.php');
use PayFlowReportingSDK\CustomReport\CustomReport;
use PayFlowReportingSDK\GetReportResults;
class GetReportMetaDataTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstructionConfigIsArray()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\GetReportResults::__construct: Config must be an array');
		$report = new GetReportResults('test');
	}
	
	public function testObjectConstructionConfigReportId()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\GetReportResults::__construct: You must set reportId in config');
		$report = new GetReportResults(array());
	}
	
	public function testObjectConstructionConfigPageNum()
	{
		$this->setExpectedException('Exception','PayFlowReportingSDK\GetReportResults::__construct: You must set pageNum in config');
		$report = new GetReportResults(array('reportId'=>'11111'));
	}
	
	public function testObjectConstructionSuccess()
	{
		$config = array(
				'reportId' => '15648616',
				'pageNum' => 1
		);
		$report = new GetReportResults($config);
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
		
		$reportId = (string)$report->getCallResponseDecoded()->runReportResponse->reportId;
		$config = array(
				'reportId' => $reportId,
				'pageNum' => 1
		);
		$report = new GetReportResults($config);
		$report->executeCall();
		$this->assertEquals((string)$report->getCallResponseDecoded()->baseResponse->responseCode,'100');
		
	}
	
}