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
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading">
                        <h3 class="panel-title">Actions</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="/admin/newsletter/load/<?= $newsletter->newsletterId; ?>" target="_blank"><i class="fa fa-search"></i> Prévisualiser</a>
                            </li>
                            <li>
                                <a href="/admin/newsletter/delete/<?= $newsletter->newsletterId; ?>"><i class="fa fa-trash"></i> Supprimer</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?= $newsletter->newsletterTitle; ?></h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <form id="box-edit">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Titre</label>
                                        <input class="form-control" name="title" id="title" type="text" value="<?= $newsletter->newsletterTitle; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" name="date" type="text" value="<?= date("d/m/Y à H:i", $newsletter->newsletterDate); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Etat</label>
                                        <input class="form-control" name="state" type="text" value="<?= ($newsletter->newsletterState == 0) ? "Brouillon" : "Envoyée"; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div class="panel panel-default" id="type_step">
					<div class="panel-heading">
						<h3 class="panel-title">Préparation de l'envoi de la newsletter</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <p>Vous êtes sur le point d'envoyer la newsletter. Pour l'envoyer, merci de selectionner la cible de cette envoit :</p>
                        <form id="box-type">
                            <div id="box-type-result"></div>
                            <div class="form-check">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="type" value="1" checked> <span class="label-text">Tout le monde</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="type" value="2"> <span class="label-text">Tout les vips</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="type" value="3"> <span class="label-text">Tout les non-vips</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-content-icon"></i> Selectionner</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div class="panel panel-default" id="final_step" style="display: none;">
					<div class="panel-heading">
						<h3 class="panel-title">Liste d'envoi</h3>
					</div>
					<div class="panel-body table-responsive" style="padding: 30px 20px;">
                        <p> Voici une liste récapitulatif de tous les comptes vers lesquelles sera envoyée cette newsletter : </p>
                        <div id="box-send-result"></div>
                        <table class="table table-striped" id="admin_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom d'utilisateur</th>
									<th>Email</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody id="users">
								
							</tbody>
						</table>
					</div>
                    <div class="panel-footer" style="height: 56px;">
                        <div class="pull-left">
                            <button type="button" onclick="back();" class="btn btn-info btn-large btn-icon-left"><i class="fa fa-undo" ></i> Retour</button>
                        </div>
                        <div class="pull-right">
                            <form id="box-send">
                                <input type="hidden" name="id" value="<?= $newsletter->newsletterId; ?>">
                                <input type="hidden" name="type" id="type_input">
                                <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-paper-plane" id="box-send-icon"></i> Envoyer</button>
                            </form>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>
