<?php
use Web\Url;
use Session\Session;
use Usage\Geolocation;

$geo = new Geolocation();
?>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">        
				<h1 class="title theme-color-underline" style="margin-bottom: 0px;"><?= $translate->element("view", "title"); ?></h1>
			</div>        
		</div>
		<br>
		<div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="princing-slider">
                    <input style="width: 100%;" id="sub" type="text"
                        data-provide="slider"
                        data-slider-ticks="[0, 1, 2, 3]"
                        data-slider-ticks-labels='["1 month", "3 month", "6 month", "24 month"]'
                        data-slider-min="0"
                        data-slider-max="3"
                        data-slider-step="1"
                        data-slider-value="0"
                        data-slider-tooltip="hide" />
                </div>
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <span class="icon fa fa-globe"></span>
                        <h3 class="title sub_name">VIP</h3>
                    </div>
                    <div class="price-value">
                        <span class="amount">
                            <span class="sub_price">10</span>
                            <span class="currency">€</span>
                        </span>
                    </div>
                    <ul class="pricing-content">
                        <i><li class="sub_time">1 month</li></i>
                        <li>Legitbot</li>
                        <li>Ragebot</li>
                        <li>Misc</li>
                        <li>Skin Changer</li>
                        <li>VAC | EAC Secure</li>
                    </ul>
                </div>
            </div>	
            <div class="col-md-6 col-sm-6 col-md-offset-2">
                <h5 class="title theme-color-underline text-center" style="margin-bottom: 0px;"><?= $translate->element("view", "invoice", "title"); ?></h5>
                <div class="row" style="margin-top:35px;">
                    <div class="col-md-12 bill">
                        <address>
                            <strong><?= $translate->element("view", "invoice", "to"); ?> :</strong><br>
                            <?= Session::readUser("username"); ?><br>
                            <?= Session::readUser("email"); ?><br>
                            <?= $geo->getIp(); ?>
                        </address>
                        <br>
                        <address>
                            <strong><?= $translate->element("view", "invoice", "payment_type"); ?> :</strong><br>
                            Selly.gg<br>
                        </address>
                        <address class="pull-right text-right">
                            <strong><?= $translate->element("view", "invoice", "date"); ?> :</strong><br>
                                <?php echo date("Y-m-d");?>
                        </address>
                    </div>
                    <div class="col-md-12">
                        <h2 class="text-center theme-color-underline"><?= $translate->element("view", "invoice", "summary", "title"); ?></h2>
                        <br>
                    </div>
                    <div class="col-md-12 summary">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td><strong><?= $translate->element("view", "invoice", "summary", "cat_1"); ?></strong></td>
                                        <td class="text-center"><strong><?= $translate->element("view", "invoice", "summary", "cat_2"); ?></strong></td>
                                        <td class="text-center"><strong><?= $translate->element("view", "invoice", "summary", "cat_3"); ?></strong></td>
                                        <td class="text-right"><strong><?= $translate->element("view", "invoice", "summary", "cat_4"); ?></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b class="sub_name">VIP</b></td>
                                        <td class="text-center sub_price">10 €</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right"><span class="sub_price">10</span> €</td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong><?= $translate->element("view", "invoice", "summary", "cat_4"); ?> : </strong></td>
                                        <td class="thick-line text-right sub_price"><span class="sub_price">10</span> €</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong><?= $translate->element("view", "invoice", "summary", "fee", "title"); ?> : </strong></td>
                                        <td class="no-line text-right"><?= $translate->element("view", "invoice", "summary", "fee", "no"); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong><?= $translate->element("view", "invoice", "summary", "total"); ?> : </strong></td>
                                        <td class="no-line text-right"><strong><span class="sub_price">10</span> €</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 45px;">
                        <a id="purchase_link" data-selly-product="8e5a68f5" class="btn btn-default btn-block"> <?= $translate->element("view", "invoice", "summary", "btn"); ?></a>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>
