<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
		exit;
	};
	
	$ip = $_SERVER['REMOTE_ADDR'];
			
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
				if(!empty($_GET["hwid"])){
					error_reporting( ~E_DEPRECATED & ~E_NOTICE );
					$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
					$dbh->exec('SET NAMES utf8');
					if ( !$dbh ) {
						die("Connection failed : " . mysql_error());
					};
					
						$req_check = $dbh->prepare('SELECT * FROM users WHERE userName=:username AND userPass = :password');
						$req_check->bindParam(':username', $username, PDO::PARAM_STR);
						$req_check->bindParam(':password', $password, PDO::PARAM_STR);
						$req_check-> execute();
						$row_check = $req_check->fetch();
						$email = $row_check['userEmail'];
					
					if ($hwid != $row_check['hwid']){ 
						$ip = $_SERVER['REMOTE_ADDR'];
						$req2 = $dbh->prepare('INSERT INTO banned (ip) VALUES(:ip)');
						$req2->bindParam(':ip', $ip, PDO::PARAM_STR);
						$req2-> execute();
						
						$ip = $_SERVER['REMOTE_ADDR'];
						$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
						echo $output;
						echo "<pre>YOU ARE BANNED.</pre>";
						exit;
					};
					
						$row = "/home/software/free.dll";
						header("Content-type: application/force-download");
						header("Content-Length: ".filesize($row));
						readfile($row);
						$req3 = $dbh->prepare('INSERT INTO free_inject (userName,mail,ip) VALUES(:username,:email,:ip)');
						$req3->bindParam(':username', $username, PDO::PARAM_STR);
						$req3->bindParam(':email', $email, PDO::PARAM_STR);
						$req3->bindParam(':ip', $ip, PDO::PARAM_STR);
						$req3-> execute();
						exit; // OK
						
					}else {
						$ip = $_SERVER['REMOTE_ADDR'];
						$req2 = $dbh->prepare('INSERT INTO banned (ip) VALUES(:ip)');
						$req2->bindParam(':ip', $ip, PDO::PARAM_STR);
						$req2-> execute();
								
						$ip = $_SERVER['REMOTE_ADDR'];
						$output = shell_exec("sudo iptables -I INPUT -s ".$ip." -j DROP");
						echo $output;
						echo "<pre>YOU ARE BANNED.</pre>";
						exit;
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
						exit;
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
						exit;
					};
	
?>