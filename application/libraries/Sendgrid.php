<?php

class Sendgrid {

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->library('email');
    }


    public function send_mail($message_info = '') {
        $message_info['to'] = 'mike.iglesias11@gmail.com';
        $message_info['subject'] = 'testing templating';
        
        if($message_info['type'] == 'package_delivery') {
            $html = $this->generatePackageNotificationTemplate($message_info);
        } else if ($message_info['type'] == 'general') {
            $html = $this->generateGeneralNotificationTemplate($message_info);
        }
        $params = array(
            'api_user'  => 'letusdorm',
            'api_key'   => 'lud1open311',
            'to'        => $message_info['to'],
            'subject'   => $message_info['subject'],
            'html'      => $html,
            'text'      => 'Notification',
            'from'      => 'mci12@my.fsu.edu',
        );


        $request = 'http://sendgrid.com/api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        curl_close($session);

        // print everything out
        //print_r($r = json_decode($response));
        
    }
    
    
    
    /*******************************************************
     * Compile Email Templates
     * 1) General Notification Template
     * 2) Package Received Notification
     */
    public function generateGeneralNotificationTemplate($message_info) {
        $html = '<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title>Notification</title>

<!-- Hotmail ignores some valid styling, so we have to add this -->
<style type="text/css">
.ReadMsgBody
{width: 100%; background-color: #d2d2d2;}
.ExternalClass
{width: 100%; background-color: #d2d2d2;}
body
{width: 100%; height: 100%; background-color: #FFFFFF;}
html
{width: 100%; height: 100%;}

</style>
</head>


<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">

<!-- Wrapper -->
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td width="100%" valign="top" height="100%" background="images/bg.jpg">	

		<!-- Main wrapper -->
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tbody><tr>
				<td>
				
					<!-- Cant view this email? -->
					<table width="656" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td height="80" style="text-align: center; font-style: italic; font-size: 11px; color: #AAAAAA; font-weight: normal; text-align: center; font-family: Georgia, serif; text-shadow: 1px 1px 1px #FFFFFF;" mc:edit="cant_view">
								
								<a style="color: #AAAAAA; text-decoration: none;" href="#">Can not view Email?</a>
							
							
							</td>
						</tr>
					</tbody></table><!-- End Cant view this email? -->
					
					<!-- Border Top -->
					<table width="702" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td width="702" style="line-height: 1px;">
								<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/border_top.jpg">									
							</td>
						</tr>
					</tbody></table><!-- End Border Top -->
					
					<!-- Navigation -->
					<!-- End Navigation -->
					
					<!-- Shadow Under The Nav -->
					

					
					<!-- White BG Color Wrapper -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td bgcolor="#FFFFFF">
							
								
							
							
							<!-- Start Shadow Under The Header -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<!-- Start 1px Border Left -->
										<td width="1" bgcolor="#d9d9d9"></td>
										<td width="31" bgcolor="#FFFFFF"></td>
										<td width="538">
									
											<!-- Shadow under the Header -->
											<!-- End Shadow under the Header -->
											
											<!-- Header Headline -->
											<table width="538" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 16px; color: #626262; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; line-height: 36px;">
												<tbody><tr>
													<td width="538" valign="top" mc:edit="header_headline"><a style="text-decoration: none; color: #eab37d;" href="#">Notification</a>							
													</td>
												</tr>
											</tbody></table><!-- End Header Headline -->
											
											<!-- Header Text -->
											<table width="538" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 12px; color: #9d9d9d; font-weight: normal; text-align: left; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 20px;">
												<tbody><tr>
													<td width="538" valign="top" mc:edit="header_text">' . $message_info['details'] . '<br><br>								
													</td>
												</tr>
											</tbody></table><!-- End HeaderText -->

										</td>
										<td width="31" bgcolor="#FFFFFF"></td>
										
										<!-- Start 1px Border Right -->
										<td width="1" bgcolor="#d9d9d9"></td>
									</tr>
								</tbody></table><!-- End Header + Text -->
								
								
								<!-- Empty Table -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" align="center">
									<tbody><tr>
										<td width="1" bgcolor="#d9d9d9"></td>
										<td width="600" height="10" style="line-height: 1px;">
											<img style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/blank.gif">	
										</td>
										<td width="1" bgcolor="#d9d9d9"></td>				
									</tr>
								</tbody></table>
								
								<!-- Shadow Under the Header Teaxt -->
								
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 1 -->
								<!-- End 1 Images + Headline 1 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 2 -->
								<!-- End 2 Images + Headline 2 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 3 -->
								<!-- End 1 Images + Headline 3 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 4 -->
								<!-- End 4 Images + Headline 4 -->
								
								<!-- Empty Table -->
								
								
								<!-- Footer Shadow Top -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<td width="1" bgcolor="#cfcfcf"></td>
										<td width="600">
											<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/footer_shadow_top.jpg">
										</td>
										<td width="1" bgcolor="#cfcfcf"></td>
									</tr>
								</tbody></table>
								
								<!-- Footer Buttons etc. -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<td width="1" height="70" bgcolor="#cfcfcf"></td>
										<td width="31" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/facebook_button.jpg" mc:edit="facebook_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/twitter_button.jpg" mc:edit="twitter_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/youtube_button.jpg" mc:edit="youtube_button.jpg"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/pinterest_button.jpg" mc:edit="pinterest_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/google_button.jpg" mc:edit="google_button_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="75" height="70"></td>
										
										<td width="70" valign="middle" height="70">
										</td>
										<td width="2" height="70"></td>
										<td width="34" height="70">
											
											<!-- Counter -->
											<table width="34" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody><tr>
													<td width="7">
													
														<!-- Counter Left -->
														
													</td>
													<td width="22" valign="middle">
														
													</td>
													<td width="5">
													
														<!-- Counter Right -->
														
													</td>
													
												</tr>
											</tbody></table>
				
										</td>
										<td width="25" height="70"></td>
										<td width="70" valign="middle" height="70">
											<a href="#"></a></td>
										<td width="2" height="70"></td>
										<td width="34" height="70">
										
											<!-- Counter -->
											<table width="34" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody><tr>
													<td width="7">
													
														<!-- Counter Left -->
														
													</td>
													<td width="22" valign="middle">
														
													</td>
													<td width="5">
													
														<!-- Counter Right -->
														
													</td>
													
												</tr>
											</tbody></table>
										</td>
										
										<td width="32" height="70"></td>
										<td width="1" height="70" bgcolor="#cfcfcf"></td>
									</tr>
								</tbody></table>
								
								<!-- Bottom Shadow -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>	
										<td width="602">
											<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/bottom_shadow.jpg">
										</td>
									</tr>
								</tbody></table>
					

							</td>
						</tr>
					</tbody></table><!-- End White BG Color Wrapper -->
					
					<!-- Empty Table -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td width="602" height="8">
								<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/blank.gif">
							</td>
						</tr>
					</tbody></table>

					
					<!-- Unsubscribe -->
					<table width="580" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 12px; color: #989898; font-weight: normal; text-align: center; font-family: Georgia, serif. Helvetica; line-height: 20px; font-style: italic;">
						<tbody><tr>
							<td width="580" mc:edit="unsubscribe">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas sed diam eget risus varius
blandit sit amet non tortor mauris condimentum <a style="text-decoration: none; color: #eab37d; font-weight: bold;" href="#">unsubscribe</a>									
							</td>
						</tr>
					</tbody></table><!-- End Unsubscribe -->
					
					<!-- Bottom Logo -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center" style="text-align: center;">
						<tbody><tr>
							<td width="602" height="140">
								<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/logo_bottom.jpg" mc:edit="logo_bottom"></a>								
							</td>
						</tr>
					</tbody></table><!-- End Bottom Logo -->
						
		
				</td>
			</tr>
		</tbody></table><!-- End Main wrapper -->

		</td>
	</tr>
</tbody></table><!-- End Wrapper -->

<!-- Done -->




</body></html>';
        return $html;
    } // ***END generatePackageNotificationTemplate() Method
    
    public function generatePackageNotificationTemplate($message_info) {
        $html = '<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title>Package Delivery Reminder</title>

<!-- Hotmail ignores some valid styling, so we have to add this -->
<style type="text/css">
.ReadMsgBody
{width: 100%; background-color: #d2d2d2;}
.ExternalClass
{width: 100%; background-color: #d2d2d2;}
body
{width: 100%; height: 100%; background-color: #FFFFFF;}
html
{width: 100%; height: 100%;}

</style>
</head>


<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">

<!-- Wrapper -->
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td width="100%" valign="top" height="100%" background="images/bg.jpg">	

		<!-- Main wrapper -->
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tbody><tr>
				<td>
				
					<!-- Cant view this email? -->
					<table width="656" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td height="80" style="text-align: center; font-style: italic; font-size: 11px; color: #AAAAAA; font-weight: normal; text-align: center; font-family: Georgia, serif; text-shadow: 1px 1px 1px #FFFFFF;" mc:edit="cant_view">
								
								<a style="color: #AAAAAA; text-decoration: none;" href="#">Can not view Email?</a>
							
							
							</td>
						</tr>
					</tbody></table><!-- End Cant view this email? -->
					
					<!-- Border Top -->
					<table width="702" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td width="702" style="line-height: 1px;">
								<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/border_top.jpg">									
							</td>
						</tr>
					</tbody></table><!-- End Border Top -->
					
					<!-- Navigation -->
					<!-- End Navigation -->
					
					<!-- Shadow Under The Nav -->
					

					
					<!-- White BG Color Wrapper -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td bgcolor="#FFFFFF">
							
								
							
							
							<!-- Start Shadow Under The Header -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<!-- Start 1px Border Left -->
										<td width="1" bgcolor="#d9d9d9"></td>
										<td width="31" bgcolor="#FFFFFF"></td>
										<td width="538">
									
											<!-- Shadow under the Header -->
											<!-- End Shadow under the Header -->
											
											<!-- Header Headline -->
											<table width="538" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 16px; color: #626262; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; line-height: 36px;">
												<tbody><tr>
													<td width="538" valign="top" mc:edit="header_headline"><a style="text-decoration: none; color: #eab37d;" href="#">Package Notification: You Have Received A Package</a>							
													</td>
												</tr>
											</tbody></table><!-- End Header Headline -->
											
											<!-- Header Text -->
											<table width="538" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 12px; color: #9d9d9d; font-weight: normal; text-align: left; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 20px;">
												<tbody><tr>
													<td width="538" valign="top" mc:edit="header_text">' . $message_info['details'] . '<br><br>								
													</td>
												</tr>
											</tbody></table><!-- End HeaderText -->

										</td>
										<td width="31" bgcolor="#FFFFFF"></td>
										
										<!-- Start 1px Border Right -->
										<td width="1" bgcolor="#d9d9d9"></td>
									</tr>
								</tbody></table><!-- End Header + Text -->
								
								
								<!-- Empty Table -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" align="center">
									<tbody><tr>
										<td width="1" bgcolor="#d9d9d9"></td>
										<td width="600" height="10" style="line-height: 1px;">
											<img style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/blank.gif">	
										</td>
										<td width="1" bgcolor="#d9d9d9"></td>				
									</tr>
								</tbody></table>
								
								<!-- Shadow Under the Header Teaxt -->
								
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 1 -->
								<!-- End 1 Images + Headline 1 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 2 -->
								<!-- End 2 Images + Headline 2 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 3 -->
								<!-- End 1 Images + Headline 3 -->
								
								<!-- Empty Table -->
								
								
								<!-- Start Images + Headlines 4 -->
								<!-- End 4 Images + Headline 4 -->
								
								<!-- Empty Table -->
								
								
								<!-- Footer Shadow Top -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<td width="1" bgcolor="#cfcfcf"></td>
										<td width="600">
											<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/footer_shadow_top.jpg">
										</td>
										<td width="1" bgcolor="#cfcfcf"></td>
									</tr>
								</tbody></table>
								
								<!-- Footer Buttons etc. -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>
										<td width="1" height="70" bgcolor="#cfcfcf"></td>
										<td width="31" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/facebook_button.jpg" mc:edit="facebook_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/twitter_button.jpg" mc:edit="twitter_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/youtube_button.jpg" mc:edit="youtube_button.jpg"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/pinterest_button.jpg" mc:edit="pinterest_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="35" height="70">
											<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/google_button.jpg" mc:edit="google_button_button"></a>
										</td>
										<td width="10" height="70"></td>
										<td width="75" height="70"></td>
										
										<td width="70" valign="middle" height="70">
										</td>
										<td width="2" height="70"></td>
										<td width="34" height="70">
											
											<!-- Counter -->
											<table width="34" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody><tr>
													<td width="7">
													
														<!-- Counter Left -->
														
													</td>
													<td width="22" valign="middle">
														
													</td>
													<td width="5">
													
														<!-- Counter Right -->
														
													</td>
													
												</tr>
											</tbody></table>
				
										</td>
										<td width="25" height="70"></td>
										<td width="70" valign="middle" height="70">
											<a href="#"></a></td>
										<td width="2" height="70"></td>
										<td width="34" height="70">
										
											<!-- Counter -->
											<table width="34" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody><tr>
													<td width="7">
													
														<!-- Counter Left -->
														
													</td>
													<td width="22" valign="middle">
														
													</td>
													<td width="5">
													
														<!-- Counter Right -->
														
													</td>
													
												</tr>
											</tbody></table>
										</td>
										
										<td width="32" height="70"></td>
										<td width="1" height="70" bgcolor="#cfcfcf"></td>
									</tr>
								</tbody></table>
								
								<!-- Bottom Shadow -->
								<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody><tr>	
										<td width="602">
											<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/bottom_shadow.jpg">
										</td>
									</tr>
								</tbody></table>
					

							</td>
						</tr>
					</tbody></table><!-- End White BG Color Wrapper -->
					
					<!-- Empty Table -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody><tr>
							<td width="602" height="8">
								<img border="0" style="display: block;" alt="" src="http://letusdorm.com/platform/email_img/images/blank.gif">
							</td>
						</tr>
					</tbody></table>

					
					<!-- Unsubscribe -->
					<table width="580" cellspacing="0" cellpadding="0" border="0" align="center" style="font-size: 12px; color: #989898; font-weight: normal; text-align: center; font-family: Georgia, serif. Helvetica; line-height: 20px; font-style: italic;">
						<tbody><tr>
							<td width="580" mc:edit="unsubscribe">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas sed diam eget risus varius
blandit sit amet non tortor mauris condimentum <a style="text-decoration: none; color: #eab37d; font-weight: bold;" href="#">unsubscribe</a>									
							</td>
						</tr>
					</tbody></table><!-- End Unsubscribe -->
					
					<!-- Bottom Logo -->
					<table width="602" cellspacing="0" cellpadding="0" border="0" align="center" style="text-align: center;">
						<tbody><tr>
							<td width="602" height="140">
								<a href="#"><img border="0" alt="" src="http://letusdorm.com/platform/email_img/images/logo_bottom.jpg" mc:edit="logo_bottom"></a>								
							</td>
						</tr>
					</tbody></table><!-- End Bottom Logo -->
						
		
				</td>
			</tr>
		</tbody></table><!-- End Main wrapper -->

		</td>
	</tr>
</tbody></table><!-- End Wrapper -->

<!-- Done -->




</body></html>';
        return $html;
    } // ***END generateGeneralNotificationTemplate() Method
    
    
    
    
    
}