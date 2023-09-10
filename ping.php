<?php
$data = "www-data 73475 0.0 0.0 2888 808 ? S 20:50 0:00 sh -c ps aux | grep -i 'novnc_proxy --listen 1111' www-data 73477 0.0 0.1 3468 1236 ? S 20:50 0:00 grep -i novnc_proxy --listen 1111 ";
echo explode(" ", $data)[1];
?>
