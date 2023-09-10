<?php
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function dedicatedserver_MetaData(){
  return array(
      'DisplayName' => 'Natanetwork - Dedicated Server'
  );
}

function dedicatedserver_ClientArea($params) {
  return array(
      'templatefile' => 'clientarea',
      'vars' => array(
          'params'=> $params,
      ),
  );
}

function dedicatedserver_startNoVNC($params) {
	exec('cd ../modules/servers/dedicatedserver && ./novnc/utils/novnc_proxy  --listen 1111 --vnc 10.255.255.54:5909 --ssl-only --heartbeat 3 --web-auth --auth-plugin BasicHTTPAuth --auth-source username:password &');
	return 'success';
}
function dedicatedserver_stopNoVNC($params) {	
	$proccess = shell_exec("ps aux | grep -i 'novnc_proxy  --listen 1111'");
	$pid = explode(" ", $proccess)[3];
	// kill
	shell_exec("kill -9 ".$pid." && kill $(lsof -t -i:1111)");
	return $pid;
}
  
function dedicatedserver_AdminCustomButtonArray() {
	$buttonarray = array(
		'Start NoVNC' => 'startNoVNC',
		'Stop NoVNC' => 'stopNoVNC',
	);
	return $buttonarray;
}
function dedicatedserver_AdminServicesTabFields($params) {
  try {
      // Mendapatkan admin notes untuk produk dengan ID tertentu
      $adminNotes = Capsule::table('tblhosting')
          ->where('id', $params['serviceid'])
          ->value('notes');
  
      if ($adminNotes) {
          // Memisahkan admin notes menjadi baris-baris
          $notesLines = explode("\n", $adminNotes);
      }
}catch (Exception $e) {

}

	$userpass = str_replace(array("\n", "\r"), '', $notesLines[3].":".$notesLines[4]."@");
	// ./novnc/utils/novnc_proxy --vnc 10.255.255.54:5909 --ssl-only --heartbeat 3 --web-auth --auth-plugin BasicHTTPAuth --auth-source username:password --listen 1111
	// $status = shell_exec('ping -c1 google.com');
	// if (str_contains($output, '0% packet loss')) {
	// 	echo "OK";
	// }
    $fieldsarray = array(
        'API Connection Status' => '<div class="successbox">VNC Connection OK</div>',
        'Connection information' =>
	    '
		<table style="width:30%">

			<tr>
				<td><b>VNC Server:</b></td>
				<td>' . $notesLines[0] . '</td>
			</tr>

			<tr>
				<td><b>VNC Port:</b></td>
				<td>' . $notesLines[1] . '</td>
			</tr>

			<tr>
				<td><b>VNC Password:</b></td>
				<td>' . $notesLines[2] . '</td>
			</tr>

			<tr>
				<td>==========</td>
				<td>
				<td>
			</tr>

			<tr>
				<td><b>NoVNC User:</b></td>
				<td>' . $notesLines[3] . '</td>
			</tr>

			<tr>
				<td><b>NoVNC Password:</b></td>
				<td>' . $notesLines[4] . '</td>
			</tr>

			<tr>
				<td><b>NoVNC Access:</b></td>
				<td><button onclick="runNoVNC()" type="button" class="btn btn-primary">NoVNC Console</button></td>
			</tr>

		</table>
		<script>
			function runNoVNC(){
				window.open( "https://'.$userpass.'" + window.location.host + ":"+'.$params['serviceid'].'+"/vnc.html");
				alert( "https://'.$userpass.'" + window.location.host + ":"+'.$params['serviceid'].'+"/vnc.html");
			}
		</script>
	    '
    );
  return $fieldsarray;
}
?>