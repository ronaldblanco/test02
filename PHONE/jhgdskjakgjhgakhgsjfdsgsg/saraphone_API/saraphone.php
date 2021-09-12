<!--
/*
   SaraPhone
   Version: MPL 1.1

   The contents of this file are subject to Mozilla Public License Version
   1.1 (the "License"); you may not use this file except in compliance with
   the License. You may obtain a copy of the License at
   http://www.mozilla.org/MPL/

   Software distributed under the License is distributed on an "AS IS" basis,
   WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
   for the specific language governing rights and limitations under the
   License.

   The Original Code is SaraPhone

   The Initial Developer of the Original Code is
   Giovanni Maruzzelli <gmaruzz@opentelecom.it>
   Portions created by the Initial Developer are Copyright (C) 2020
   the Initial Developer. All Rights Reserved.

   SaraPhone gets its name from Giovanni's wife, Sara.

   Author(s):
   Giovanni Maruzzelli <gmaruzz@opentelecom.it>
   Danilo Volpinari
   Luca Mularoni
 */
-->
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

  //var_dump($_POST);
  $domain = $env['mypbx'];
  $server = $env['mypbx'];
  $port = $env['mywssport'];
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A WebRTC client for SIP">
    <meta name="author" content="Giovanni Maruzzelli">
    <link rel="icon" href="favicon.ico">
    <title>SaraPhone WebRTC</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>
