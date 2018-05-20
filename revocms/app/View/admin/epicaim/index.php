<?php 
use Core\View;
use App\Model\Online;
use Web\Url;
use RevoCMS\RevoCMS;

$rcms = RevoCMS::getInstance();

$online = new Online();
$online = $online->getOnline();

$format = [];

foreach($online as $key => $value){
    foreach($value as $entry){
        $entry->type = $key;
        $format[] = $entry;
    }
}
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
						<h3 class="panel-title">Qui est connectés ?</h3>
					</div>
					<div class="panel-body table-responsive" style="padding: 30px 20px;">
                        <p>Il y a actuellement <strong><?= count($format); ?></strong> personnes en lignes dont <strong><?= count($online["connected"]); ?></strong> membres connectés</p>
                        <table class="table table-striped" id="admin_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom d'utilisateur</th>
                                    <th>Ip</th>
                                    <th>Page actuelle</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($format as $user) : ?>
									<tr>
                                        <td><?= $user->onlineId; ?></td>
										<td><?= ($user->type == "connected") ? $user->userName : "Visiteur"; ?></td>
                                        <td><?= $user->onlineIp; ?></td>
                                        <td><a href="<?= Url::getUrl($user->pageUrl); ?>" target="_blank" style="color: white;"><?= $user->pageName; ?></a></td>
                                        <td><?php if($user->type == "connected"): ?><a href="/admin/view/user/<?= $user->userId; ?>" class="btn btn-primary">Voir</a><?php endif; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
                    </div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Free Mode</h3>
					</div>
					<div class="panel-body table-responsive">
                        <p>Le mode est actuellement : <strong><?= ($rcms->configs->config->get("FREE_MODE")) ? "Activé" : "Désactivé";?></strong></p>
						<div id="free_mode_result"></div>
						<button type="button" onclick="toggleFreeMode();" class="btn btn-success btn-large btn-icon-left"><i class="fa fa-toggle-<?= ($rcms->configs->config->get("FREE_MODE")) ? "off" : "on";?>"></i> <?= ($rcms->configs->config->get("FREE_MODE")) ? "Désactiver" : "Activer";?></button>
                    </div>
				</div>
			</div>
        </div>
    </div>
</div>