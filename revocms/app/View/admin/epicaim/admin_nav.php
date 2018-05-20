<?php 
use Web\Url;
?>
<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">Navigation</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li <?= (Url::detectUri() == "admin") ? "class=\"active\"" : "";?>>
                <a href="/admin"><i class="fa fa-home"></i> Accueil</a>
            </li>
            <li <?= (Url::detectUri() == "admin/list/vip") ? "class=\"active\"" : "";?>>
                <a href="/admin/list/vip"><i class="fa fa-list"></i> Vips</a>
            </li>
            <li <?= (Url::detectUri() == "admin/list/users") ? "class=\"active\"" : "";?>>
                <a href="/admin/list/users"><i class="fa fa-users"></i> Users</a>
            </li>
            <li <?= (Url::detectUri() == "admin/list/tokens") ? "class=\"active\"" : "";?>>
                <a href="/admin/list/tokens"><i class="fa fa-shopping-basket"></i> Token</a>
            </li>
            <li <?= (Url::detectUri() == "admin/newsletter") ? "class=\"active\"" : "";?>>
                <a href="/admin/newsletter"><i class="fa fa-newspaper-o"></i> Newsletters</a>
            </li>
        </ul>
    </div>
</div>