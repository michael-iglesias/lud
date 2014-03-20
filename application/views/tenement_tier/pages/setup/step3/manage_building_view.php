
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
				
			});
		</script>

		
		<!-- Main content -->
		<div class="container" role="main">
			<br />
			<!-- Main data container -->
			<div class="content">
			
				<!-- Page header -->
				<div class="page-header">
                                    <h1><span class="<?= $page_header_icon; ?>"></span> <?= $page_header_title; ?></h1>
				</div>
				<!-- /Page header -->
				
				<!-- Page container -->
				<div class="page-container">
                       
                                    
                                    <div class="row">
                                        <div class="span12">
                                            <div class="accordion huge" id="accordion2" style="font-weight: bold;">

                                                <?php $floor_count = ($tower_info[0]['tow_floor_count'] + 0); ?>
                                                <?php for($i = 1; $i <= $floor_count; $i++): ?>
                                                    <div class="accordion-group"> 
                                                            <div class="accordion-heading">
                                                                    <a data-toggle="collapse" data-parent="#accordion2" href="#floor<?= $i; ?>" class="accordion-toggle collapsed">Floor <?= $i; ?></a>
                                                            </div>
                                                            <div class="accordion-body collapse" id="floor<?= $i; ?>" style="height: 0px;">
                                                                <div class="accordion-inner">
                                                                    <?php foreach($tower_units as $row): ?>
                                                                        <?php if($row['tun_floor'] == $i): ?>
                                                                            <div class="span3 building-box" style="margin-top: 15px; height: 190px;">
                                                                                <h4 style="text-align: center;">Room/Unit #: <?= $row['tun_number']; ?></h4>
                                                                                <ul class="unstyled">
                                                                                    <li><span class="awe-caret-right"></span> Unit Capacity:&nbsp;&nbsp;<span style="color: red;"><?= $unit_capacity = $row['tun_capacity']; ?></span></li>
                                                                                    <li><span class="awe-caret-right"></span> Unit Vacancies:&nbsp;&nbsp;<span style="color: green;"><?= $unit_tenants = $row['tun_capacity'] - $row['Occupancies']; ?></span></li>
                                                                                    <li><span class="awe-caret-right"></span> Packages:&nbsp;&nbsp;<?= $row['Pending_Packages']; ?></li>
                                                                                    <li><span class="awe-caret-right"></span> Open Maintenance Tickets:&nbsp;&nbsp;<?= $row['Maintenance_Tickets']; ?></li>
                                                                                    <?php if($unit_tenants != $unit_capacity): ?>
                                                                                    <li><span class="awe-caret-right"></span> <a href="#unitoccupanciesmodal" data-toggle="modal" onclick="displayUnitTenants(<?= $row['tun_id']; ?>, <?= $row['tun_number']; ?>);">View Tenants</a></li>
                                                                                    <?php else: ?>
                                                                                    <br />
                                                                                    <?php endif; ?>
                                                                                </ul>
                                                                                <center><a href="<?= base_url(); ?>index.php/tenement/manage_unit/<?= $row['tun_id']; ?>" class="btn btn-wuxia btn-warning">Manage Unit</a></center>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                    </div>


                                                <?php endfor; ?>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- START TowerUnit Tenets Modal Window -->
                                    <div id="unitoccupanciesmodal" class="modal fade hide" style="display: none;" aria-hidden="true">
                                        <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Room/Unit #: <span id="unit-occupancies-modaltitle"></span> Tenants</h3>
                                        </div>
                                        <div id="unitoccupancies-modal-body" class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
                                        </div>
                                    </div>
                                    <!-- ***END TowerUnit Tenets Modal Window -->

                                    <script src="<?= base_url();?>js/site/tenement.js"></script>
                                    
                                    
                                    
                                </div>
				<!-- /Page container -->
			
			</div>
			<!-- /Main data container -->
			
		</div>
		<!-- /Main content -->
		
		<!-- Main footer -->
		<footer class="container">
			<nav>
				<ul>
					<li>&copy; Copyright 2013. All rights reserved.</li>
					<li><a href="">Support</a></li>
					<li><a href="">Contact us</a></li>
				</ul>
			</nav>
			<p>Powered by <a href="http://letusdorm.com">Let Us Dorm</a></p>
		</footer>
		<!-- /Main footer -->
		
		<!-- Scripts -->
		<script src="<?= base_url(); ?>js/navigation.js"></script>

		<!-- Bootstrap scripts -->
		<!--
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-collapse.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-transition.js"></script>
		-->
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap.js"></script>
		<script src="<?= base_url();?>js/site/tenant.js"></script>
                <script src="<?= base_url();?>js/site/tenement.js"></script>
		<!-- jQuery plUpload -->
		<!--<script src="<?= base_url(); ?>js/plugins/plUpload/plupload.full.js"></script>
		<script src="<?= base_url(); ?>js/plugins/plUpload/jquery.plupload.queue/jquery.plupload.queue.js"></script> -->
		<script>
			$(document).ready(function() {
				
				
			});
		</script>

