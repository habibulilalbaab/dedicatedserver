<?php

// Developed by Muhammad Habib Ulil A <habib@natanetwork.co.id>

use \WHMCS\Database\Capsule;

// if (!defined("WHMCS")) {
//     die("This file cannot be accessed directly");
// }

function adminNotes($params){
	// Mendapatkan admin notes untuk produk dengan ID tertentu
	$adminNotes = Capsule::table('tblhosting')
		->where('id', $params['serviceid'])
		->value('notes');
	if ($adminNotes) {
		// Memisahkan admin notes menjadi baris-baris
		$notesLines = explode("\n", $adminNotes);
	}
	return $notesLines;
}

function dedicatedserver_MetaData(){
  return array(
      'DisplayName' => 'Natanetwork - Dedicated Server'
  );
}

function dedicatedserver_ClientArea($params) {
	$port = $params['serviceid']+1000;
	$statusNoVNC = shell_exec("lsof -t -i:".$port);
	if ($statusNoVNC != NULL) {
		$statusNoVNC = true;
	}
	$userpass = str_replace(array("\n", "\r"), '', adminNotes($params)[3].":".adminNotes($params)[4]."@");
	return array(
		'templatefile' => 'clientarea',
		'vars' => array(
			'params' => $params,
			'statusNoVNC' => $statusNoVNC,
			'notesLines' => adminNotes($params),
			'userpass' => $userpass,
			'port' => $port,
		)
	);
}
function dedicatedserver_CreateAccount($params) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$usernameLength = 8; // Panjang username yang diinginkan
	$passwordLength = 12; // Panjang username yang diinginkan
	$username = '';
	$password = '';

	for ($i = 0; $i < $usernameLength; $i++) {
		$randomChar = $characters[rand(0, strlen($characters) - 1)];
		$username .= $randomChar;
	}
	for ($i = 0; $i < $passwordLength; $i++) {
		$randomChar = $characters[rand(0, strlen($characters) - 1)];
		$password .= $randomChar;
	}
	$notes = "0.0.0.0\n5900\n0000\n".$username."\n".$password;
	Capsule::table('tblhosting')
        ->where('id', $params['serviceid'])
        ->update(['notes' => $notes]);
	return 'success';
}
function dedicatedserver_startNoVNC($params) {
	try {
		$userpass = str_replace(array("\n", "\r"), '', adminNotes($params)[3].":".adminNotes($params)[4]);
		$vncserver = str_replace(array("\n", "\r"), '', adminNotes($params)[0].":".adminNotes($params)[1]);
		$port = $params['serviceid']+1000;
		$command = "cd ../modules/servers/dedicatedserver && nohup ./novnc/utils/novnc_proxy  --listen ".$port." --vnc ".$vncserver." --ssl-only --heartbeat 3 --web-auth --auth-plugin BasicHTTPAuth --auth-source ".$userpass."  > /dev/null 2>&1 &";
		shell_exec($command);
		return 'success';
	} catch (\Throwable $th) {
		//throw $th;
		return $th->getMessage();
	}
}
function dedicatedserver_stopNoVNC($params) {
	try {	
		$port = $params['serviceid']+1000;
		$proccess = shell_exec("pgrep -f 'novnc_proxy --listen ".$port."'");
		// kill
		shell_exec("kill -9 ".$proccess);
		shell_exec("kill $(lsof -t -i:".$port.")");
		return 'success';
	} catch (\Throwable $th) {
		//throw $th;
		return $th->getMessage();
	}
}
function dedicatedserver_rebootNoVNC($params) {
	try {	
		dedicatedserver_stopNoVNC($params);
		sleep(1);
		dedicatedserver_startNoVNC($params);
		return 'success';
	} catch (\Throwable $th) {
		//throw $th;
		return $th->getMessage();
	}
}
  
function dedicatedserver_AdminCustomButtonArray() {
	$buttonarray = array(
		'Start NoVNC' => 'startNoVNC',
		'Reboot NoVNC' => 'rebootNoVNC',
		'Stop NoVNC' => 'stopNoVNC',
	);
	return $buttonarray;
}
function dedicatedserver_AdminServicesTabFields($params) {
	$userpass = str_replace(array("\n", "\r"), '', adminNotes($params)[3].":".adminNotes($params)[4]."@");
	$port = $params['serviceid']+1000;
	$statusNoVNC = shell_exec("lsof -t -i:".$port);
	if ($statusNoVNC == NULL) {
		$fieldsarray = array(
			'API Connection Status' => '<div class="errorbox">NoVNC Connection Offline</div>',
			'Connection information' =>
			'
			<table style="width:100%">

				<tr>
					<td><b>VNC Server:</b></td>
					<td>' . adminNotes($params)[0] . '</td>
				</tr>

				<tr>
					<td><b>VNC Port:</b></td>
					<td>' . adminNotes($params)[1] . '</td>
				</tr>

				<tr>
					<td><b>VNC Password:</b></td>
					<td>' . adminNotes($params)[2] . '</td>
				</tr>

				<tr>
					<td>==========</td>
					<td>
					<td>
				</tr>

				<tr>
					<td><b>NoVNC User:</b></td>
					<td>' . adminNotes($params)[3] . '</td>
				</tr>

				<tr>
					<td><b>NoVNC Password:</b></td>
					<td>' . adminNotes($params)[4] . '</td>
				</tr>
			</table>
			'
		);
	}else{
		$fieldsarray = array(
			'API Connection Status' => '<div class="successbox">NoVNC Connection OK</div>',
			'Connection information' =>
			'
			<table style="width:100%">

				<tr>
					<td><b>VNC Server:</b></td>
					<td>' . adminNotes($params)[0] . '</td>
				</tr>

				<tr>
					<td><b>VNC Port:</b></td>
					<td>' . adminNotes($params)[1] . '</td>
				</tr>

				<tr>
					<td><b>VNC Password:</b></td>
					<td>' . adminNotes($params)[2] . '</td>
				</tr>

				<tr>
					<td>==========</td>
					<td>
					<td>
				</tr>

				<tr>
					<td><b>NoVNC User:</b></td>
					<td>' . adminNotes($params)[3] . '</td>
				</tr>

				<tr>
					<td><b>NoVNC Password:</b></td>
					<td>' . adminNotes($params)[4] . '</td>
				</tr>

				<tr>
					<td><b>NoVNC URL:</b></td>
					<td id="novncurl"></td>
				</tr>

				<tr>
					<td><b>NoVNC Access:</b></td>
					<td><button onclick="runNoVNC()" type="button" class="btn btn-primary">NoVNC Console</button></td>
				</tr>

			</table>
			<script>
				document.getElementById("novncurl").innerHTML = "https://'.$userpass.'" + window.location.host + ":"+'.$port.'+"/vnc.html";
				function runNoVNC(){
					window.open( "https://'.$userpass.'" + window.location.host + ":"+'.$port.'+"/vnc.html");
				}
			</script>
			'
		);
	}
  return $fieldsarray;
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'startNoVNC') {
	$startNoVNC = dedicatedserver_startNoVNC($params);
	echo json_encode(['result' => 'success', 'message' => $startNoVNC]);
}

?>