<?php
	session_start();
    // create curl resource
    $ch = curl_init();

    $api_url = 'http://162.243.56.184/api/index.php/user/dashboard/' . $_SESSION['tnt_id'];
    $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, $api_url ); 
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('Accept: application/json', 'Content-Length: 0') );                                   
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );   
    $response = curl_exec( $ch );   
    $result = json_decode($response); 

    // close curl resource to free up system resources
    curl_close($ch);
    
	foreach($result as $key => $v) {
		if($key == 'status') {
			$status = $v;
		}
		if($key == 'user_dashboard_info') {
			$user_dashboard_info = $v;
		}
		if($key == 'data') {
			$data = $v;
		}
	}
	
	if($user_dashboard_info == 1) {

	}
	
    


?>
<?php require_once("./resources/header.php"); ?>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                    	<div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-alizarin" href="#">
                                <div class="tiles-heading">Maintenance Requests</div>
                                <div class="tiles-body-alt">
                                    <i class="fa fa-wrench"></i>
                                    <div class="text-center">?</div>
                                    <small>Open Maintenance Requests</small>
                                </div>
                                <div class="tiles-footer"></div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-toyo" href="#">
                                <div class="tiles-heading">Profit</div>
                                <div class="tiles-body-alt">
                                    <!--i class="fa fa-bar-chart-o"></i-->
                                    <div class="text-center"><span class="text-top">$</span>854</div>
                                    <small>+8.7% from last period</small>
                                </div>
                                <div class="tiles-footer"></div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-success" href="#">
                                <div class="tiles-heading">Packages</div>
                                <div class="tiles-body-alt">
                                    <!--i class="fa fa-money"></i-->
                                    <div class="text-center">?</div>
                                    <small>Packages Pending Pickup</small>
                                </div>
                                <div class="tiles-footer"></div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-orange" href="#">
                                <div class="tiles-heading">Guest Passes</div>
                                <div class="tiles-body-alt">
                                    <i class="fa fa-group"></i>
                                    <div class="text-center">?</div>
                                    <small>Open Guest Passes</small>
                                </div>
                                <div class="tiles-footer"></div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row">        
                <div class="col-md-6">
                    <div class="panel panel-indigo">
                        <div class="panel-heading">
                            <h4>User Accounts</h4>
                            <div class="options">
                                <a href="javascript:;"><i class="fa fa-cog"></i></a>
                                <a href="javascript:;"><i class="fa fa-wrench"></i></a> 
                                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0px;">
                                    <thead>
                                        <tr>
                                            <th class="col-xs-1 col-sm-1"><input type="checkbox" id="select-all"></th>
                                            <th class="col-xs-9 col-sm-3">User ID</th>
                                            <th class="col-sm-6 hidden-xs">Email Address</th>
                                            <th class="col-xs-2 col-sm-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selects">
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>cranston</td>
                                            <td class="hidden-xs">cranstonb@gnail.com</td>
                                            <td><span class="label label-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>aaron</td>
                                            <td class="hidden-xs">ppaul@lime.com</td>
                                            <td><span class="label label-grape">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>norris</td>
                                            <td class="hidden-xs">j.norris@gnail.com</td>
                                            <td><span class="label label-warning">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>gunner</td>
                                            <td class="hidden-xs">gunner@outluk.com</td>
                                            <td><span class="label label-danger">Blocked</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>mrford</td>
                                            <td class="hidden-xs">fordm@gnail.com</td>
                                            <td><span class="label label-grape">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class=""></td>
                                            <td>stewrtt</td>
                                            <td class="hidden-xs">swttrs@outluk.com</td>
                                            <td><span class="label label-danger">Blocked</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="active">
                                            <td colspan="4" class="text-left">
                                                <label for="action" style="margin-bottom:0">Action </label>
                                                <select name="action">
                                                    <option value="Edit">Edit</option>
                                                    <option value="Aprove">Aprove</option>
                                                    <option value="Move">Move</option>
                                                    <option value="Delete">Delete</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                              <h4><i class="icon-highlight fa fa-check"></i> To-do List</h4>
                              <div class="options">
                                <a href="javascript:;"><i class="fa fa-cog"></i></a>
                                <a href="javascript:;"><i class="fa fa-wrench"></i></a> 
                                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                              </div>
                        </div>
                        <div class="panel-body">
                            <ul class="panel-tasks">
                                <li>
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Write documentation for theme</span>
                                        <span class="label label-info">6 Days</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-inverse">
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Compile code</span>
                                        <span class="label label-primary">3 Days</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-primary">
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Upload files to server</span>
                                        <span class="label label-orange">Tomorrow</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-success">
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Call client</span>
                                        <span class="label label-danger">Today</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-info">
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Buy some milk</span>
                                        <span class="label label-danger">Today</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Setup meeting with client</span>
                                        <span class="label label-sky">2 Weeks</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-danger">
                                    <label>
                                        <i class="fa fa-ellipsis-v icon-dragtask"></i>
                                        <input type="checkbox"> 
                                        <span class="task-description">Pay office rent and bills</span>
                                        <span class="label label-sky">3 Weeks</span>
                                    </label>
                                    <div class="options">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                            <a href="#" class="btn btn-success btn-sm pull-left">Add Tasks</a>
                            <a href="#" class="btn btn-default-alt btn-sm pull-right">See All Tasks</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
            </div>

        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->

    <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline">
                <li>AVANT &copy; 2013</li>
                <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
            </ul>
        </div>
    </footer>

</div> <!-- page-container -->

<?php require_once("./resources/footer.php"); ?>