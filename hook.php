<?php
include "dedicatedserver.php";

add_hook('ClientAreaPage', 1, 'customButtonHook');

function customButtonHook($vars) {
    // Cek apakah tombol "Create" diklik
    if (isset($_POST['runNoVNC'])) {
        dedicatedserver_startNoVNC($params)
    }
}

?>