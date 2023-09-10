<?php
$output = shell_exec('ping -c1 google.com');
if (str_contains($output, '0% packet loss')) {
    echo "OK";
}
?>
