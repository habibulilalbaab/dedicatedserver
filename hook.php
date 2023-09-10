<?php
function activate() {
    // Daftarkan hook 'ClientAreaPage'
    add_hook('ClientAreaPage', 1, $this->module_name . '_client_area_hook');
    return array('status' => 'success', 'description' => 'Modul berhasil diaktifkan');
}

function module_name_client_area_hook($vars) {
    if ($vars['filename'] === 'clientareaproductdetails' && isset($_GET['id']) && $_GET['id'] === '218') {
        // Tambahkan tombol "Start NoVNC" dengan tautan ke fungsi dedicatedserver_startNoVNC()
        $productId = (int) $_GET['id'];
        echo '<a href="clientarea.php?action=start_novnc&id=' . $productId . '" class="btn btn-primary">Start NoVNC</a>';
    }
}

add_hook('ClientAreaPage', 1, function($vars) {
    if ($_GET['action'] === 'start_novnc' && isset($_GET['id'])) {
        $productId = (int) $_GET['id'];

        // Panggil fungsi dedicatedserver_startNoVNC() dengan ID produk yang sesuai
        $result = dedicatedserver_startNoVNC($productId);

        if ($result === true) {
            echo '<script>alert("NoVNC telah berhasil dimulai.");</script>';
        } else {
            echo '<script>alert("Gagal memulai NoVNC.");</script>';
        }
    }
});

?>