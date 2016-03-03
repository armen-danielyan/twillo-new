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
?>
	
	
<!DOCTYPE html>
<html>
  <head>
    <title>Hello Client Monkey 2</title>
    <script type="text/javascript"
      src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
    <script type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <link href="http://static0.twilio.com/marketing/bundles/quickstart/client.css"
      type="text/css" rel="stylesheet" />
    <script type="text/javascript">
 
      Twilio.Device.setup("<?php echo $token; ?>");
 
      Twilio.Device.ready(function (device) {
        $("#log").text("Ready");
      });
 
      Twilio.Device.error(function (error) {
        $("#log").text("Error: " + error.message);
      });
 
      Twilio.Device.connect(function (conn) {
        $("#log").text("Successfully established call");
      });
 
      Twilio.Device.disconnect(function (conn) {
        $("#log").text("Call ended");
      });
 
      function call() {
        Twilio.Device.connect();
      }
 
      function hangup() {
        Twilio.Device.disconnectAll();
      }
    </script>
  </head>
  <body>
    <button class="call" onclick="call();">
      Call
    </button>
 
    <button class="hangup" onclick="hangup();">
      Hangup
    </button>
 
    <div id="log">Loading pigeons...</div>
  </body>
</html>