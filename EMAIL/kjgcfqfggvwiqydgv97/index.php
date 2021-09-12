<?php

//Get ENV
	$env = file_get_contents('../../../../.env', true);
	$env = explode("\n",$env);
	$getEnv = [];
	foreach($env as $data){
		$data = explode("=",$data);
		$getEnv[$data[0]] = $data[1];
	}
	$env = $getEnv;
	unset($getEnv);

?>

<script src="https://apis.google.com/js/api.js"></script>
<script>
  /**
   * Sample JavaScript code for gmail.users.getProfile
   * See instructions for running APIs Explorer code samples locally:
   * https://developers.google.com/explorer-help/guides/code_samples#javascript
   */

  function authenticate() {
    return gapi.auth2.getAuthInstance()
        .signIn({scope: "https://mail.google.com/ https://www.googleapis.com/auth/gmail.compose https://www.googleapis.com/auth/gmail.modify https://www.googleapis.com/auth/gmail.readonly"})
        .then(function() { console.log("Sign-in successful"); },
              function(err) { console.error("Error signing in", err); });
  }
  function loadClient() {
    gapi.client.setApiKey(<?php echo $env['googleapikey']; ?>);
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/gmail/v1/rest")
        .then(function() { console.log("GAPI client loaded for API"); },
              function(err) { console.error("Error loading GAPI client for API", err); });
  }
  // Make sure the client is loaded and sign-in is complete before calling this method.
  function execute() {
   
	  return gapi.client.gmail.users.messages.list({
		"userId": <?php echo $env['googleuserid']; ?>,
		  //"path":"inbox",
		  "maxResults":5,
		  "q":"from:<?php echo $env['googleuserid']; ?>"
	  	/*"labelIds": [
        	"inbox"
      	]*/
	  })
        .then(function(response) {
		  console.log("Response", response);
		  
		  gapi.client.gmail.users.messages.get({
      "userId": <?php echo $env['googleuserid']; ?>,
      "id": response.result.messages[0].id
    })
        .then(function(response2) {
                // Handle the results here (response.result has the parsed body).
                console.log("Response", response2);
              },
              function(err2) { console.error("Execute error", err2); });
			  
                // Handle the results here (response.result has the parsed body).
                //console.log("Response", response);
              },
              function(err) { console.error("Execute error", err); });
  }
  gapi.load("client:auth2", function() {
    gapi.auth2.init({client_id: <?php echo $env['googleClientID']; ?>});
  });
</script>
<button onclick="authenticate().then(loadClient)">authorize and load</button>
<button onclick="execute()">execute</button>
