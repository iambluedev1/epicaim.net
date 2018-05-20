<?php 
$ip = $_SERVER['REMOTE_ADDR'];
$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
echo $output;
echo "<pre>YOU ARE BANNED.</pre>";
?>