<?php
    // Include the Twilio PHP library
    require 'vendor/autoload.php';
 
    // Twilio REST API version
    $version = date('Y-m-d');
 
    // Set our Account SID and AuthToken
    $sid = 'ACc428f1701f51ab5b67c3ec1e119418dd';
    $token = 'd1cdc9fbf87449ec8eff22b58b35e681';
     
    // A phone number you have previously validated with Twilio
    $phonenumber = '441363688065';
     
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