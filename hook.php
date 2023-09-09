function hook_adminproductconfigfields($params)
{
    // Mengambil nilai-nilai dari kolom-kolom yang telah disimpan
    $vnc_ip = "1.1.1.1";
    $vnc_port = "5900";
    $vnc_password = "admin";
    
    // Tambahkan form atau kolom-kolom di sini dan isi dengan nilai-nilai dari database
    $html = '<div class="form-group">
                <label for="vnc_ip">IP Address VNC:</label>
                <input type="text" id="vnc_ip" name="vnc_ip" value="' . $vnc_ip . '">
            </div>
            <div class="form-group">
                <label for="vnc_port">Port VNC:</label>
                <input type="text" id="vnc_port" name="vnc_port" value="' . $vnc_port . '">
            </div>
            <div class="form-group">
                <label for="vnc_password">Password VNC:</label>
                <input type="password" id="vnc_password" name="vnc_password" value="' . $vnc_password . '">
            </div>';

    return $html;
}

