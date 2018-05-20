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
                            <li class="active">
                                <a href="/admin/token/add"><i class="fa fa-list"></i> Ajouter un token</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 clearfix">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Ajouter un token</h3>
					</div>
                    <form class="panel panel-default" id="box-token-add" method="post">
                        <div class="panel-body" style="padding: 30px 20px;">
                            <div id="box-token-add-result"></div>
                            <div class="form-group">
                                <label>Token</label>
                                <input class="form-control" name="token" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Durée</label>
                                <input class="form-control" name="time" type="text" required>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
							<button type="submit" class="btn btn-default btn-large btn-icon-left"><i class="fa fa-edit" id="box-token-add-icon"></i> Ajouter</button>
						</div>
                    </form>
				</div>
			</div>
        </div>
    </div>
</div>