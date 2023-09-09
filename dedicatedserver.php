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
        'API Connection Status' => '<div class="successbox">API Connection OK</div>',
        'Connection information' =>
	    '<table style="width:30%">

	    <tr>
	    <td><b>Comment:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>

	    <tr>
	    <td><b>Service:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>

	    <tr>
	    <td><b>Name:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>
	    
	    <tr>
	    <td><b>Caller-id:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>
		
	    <tr>
	    <td><b>Address:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>

	    <tr>
	    <td><b>Uptime:</b></td>
	    <td>' . $params['id'] . '</td>
	    </tr>
	    </table>'
    );
  }
  return $fieldsarray;
}
?>