<script>
var audio0 = new Audio("wav/0.wav");
var audio1 = new Audio("wav/1.wav");
var audio2 = new Audio("wav/2.wav");
var audio3 = new Audio("wav/3.wav");
var audio4 = new Audio("wav/4.wav");
var audio5 = new Audio("wav/5.wav");
var audio6 = new Audio("wav/6.wav");
var audio7 = new Audio("wav/7.wav");
var audio8 = new Audio("wav/8.wav");
var audio9 = new Audio("wav/9.wav");
var audio_star = new Audio("wav/star.wav");
var audio_hash = new Audio("wav/hash.wav");
var audio_silence = new Audio("wav/silence.wav");
</script>
<div class="container">
    <div style="display: block; background-color: black;" id="hideAll">
	      <h2>Wait please...</h2>
    </div>
    <div align="center">

        <div align="center" class="form-signin">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 10px;" >
                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8" >
                    <div align="center" class="form-signin">
                        <div align="center" id="signin" class="form-signin-content">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                                    <div id="webphone_body" >
                                        <br/>
                                        <br/>
                                        <input id="login" style="max-width: 380px;" class="form-control input-md" placeholder="Your Account Login (eg: 2020)" value="78" required autofocus>
                                        <br/>
                                        <input id="passwd" style="max-width: 380px;" type="password" class="form-control input-md" placeholder="Your Account Password (eg: 12345)" value="****" required>
                                        <br/>
                                        <input id="yourname" style="max-width: 380px;" type="text" class="form-control input-md" placeholder="Your Display Name (optional, eg: Giovanni Maruzzelli)" value="FusionPBX test" required>
                                        <br/>
                                        <button class="btn btn-sm btn-primary btn-default" data-inline="true" id="signinctrlbtn">Advanced: set Server and BLFs</button>
                                        <br/>
                                        &nbsp;
                                        <br/>
                                        <div id="signinadv1" align="center" style="text-shadow:0 0px 0px rgba(0,0,0,.5);">
                                            <table>
                                                <tr>
                                                   <td> <input style="background-color: black;" size=25 id="domain" value="" /></td><td>&nbsp;SIP&nbsp;Domain&nbsp;Name&nbsp;</td>
                                                </tr>
                                                <tr>
                                                   <td> <input style="background-color: black;" size=25 id="proxy" value="" /></td><td>&nbsp;WSS&nbsp;Proxy&nbsp;Name&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="port" value="" /></td><td>&nbsp;WSS&nbsp;Proxy&nbsp;Port&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres1" value="" /></td><td>&nbsp;BLF1&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres1_label" value="" /></td><td>&nbsp;BLF1&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres2" value="" /></td><td>&nbsp;BLF2&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres2_label" value="" /></td><td>&nbsp;BLF2&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres3" value="" /></td><td>&nbsp;BLF3&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres3_label" value="" /></td><td>&nbsp;BLF3&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres4" value="" /></td><td>&nbsp;BLF4&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres4_label" value="" /></td><td>&nbsp;BLF4&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres5" value="" /></td><td>&nbsp;BLF5&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres5_label" value="" /></td><td>&nbsp;BLF5&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres6" value="" /></td><td>&nbsp;BLF6&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres6_label" value="" /></td><td>&nbsp;BLF6&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres7" value="" /></td><td>&nbsp;BLF7&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres7_label" value="" /></td><td>&nbsp;BLF7&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres8" value="" /></td><td>&nbsp;BLF8&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres8_label" value="" /></td><td>&nbsp;BLF8&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres9" value="" /></td><td>&nbsp;BLF9&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres9_label" value="" /></td><td>&nbsp;BLF9&nbsp;Label</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres10" value="" /></td><td>&nbsp;BLF10&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color: black;" size=25 id="pres10_label" value="" /></td><td>&nbsp;BLF10&nbsp;Label</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <br/>
                                        <button class="btn btn-md btn-primary btn-success" data-inline="true" id="loginbtn">Login</button>
                                        <br/>
                                        <div class="row">
                                            <br/>
                                            <button class="btn btn-md btn-primary btn-danger" data-inline="true" id="gotopanel2" style="margin-bottom: 0px; width: 160px !important;" >Back to Login</button>
                                            <div align="center" class="inner" style="color: #808080">
                                                <br/>
                                                <i>SaraPhone WebRTC</i>
                                                <p>2020
                                                <br/>Giovanni Maruzzelli - OpenTelecom.IT</p>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div align="center" id="dial" class="form-signin-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                                <div id="webphone_body" >
                                    <div id="webphone_display" >
                                        <h4><span id="whoami"></span></h4>
                                        <div id="dialadv1">
                                        </div>
                                        <div style="max-width: 95%; margin: -20px 0px 0px 0px; white-space: nowrap; overflow: hidden; text-overflow: clip;">
                                            <input id="ext" type="hidden" class="form-control input-lg" placeholder="number to dial (eg: 0549123456)" >
                                            <h2><span id="calling" style="font-size: 20px !important;">...</span></h2>
                                            <input id="calling_input" style="max-width: 280px;font-size: 15px !important;" class="form-control input-sm" placeholder="number to dial (eg: 0549123456)" >
                                        </div>
                                    </div>
                                    <div id="isIncomingcall">
                                        <div class="row">
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="webphone_keypad">
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">1</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">2</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">3</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">4</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">5</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">6</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">7</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">8</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">9</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">.*</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">0</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;">#</button>
                                                <br/>
                                                <button class="btn btn-sm btn-primary btn-success" data-inline="true" id="anscallbtn" style="margin-top: 5px; margin-bottom: 5px; margin-right: 8px; width: 72px !important;" >Answer</button>
                                                <button class="btn btn-sm btn-primary btn-danger" data-inline="true" id="rejcallbtn" style="margin-top: 5px; margin-bottom: 5px; margin-right: 2px; width: 72px !important;" >Reject</button><br />
                                                <br/>
                                            </div>
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="color: #808080">
                                                <br/>
                                                <i>SaraPhone WebRTC</i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="center" class="inner" style="color: #808080">
                                                <p>2020
                                                <br/>Giovanni Maruzzelli - OpenTelecom.IT</p>
                                           </div>
                                       </div>
                                    </div>
                                    <div id="isNotIncomingcall">
                                        <div class="row">
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="webphone_keypad">
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext1btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio1.play ( )">1</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext2btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio2.play ( )">2</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext3btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio3.play ( )">3</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext4btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio4.play ( )">4</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext5btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio5.play ( )">5</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext6btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio6.play ( )">6</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext7btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio7.play ( )">7</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext8btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio8.play ( )">8</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext9btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio9.play ( )">9</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="extstarbtn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio_star.play ( )">.*</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="ext0btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio0.play ( )">0</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="extpoundbtn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio_hash.play ( )">#</button>
                                                <br/>
                                                <button class="btn btn-sm btn-primary btn-success" data-inline="true" id="callbtn" style="margin-top: 5px; margin-bottom: 5px; margin-right: 8px; width: 72px !important;" onclick="audio_silence.play ( )">Dial</button>
                                                <button class="btn btn-sm btn-primary btn-danger" data-inline="true" id="delcallbtn" style="margin-top: 5px; margin-bottom: 5px; margin-right: 2px; width: 72px !important;" onclick="audio_silence.play ( )">Canc</button><br />
                                                <br/>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" id="webphone_keypad_right">
                                                <button class="btn btn-sm btn-primary btn-success" data-inline="true" id="redialbtn" style="margin-bottom: 8px; width: 120px !important;">ReDial</button><br />
