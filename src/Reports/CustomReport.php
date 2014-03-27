<?php
namespace PayFlowReportingSDK\CustomReport;
include_once(__DIR__.'/../PayFlowReportingAPI.php');
use PayFlowReportingSDK\PayFlowReportingAPI;
use \Exception;
class CustomReport extends PayFlowReportingAPI {
	
	public function __construct($config) {
		
		parent::__construct();
		
		if(!is_array($config))
			throw new Exception(__METHOD__.': Config must be an array');
		
		if(!isset($config['templateName']))
			throw new Exception(__METHOD__.': You must set templateName in config');
		if(!isset($config['start_date']))
			throw new Exception(__METHOD__.': You must set start_date in config');
		if(!isset($config['end_date']))
			throw new Exception(__METHOD__.': You must set end_date in config');
		if(!isset($config['pageSize']))
			throw new Exception(__METHOD__.': You must set pageSize in config');
		
		//parse dates
		$start_date = date('Y-m-d g:i:s',strtotime($config['start_date']));
		$end_date = date('Y-m-d g:i:s',strtotime($config['end_date']));
		
		$this->call_query->addChild('runReportRequest');
		$this->call_query->runReportRequest->addChild('templateName', $config['templateName']);
		
		
		$startdate = $this->call_query->runReportRequest->addChild('reportParam');
		$startdate->addChild('paramName','start_date');
		$startdate->addChild('paramValue',$start_date);
		
		//$root->addChild('reportParam');
		
		$enddate = $this->call_query->runReportRequest->addChild('reportParam');
		$enddate->addChild('paramName','end_date');
		$enddate->addChild('paramValue',$end_date);
		
		//Add optional values
		if(isset($config['options']) && is_array($config['options'])) {
			foreach($config['options'] as $key => $value) {
				$param = $this->call_query->runReportRequest->addChild('reportParam');
				$param->addChild('paramName',$key);
				$param->addChild('paramValue',$value);
			}
		}
		
		$this->call_query->runReportRequest->addChild('pageSize',$config['pageSize']);	
	}
	
}