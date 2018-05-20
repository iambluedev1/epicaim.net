<?php 
use Web\Url;
use Usage\Text;
?>
<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">Actions</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li <?= (Text::startsWith(Url::detectUri(), "admin/view/user") && !Text::endsWith(Url::detectUri(), "/logs") && !Text::endsWith(Url::detectUri(), "/tokens") && !Text::endsWith(Url::detectUri(), "/injects") && !Text::endsWith(Url::detectUri(), "/free-injects")) ? "class=\"active\"" : "";?>>
                <a href="/admin/view/user/<?= $user->userId; ?>"><i class="fa fa-home"></i> Accueil</a>
            </li>
            <li <?= (Text::endsWith(Url::detectUri(), "/logs")) ? "class=\"active\"" : "";?>>
                <a href="/admin/view/user/<?= $user->userId; ?>/logs"><i class="fa fa-history"></i> Logs de connexion</a>
            </li>
            <li <?= (Text::endsWith(Url::detectUri(), "/tokens")) ? "class=\"active\"" : "";?>>
                <a href="/admin/view/user/<?= $user->userId; ?>/tokens"><i class="fa fa-shopping-cart"></i> Logs de tokens</a>
            </li>
            <li <?= (Text::endsWith(Url::detectUri(), "/injects")) ? "class=\"active\"" : "";?>>
                <a href="/admin/view/user/<?= $user->userId; ?>/injects"><i class="fa fa-list"></i> Logs d'injections</a>
            </li>
            <li <?= (Text::endsWith(Url::detectUri(), "/free-injects")) ? "class=\"active\"" : "";?>>
                <a href="/admin/view/user/<?= $user->userId; ?>/free-injects"><i class="fa fa-list-ul"></i> Logs d'injections (free)</a>
            </li>
        </ul>
    </div>
</div>