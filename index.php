<?php
    // Include the Twilio PHP library
    require 'vendor/autoload.php';


// put your Twilio API credentials here
$accountSid = 'AC6f2b9944225754e4914282b1be9da523';
$authToken  = '3d58e80ae1d3c4d7049c238c511b987a';
 
// put your Twilio Application Sid here
$appSid     = 'AP7917f5802425ff1ed969734af498b698';

// put your default Twilio Client name here
$clientName = 'jenny';

// get the Twilio Client name from the page request parameters, if given
if (isset($_REQUEST['client'])) {
    $clientName = $_REQUEST['client'];
}
 
$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing($appSid);
$capability->allowClientIncoming($clientName);
$token = $capability->generateToken();
?>
 
<!DOCTYPE html>
<html>
  <head>
    <title>Hello Client Monkey 6</title>
    <script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.2/twilio.min.js"></script>
    <script type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <link href="http://static0.twilio.com/bundles/quickstart/client.css"
      type="text/css" rel="stylesheet" />
    <script type="text/javascript">
 
      Twilio.Device.setup("<?php echo $token; ?>");
 
      Twilio.Device.ready(function (device) {
        $("#log").text("Client '<?php echo $clientName ?>' is ready");
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
 
      Twilio.Device.incoming(function (conn) {
        $("#log").text("Incoming connection from " + conn.parameters.From);
        // accept the incoming connection and start two-way audio
        conn.accept();
      });
 
      Twilio.Device.presence(function (pres) {
        if (pres.available) {
          // create an item for the client that became available
          $("<li>", {id: pres.from, text: pres.from}).click(function () {
            $("#number").val(pres.from);
            call();
          }).prependTo("#people");
        }
        else {
          // find the item by client name and remove it
          $("#" + pres.from).remove();
        }
      });
 
      function call() {
        // get the phone number or client to connect the call to
        params = {"PhoneNumber": $("#number").val()};
        Twilio.Device.connect(params);
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
 
    <input type="text" id="number" name="number"
      placeholder="Enter a phone number or client to call" value='+37494471018'/>
 
    <div id="log">Loading pigeons...</div>
 
    <ul id="people"/>
  </body>
</html>

<?php
exit;
    // Include the Twilio PHP library
    //require 'vendor/twilio/sdk/Services/Twilio.php';
    require 'vendor/autoload.php';
 
    // Twilio REST API version
    $version = "2016-02-25";

    // Set our Account SID and AuthToken
    $sid   = 'AC6f2b9944225754e4914282b1be9da523';
    $token = '3d58e80ae1d3c4d7049c238c511b987a';

    // A phone number you have previously validated with Twilio
    $phonenumber = '353867964180';

    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($sid, $token, $version);

    try {
        // Initiate a new outbound call
        $call = $client->account->calls->create(
            $phonenumber, // The number of the phone initiating the call
            '37494471018', // The number of the phone receiving call
            'http://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient', // The URL Twilio will request when the call is answered
			array
			(
				'Method' => 'POST'
			)
        );
        echo 'Started call: ' . $call->sid;
    }
	catch (Exception $e)
	{
        echo 'Error: ' . $e->getMessage();
        echo '<br>';
        echo 'Error: ' . $e->getStatus();
    }