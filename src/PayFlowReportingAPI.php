<?php
namespace PayFlowReportingSDK;
use \SimpleXMLElement;
class PayFlowReportingAPI {
	
	//Setup Variables
	protected $call_endpoint;
	protected $environment;
	protected $timeout;
	
	//Call Variables
	protected $call_credentials;
	protected $call_query;
	protected $call_response;
	protected $call_response_decoded;	
	
	public function __construct($config = null)
	{
        // if no config load the config file
		if(is_null($config))
		{
			include __DIR__.'/../config/config.php';
		}
		//Set timeout
		$this->timeout = $config['timeout'];
		
		$this->environment = $config['environment'];
		if($config['environment'] == 'production')
		{
			$this->call_endpoint = 'https://payments-reports.paypal.com/reportingengine';
		}
		else
		{	
			$this->call_endpoint = 'https://payments-reports.paypal.com/test-reportingengine';
		}
		
		//set xml element
		
		$this->call_query = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><reportingEngineRequest></reportingEngineRequest>');
		//$this->call_query->addChild('');
		
		$this->setCredentials($config['credentials']);
	}
	
	//GET METHODS
	public function getCallResponse()
	{
		return $this->call_response;
	}
	
	public function getCallResponseDecoded()
	{
		return $this->call_response_decoded;
	}
	
	public function getCallEndpoint()
	{
		return $this->call_endpoint;
	}
	
	public function getHostedEndpoint()
	{
		return $this->hosted_endpoint;
	}
	
	public function getCallQuery()
	{
		return $this->call_query;
	}
	
	public function getCallVariables()
	{
		return $this->call_variables;
	}
	
	public function getCredentials()
	{
		return $this->call_credentials;
	}
	
	public function getEnvironment()
	{
		return $this->environment;
	}
	
	public function getValidationParameters()
	{
		return $this->validation_parameters;
	}
	
	public function setCredentials($credentials)
	{	
		$this->call_query->addChild('authRequest');
		$this->call_query->authRequest->addChild('user',$credentials['USER']);
		$this->call_query->authRequest->addChild('vendor',$credentials['VENDOR']);
		$this->call_query->authRequest->addChild('partner',$credentials['PARTNER']);
		$this->call_query->authRequest->addChild('password',$credentials['PWD']);
	}
	
	public function setCustomReport() {
		
		$this->call_query->addChild('runReportRequest');
		$this->call_query->runReportRequest->addChild('templateName', 'MyTestReport');
		
		
		$startdate = $this->call_query->runReportRequest->addChild('reportParam');
		$startdate->addChild('paramName','start_date');
		$startdate->addChild('paramValue','2014-03-01 00:00:00');
		
		//$root->addChild('reportParam');
		
		$enddate = $this->call_query->runReportRequest->addChild('reportParam');
		$enddate->addChild('paramName','end_date');
		$enddate->addChild('paramValue','2014-03-24 23:59:59');
		
		
		
		$this->call_query->runReportRequest->addChild('pageSize',50);
		
		//$this->call_query->addChild('runReportRequest',$root);
		
	}
	

	public function executeCall()
	{
		//$this->quickValidation();
		
		
		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_URL,$this->call_endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $this->call_query->asXML());  //Set My query string
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout); //timeout in seconds
		$this->call_response =  curl_exec($ch);		//Execute the API Call
		$this->call_response_decoded = new SimpleXMLElement($this->call_response);
		
		return $this->call_response;
	}
	
}