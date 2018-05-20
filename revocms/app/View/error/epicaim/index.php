<style>
hr {
	border-top: 1px solid #ba2323;
}

.top-line {
	margin-top: 25px;
}

.top {
	padding-bottom: 40px;
}

.top-brand {
	margin-left: -20px;
}

.login-container {
	padding-top: 80px;
}

.bottom {
	background-color: #ba2323;
	border-top: 1px solid #ba2323;
	border-bottom-left-radius: 3px;
	border-bottom-right-radius: 3px;
	height: 40px;
	text-align: center;
	font-size: 15px;
	padding-top: 8px;
	margin-top: 50px;
	margin-bottom: 50px;
}

@media screen and (max-width: 1000px) {
	.top-line {
		display: none;
	}
	
	.top {
		padding-bottom: 10px;
	}
	
	.top-brand {
		margin-left: -20px;
	}
	
	.login-container {
		padding-top: 20px;
	}
	
	.bottom {
		margin-top: 20px;
		margin-bottom: 20px;
	}
}
</style>

<div id="content">
	<div class="container relative login-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 top">
				<div>
					<a class="navbar-brand top-brand">
						<p><?= $translate->element("view", "title"); ?></p>
					</a>
				</div>
				<hr class="top-line">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<p>
					<?= $translate->element("view", "error"); ?>
				</p>
			</div>
		</div>
    </div>
</div>