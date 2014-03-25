<?php

session_start();

$validated  = NULL;
$username = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$url = 'http://162.243.56.184/api/index.php/login';
	$params = array(
		"login_email" => $_POST['username'],
		"login_password" => $_POST['password']
	);	
	$result = json_decode(httpPost($url, $params));

	foreach($result as $key => $v) {
		if($key == 'status') {
			$status = $v;
		}
		if($key == 'login_match') {
			$login_match = $v;
		}
		if($key == 'data') {
			$data = $v;
		}
	}
	// If user was validated
	if($login_match == 1) {
		foreach($data as $row) {
			$fname = $row->tnt_fname;
			$lname = $row->tnt_lname;
			$tmt_id = $row->tmt_id;
			$tow_id = $row->tow_id;
			$tun_id = $row->tun_id;
			$urm_id = $row->urm_id;
			$tnt_id = $row->tnt_id;
			$tow_name = $row->tow_name;
			$tun_number = $row->tun_number;
		}
		
		$_SESSION['valid_tenant'] = TRUE;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['tmt_id'] = $tmt_id;
		$_SESSION['tow_id'] = $tow_id;
		$_SESSION['tun_id'] = $tun_id;
		$_SESSION['urm_id'] = $urm_id;
		$_SESSION['tnt_id'] = $tnt_id;
		$_SESSION['tow_name'] = $tow_name;
		$_SESSION['tun_number'] = $tun_number;
		
		header("Location: hub.php");
	} else {
		$validated = false;
		$username = $_POST['username'];
	}
} // ***END $_SERVER['REQUEST_METHOD'] 
        

function httpPost($url,$params)
{
   $postData = json_encode($params);
 
    $ch = curl_init(); 
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);   
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($postData))                                                                       
    );
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Avant</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avant">
    <meta name="author" content="The Red Team">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
    <link rel="stylesheet" href="assets/css/styles.min.css?=113">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    
    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
</head><body class="focusedform">

<div class="verticalcenter">
	<a href="index.htm"><img src="assets/img/logo-big.png" alt="Logo" class="brand" /></a>
	<div class="panel panel-primary">
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Log in to get started or <a href="extras-signupform.htm">Sign Up</a></h4>
				<form id="login-form" action="login.php" method="post" class="form-horizontal" style="margin-bottom: 0px !important;">
						<?php if($validated === FALSE): ?>
						<div class="alert alert-dismissable alert-danger">
							<strong>Oh snap!</strong> Change a few things up and try submitting again.
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						</div>
						<?php endif; ?>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control" name="username" id="username" value="<?= $username; ?>" placeholder="Email Address">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" id="password" placeholder="Password">
								</div>
							</div>
						</div>
					</form>
					
		</div>
		<div class="panel-footer">
			<a href="extras-forgotpassword.htm" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>
			
			<div class="pull-right">
				<a href="#" onclick="document.getElementById('login-form').submit();" class="btn btn-primary">Log In</a>
			</div>
		</div>
	</div>
 </div>
      
</body>
</html>