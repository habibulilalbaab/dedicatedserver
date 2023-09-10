<?php
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}


// Mendapatkan admin notes untuk produk dengan ID tertentu
$this->$adminNotes = Capsule::table('tblhosting')
	->where('id', $params['serviceid'])
	->value('notes');
if ($this->$adminNotes) {
	// Memisahkan admin notes menjadi baris-baris
	$this->$notesLines = explode("\n", $adminNotes);
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
	try {
		shell_exec('cd ../modules/servers/dedicatedserver && nohup ./novnc/utils/novnc_proxy  --listen '.$params['serviceid'].' --vnc '.$notesLines[0].':'.$notesLines[1].' --ssl-only --heartbeat 3 --web-auth --auth-plugin BasicHTTPAuth --auth-source '.$notesLines[3].':'.$notesLines[4].'  > /dev/null 2>&1 &');
		return 'success';
	} catch (\Throwable $th) {
		//throw $th;
		return $th->getMessage();
	}
}
function dedicatedserver_stopNoVNC($params) {
	try {	
		$proccess = shell_exec("pgrep -f 'novnc_proxy --listen ".$params['serviceid']."'");
		// kill
		shell_exec("kill -9 ".$proccess);
		shell_exec("kill $(lsof -t -i:".$params['serviceid'].")");
		return 'success';
	} catch (\Throwable $th) {
		//throw $th;
		return $th->getMessage();
	}
}
  
function dedicatedserver_AdminCustomButtonArray() {
	$buttonarray = array(
		'Start NoVNC' => 'startNoVNC',
		'Stop NoVNC' => 'stopNoVNC',
	);
	return $buttonarray;
}
function dedicatedserver_AdminServicesTabFields($params) {
	$userpass = str_replace(array("\n", "\r"), '', $notesLines[3].":".$notesLines[4]."@");
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
			}
		</script>
	    '
    );
  return $fieldsarray;
}
?>