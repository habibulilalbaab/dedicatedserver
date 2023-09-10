<?php
add_hook('ClientAreaPage', 1, 'customButtonHook');

function customButtonHook($vars) {
    // Cek apakah tombol "Create" diklik
    if (isset($_POST['createButton'])) {
        // Jalankan perintah "create" di sini
        // ...
        // Redirect atau kirim respons sesuai kebutuhan Anda
        return 'success';
    }
}

?>