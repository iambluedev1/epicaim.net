<?php
use Web\Url;
use Web\Assets;
use Session\Session;
use Web\Request;
use Usage\Flash;
use RevoCMS\RevoCMS;

$flash = Flash::getInstance();
$rcms = RevoCMS::getInstance();
?>
<!DOCTYPE html>
<html lang="<?= $rcms->configs->config->get("LANGUAGE_CODE"); ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title><?=$title.' - '.	$rcms->configs->config->get("SITETITLE");?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="EpicAim a new UNDETECTED CS:GO CHEAT">
    <meta name="keywords" content="epicaim, epic, epicaim.net, pedophillia, pedophillia.eu, csgo cheats,csgo cheats free,csgo cheats commands,csgo cheats console,csgo cheats for mac,csgo cheats reddit,csgo cheats 2018,csgo cheats undetected,csgo cheats paid,csgo cheats mpgh,csgo cheats discord,csgo cheats aimbot,csgo cheats ahk,csgo cheats aim,cs go cheats ammo,cs go hacks and cheats,aimware cs go cheats,all cs go cheats,cs go admin cheats,how to allow cheats in cs go,cs go anti cheats,csgo cheats buy,csgo cheats best,cs go bots cheats,cs go cheat ban,cheat bind cs go,cs go cheat bypass,cs go cheat boosting,cs go cheat bomb planting,cs go cheat bypass overwatch,csgo betting cheats,csgo cheats cracked,csgo cheats cheap,csgo cheats crashing,csgo cheats code,csgo cheats c++,csgo cheats crashing 2018,cs go cheats,cs go cheats config,csgo cheats download,csgo cheats detected,csgo cheats dll,csgo cheats download free,cs go cheats deathmatch,csgo cheats driver,csgodouble cheats,how to disable cheats in cs go,cs go wallhack download,csgo cheats esea,cs go esp cheats,how to enable cheats in cs go,cheats explained cs go,cs go cheats exposed,ezfrags cs go cheats,elitepvpers cs go cheats,epvp cs go cheats,cs go cheats elite,everyone cheats in cs go,csgo cheats for sale,csgo cheats forum,csgo cheats free 2018,csgo cheats faceit,csgo cheats for 5 dollars,csgo cheats for esea,csgo cheats for mac free license,csgo cheats for practice,csgo cheats github,cs go cheats give weapon,cs go cheats give smoke,cs go cheats give money,german cs go cheats,cs go give cheats,cs go grenade cheats,cs go cheats give ak47,cs go cheats gravity,cs go cheats guide,csgo cheats hvh,cs go cheats health,cs go cheats hackforums,cs go cheats huge,cs go cheating history,cs go hours cheat,cs go hiding cheat,hltv cs go cheating,csgo host cheats,csgo cheats injector,csgo cheats in console,csgo cheats in mouse,cs go cheats infinite ammo,how to inject cheats in cs go,cs go cheats items,cs go ingame cheats,csgo impulse cheats,csgo wallhack in console,i want cheats cs go,ilikecheats csgo,jump cheat for cs go,cs go jackpot cheats,csgo juazey cheats,cs go wallhack july 2015,cs go wallhack january 2016,cs go wallhack june 2015,cs go wallhack june,joelz cs go cheating,java cs go cheat,jackfrags cs go cheats,cs go knife cheats,kqly cs go cheat,cs go key cheat,kernel cs go cheats,csgo k0nfig cheating,csgo config cheating,krystal cs go cheating,csgo cheat kaufen,csgo kickback cheats,csgo wallhack kodu,csgo cheats list,csgo cheats leaked,csgo cheats lifetime,csgo cheats linux,csgo cheats legal,csgo cheats legit,cs go lan cheats,cs go cheat loader,how to cheat in cs go lobby,cs go lag cheat,l$ cs go cheat,csgo cheats mac,csgo cheats money,cs go cheats max money,cs go cheats menu,cs go cheats memory,cs go mouse cheats,cs go multiplayer cheats,cs go mm cheats,moe cs go cheats,csgo cheats no recoil,csgo cheats no vac,cs go cheats not working,cs go cheat names,cs go cheat news,niko cs go cheats,cheats csgo norecoil,cs go wallhack no survey,cs go wallhack no virus,cs go wallhack november 2015,csgo cheats on phone,csgo cheats on mac,csgo cheats offline,csgo cheats online,csgo cheats on usb,cs go cheats off,cs go cheats outline,organner cs go cheats,csgo cheats private,csgo cheats pc,csgo cheats premium,csgo cheats paste,csgo cheats paysafecard,cs go practice cheats,cs go cheats price,cs go pro cheats,cs go cheats pixel,csgo cheats rcs,csgo cheats resolver,cs go cheats respawn,cs go cheats review,cs go cheats how to restart,cs go cheats running,csgo cheat report,cs go cheat recoil control system,rage cheat cs go,csgo cheats source,csgo cheats sv,csgo cheats subreddit,cs go smoke cheats,csgo single player cheats,cs go steam cheats,sites with cheats for cs go,spinbot cs go cheats,cs go cheats shop,cs go sdk cheats,csgo cheats that bypass faceit,csgo cheats trial,csgo cheats to buy,cs go cheats time,csgo cheats tobys,cs go cheats timer,cs go training cheats,how to turn off cheats in cs go,top cs go cheats,cs go titan cheats,csgo cheats unknowncheats,csgo cheats undetected 2018,csgo cheats undetected free,cs go cheats unlimited time,unknowncheats csgo,cs go cheats unlimited ammo,cs go cheats usb,csgo cheat unlimited money,csgo unity cheats,cs go vip cheats,cs go cheats video,cs go cheat vac,cs go wallhack vac undetected,cs go wallhack vac,cs go wallhack v8,how to wallhack vs bot cs go,cs go wallhack video download,cs go cheat engine vac,cs go viewmodel cheat,csgo cheats with walkbot,csgo cheats with skin changer,csgo cheats what is backtracking,csgo cheats wallhack,cs go wiki cheats,cs go cheats walls,cs go weapon cheats,cs go cheats wireframe,cs go workshop cheats,x22 cs go cheats,cs go cheats - xinstanthook v3.0 free,csgo cheats xray,cs go cheats - xinstanthook v3.0,cs go cheats - xinstanthook v3.0 download,csgo cheats - xinstanthook v3.0 cracked,cs go cheats - xinstanthook v3.0 ©,cs go xbox cheats,cs go xantares cheats,cs go cheats codes,os x cs go cheats,cs go cheats for mac os x,csgo cheats youtube,youtube cs go wallhack,cs go wallhack yt,cs go wallhack yapma,zlitz cs go cheats,ze4 csgo cheats,zero cs go cheats,zat cs go cheats,sv_cheats 0 commands cs go,cs go sv_cheats 0,cs go cheats 1,cs go 1v1 cheats,cs 1.6 cheats,cs go servers with sv_cheats 1,cs go sv_cheats 1 bypass,cs go sv_cheats 1 money,cs go sv_cheats 1 no recoil,cs go sv_cheats 1 aim,csgo sv_cheats 1 fun,sv_cheats 1 fly cs go,cs go sv_cheats 1 wallhack,cs go cheats 2015,cs go cheats 2016,cs go cheats 2014,cs go wallhack 2016,cs go wallhack download 2015,csgo wallhack 2015 undetectable multihack,cs go wallhack august 2015,cs go wallhack december 2014,cs go wallhack 2014 download,csgo 3d wallhack,cs go cheats for mac,free cs go cheats,cs go cheats money,csgo cheats for console,cs go skins cheats,top 5 cs go cheats,5 dollar cheats csgo,project 7 cs go cheats">
    <meta name="language" content="<?= $rcms->configs->config->get("LANGUAGE_CODE"); ?>" />
	<meta name="robots" content="all, index, follow" />
	
	<link href="<?= Url::relativeTemplatePath(); ?>css/bootstrap.css" rel="stylesheet">
	<link href="<?= Url::relativeTemplatePath(); ?>css/modern-business.css" rel="stylesheet">
	<link href="<?= Url::relativeTemplatePath(); ?>css/animate.css" rel="stylesheet">
	<link href="<?= Url::relativeTemplatePath(); ?>css/flat.css" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
	
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="<?= Url::relativeTemplatePath(); ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= Url::relativeTemplatePath(); ?>css/Main.css" rel="stylesheet">
	<link href="<?= Url::relativeTemplatePath(); ?>css/Mobile.css" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Dosis:600" rel="stylesheet">
	
	<script src="<?= Url::relativeTemplatePath(); ?>js/clipboard.min.js"></script>
	<script src="<?= Url::relativeTemplatePath(); ?>js/wow.min.js"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css" />

    <?php if(@!is_null($css)): ?>
        <?= Assets::css($css); ?>
    <?php endif; ?>

	<?php if(Url::detectUri() == "login" || Url::detectUri() == "register" || Url::detectUri() == "lost-password"): ?>
		<style>
			.menu {
				top: 0px;
			}
		</style>
	<?php endif; ?>
