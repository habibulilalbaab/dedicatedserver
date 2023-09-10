<?php
add_hook('ClientAreaPage', 1, function($vars) {
    // Periksa apakah halaman detail layanan sedang ditampilkan
    if ($vars['filename'] === 'clientareaproductdetails') {
        // Ambil ID produk dari variabel WHMCS
        $productId = (int) $_GET['id'];

        // Tambahkan tombol dan JavaScript
        echo '<a href="clientarea.php?action=custom_action&product_id=' . $productId . '" class="btn btn-primary" id="customButton">Tombol Kustom</a>';
        echo '<script>
                  document.getElementById("customButton").addEventListener("click", function(event) {
                      event.preventDefault(); // Untuk mencegah perubahan URL
                      // Kirim permintaan ke aksi kustom di sini
                      fetch("clientarea.php?action=custom_action&product_id=' . $productId . '")
                          .then(function(response) {
                              if (response.ok) {
                                  alert("Tindakan berhasil dijalankan.");
                              } else {
                                  alert("Tindakan gagal.");
                              }
                          })
                          .catch(function(error) {
                              console.error("Terjadi kesalahan:", error);
                          });
                  });
              </script>';
    }
});

?>