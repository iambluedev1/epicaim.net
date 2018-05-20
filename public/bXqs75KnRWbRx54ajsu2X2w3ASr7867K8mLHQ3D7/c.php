<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
		exit;
	};
	
	$req = $dbh->prepare('SELECT * FROM cheat_inject WHERE `date` > SUBDATE( CURRENT_TIMESTAMP, INTERVAL 2 MINUTE) AND ip = :ip');
	$req->bindParam(':ip', $ip, PDO::PARAM_STR);
	$req-> execute();
	$count = $req->rowCount();
	if ($count == "0") {
		$ip = $_SERVER['REMOTE_ADDR'];
		$req2 = $dbh->prepare('INSERT INTO banned (ip) VALUES(:ip)');
		$req2->bindParam(':ip', $ip, PDO::PARAM_STR);
		$req2-> execute();
				
		$ip = $_SERVER['REMOTE_ADDR'];
		$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
		echo $output;
		echo "<pre>YOU ARE BANNED.</pre>";
		exit; // Pas d'injection détecté, ça dégage
	}else {
		echo "OK";
		exit;
	};
?>