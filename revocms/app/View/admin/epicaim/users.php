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
            </div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Liste des utilisateurs</h3>
					</div>
					<div class="panel-body table-responsive" style="padding: 30px 20px;">
						<table class="table table-striped" id="admin_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom d'utilisateur</th>
									<th>Email</th>
                                    <th>Inscrit le</th>
                                    <th>Rang</th>
                                    <th>Etat du compte</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users as $user) : ?>
									<tr>
										<td><?= $user->userId; ?></td>
										<td><?= $user->userName; ?></td>
										<td><?= $user->userEmail; ?></td>
                                        <td><?= date("d/m/Y à H:i", $user->registeredAt); ?></td>
                                        <td><?= ($user->is_admin == 0) ? "Membre" : "Administrateur"; ?></td>
                                        <td><?= ($user->userState == 0) ? "<span style=\"color: lightred;\">Non-Confirmé</span>" : "<span style=\"color: lightgreen;\">Confirmé</span>"; ?></td>
                                        <td><a href="/admin/view/user/<?= $user->userId; ?>" class="btn btn-primary">Voir</a></td>
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