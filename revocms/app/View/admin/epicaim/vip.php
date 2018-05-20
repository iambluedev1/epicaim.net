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
						<h3 class="panel-title">Historique des vips</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                        <table class="table table-striped" id="vips">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom d'utilisateur</th>
                                    <th>Token</th>
									<th>Adresse ip</th>
									<th>Date</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($logs as $log) : ?>
                                    <tr>
										<td><?= $log->userId; ?></td>
										<td><?= $log->userName; ?></td>
                                        <td><?= $log->token; ?></td>
										<td><?= $log->ip; ?></td>
										<td><?= $log->date_active; ?></td>
                                        <td><a href="/admin/view/user/<?= $log->userId; ?>" class="btn btn-primary">Voir</a></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
        </div>
    </div>
</div>