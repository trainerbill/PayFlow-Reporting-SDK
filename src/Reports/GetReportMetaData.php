<?php
namespace PayFlowReportingSDK;
include_once(__DIR__.'/../PayFlowReportingAPI.php');
use PayFlowReportingSDK\PayFlowReportingAPI;
use \Exception;
class GetReportMetaData extends PayFlowReportingAPI {
	
	public function __construct($config) {
		
		parent::__construct();
		
		if(!is_array($config))
			throw new Exception(__METHOD__.': Config must be an array');
		
		if(!isset($config['reportId']))
			throw new Exception(__METHOD__.': You must set reportId in config');
		
		$this->call_query->addChild('getMetaDataRequest');
		$this->call_query->getMetaDataRequest->addChild('reportId', $config['reportId']);
	}
	
}