<!--
                                                <div class="blinking"><button class="btn btn-sm btn-primary btn-danger" data-inline="true" id="unholdbtn" style="margin-bottom: 8px; width: 120px !important;">UnHold</button></div><br />
-->
                                                <button class="btn btn-sm btn-primary btn-warning" data-inline="true" id="dndbtn" style="margin-bottom: 8px; width: 120px !important;" onclick="audio1.play ( )">DND</button><br />
                                                <button class="btn btn-sm btn-primary btn-info" data-inline="true" id="checkvmailbtn" style="margin-bottom: 8px; width: 120px !important;" >VoiceMail: <span id="vmailcount">0/0</span></button><br />
                                                <br/>
<!--
                                                <button class="btn btn-sm btn-primary" data-inline="true" id="phonebookbtn" style="margin-bottom: 8px; width: 120px !important;">Contacts</button><br />
                                                <br/>
-->
                                                <button class="btn btn-sm btn-primary btn-warning" data-inline="true" id="ringbtn" style="margin-bottom: 8px; width: 120px !important;" onclick="audio1.play ( )">MUTE RING</button><br />
                                                <button class="btn btn-sm btn-primary btn-warning" data-inline="true" id="autoanswerbtn" style="margin-bottom: 8px; width: 120px !important;" onclick="audio1.play ( )">AUTOANSWER</button><br />
                                                <br/>
                                                <button class="btn btn-sm btn-primary" data-inline="true" id="dialctrlbtn" style="margin-bottom: 8px; width: 120px !important;">Audio/Mic</button><br />
                                                <button class="btn btn-sm btn-primary btn-danger" data-inline="true" id="gotopanel3" style="margin-bottom: 8px; width: 120px !important;" >Back to Login</button>
                                            </div>
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="color: #808080">
                                                <br/>
                                                <i>SaraPhone WebRTC</i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="center" class="inner" style="color: #808080">
                                                <p>2020
                                                <br/>Giovanni Maruzzelli - OpenTelecom.IT</p>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-md btn-primary btn-warn" data-inline="true" id="asknotificationpermission" style="margin-top: 0px; margin-bottom: 8px; width: 200px !important;">Allow Call Notifications</button>

                    </div>
                    <div align="center" id="incall" class="form-signin-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                                <div id="webphone_body" >
                                    <div id="webphone_display" >
                                        <h2 style="font-size: 20px !important;">Speaking with:<br/><br/><span id="speakingwith">...</span></h2>
                                    </div>
                                    <div id="dialpad">
                                        <div class="row">
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="webphone_keypad">
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf1btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio1.play ( )">1</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf2btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio2.play ( )">2</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf3btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio3.play ( )">3</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf4btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio4.play ( )">4</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf5btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio5.play ( )">5</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf6btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio6.play ( )">6</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf7btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio7.play ( )">7</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf8btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio8.play ( )">8</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf9btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio9.play ( )">9</button>
                                                <br/>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmfstarbtn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio_star.play ( )">.*</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmf0btn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio0.play ( )">0</button>
                                                <button class="btn btn-lg btn-primary btn-default" data-inline="true" id="dtmfpoundbtn" style="margin-bottom: 5px; margin-right: 3px; width: 48px !important; height: 48px !important; font-size: 20px; font-weight: bold;" onclick="audio_hash.play ( )">#</button>
                                                <br/>
                                                <button class="btn btn-sm btn-primary btn-danger" data-inline="true" id="hangupbtn"     style="margin-top: 5px; margin-bottom: 5px; width: 67px !important;">Hangup</button>
                                                <br/>
                                                <br/>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" id="webphone_keypad_right">
<!--
                                                <button class="btn btn-sm btn-primary btn-warning" data-inline="true" id="holdbtn" style="margin-bottom: 8px; width: 120px !important;">Hold</button><br />
-->
                                                <button class="btn btn-sm btn-primary btn-warning" data-inline="true" id="mutebtn" style="margin-bottom: 8px; width: 120px !important;">Mute</button><br />
