<?php

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	public function testCredentialsExist()
	{
		$this->assertTrue(file_exists( __DIR__.'/../config/credentials.php'));
	}
	
	public function testConfigurationExists() {
		$this->assertTrue(file_exists( __DIR__.'/../config/config.php'));		
	}
	
	public function testConfiguration() {
		include( __DIR__.'/../config/config.php');
		
		$this->assertTrue(isset($config['environment']));
		$this->assertTrue(isset($config['timeout']));
		$this->assertEquals($config['timeout'],90);
		
		$this->assertTrue(is_array($config['credentials']));
		$this->assertEquals($config['credentials']['PARTNER'],'PayPal');
		$this->assertEquals($config['credentials']['VENDOR'],'andrewawesome');
		$this->assertEquals($config['credentials']['USER'],'website');
		$this->assertEquals($config['credentials']['PWD'],'test1234');
		
		
		
	}
	
}
?>