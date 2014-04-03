<?php
namespace PayFlowReportingSDK\DailyActivityReport;
require_once(__DIR__.'/../PayFlowReportingAPI.php');
use PayFlowReportingSDK\PayFlowReportingAPI;
use \Exception;
class DailyActivityReport extends PayFlowReportingAPI {
	
	public function __construct($config) {
		
		parent::__construct();
		
		if(!is_array($config))
			throw new Exception(__METHOD__.': Config must be an array');
		
		if(!isset($config['report_date']))
			throw new Exception(__METHOD__.': You must set report_date in config');
		if(!isset($config['pageSize']))
			throw new Exception(__METHOD__.': You must set pageSize in config');
		
		//parse dates
		$report_date = date('Y-m-d',strtotime($config['report_date']));
		
		
		$this->call_query->addChild('runReportRequest');
		$this->call_query->runReportRequest->addChild('reportName', 'DailyActivityReport');
		
		
		$reportdate = $this->call_query->runReportRequest->addChild('reportParam');
		$reportdate->addChild('paramName','report_date');
		$reportdate->addChild('paramValue',$report_date);
		
		$this->call_query->runReportRequest->addChild('pageSize',$config['pageSize']);	
	}
	
}