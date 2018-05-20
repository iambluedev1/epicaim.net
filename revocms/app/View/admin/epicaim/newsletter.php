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
                                <a href="/admin/newsletter/add"><i class="fa fa-plus"></i> Ajouter une newsletter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Newsletters</h3>
					</div>
					<div class="panel-body" style="padding: 30px 20px;">
                    <table class="table table-striped" id="admin_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Etat</th>
                                    <th>Date</th>
                                    <th>Actions</th>
								</tr>
							</thead>
                            <tbody>
                            <?php foreach ($logs as $newsletter) : ?>
                                <tr>
                                    <td><?= $newsletter->newsletterId; ?></td>
                                    <td><?= $newsletter->newsletterTitle; ?></td>
                                    <td><?= ($newsletter->newsletterState == 0) ? "Brouillon" : "Envoyée"; ?></td>
                                    <td><?= date("d/m/Y à H:i", $newsletter->newsletterDate); ?></td>
                                    <td><a href="/admin/newsletter/view/<?= $newsletter->newsletterId; ?>" class="btn btn-primary">Voir</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
					</div>
				</div>
        </div>
    </div>
</div>