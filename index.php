<?php
	require_once('vendor/autoload.php');
	
	$api_name      = "project 1";
	$api_key       = 'AIzaSyD92iR48eA9zy5WDNxPWVOLkTbfTngGqL0';
	$client_id     = '474384267605-in625jnredio01mjv09f5qc3qliqm98f.apps.googleusercontent.com';
	$client_secret = 'TNXRsOsyogHS4PZfZTD_EDeB';
	
	$client = new Google_Client();
	$client->setApplicationName($api_name);
	$client->setDeveloperKey($api_key);
	
	$service = new Google_Service_Books($client);

	$optParams = array('filter' => 'free-ebooks');
	$results = $service->volumes->listVolumes('Alexandr Pushkin', $optParams);
	echo "<pre>";
	print_r($service);exit;
		
	
?>