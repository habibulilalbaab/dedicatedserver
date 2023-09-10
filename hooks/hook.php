<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('ClientAreaPageProductDetails', 1, function($vars) {
    // Tambahkan tombol di halaman detail produk
    $buttonHtml = '<button id="customProductButton" class="btn btn-success">Klik Saya</button>';
    $vars['output'] = str_replace('<div class="product-price">', '<div class="product-price">' . $buttonHtml, $vars['output']);
    
    // Tambahkan script JavaScript untuk menangani klik tombol
    $jsScript = '
    <script>
        document.getElementById("customProductButton").addEventListener("click", function(event) {
            event.preventDefault();
            alert("Berhasil diklik!");
        });
    </script>';
    
    $vars['output'] = str_replace('</body>', $jsScript . '</body>', $vars['output']);
});

?>