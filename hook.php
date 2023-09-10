<?php
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