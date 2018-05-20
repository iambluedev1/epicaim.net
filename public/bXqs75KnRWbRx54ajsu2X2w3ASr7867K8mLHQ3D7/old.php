<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
		exit;
	};
	
	$req = $dbh->prepare('SELECT * FROM cheat_inject WHERE `date` > SUBDATE( CURRENT_TIMESTAMP, INTERVAL 1 HOUR) AND ip = :ip');
	$req->bindParam(':ip', $ip, PDO::PARAM_STR);
	$req-> execute();
	$count = $req->rowCount();
	if ($count == "0") {
		echo "ERROR";
		exit;
	}else {
		echo "OK";
		exit;
	};
?>