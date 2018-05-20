<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">        
				<h1 class="title theme-color-underline" style="margin-bottom: 0px;"><?= $translate->element("view", "logs", "main_title"); ?></h1>
			</div>        
		</div>
		<br>
		<div class="row">
			<div class="col-md-9 clearfix" id="customer-account">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?= $translate->element("view", "logs", "sub_title"); ?></h3>
					</div>
					<div class="panel-body table-responsive" style="padding: 30px 20px;">
						<table class="table table-striped" id="logs">
							<thead>
								<tr>
									<th><?= $translate->element("view", "logs", "table", "cat_1"); ?></th>
									<th><?= $translate->element("view", "logs", "table", "cat_2"); ?></th>
									<th><?= $translate->element("view", "logs", "table", "cat_3"); ?></th>
									<th><?= $translate->element("view", "logs", "table", "cat_4"); ?></th>
									<th><?= $translate->element("view", "logs", "table", "cat_5"); ?></th>
									<th><?= $translate->element("view", "logs", "table", "cat_6"); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($logs as $log) : ?>
									<tr>
										<td><?= $log->ip; ?></td>
										<td><?= $log->city; ?></td>
										<td><?= $log->region; ?></td>
										<td><?= $log->country_name; ?> (<?= $log->country_code; ?>)</td>
										<?php $browser = unserialize($log->browser); ?>
										<td><?= $browser["name"]; ?></td>
										<td><?= $log->date; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-3">
			   <div class="panel panel-default sidebar-menu">
				  <div class="panel-heading">
					 <h3 class="panel-title"><?= $translate->element("view", "logs", "actions", "title"); ?></h3>
				  </div>
				  <div class="panel-body">
					 <ul class="nav nav-pills nav-stacked">
						<li>
						    <a href="/account"><i class="fa fa-list"></i> <?= $translate->element("view", "logs", "actions", "links", "account"); ?></a>
						</li>
						<li class="active">
							<a href="/account/logs"><i class="fa fa-money"></i> <?= $translate->element("view", "logs", "actions", "links", "logs"); ?></a>
						</li>
						<li>
						   <a href="/account/tokens"><i class="fa fa-key"></i> <?= $translate->element("view", "logs", "actions", "links", "tokens"); ?></a>
						</li>
						<li>
						   <a href="/logout"><i class="fa fa-sign-out"></i> <?= $translate->element("view", "logs", "actions", "links", "logout"); ?></a>
						</li>
					 </ul>
				  </div>
			   </div>
			</div>
		</div>
    </div>
</div>
