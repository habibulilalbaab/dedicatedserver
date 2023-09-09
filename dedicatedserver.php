<?php
use WHMCS\Database\Capsule;

function dedicatedserver_MetaData(){
  return array(
      'DisplayName' => 'Natanetwork - Dedicated Server',
      'Hooks' => array(
            'AdminProductConfigFields' => 1
        ),
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
	    <td><b>NoVNC User:</b></td>
	    <td>' . $params['serviceid'] . '</td>
	    </tr>
		
	    <tr>
	    <td><b>NoVNC Password:</b></td>
	    <td>' . $params['serviceid'] . '</td>
	    </tr>

	    </table>'
    );
  return $fieldsarray;
}
?>
