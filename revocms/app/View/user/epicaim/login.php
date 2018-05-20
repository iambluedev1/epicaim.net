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
			<div class="col-md-4 col-md-offset-2">
				<form class="panel panel-default panel-login" id="login-form" method="post">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i> <?= $translate->element("view", "login", "title"); ?></h3>
					</div>
					<div class="panel-body">	
						<div id="resultlf" style="display:none;"></div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-red"></i></span>
							<input type="text" class="form-control" name="login" placeholder="<?= $translate->element("view", "login", "inputs", "input_1"); ?>" maxlength="40">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-red"></i></span>
							<input type="password" class="form-control" name="password" placeholder="<?= $translate->element("view", "login", "inputs", "input_2"); ?>" maxlength="15">
						</div>
						<div class="checkbox">
							<div class="form-check">
								<label>
									<input type="checkbox" name="check" checked> <span class="label-text"><?= $translate->element("view", "login", "inputs", "input_3"); ?></span>
								</label>
							</div>
						</div>
						<br>
						<small><a href="/lost-password"><?= $translate->element("view", "login", "lost_password"); ?></a></small>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-default btn-block"><?= $translate->element("view", "login", "btn"); ?></button>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<form class="panel panel-default panel-login">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i> <?= $translate->element("view", "login", "box_title"); ?></h3>
					</div>
					<div class="panel-body">	
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/krwkyHDd8i8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="bottom">
					<?= $translate->element("view", "login", "info"); ?>
					<ul class="list-inline list-unstyled pull-right">
						<li <?= (Session::readUser("lang") == "fr") ? "class=\"active\"" : "";?>><a href="/lang/fr/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/800px-Flag_of_France.svg.png" /></a></li>
						<li <?= (Session::readUser("lang") == "en") ? "class=\"active\"" : "";?>><a href="/lang/en/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a4/Flag_of_the_United_States.svg/800px-Flag_of_the_United_States.svg.png" /></a></li>
					</ul>
				</div>
			</div>
		</div>
    </div>
</div>
