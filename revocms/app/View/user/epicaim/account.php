<?php
use Session\Session;
use Usage\Geolocation;

$geo = new Geolocation();
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">        
				<h1 class="title theme-color-underline" style="margin-bottom: 0px;"><?= $translate->element("view", "account", "title"); ?></h1>
			</div>        
		</div>
		<br>
		<div class="row">
			<div class="col-md-9 clearfix" id="customer-account">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?= $translate->element("view", "account", "summary", "title"); ?></h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $translate->element("view", "account", "summary", "username"); ?></label>
									<input class="form-control" value="<?= Session::readUser("username"); ?>" disabled="" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $translate->element("view", "account", "summary", "email"); ?></label>
									<input class="form-control" value="<?= Session::readUser("email"); ?>" disabled="" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $translate->element("view", "account", "summary", "rank"); ?></label>
								  <input class="form-control" value="<?= (Session::readUser("is_admin") == 0) ? "Membre" : "Administrateur"; ?>" disabled="" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $translate->element("view", "account", "summary", "ip"); ?></label>
									<input class="form-control" value="<?= $geo->getIp(); ?>" disabled="" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $translate->element("view", "account", "summary", "date"); ?></label>
									<?php $date = date("d/m/Y à H:i", Session::readUser("register"));?>
									<input class="form-control" value="<?= $date; ?>" disabled="" type="text">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box clearfix no-mb">
				   <div class="panel panel-default">
					  <div class="panel-heading">
						 <h3 class="panel-title"><?= $translate->element("view", "account", "password", "title"); ?></h3>
					  </div>
					  <div class="panel-body" style="padding: 30px 20px;">
					  	<form id="box-change-password">
						 	 <div id="box-change-password-result"></div>
						 	<input type="hidden" name="change_password" value="true" />
							<div class="row">
							<div class="col-sm-12">
								  <div class="form-group">
									 <label><?= $translate->element("view", "account", "password", "password_old"); ?></label>
									 <input class="form-control" name="confirm_password" type="password" required>
									 <small><?= $translate->element("view", "account", "password", "password_info"); ?></small>
								  </div>
							   </div>
							   <div class="col-sm-6">
								  <div class="form-group">
									 <label><?= $translate->element("view", "account", "password", "password_new_1"); ?></label>
									 <input class="form-control" name="new_password" type="password" required>
								  </div>
							   </div>
							   <div class="col-sm-6">
								  <div class="form-group">
									 <label><?= $translate->element("view", "account", "password", "password_new_2"); ?></label>
									 <input class="form-control" name="new_confirm_password" type="password" required>
								  </div>
							   </div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-default btn-large btn-icon-left pull-right"><i class="fa fa-edit" id="box-change-password-icon"></i> <?= $translate->element("view", "account", "password", "update"); ?></button>
							</div>
						 </form>
					  </div>
				   </div>
				</div>
				<div class="box clearfix no-mb">
				   <div class="panel panel-default">
					  <div class="panel-heading">
						 <h3 class="panel-title">Newsletter</h3>
					  </div>
					  <div class="panel-body" style="padding: 30px 20px;">
					  	<form id="box-newsletter">
						 	<div id="box-newsletter-result"></div>
						 	<input type="hidden" name="newsletter_mode" value="true" />
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="checkbox form-check">
											<label style="padding-left: 0px;">
												<input id="newsletter" type="checkbox" name="newsletter" <?= ($newsletter) ? "checked" : ""; ?>> <span class="label-text">S'abonner à la newsletter</span>
											</label>
										</div>
										<small>Si activé, vous recevrez dans votre boite mail toutes les nouveautés de notre site web !</small>
									</div>
							   	</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-default btn-large btn-icon-left pull-right"><i class="fa fa-edit" id="box-newsletter-icon"></i> <?= $translate->element("view", "account", "password", "update"); ?></button>
							</div>
						 </form>
					  </div>
				   </div>
				</div>
			</div>
			<div class="col-md-3">
			   <div class="panel panel-default sidebar-menu">
				  <div class="panel-heading">
					 <h3 class="panel-title"><?= $translate->element("view", "account", "actions", "title"); ?></h3>
				  </div>
				  <div class="panel-body">
					 <ul class="nav nav-pills nav-stacked">
						<li class="active">
						    <a href="/account"><i class="fa fa-list"></i> <?= $translate->element("view", "account", "actions", "links", "account"); ?></a>
						</li>
						<li>
							<a href="/account/logs"><i class="fa fa-money"></i> <?= $translate->element("view", "account", "actions", "links", "logs"); ?></a>
						</li>
						<li>
						   <a href="/account/tokens"><i class="fa fa-key"></i> <?= $translate->element("view", "account", "actions", "links", "tokens"); ?></a>
						</li>
						<li>
						   <a href="/logout"><i class="fa fa-sign-out"></i> <?= $translate->element("view", "account", "actions", "links", "logout"); ?></a>
						</li>
					 </ul>
				  </div>
			   </div>
			</div>
		</div>
    </div>
</div>
