<?php
namespace PayFlowReportingSDK;
include_once(__DIR__.'/../PayFlowReportingAPI.php');
use PayFlowReportingSDK\PayFlowReportingAPI;
use \Exception;
class GetReportResults extends PayFlowReportingAPI {
	
	public function __construct($config) {
		
		parent::__construct();
		
		if(!is_array($config))
			throw new Exception(__METHOD__.': Config must be an array');
		
		if(!isset($config['reportId']))
			throw new Exception(__METHOD__.': You must set reportId in config');
		
		if(!isset($config['pageNum']))
			throw new Exception(__METHOD__.': You must set pageNum in config');
		
		$this->call_query->addChild('getDataRequest');
		$this->call_query->getDataRequest->addChild('reportId', $config['reportId']);
		$this->call_query->getDataRequest->addChild('pageNum', $config['pageNum']);
		
		
	}
	
}