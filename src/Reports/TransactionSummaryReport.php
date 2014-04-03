<?php
namespace PayFlowReportingSDK\TransactionSummaryReport;
include_once(__DIR__.'/../PayFlowReportingAPI.php');
use PayFlowReportingSDK\PayFlowReportingAPI;
use \Exception;
class TransactionSummaryReport extends PayFlowReportingAPI {
	
	public function __construct($config) {
		
		parent::__construct();
		
		if(!is_array($config))
			throw new Exception(__METHOD__.': Config must be an array');
		
		
		if(!isset($config['start_date']))
			throw new Exception(__METHOD__.': You must set start_date in config');
		if(!isset($config['end_date']))
			throw new Exception(__METHOD__.': You must set end_date in config');
		if(!isset($config['pageSize']))
			throw new Exception(__METHOD__.': You must set pageSize in config');
		
		//Timestamps
		$start_date = strtotime($config['start_date']);
		$end_date = strtotime($config['end_date']);
		
		if($start_date > $end_date)
			throw new Exception(__METHOD__.': StartDate is greater than EndDate');
		
		//parse dates
		$start_date = date('Y-m-d H:i:s', $start_date);
		$end_date = date('Y-m-d H:i:s',$end_date);
		
			
		$this->call_query->addChild('runReportRequest');
		$this->call_query->runReportRequest->addChild('reportName', 'TransactionSummaryReport');
		
		
		$startdate = $this->call_query->runReportRequest->addChild('reportParam');
		$startdate->addChild('paramName','start_date');
		$startdate->addChild('paramValue',$start_date);
		
		$enddate = $this->call_query->runReportRequest->addChild('reportParam');
		$enddate->addChild('paramName','end_date');
		$enddate->addChild('paramValue',$end_date);
		
		$this->call_query->runReportRequest->addChild('pageSize',$config['pageSize']);	
	}
	
}