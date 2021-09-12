<?php

//Get ENV
	$env = file_get_contents('../../../.env', true);
	$env = explode("\n",$env);
	$getEnv = [];
	foreach($env as $data){
		$data = explode("=",$data);
		$getEnv[$data[0]] = $data[1];
	}
	$env = $getEnv;
	unset($getEnv);

require_once (__DIR__.'/crest/crest.php');
require_once (__DIR__.'/lib/freeSwitchEsl.php');
$freeswitch = new Freeswitchesl();

$mypbxsocketip = $env['mypbxsocketip'];
$myport = $env['myport'];
$mypass = $env['mypass'];
$mypbx = $env['mypbx']; //local
$waittime = 1;

$callto = isset($_POST['data']['PHONE_NUMBER']) ? $_POST['data']['PHONE_NUMBER'] : 0;
$calltoi = isset($_POST['data']['PHONE_NUMBER_INTERNATIONAL']) ? $_POST['data']['PHONE_NUMBER_INTERNATIONAL'] : 0;
$userid = isset($_POST['data']['USER_ID']) ? $_POST['data']['USER_ID'] : 0;
$entitytype = isset($_POST['data']['CRM_ENTITY_TYPE']) ? $_POST['data']['CRM_ENTITY_TYPE'] : 0;
$entityid = isset($_POST['data']['CRM_ENTITY_ID']) ? $_POST['data']['CRM_ENTITY_ID'] : '';

$auth = isset($_POST['auth']['application_token']) ? $_POST['auth']['application_token'] : 0;
$domain = isset($_POST['auth']['domain']) ? $_POST['auth']['domain'] : '';

if($auth === $env['key'] && $domain === $env['crmdomain']){
	
$contact = ( CRest :: call (
    'crm.contact.list' ,
   		[
 	 	 'FILTER' => ['PHONE' => $callto],
	 	 'SELECT' => ['ID','ASSIGNED_BY_ID'],
	 	 //'EMAIL'=> [['VALUE' => 'lola@yea.com', 'VALUE_TYPE' => 'WORK']] ,
	 	 //'PHONE'=> [['VALUE' => '123458', 'VALUE_TYPE' => 'WORK']] ,
    	])
	);
//writeToLog($contact['result'][0]['ID'], 'Contact ID.');
	
$responsable = ( CRest :: call (
    	'user.get' ,
   			[
 	  			'FILTER' => ['ID' => $userid],
				'SELECT' => ['UF_PHONE_INNER','WORK_PHONE','PERSONAL_MOBILE'],
    		])
		);
//writeToLog($responsable['result'][0]['UF_PHONE_INNER']); //extencion
$caller = $responsable['result'][0]['UF_PHONE_INNER'];
//writeToLog($caller, 'User EXT.');
	
$connect = $freeswitch->connect($mypbxsocketip,$myport,$mypass);
sleep($waittime);
if ($connect) {
	
	$call = $freeswitch->api("originate", "sofia/internal/" . $caller . "@" . $mypbx . " &bridge(sofia/gateway/".$env['mypbxgateway']."/" . $callto . ")");
} else {
	$connect = $freeswitch->connect($mypbxsocketip,$myport,$mypass);
	sleep($waittime);
	if ($connect) {
		$call = $freeswitch->api("originate", "sofia/internal/" . $caller . "@" . $mypbx . " &bridge(sofia/gateway/".$env['mypbxgateway']."/" . $callto . ")");
	}
}
$freeswitch->disconnect();
	
if(isset($call) && $call != ""){
	
	$timeline = ( CRest :: call (
    'crm.timeline.comment.add' ,
   	[
		'fields' =>
           [
               "ENTITY_ID" => $contact['result'][0]['ID'],
               "ENTITY_TYPE" => "contact",
               "COMMENT" => "A call was done to this Contact with result: ". $call,
           ]
   	])
	);
	
	$setmessage = ( CRest :: call (
    	'im.notify' ,
   		[
			"to" => $responsable['result'][0]['ID'],
         	"message" => "A call was done to this Contact with result: ". $call,
         	"type" => 'SYSTEM',
   		])
	);
	
}	
	
} //end if

/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= ob_get_flush();
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}  

?>