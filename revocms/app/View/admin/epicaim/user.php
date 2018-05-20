<?php 
use Core\View;
?>
<div id="content">
	<div class="container">
        <div class="row">
            <div class="col-md-12">        
                <h1 class="title theme-color-underline" style="margin-bottom: 0px;">Panel d'administration</h1>
            </div>        
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <?php 
                    View::autoRender(false);
                    View::render(["folder" => "admin", "file" => "admin_nav"]);
                ?>

                <?php 
                    View::autoRender(false);
                    View::render(["folder" => "admin", "file" => "user_nav"]);
                ?>
			</div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Compte de : <?= $user->userName; ?> <span class="pull-right"><?= (!$online) ? "<font color=\"white\">Hors ligne</font>" : "<font color=\"lightgreen\">En ligne</font>"?></span></h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <div id="box-confirm-account-result"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nom d'utilisateur</label>
                                    <input class="form-control" value="<?= $user->userName; ?>" disabled="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Adresse email</label>
                                    <input class="form-control" value="<?= $user->userEmail; ?>" disabled="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Rang</label>
                                    <input class="form-control" value="<?= ($user->is_admin == 0) ? "Membre" : "Administrateur"; ?>" disabled="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ip d'inscription</label>
                                    <input class="form-control" value="<?= $user->ip; ?>" disabled="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Inscrit le</label>
                                    <?php $date = date("d/m/Y à H:i", $user->registeredAt);?>
                                    <input class="form-control" value="<?= $date; ?>" disabled="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>HWID</label>
                                    <div class="input-group">
                                    <input class="form-control" value="<?= $user->hwid; ?>" id="hwid" disabled="" type="text">
                                        <div class="input-group-btn">
                                        <button class="btn btn-danger" style="background-color: #ba2323;" onclick="editHWID();">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Etat du compte</label>
                                    <input class="form-control" value="<?= ($user->userState == 0) ? "Non-Confirmé" : "Confirmé"; ?>" disabled="" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Abonnement</label>
                                    <input class="form-control" value="<?= ($user->is_vip == 0) ? "Aucun aboonement" : $user->is_vip . " jours restant"; ?>" disabled="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Newsletter</label>
                                    <input class="form-control" value="<?= ($user->newsletter == 0) ? "Non-Activé" : "Activé"; ?>" disabled="" type="text">
                                </div>
                            </div>
                        </div>
					</div>
                    <div class="panel-footer" style="height: 56px;">
                        <?php if($user->userState == 0) : ?>
                            <form id="box-confirm-account" method="post">
                                <input type="hidden" name="id" value="<?= $user->userId;?>" />
                                <button type="submit" class="btn btn-success btn-large btn-icon-left pull-left"><i class="fa fa-edit" id="box-confirm-account-icon"></i> Confirmer le compte</button>
                            </form>
                        <?php endif; ?>
                    </div>
				</div>
                <div class="panel panel-default" id="panel-hwid" style="display: none;">
					<div class="panel-heading">
						<h3 class="panel-title">Modification de l'HWID</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <form id="box-hwid">
                            <input type="hidden" name="id" value="<?= $user->userId;?>" />
                            <div id="box-hwid-result"></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Nouvel HWID</label>
                                        <input class="form-control" name="new_hwid" id="new_hwid" type="text" value="HWID_HERE">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-hwid-icon"></i> Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>