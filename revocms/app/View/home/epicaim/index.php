<?php 
use Session\Session;
?>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center">
				<h4 class="title theme-color-underline"><?= $translate->element("view", "home_cat1"); ?></h4>
				<hr/>
				<div class="panel panel-default">
					<div class="panel-heading clickable">
						<h3 class="panel-title"><?= $translate->element("view", "home_cat1_h"); ?></h3>
					</div>
					<div class="panel-body">
						<p>
							<?= $translate->element("view", "home_cat1_text1"); ?>
						</p>
					</div>
					<div class="panel-footer">
						<a href="https://epicaim.net/dl/EpicAimLoader.exe" target="_blank" class="btn btn-default btn-block">Download cheat client</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 text-center">
				<h4 class="title theme-color-underline"><?= $translate->element("view", "home_cat2"); ?></h4>
				<hr/>
				<div class="panel panel-success">
					<div class="panel-heading clickable">
						<h3 class="panel-title"><?= $translate->element("view", "home_cat2_h"); ?></h3>
					</div>
					<div class="panel-body">
						<p>
							<?= $translate->element("view", "home_cat2_text_status"); ?><b style='color:green;'><?= $translate->element("view", "home_cat2_text_status_state"); ?></b><br/>
							<?= $translate->element("view", "home_cat2_text_vip"); ?><b style='color:green;'> <?= Session::readUser("is_vip"); ?> Days !</b><br/>
							<br/>
							<b style='color:red;'><?= $translate->element("view", "home_cat2_text_vac"); ?></b> : <b style='color:green;'> <?= $translate->element("view", "home_cat2_text_vac_state"); ?></b><br/>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 text-center">
				<h4 class="title theme-color-underline"><?= $translate->element("view", "home_cat3"); ?></h4>
				<hr/>
				<div class="panel panel-default ">
					<div class="panel-heading clickable">
						<h3 class="panel-title"><?= $translate->element("view", "home_cat3_h"); ?></h3>
					</div>
					<div class="panel-body">
						<p>
							<?= $translate->element("view", "home_cat3_text1"); ?><br/>
							Administrator Unique DiscordID : <br/>
							<b style='color:black;'>
								Username#5591</br/>
								P e d o#8886<br/>
							</b>
						</p>
					</div>
					<div class="panel-footer">
						<a href="/support" target="_blank" class="btn btn-default btn-block"><?= $translate->element("view", "home_cat3_button"); ?></a>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
