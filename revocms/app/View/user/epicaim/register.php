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
				<form class="panel panel-default panel-register" id="register-form" method="post">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i> <?= $translate->element("view", "register", "title"); ?></h3>
					</div>
					<div class="panel-body">	
						<div id="resultlf" style="display:none;"></div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-red"></i></span>
							<input type="text" class="form-control" name="login" id="login" placeholder="<?= $translate->element("view", "register", "inputs", "input_1"); ?>">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-red"></i></span>
							<input type="email" class="form-control" name="email" id="email" placeholder="<?= $translate->element("view", "register", "inputs", "input_2"); ?>">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-red"></i></span>
							<input type="password" class="form-control" name="password" id="password" placeholder="<?= $translate->element("view", "register", "inputs", "input_3"); ?>">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-red"></i></span>
							<input type="password" class="form-control" name="rpassword" id="rpassword" placeholder="<?= $translate->element("view", "register", "inputs", "input_4"); ?>">
						</div>
						<div class="checkbox">
							<div class="form-check">
								<label>
									<input type="checkbox" name="newsletter" id="newsletter"> <span class="label-text"><?= $translate->element("view", "register", "inputs", "input_5"); ?></span>
								</label>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-default btn-block"><?= $translate->element("view", "register", "btn"); ?></button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="bottom">
				<?= $translate->element("view", "register", "info"); ?>
				<ul class="list-inline list-unstyled pull-right">
					<li <?= (Session::readUser("lang") == "fr") ? "class=\"active\"" : "";?>><a href="/lang/fr/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/800px-Flag_of_France.svg.png" /></a></li>
					<li <?= (Session::readUser("lang") == "en") ? "class=\"active\"" : "";?>><a href="/lang/en/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a4/Flag_of_the_United_States.svg/800px-Flag_of_the_United_States.svg.png" /></a></li>
				</ul>
				</div>
			</div>
		</div>
    </div>
</div>