</head>
<body>
<?php if(Url::detectUri() != "login" && Url::detectUri() != "register" && Url::detectUri() != "lost-password") : ?>
<div class="header-desktop">
	<div class="user-bar">
		<div class="container">
			<div class="pull-right">
				<div class="user-links">
					<ul class="list-inline list-unstyled">
						<?php if(Session::readUser("is_admin") != 0):?>
							<li><a href="/admin" style="color: #ba2323;">Panel d'aministration</a></li>
						<?php endif; ?>
						<li><a href="/account"><?= $translate->element("template", "links", "account"); ?></a></li>
						<li><a href="/logout"><?= $translate->element("template", "links", "logout"); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
    </div>
	<div class="menu">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container nav-content">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">
						<p><?= $rcms->configs->config->get("SITETITLE"); ?></p>
					</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php if(Session::readUser("is_vip") != 0):?>
						<li class="li-nav">
							<a href="/"><?= $translate->element("template", "links", "home"); ?></a>
						</li>
						<?php endif; ?>
						<li class="li-nav">
							<a href="/shop"><?= $translate->element("template", "links", "shop"); ?></a>
						</li>
						<li class="li-nav">
							<a href="/token"><?= $translate->element("template", "links", "token"); ?></a>
						</li>
						<li class="li-nav">
							<a href="/support" target="_blank"><?= $translate->element("template", "links", "support"); ?></a>
						</li>
					</ul>
				</div>
				
			</div>
		</nav>
    </div>
</div>
<div class="header-mobile">
	<a class="brand" href="/">
		<p><?= $rcms->configs->config->get("SITETITLE"); ?></p>
		<a class="btn-menu-mobile"><i class="fa fa-align-justify"></i></a>
	</a>
	<div class="menu">
		<ul class="main-menu list-unstyled">
			<?php if(Session::readUser("is_vip") != 0):?>
			<li class="li-nav">
				<a href="/">Accueil</a>
			</li>
			<?php endif; ?>
			<li class="li-nav">
				<a href="/shop">Purchase</a>
			</li>
			<li class="li-nav">
				<a href="/token">Token</a>
			</li>
			<li class="li-nav">
				<a href="/support" target="_blank">Support</a>
			</li>
			<div class="clearfix"></div>
			<div class="diviseur"></div>
			<?php if(Session::readUser("is_admin") != 0):?>
				<li><a href="/admin" style="color: #ba2323;">Panel d'aministration</a></li>
			<?php endif; ?>
			<li><a href="/account">Mon compte</a></li>
			<li><a href="/logout">Se déconnecter</a></li>
		</ul>
	</div>
</div>
<?php if($flash->hasMessages()): ?>
    <?= $flash->display("all", false, true);?>
<?php endif;?>
<?php endif; ?>

