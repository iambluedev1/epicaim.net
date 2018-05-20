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
                                <a href="/admin/token/add"><i class="fa fa-list"></i> Ajouter un token</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Liste des tokens</h3>
					</div>
					<div class="panel-body table-responsive" style="padding: 30px 20px;">
						<table class="table table-striped" id="admin_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Token</th>
									<th>Temps</th>
                                    <th>Etat</th>
                                    <th>Actions</th>
                                    <th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tokens as $token) : ?>
									<tr>
										<td><?= $token->id; ?></td>
										<td><?= $token->token; ?></td>
										<td><?= $token->day; ?></td>
                                        <td><?= ($token->active == "no") ? "Non-Utilisé" : "Utilisé"; ?></td>
                                        <?php if($token->active == "yes") : ?>
                                            <td><a href="/admin/token/desactivate/<?= $token->id; ?>" class="btn btn-primary">Désactiver</a></td>
                                        <?php else: ?>
                                            <td><a href="/admin/token/activate/<?= $token->id; ?>" class="btn btn-info">Activer</a></td>
                                        <?php endif; ?>
                                        <td><a href="/admin/token/delete/<?= $token->id; ?>" class="btn btn-danger">Supprimer</a></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>