<!--
                                                <button title="at beep, enter the digits you want to call, then press '#'. You will be connected. After you talk, hangup to transfer the original call, or press '#' to get the original call back. If attended transfer does not work, you get the original call back." class="btn btn-sm btn-primary" data-inline="true" id="attxbtn" style="margin-bottom: 8px; width: 120px !important;" onclick="audio1.play ( )">Att-Xfer</button><br />
                                                <button title="at beep, enter the digits you want to call, then press '#'. If transfer does not work, you get the original call back." class="btn btn-sm btn-primary btn-success" data-inline="true" id="xferbtn" style="margin-bottom: 8px; width: 120px !important;" onclick="audio1.play ( )">Xfer</button><br />
-->
                                            </div>
                                            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="color: #808080">
                                                <br/>
                                                <i>SaraPhone WebRTC</i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="center" class="inner" style="color: #808080">
                                                <p>2020
                                                <br/>Giovanni Maruzzelli - OpenTelecom.IT</p>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" style="cacawidth: 640px;" id="video1" class="embed-responsive embed-responsive-16by9">
                                <video id="audio" width="1" autoplay="autoplay" playsinline style="object-fit: contain;" class="embed-responsive-item"> </video>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div align="center" id="dial" class="form-signin-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                                <div id="webphone_blf" style="height:auto;min-height:30px;">
                                    <h4>BLFs</h4>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres1btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent1">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres2btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent2">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres3btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent3">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres4btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent4">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres5btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent5">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres6btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent6">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres7btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent7">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres8btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent8">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres9btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent9">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres10btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent10">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres11btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent11">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres12btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent12">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres13btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent13">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres14btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent14">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres15btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent15">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres16btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent16">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres17btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent17">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres18btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent18">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres19btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent19">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres20btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent20">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres21btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent21">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres22btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent22">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres23btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent23">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres24btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent24">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres25btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent25">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres26btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent26">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres27btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent27">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres28btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent28">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres29btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent29">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres30btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent30">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres31btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent31">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres32btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent32">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres33btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent33">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres34btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent34">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres35btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent35">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres36btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent36">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres37btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent37">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres38btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent38">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres39btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent39">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres40btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent40">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres41btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent41">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres42btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent42">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres43btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent43">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres44btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent44">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres45btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent45">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres46btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent46">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres47btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent47">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres48btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent48">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres49btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent49">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres50btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent50">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres51btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent51">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres52btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent52">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres53btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent53">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres54btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent54">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres55btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent55">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres56btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent56">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres57btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent57">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres58btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent58">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres59btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent59">...</span></button>
<button class="btn btn-sm btn-primary btn-default" data-inline="true" id="pres60btn" style="margin-bottom: 5px; width: 150px !important;" onclick="audio1.play ( )"><span id="ispresent60">...</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                    <div align="center" class="form-signin">
                        <div align="center" id="signin" class="form-signin-content">
<!--
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                                    <iframe id="phonebook" src="contacts.php?user_extension=1010" style="display: none; width: 100%; height: 145px; padding: 15px; border-style: solid; border-width: 1px; border-radius: 15px; border-color: #292929; background: #333; background-image:url('img/bg_333.jpg'); background-repeat: repeat; background-attachment: fixed !important;"></iframe>
                                </div>
                            </div>
-->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                    <div align="center" class="form-signin">
                        <div align="center" id="signin" class="form-signin-content">
                            <div id="dialadv2">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top: 10px;">
                                        <div id="webphone_body">
                                            <div style="font-size: 12px; margin-bottom: 4px; width: 100%; background-color: #333;" id="listmic">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/adapter.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/sip.js"></script>
    <script type="text/javascript" src="js/fs.js"></script>
    <script type="text/javascript" src="saraphone.js?random=5e95b0591ba90"></script>
    <script type="text/javascript">
        //getServerData(<?php //echo $domain;?>,<?php //echo $server;?>,<?php //echo $port;?>);
    </script>
    <script>
	function blinker() { $('.blinking').fadeOut(500); $('.blinking').fadeIn(500); }
	setInterval(blinker, 1000);
    </script>
</div>
</body>
