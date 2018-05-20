<?php 
error_reporting( ~E_DEPRECATED & ~E_NOTICE );
$dbh = new PDO('mysql:host=localhost;dbname=pedo', 'pedo', '9N0Q7Ahn1sLMcKE7');	
$dbh->exec('SET NAMES utf8');
if ( !$dbh ) {
	die("Connection failed : " . mysql_error());
};
	$req = $dbh->prepare("SELECT ip, GROUP_CONCAT(userName) FROM users WHERE ip != '0' AND ip != '0.0.0.0' GROUP BY ip HAVING COUNT(DISTINCT userId) > 1");
	$req-> execute();			
	$double_compte = $req->fetchall();

?>
<html>
	<table>
		<thead>
			<tr>
				<th><center>id</center></th>
				<th><center>ip</center></th>
				<th><center>userName</center></th>
			</tr>
		</thead>
		<tbody>
				<?php foreach($double_compte as $key => $value){ ?>
					<tr>
					  <td><?= $key ?></td>
					  <td><?= $value['ip'] ?></td>
					  <td><?= $value['GROUP_CONCAT(userName)'] ?></td>
					</tr>
				<?php } ?>
		</tbody>
	</table>
</html>