<?php
use WHMCS\Database\Capsule;

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
    $fieldsarray = array(
        'API Connection Status' => '<div class="successbox">VNC Connection OK</div>',
        'Connection information' =>
	    '<table style="width:30%">

	    <tr>
	    <td><b>VNC Server:</b></td>
	    <td>' . $params['serviceid'] . '</td>
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
	    <td><a href="#" class="btn btn-primary">NoVNC Console</a></td>
	    </tr>

	    </table>'
    );
  return $fieldsarray;
}
?>
