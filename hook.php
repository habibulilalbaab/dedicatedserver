<?php
include "dedicatedserver.php";

function customButtonHook($vars) {
    // Cek apakah tombol "Create" diklik
    error_log('Hook is running');
    if (isset($_POST['runNoVNC'])) {
        dedicatedserver_startNoVNC($params);
        echo 'success';
    }
}

add_hook('ClientAreaPage', 1, 'customButtonHook');

?>