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
				<td>' . $params['serviceid'] . '</td>
			</tr>

			<tr>
				<td><b>NoVNC Password:</b></td>
				<td>' . $params['serviceid'] . '</td>
			</tr>

			<tr>
				<td><b>NoVNC Access:</b></td>
				<td><button onclick="runNoVNC()" type="button" class="btn btn-primary">NoVNC Console</button></td>
			</tr>

		</table>
		<script>
			function runNoVNC(){
				alert("ok")
			}
		</script>
	    '
    );
  return $fieldsarray;
}
?>