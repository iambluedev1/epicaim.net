<?php
use RevoCMS\RevoCMS;
use Session\Session;
use Web\Url;
use Usage\Flash;

$rcms = RevoCMS::getInstance();
$flash = Flash::getInstance();
?>

<div id="content">
	<div class="container relative login-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 top">
				<div>
					<a class="navbar-brand top-brand">
						<p><?= $rcms->configs->config->get("SITETITLE"); ?></p>
					</a>
				</div>
				<hr class="top-line">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<?php if($flash->hasMessages()): ?>
					<?= $flash->display("all", false, true);?>
				<?php endif;?>	
			</div>
			<div class="col-md-4 col-md-offset-4">
				<form class="panel panel-default panel-lost" method="post" id="lost-password">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i> <?= $translate->element("view", "lost_password", "title"); ?></h3>
					</div>
					<div class="panel-body">
						<div id="result"></div>	
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-red"></i></span>
							<input type="text" class="form-control" name="username" placeholder="<?= $translate->element("view", "lost_password", "inputs", "input_1"); ?>" maxlength="40">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-red"></i></span>
							<input type="email" class="form-control" name="email" placeholder="<?= $translate->element("view", "lost_password", "inputs", "input_2"); ?>" maxlength="40">
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-default btn-block"><?= $translate->element("view", "lost_password", "btn"); ?></button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="bottom">
				<?= $translate->element("view", "lost_password", "info"); ?>
				<ul class="list-inline list-unstyled pull-right">
					<li <?= (Session::readUser("lang") == "fr") ? "class=\"active\"" : "";?>><a href="/lang/fr/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/800px-Flag_of_France.svg.png" /></a></li>
					<li <?= (Session::readUser("lang") == "en") ? "class=\"active\"" : "";?>><a href="/lang/en/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a4/Flag_of_the_United_States.svg/800px-Flag_of_the_United_States.svg.png" /></a></li>
				</ul>
				</div>
			</div>
		</div>
    </div>
</div>
