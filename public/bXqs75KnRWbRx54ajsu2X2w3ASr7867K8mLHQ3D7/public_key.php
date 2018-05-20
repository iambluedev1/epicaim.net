<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
	};
	$navig = $_SERVER ['HTTP_USER_AGENT'];
	if ($navig == "peA7u98UbL937L57k85cDS8wB8mR35E53X3as6pb7e4SJep5xgRT9JLF7K9V9eD4xL2sfp9BxLvMTXThbQc4pLc4jd5D5g9QDg9K") {
		
		$token = openssl_random_pseudo_bytes(32);
		$token = bin2hex($token);
		echo $token;
		
		$req_truncate = $dbh->prepare('TRUNCATE public_key');
		$req_truncate-> execute();
		
		$req_public_key = $dbh->prepare('INSERT INTO public_key (token) VALUES(:token)');
		$req_public_key->bindParam(':token', $token, PDO::PARAM_STR);
		$req_public_key-> execute();
		exit;
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
		$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
		echo $output;
		echo "<pre>YOU ARE BANNED.</pre>";
		exit;
	}
?>