<?php
require_once (__DIR__.'/crest/crest.php');

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

/*Vars***********************************/
//$ext = isset($_GET['ext']) ? $_GET['ext'] : 0;
$userid = isset($_POST['data']['USER_ID']) ? $_POST['data']['USER_ID'] : 0;
//$callto = isset($_GET['callto']) ? $_GET['callto'] : 0;
$callto = isset($_POST['data']['PHONE_NUMBER']) ? $_POST['data']['PHONE_NUMBER'] : 0;
$pass = '';
$server = $env['serverdomain'];
$url = '';
/*End Vars*******************************/

//Only for TESTs!
//$myfile = fopen("log.txt", "a") or die("Unable to open file!");
//echo '**************************\n';
//echo date("Y.m.d G:i:s")."\n";
//var_dump($_GET);
//var_dump($_POST); //from bitrix24

$responsable = ( CRest :: call (
    	'user.get' ,
   			[
 	  			'FILTER' => ['ID' => $userid],
				'SELECT' => ['UF_PHONE_INNER','WORK_PHONE','PERSONAL_MOBILE'],
    		])
		);
//writeToLog($responsable['result'][0]['UF_PHONE_INNER']); //extencion
$ext = $responsable['result'][0]['UF_PHONE_INNER'];
//var_dump($ext);
//var_dump($callto);
if((!isset($ext) || $ext === 0) || (!isset($callto) || $callto === 0)) {
	echo "There it is not data to proceed!";
} else {

	if(file_exists(__DIR__ . '/ext.json')){
		$extencions = json_decode(file_get_contents(__DIR__ . '/ext.json'),true);
		//var_dump(file_get_contents(__DIR__ . '/ext.json'));
		//var_dump(json_decode(file_get_contents(__DIR__ . '/ext.json'),true));
		//var_dump($extencions);
		for($i = 0;$i < count($extencions);$i++){
			if($extencions[$i]['ext'] == $ext) $pass = $extencions[$i]['pass'];
		}
		//var_dump($pass);
	}

?>

<?php

$url = 'https://' . $server . '/PHONE/jhgdskjakgjhgakhgsjfdsgsg/saraphone_API/saraphone.html?ext=' . base64_encode($ext) . '&pass='. base64_encode(base64_encode($pass)) .'&callto=' . base64_encode($callto);

$form = "<script type='text/javascript'> var myForm = document.createElement('form'); myForm.target = 'phone'; myForm.method = 'POST'; myForm.action = " . $url . ";</script>";
$input = "<script type='text/javascript'> var myInput = document.createElement('input'); myInput.type = 'text'; myInput.name = 'pass'; myInput.value = ". $pass ."; myForm.appendChild(myInput); document.body.appendChild(myForm);</script>";
$wopen = "<script type='text/javascript'>	window.open('" . $url . "','phone');</script>";
	
}

?>

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" name="phone" allowfullscreen></iframe>
		</div>
		<script type='text/javascript'>
			window.open("<?php echo $url;?>", "phone");
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
