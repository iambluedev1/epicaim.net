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
                            <div id="box-edit-result"></div>
                            <div class="row">
                                <input type="hidden" name="id" value="<?= $newsletter->newsletterId; ?>">
                                <input type="hidden" name="change_title" value="true">
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
                                <div class="col-sm-12">
                                    <div class="pull-left">
                                        <button type="button" class="btn btn-success btn-large btn-icon-left"><i class="fa fa-edit"></i> Envoyer</button>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-edit-icon"></i> Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
                <div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Contenu</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <form id="box-content">
                            <div id="box-content-result"></div>
                            <div class="row">
                                <input type="hidden" name="id" value="<?= $newsletter->newsletterId; ?>">
                                <input type="hidden" name="change_content" value="true">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea id="newsContent" name="content"><?= $newsletter->newsletterContent; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-content-icon"></i> Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
                <div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Traductions</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <form id="box-trad">
                            <div id="box-trad-result"></div>
                            <input type="hidden" name="id" value="<?= $newsletter->newsletterId; ?>">
                            <input type="hidden" name="change_trad" value="true">
                            <div id="trads">
                                <?php 
                                $i = 0;
                                foreach(json_decode($newsletter->newsletterTranslate) as $trad):?>
                                    <div id="trad-<?= $i; ?>">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Nom de la variable</label>
                                                    <span class="pull-right"><a onclick="delTrad(0<?= $i; ?>);"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;</a></span>
                                                    <input class="form-control" name="trad_title[]" type="text" value="<?= $trad->name; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Version française</label>
                                                    <input class="form-control" type="text" name="trad_fr[]" value="<?= $trad->fr; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Version anglaise</label>
                                                    <input class="form-control" type="text" name="trad_en[]" value="<?= $trad->en; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                <?php 
                                $i++;
                                endforeach; 
                                ?>
                            </div>
                            <div class="row">    
                                <div class="col-sm-12">
                                    <div class="pull-left">
                                        <button type="button" onclick="addTrad();" class="btn btn-info btn-large btn-icon-left"><i class="fa fa-plus"></i> Ajouter une traduction</button>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-tad-icon"></i> Modifier</button>
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