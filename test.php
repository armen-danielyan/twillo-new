<?php
    // Include the Twilio PHP library
    require 'vendor/autoload.php';
 
    // Twilio REST API version
    $version = date('Y-m-d');
 
    // Set our Account SID and AuthToken
    $sid   = 'AC6f2b9944225754e4914282b1be9da523';
    $token = '3d58e80ae1d3c4d7049c238c511b987a';
     
    // A phone number you have previously validated with Twilio
    $phonenumber = '+353766805830';
     
    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($sid, $token, $version);
 
    try {
        // Initiate a new outbound call
        $call = $client->account->calls->create(
            $phonenumber, // The number of the phone initiating the call
            '+37494471018', // The number of the phone receiving call
            'http://demo.twilio.com/welcome/voice/' // The URL Twilio will request when the call is answered
        );
        echo 'Started call: ' . $call->sid;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }