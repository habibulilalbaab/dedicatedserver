add_hook('ClientAreaPage', 1, function($vars) {
    if ($_GET['action'] === 'custom_action') {
        // Lakukan apa pun yang diperlukan setelah tindakan selesai
        echo "Tindakan kustom berhasil dijalankan.";
    }
});
