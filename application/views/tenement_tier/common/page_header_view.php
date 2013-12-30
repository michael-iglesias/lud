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
		
		<!-- jQuery plUpload -->
                <link rel="stylesheet" href="<?= base_url(); ?>css/plugins/jquery.plupload.queue.css">
		<link rel="stylesheet" href="<?= base_url(); ?>css/plugins/jquery.ui.plupload.css">
		
		<!-- CSS styles -->
		<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>css/wuxia-orange.css'>
		
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
		
		<script>
			$(document).ready(function(){
				
				// Navbar tooltips
				$('.navbar [title]').tooltip({
					placement: 'bottom'
				});
				
				// Content tooltips
				$('[role=main] [title]').tooltip({
					placement: 'top'
				});
				
				// Dropdowns
				$('.dropdown-toggle').dropdown();
                                
				// Tabs
				$('.packageTabs a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
				
			});
		</script>
		
	</head>
	<body>
	
		<!-- Main navigation bar -->
		<!-- There are 3 navigation styles available.-->
		<!--    default - fixed on top without any special effect (no extra markup) -->
		<!--    affix - Bootstrap affix plugin to track page scrolling, you can hide, move or change alpha when scrolled down (navigation.js) -->
		<!--    arrowed - add class .active-arrow to ul.nav to add arrow for active element -->
		<header class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">

					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="awe-user"></span></button>
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="awe-chevron-down"></span></button>

                                        <a class="brand" href="<?= base_url(); ?>">Let Us Dorm</a>

					<div class="nav-collapse">

						<!-- Main navigation -->
						<nav class="navigation">
							<ul class="nav active-arrows" role="navigation">
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="ui-buttons.html">
										<div><span class="awe-table"></span> Management</div>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu pull-right">
                                                                            <li>
                                                                                    <a href="<?= base_url(); ?>index.php/tenement/property">
                                                                                            <span class="awe-table"></span>
                                                                                            Manage Property
                                                                                    </a>
                                                                            </li>
                                                                            <li>
                                                                                    <a href="<?= base_url(); ?>index.php/tenement/tenants">
                                                                                            <span class="awe-group"></span>
                                                                                            Manage Tenants
                                                                                    </a>
                                                                            </li>
                                                                            <li>
                                                                                    <a href="<?= base_url(); ?>index.php/tenement/employees">
                                                                                            <span class="awe-tasks"></span>
                                                                                            Manage Employees
                                                                                    </a>
                                                                            </li>

										<li><a href="500.html"><span class="awe-flag"></span> 500</a></li>
										<li><a href="503.html"><span class="awe-flag"></span> 503</a></li>
									</ul>
								</li>
                                                                <li>
                                                                    <a href="<?= base_url(); ?>index.php/tenement/package_logging">
                                                                            <span class="awe-envelope"></span>
                                                                            Packages
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?= base_url(); ?>index.php/tenement/notification_center">
                                                                            <span class="awe-bullhorn"></span>
                                                                            Notification center
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?= base_url(); ?>index.php/tenement/roommate_matching">
                                                                            <span class="awe-group"></span>
                                                                            Roommate Matching
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="ui-buttons.html">
                                                                            <div><span class="awe-bar-chart"></span> Analytics</div>
                                                                            <span class="caret"></span>
                                                                    </a>
                                                                    <ul class="dropdown-menu pull-right">
                                                                        <li>
                                                                                <a href="<?= base_url(); ?>index.php/tenement/property">
                                                                                        <span class="awe-table"></span>
                                                                                        Tenant Impressions
                                                                                </a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="<?= base_url(); ?>index.php/tenement/tenants">
                                                                                        <span class="awe-group"></span>
                                                                                        Maintenance Request Stats
                                                                                </a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="<?= base_url(); ?>index.php/tenement/employees">
                                                                                        <span class="awe-tasks"></span>
                                                                                        Guest Pass Stats
                                                                                </a>
                                                                        </li>
                                                                    </ul>
								</li>
							</ul>
						</nav>
						
						<!-- User navigation -->
						<nav class="user">
							<div class="user-info pull-right">
                                                                <?php if($session_data['temp_avatar'] == NULL): ?>

                                                                <?php else: ?>
                                                                <img src="<?= base_url(); ?>uploadedmedia/employee/avatars/temp<?= $session_data['temp_id'] . '/' . $session_data['temp_avatar']; ?>" width="30" height="35" alt="User avatar">
                                                                <?php endif; ?>
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                                            <div><strong><?= ucfirst($session_data['temp_fname']) . ' ' . ucfirst($session_data['temp_lname']); ?></strong><?= ucfirst($session_data['temp_position']); ?></div>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="<?= base_url(); ?>index.php/tenement/account_edit"><span class="awe-cogs"></span> Account settings</a></li>
										<li class="divider"></li>
										<li><a href="<?= base_url(); ?>index.php/tenement/logout"><span class="awe-signout"></span> Logout</a></li>
									</ul>
								</div>
							</div>
						</nav>

					</div>
				</div>
			</div>
		</header>
		<!-- /Main navigation bar -->
		
		<!-- Main content -->
		<div class="container" role="main">
			<br />
			<!-- Main data container -->
			<div class="content">