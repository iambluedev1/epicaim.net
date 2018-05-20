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
				echo $row['hwid'];
				exit; // brave type, il est bien connecté
			};
		}else {
			echo "USERNAME";
			exit; // Pas de MDP
		};
		
		}else {
			echo "USERNAME";
			exit; // Pas de Nom de compte
		};
?>