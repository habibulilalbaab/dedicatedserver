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

function dedicatedserver_AdminServicesTabFields() {
  try {
      // Mendapatkan admin notes untuk produk dengan ID tertentu
      $adminNotes = Capsule::table('tblhosting')
          ->where('id', $params['serviceid'])
          ->value('notes');
  
      if ($adminNotes) {
          // Memisahkan admin notes menjadi baris-baris
          $notesLines = explode("\n", $adminNotes);
          return $notesLines;
      } else {
          return "Admin Notes tidak ditemukan untuk produk dengan ID " . $productId;
      }
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
    $fieldsarray = array(
        'API Connection Status' => '<div class="successbox">VNC Connection OK</div>',
        'Connection information' =>
	    '<table style="width:30%">

	    <tr>
	    <td><b>VNC Server:</b></td>
	    <td>' . dedicatedserver_AdminServicesTabFields() ?? "0.0.0.0" . '</td>
	    </tr>

	    <tr>
	    <td><b>VNC Port:</b></td>
	    <td>' . $params['serviceid'] . '</td>
	    </tr>

	    <tr>
	    <td><b>VNC Password:</b></td>
	    <td>' . $params['serviceid'] . '</td>
	    </tr>
	    
	    <tr>
	    <td>==========</td>
	    <td><td>
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
	    <td><a href="https://username@password:haruna01:6080/vnc.html?host=Haruna01&port=6080" class="btn btn-primary">NoVNC Console</a></td>
	    </tr>

	    </table>'
    );
  return $fieldsarray;
}
?>
