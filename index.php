<?php
// Include the Twilio PHP library
require 'vendor/autoload.php';

// put your Twilio API credentials here
$accountSid = 'AC6f2b9944225754e4914282b1be9da523';
$authToken  = '3d58e80ae1d3c4d7049c238c511b987a';
 
$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing('APabe7650f654fc34655fc81ae71caa3ff');
$token = $capability->generateToken();
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