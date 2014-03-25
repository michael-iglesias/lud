<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Avant</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Avant">
	<meta name="author" content="The Red Team">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all">  -->
    <link rel="stylesheet" href="assets/css/styles.min.css?=113">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

	 
        <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 
    
            <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'> 
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
        <link rel="stylesheet" href="assets/css/ie8.css">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
	<![endif]-->

	<!-- The following CSS are included as plugins and can be removed if unused-->

<link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/fullcalendar/fullcalendar.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

<!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
</head>

<body class=" ">


    <div id="headerbar">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-brown">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-pencil"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Create Post
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-grape">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-group"></i></div>
                            <div class="pull-right"><span class="badge">2</span></div>
                        </div>
                        <div class="tiles-footer">
                            Contacts
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-primary">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-envelope-o"></i></div>
                            <div class="pull-right"><span class="badge">10</span></div>
                        </div>
                        <div class="tiles-footer">
                            Messages
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-inverse">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-camera"></i></div>
                            <div class="pull-right"><span class="badge">3</span></div>
                        </div>
                        <div class="tiles-footer">
                            Gallery
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-midnightblue">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-cog"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Settings
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-orange">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-wrench"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Plugins
                        </div>
                    </a>
                </div>
                            
            </div>
        </div>
    </div>

    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>


        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="index.htm">Avant</a>
        </div>

        <ul class="nav navbar-nav pull-right toolbar">
        	<li class="dropdown">
        		<a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?= $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?> <i class="fa fa-caret-down"></i></span> <i class="fa fa-user" style="font-size: 22px;"></i> </a>
        		<ul class="dropdown-menu userinfo arrow">
        			<li class="username">
                        <a href="#">
        				    <div class="pull-left"><i class="fa fa-user userimg" style="font-size: 22px;"></i></div>
        				    <div class="pull-right"><h5>Howdy, <?= $_SESSION['fname']; ?>!</h5></div>
                        </a>
        			</li>
        			<li class="userlinks">
        				<ul class="dropdown-menu">
        					<li><a href="account_settings.php">Account Settings <i class="pull-right fa fa-cog"></i></a></li>
        					<li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li>
        					<li class="divider"></li>
        					<li><a href="logout.php" class="text-right">Sign Out</a></li>
        				</ul>
        			</li>
        		</ul>
        	</li>
        	<li class="dropdown">
        		<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><i class="fa fa-envelope"></i>
        		
        		<span class="badge">?</span></a>
        		
        		<ul class="dropdown-menu messages arrow">
        			<li class="dd-header">
        				<span>You have ? new message(s)</span>
        			</li>
                    <div class="scrollthis">
    			        <li><a href="#" class="active">
    			        	<span class="time">6 mins</span>
    			        	<img src="assets/demo/avatar/doyle.png" alt="avatar" />
    			        	<div><span class="name">Alan Doyle</span><span class="msg">Please mail me the files by tonight.</span></div>
    			        </a></li>
    			        <li><a href="#">
    			        	<span class="time">12 mins</span>
    			        	<img src="assets/demo/avatar/paton.png" alt="avatar" />
    			        	<div><span class="name">Polly Paton</span><span class="msg">Uploaded all the files to server. Take a look.</span></div>
    			        </a></li>
    			        <li><a href="#">
    			        	<span class="time">9 hrs</span>
    			        	<img src="assets/demo/avatar/corbett.png" alt="avatar" />
    			        	<div><span class="name">Simon Corbett</span><span class="msg">I am signing off for today.</span></div>
    			        </a></li>
    			        <li><a href="#">
    			        	<span class="time">2 days</span>
    			        	<img src="assets/demo/avatar/tennant.png" alt="avatar" />
    			        	<div><span class="name">David Tennant</span><span class="msg">How are you doing?</span></div>
    			        </a></li>
                        <li><a href="#" class="active">
                            <span class="time">6 mins</span>
                            <img src="assets/demo/avatar/doyle.png" alt="avatar" />
                            <div><span class="name">Alan Doyle</span><span class="msg">Please mail me the files by tonight.</span></div>
                        </a></li>
                        <li><a href="#">
                            <span class="time">12 mins</span>
                            <img src="assets/demo/avatar/paton.png" alt="avatar" />
                            <div><span class="name">Polly Paton</span><span class="msg">Uploaded all the files to server. Take a look.</span></div>
                        </a></li>
                    </div>
        			<li class="dd-footer"><a href="inbox.php">View All Messages</a></li>
        		</ul>
        	</li>
        	
            <li>
                <a href="#" id="headerbardropdown"><span><i class="fa fa-level-down"></i></span></a>
            </li>
            
		</ul>
    </header>

    <div id="page-container">
        <!-- BEGIN SIDEBAR -->
        <nav id="page-leftbar" role="navigation">
                <!-- BEGIN SIDEBAR MENU -->
            <ul class="acc-menu" id="sidebar">
                <li id="search">
                    <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
                     <form>
                        <input type="text" class="search-query" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
                <li class="divider"></li>
                <li><a href="index.htm"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Layout Options</span> </a>
                    <ul class="acc-menu">
                        <li><a href="layout-grid.htm"><span>Grids</span></a>
                        <li><a href="layout-horizontal.htm"><span>Horizontal Navigation</span></a>
                        <li><a href="layout-horizontal2.htm"><span>Horizontal Navigation 2</span></a>
                        <li><a href="layout-fixed.htm"><span>Fixed Boxed Layout</span></a>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-list-ol"></i> <span>UI Elements</span> <span class="badge badge-indigo">4</span></a>
                    <ul class='acc-menu'>
                        <li><a href="ui-typography.htm">Typography</a></li>
                        <li><a href="ui-buttons.htm">Buttons</a></li>
                        <li><a href="tables-basic.htm">Tables</a></li>
                        <li><a href="form-layout.htm">Forms</a></li>
                        <li><a href="ui-panels.htm">Panels</a></li>
                        <li><a href="ui-images.htm">Images</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-tasks"></i> <span>UI Components</span> <span class="badge badge-info">12</span></a>
                    <ul class="acc-menu">
                        <li><a href="ui-tiles.htm">Tiles</a></li>
                        <li><a href="ui-modals.htm">Modal Boxes</a></li>
                        <li><a href="ui-progressbars.htm">Progress Bars</a></li>
						<li><a href="ui-paginations.htm">Pagers &amp; Paginations</a></li>
						<li><a href="ui-breadcrumbs.htm">Breadcrumbs</a></li>
						<li><a href="ui-labelsbadges.htm">Labels &amp; Badges</a></li>
                        <li><a href="ui-alerts.htm">Alerts &amp; Notificiations</a></li>
                        <li><a href="ui-sliders.htm">Sliders &amp; Ranges</a></li>
                        <li><a href="ui-tabs.htm">Tabs &amp; Accordions</a></li>
                        <li><a href="ui-carousel.htm">Carousel</a></li>
                        <li><a href="ui-nestable.htm">Nestable Lists</a></li>
                        <li><a href="ui-wells.htm">Wells</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-table"></i> <span>Advanced Tables</span></a>
                    <ul class="acc-menu">
                        <li><a href="tables-data.htm">Data Tables</a></li>
                        <li><a href="tables-responsive.htm">Responsive Tables</a></li>
                        <li><a href="tables-editable.htm">Editable Tables</a></li>
						<!-- <li><a href="#">Samples</a></li> Coming soon -->
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-pencil"></i> <span>Advanced Forms</span><span class="badge badge-primary">5</span></a>
                    <ul class="acc-menu">
                        <li><a href="form-components.htm">Components</a></li>
                        <li><a href="form-wizard.htm">Wizards</a></li>
                        <li><a href="form-validation.htm">Validation</a></li>
                        <li><a href="form-masks.htm">Masks</a></li>
                        <li><a href="form-fileupload.htm">Multiple File Uploads</a></li>
                        <li><a href="form-dropzone.htm">Dropzone File Uploads</a></li>
                        <!-- <li><a href="#">Samples</a></li> Coming soon -->
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-map-marker"></i> <span>Maps</span></a>
                    <ul class="acc-menu">
                        <li><a href="maps-google.htm">Google Maps</a></li>
                        <li><a href="maps-vector.htm">Vector Maps</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-bar-chart-o"></i> <span>Charts</span></a>
                    <ul class="acc-menu">
                        <li><a href="charts-flot.htm">Extensible</a></li>
                        <li><a href="charts-svg.htm">Interactive</a></li>
                        <li><a href="charts-canvas.htm">Lightweight</a></li>
                        <li><a href="charts-inline.htm">Inline</a></li>
                    </ul>
                </li>
                <li><a href="calendar.htm"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                <li><a href="gallery.htm"><i class="fa fa-camera"></i> <span> Gallery</span> </a></li>
                <li><a href="javascript:;"><i class="fa fa-flag"></i> <span>Icons</span> <span class="badge badge-orange">2</span></a>
                    <ul class="acc-menu">
                        <li><a href="icons-fontawesome.htm">Font Awesome</a></li>
                        <li><a href="icons-glyphicons.htm">Glyphicons</a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li><a href="javascript:;"><i class="fa fa-briefcase"></i> <span>Extras</span> <span class="badge badge-danger">1</span></a>
                    <ul class="acc-menu">
                        <li><a href="extras-timeline.htm">Timeline</a></li>
                        <li><a href="extras-profile.htm">Profile</a></li>
                        <li><a href="extras-inbox.htm">Inbox</a></li>
                        <li><a href="extras-search.htm">Search Page</a></li>
                        <li><a href="extras-registration.htm">Registration</a></li>
                        <li><a href="extras-invoice.htm">Invoice</a></li>
                        <li><a href="extras-signupform.htm">Sign Up</a></li>
                        <li><a href="extras-404.htm">404 Page</a></li>
                        <li><a href="extras-500.htm">500 Page</a></li>
                        <li><a href="extras-login.htm">Login 1</a></li>
                        <li><a href="extras-login2.htm">Login 2</a></li>
                        <li><a href="extras-forgotpassword.htm">Password Reset</a></li>
                        <li><a href="extras-blank.htm">Blank Page</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="fa fa-sitemap"></i> <span>Unlimited Level Menu</span></a>
                    <ul class="acc-menu">
                        <li><a href="javascript:;">Menu Item 1</a></li>
                        <li><a href="javascript:;">Menu Item 2</a>
                            <ul class="acc-menu">
                                <li><a href="javascript:;">Menu Item 2.1</a></li>
                                <li><a href="javascript:;">Menu Item 2.2</a>
                                    <ul class="acc-menu">
                                        <li><a href="javascript:;">Menu Item 2.2.1</a></li>
                                        <li><a href="javascript:;">Menu Item 2.2.2</a>
                                            <ul class="acc-menu">
                                                <li><a href="javascript:;">And deeper yet!</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </nav>

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li class='active'><a href="hub.php">Resident Hub</a></li>
            </ol>
            <h1>Resident Hub</h1>
        </div>