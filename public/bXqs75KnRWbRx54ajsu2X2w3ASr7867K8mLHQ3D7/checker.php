<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
		exit;
	};
	$username = trim($_GET['username']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);
	
	$password = trim($_GET['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);
	$password = $password = hash('sha256', $password);
	
	$hwid = trim($_GET['hwid']);
	$hwid = strip_tags($hwid);
	$hwid = htmlspecialchars($hwid);
	
$navig = $_SERVER ['HTTP_USER_AGENT'];
	if ($navig == "X7veBux9A2MfRvA3uyqguXDNjeN7S82U8Cea5cm666j3tjh6NHY9Py2i2QuPCWgj9STu855b795Z2D5A8B8ST3N4Rpeu2qV34dG6") {
		if(!empty($_GET["username"])){
			if(!empty($_GET["password"])){	
			$req2 = $dbh->prepare('SELECT * FROM users WHERE userName=:username AND userPass = :password');
			$req2->bindParam(':username', $username, PDO::PARAM_STR);
			$req2->bindParam(':password', $password, PDO::PARAM_STR);
			$req2-> execute();
			$row = $req2->fetch();
			$count2 = $req2->rowCount();
			
			if ($count2 == "0" ) {
				echo "LOGIN_ERROR";
				exit; // On verrifie que le compte existe
			};
			$user_hwid = $row['hwid'];
			
			$userisvip = $row['is_vip'];
			if ($userisvip == "0" ){
				echo "NO_VIP";
				exit; // Check si il est VIP
			};
			
			if ($user_hwid == "HWID_HERE"){
				$req = $dbh->prepare('UPDATE users set hwid = :hwid WHERE userName=:username AND userPass = :password');	
				$req->bindParam(':hwid', $hwid, PDO::PARAM_STR);	
				$req->bindParam(':username', $username, PDO::PARAM_STR);
				$req->bindParam(':password', $password, PDO::PARAM_STR);
				$req-> execute();
				echo "HWID_HERE";
				exit; // premier Login, on setup le HWID
			};
			if ($user_hwid == $hwid){
			$req5 = $dbh->prepare('TRUNCATE ok_download');
			$req5-> execute();
			$date_today = strtotime(date('Y-m-d H:i:s'));
			$req4 = $dbh->prepare('INSERT INTO ok_download (date) VALUES(:date_today)');
			$req4->bindParam(':date_today', $date_today, PDO::PARAM_STR);
			$req4-> execute();
			echo $row['hwid'];
			exit; // brave type, il est bien connecté
			}
		}else {
			echo "USERNAME";
			exit; // Pas de MDP
		};
		
		}else {
			echo "USERNAME";
			exit; // Pas de Nom de compte
		};
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
		$req2 = $dbh->prepare('INSERT INTO banned (ip) VALUES(:ip)');
		$req2->bindParam(':ip', $ip, PDO::PARAM_STR);
		$req2-> execute();
				
		$ip = $_SERVER['REMOTE_ADDR'];
		$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
		echo $output;
		echo "<pre>YOU ARE BANNED.</pre>";
		exit; // pas de user agent
	};
?>