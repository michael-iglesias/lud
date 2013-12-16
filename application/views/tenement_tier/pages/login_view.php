<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?= $page_title; ?></title>
		<meta name="description" content="">
		<meta name="author" content="Let Us Dorm | www.letusdorm.com">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Styles -->
		<link rel="stylesheet" href="<?= base_url(); ?>css/wuxia-orange.css">

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="<?= base_url(); ?>img/icons/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>img/icons/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>img/icons/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>img/icons/apple-touch-icon-57-precomposed.png">
		
		<!-- JS Libs -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?= base_url(); ?>js/libs/jquery.js"><\/script>')</script>
		<script src="<?= base_url(); ?>js/libs/modernizr.js"></script>
		<script src="<?= base_url(); ?>js/libs/selectivizr.js"></script>
		
		<script src="<?= base_url(); ?>js/less.js"></script>

	</head>
	<body class="login">
		
		<!-- Login header -->
		<header>
			<h2 style="color: #878D96;">Tenement Log in</h2>
		</header>
		<!-- /Login header -->
		
		<!-- Login content -->
		<section>
                        <?php if($invalid_credentials == TRUE) {
                            echo '<div class="alert alert-error">Invalid Credentials! Please try again.</div>';
                        }
                        ?>
			<form id="login-form" method="post" action="<?= base_url() . 'index.php/tenement/process_login'; ?>">
				<fieldset>
                                        
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><span class="awe-user"></span></span><input id="icon" type="text" placeholder="Your email" name="login-email">
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><span class="awe-lock"></span></span><input id="addons" type="password" placeholder="Password" name="login-pass">
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button class="btn btn-wuxia btn-large btn-primary" type="submit">Log in</button>
					</div>
					<div class="pass-reset">
						<a href="#"><small>Password reset</small></a>
					</div>
				</fieldset>
			</form>
		</section>
		<!-- Login content -->
		
		<!-- Scripts -->

		<!-- Bootstrap scripts -->
		<!--
		<script src="js/bootstrap/bootstrap.js"></script>
		-->
		
	</body>
</html>
