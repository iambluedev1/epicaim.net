<?php
use Web\Assets;
use RevoCMS\RevoCMS;
use Session\Session;
use Web\Url;
use Web\Request;

$rcms = RevoCMS::getInstance();
?>

	<?php if(Url::detectUri() != "login" && Url::detectUri() != "register" && Url::detectUri() != "lost-password") : ?>
    <footer class="theme-color-background <?php if(Request::getController() != "AdminController" && Url::detectUri() != "account" && Url::detectUri() != "shop" && Url::detectUri() != "account/logs"): ?>navbar-fixed-bottom<?php endif; ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>
                &copy; Copyright 2018 <a href="https://epicaim.net">EpicAim.net</a>
            </p>
            <div class="socials pull-right">
                <ul class="list-inline list-unstyled pull-right">
					<li <?= (Session::readUser("lang") == "fr") ? "class=\"active\"" : "";?>><a href="/lang/fr/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/800px-Flag_of_France.svg.png" /></a></li>
					<li <?= (Session::readUser("lang") == "en") ? "class=\"active\"" : "";?>><a href="/lang/en/<?= (Url::detectUri() == "/") ? "home" : Url::detectUri(); ?>"><img class="flag" src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a4/Flag_of_the_United_States.svg/800px-Flag_of_the_United_States.svg.png" /></a></li>
				</ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
	<?php endif; ?>


<script src="<?= Url::relativeTemplatePath(); ?>js/jquery.1.12.0.js"></script>
<script src="<?= Url::relativeTemplatePath(); ?>js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
<script src="<?= Url::relativeTemplatePath(); ?>js/main.js"></script>

<script>
	$(".btn-menu-mobile").click(function(){
		$(".btn-menu-mobile").toggleClass("btn-menu-mobile-active");
		$(".header-mobile .menu").slideToggle(1000);
	});
</script>

<!-- Clipboard.js -->
<script>
    new Clipboard('a');
</script>
<!-- wow.js -->
<script>
    new WOW().init();
</script>
<!-- Tooltip Bootstrap -->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
<!-- Popover Bootstrap -->
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover(); 
    });
</script>

<script>
    var ERROR_MSG = "<?= $translate->element("template", "error");?>";
</script>

<?php if(Url::detectUri() == "shop"): ?>
<script src="<?= Url::relativeTemplatePath(); ?>js/selly.js"></script>
<script src="<?= Url::relativeTemplatePath(); ?>js/shop.js"></script>
<?php endif; ?>

<?php if(@!is_null($js)): ?>
    <?= Assets::script($js); ?>
<?php endif; ?>
<?php if(Request::getController() == "AdminController"): ?>
<script>
$(document).ready(function() {
    $("#admin_table").show().DataTable();
});
</script>
<?php endif; ?>

</body>
</html>