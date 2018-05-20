<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
	$dbh->exec('SET NAMES utf8');
	if ( !$dbh ) {
		die("Connection failed : " . mysql_error());
		exit;
	};
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$req2 = $dbh->prepare('SELECT ip FROM banned WHERE ip = :ip');
	$req2->bindParam(':ip', $ip, PDO::PARAM_STR);
	$req2-> execute();
	$count2 = $req2->rowCount();
			
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
	
	$token = trim($_GET['token']);
	$token = strip_tags($token);
	$token = htmlspecialchars($token);
	
		if(!empty($_GET["username"])){
			if(!empty($_GET["password"])){
				if(!empty($_GET["hwid"])){
					error_reporting( ~E_DEPRECATED & ~E_NOTICE );
					$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
					$dbh->exec('SET NAMES utf8');
					if ( !$dbh ) {
						die("Connection failed : " . mysql_error());
					};

					$req2 = $dbh->prepare('SELECT path FROM users WHERE userId=:id');
					$req2->bindParam(':id', $id, PDO::PARAM_STR);
					$req2-> execute();
					
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
					
					$count= $req2->rowCount();	
					
					$req_tok = $dbh->prepare('SELECT * FROM public_key');
					$req_tok-> execute();
					$tok_ok = $req_tok->fetch();
					$token_dl = $tok_ok['token'];
					
					if ($token == $token_dl) {
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
					
					$req_dl = $dbh->prepare('SELECT * FROM ok_download');
					$req_dl-> execute();
					$dl_ok = $req_dl->fetch();
					$date_today = $dl_ok['date'];
					$date_today2 = strtotime(date('Y-m-d H:i:s'));
					$navig = $_SERVER ['HTTP_USER_AGENT'];
						if ($navig == "4N6vq3966rW45Lb8u23Zvr62RCv9CFysS7x3mA7jiQjAWMLCeKYy7UPT2bfNQ9G3tf827dWK924LNwmT69iG5gNn24pxLm8Jjb9z") {
							if ($date_today == $date_today2) {
							if ($usrname == "leo") {
									$row = "/home/software/insecure.dll";
							}else {
									$row = "/home/software/pedo.dll";
							};
									header("Content-type: application/force-download");
									header("Content-Length: ".filesize($row));
									readfile($row);
									$req_truncate = $dbh->prepare('TRUNCATE public_key');
									$req_truncate-> execute();
									$req3 = $dbh->prepare('INSERT INTO cheat_inject (userName,mail,ip) VALUES(:username,:email,:ip)');
									$req3->bindParam(':username', $username, PDO::PARAM_STR);
									$req3->bindParam(':email', $email, PDO::PARAM_STR);
									$req3->bindParam(':ip', $ip, PDO::PARAM_STR);
									$req3-> execute();
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