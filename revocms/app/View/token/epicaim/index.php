<?php
use Session\Session;
use Usage\Geolocation;

$geo = new Geolocation();
?>

<div id="content">
	<div class="container relative login-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 top">
				<div>
					<a class="navbar-brand top-brand">
						<p><?= $translate->element("view", "title"); ?></p>
					</a>
				</div>
				<hr class="top-line">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<form class="panel panel-default panel-token" id="token-form">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i><?= $translate->element("view", "cat_1", "title"); ?></h3>
					</div>
					<div class="panel-body">	
						<div id="result"></div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-tags fa-red"></i></span>
							<input type="text" class="form-control" name="token" placeholder="<?= $translate->element("view", "cat_1", "input"); ?>">
						</div>
						<br>
						<small><?= $translate->element("view", "info"); ?></small>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-default btn-block"><?= $translate->element("view", "cat_1", "btn"); ?></button>
					</div>
				</form>
			</div>
			<div class="col-md-4">
                <div class="panel panel-default panel-login">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user"></i><?= $translate->element("view", "cat_2", "title"); ?></h3>
					</div>
					<div class="panel-body">	
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-red"></i></span>
							<input type="text" class="form-control" name="username"  disabled="" placeholder="<?= Session::readUser("username"); ?>">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope-o fa-red"></i></span>
							<input type="email" class="form-control" name="email"  disabled="" placeholder="<?= Session::readUser("email"); ?>">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-red"></i></span>
							<input type="email" class="form-control" name="email" disabled="" placeholder="<?= $geo->getIp(); ?>">
						</div>
					</div>
                </div>
			</div>
		</div>
    </div>
</div>