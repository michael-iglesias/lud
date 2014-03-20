<?php
function statesList() {  
    $states = array('AL'=>"Alabama",  
                    'AK'=>"Alaska",  
                    'AZ'=>"Arizona",  
                    'AR'=>"Arkansas",  
                    'CA'=>"California",  
                    'CO'=>"Colorado",  
                    'CT'=>"Connecticut",  
                    'DE'=>"Delaware",  
                    'DC'=>"District Of Columbia",  
                    'FL'=>"Florida",  
                    'GA'=>"Georgia",  
                    'HI'=>"Hawaii",  
                    'ID'=>"Idaho",  
                    'IL'=>"Illinois",  
                    'IN'=>"Indiana",  
                    'IA'=>"Iowa",  
                    'KS'=>"Kansas",  
                    'KY'=>"Kentucky",  
                    'LA'=>"Louisiana",  
                    'ME'=>"Maine",  
                    'MD'=>"Maryland",  
                    'MA'=>"Massachusetts",  
                    'MI'=>"Michigan",  
                    'MN'=>"Minnesota",  
                    'MS'=>"Mississippi",  
                    'MO'=>"Missouri",  
                    'MT'=>"Montana",  
                    'NE'=>"Nebraska",  
                    'NV'=>"Nevada",  
                    'NH'=>"New Hampshire",  
                    'NJ'=>"New Jersey",  
                    'NM'=>"New Mexico",  
                    'NY'=>"New York",  
                    'NC'=>"North Carolina",  
                    'ND'=>"North Dakota",  
                    'OH'=>"Ohio",  
                    'OK'=>"Oklahoma",  
                    'OR'=>"Oregon",  
                    'PA'=>"Pennsylvania",  
                    'RI'=>"Rhode Island",  
                    'SC'=>"South Carolina",  
                    'SD'=>"South Dakota",  
                    'TN'=>"Tennessee",  
                    'TX'=>"Texas",  
                    'UT'=>"Utah",  
                    'VT'=>"Vermont",  
                    'VA'=>"Virginia",  
                    'WA'=>"Washington",  
                    'WV'=>"West Virginia",  
                    'WI'=>"Wisconsin",  
                    'WY'=>"Wyoming");  
    return $states;  
} 
$states = statesList();
?>

<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Thu Mar 13 2014 16:14:29 GMT+0000 (UTC) -->
<html data-wf-site="531cd6478445bbe450000790">
<head>
  <meta charset="utf-8">
  <title>LUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>setup_assets/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>setup_assets/css/webflow.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>setup_assets/css/lud.webflow.css">
  <script>
    if (/mobile/i.test(navigator.userAgent)) document.documentElement.className += ' w-mobile';
  </script>
  <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script><![endif]-->
  <link rel="apple-touch-icon" href="https://y7v4p6k4.ssl.hwcdn.net/51e1a6dc3bc6b24571000014/51e1ba063522c7b57b000061_thumbnail-starter.png">
</head>
<body>
  <div class="w-row">
    <div class="w-col w-col-4 left-sidebar">
      <div class="fixed-nav">
        <img class="logo" src="<?= base_url(); ?>setup_assets/images/letusdorm_logo.jpg" width="225" alt="531cd6c6f33a286560000910_letusdorm_logo.jpg">
        <a class="nav-link" href="#page-nav-Section 1" target="_self" style="background-color: #CCC; color: #FFF;">1. property info</a>
        <a class="nav-link" href="#page-nav-Section 2" target="_self">2. select features</a>
        <a class="nav-link" href="#page-nav-Section 3" target="_self">3. add buildings &amp;&nbsp;units</a>
        <a class="nav-link" href="#">4. import tenants</a>
        <a class="nav-link" href="#">5. launch!!!</a>
      </div>
    </div>
    <div class="w-col w-col-8 content-column" style="padding-top: 10px;">
      <h3>Need Help?</h3>
      <p><em><strong><a href="http://google.com">Watch Step 1 Video Tutorial<br></a></strong></em>Phone #:&nbsp;(xxx)xxx-xxxx
        <br>Email: support@letusdorm.com
        <br>Chat:&nbsp;irc....</p>
      <div class="content-block">
        <h1 id="page-nav-Section 1">Property Info</h1>
        <div class="w-form">
            <?php echo validation_errors(); ?>
          <form method="post" action="<?= base_url(); ?>index.php/setup/process_step1" data-name="property info">
            <label for="name">Property Name:</label>
            <input class="w-input" type="text" placeholder="Enter Property Name" value="<?php echo set_value('property-name'); ?>" name="property-name" data-name="property-name" required="required"></input>
            <label for="email">Property Phone #:</label>
            <input class="w-input" type="text" placeholder="Enter Property Phone #" value="<?php echo set_value('property-phone'); ?>" name="property-phone" required="required" data-name="property-phone"></input>
            <label>Property&nbsp;Email:</label>
            <input class="w-input" type="text" placeholder="Enter Property Email Address" value="<?php echo set_value('property-email'); ?>" name="property-email" required="required" data-name="property-email"></input>
            <label>Property&nbsp;Website URL:</label>
            <input class="w-input" type="text" placeholder="Enter Property Website URL" value="<?php echo set_value('property-website'); ?>" name="property-website" required="required" data-name="property-website"></input>
            <label>Property Address:</label>
            <input class="w-input" type="text" placeholder="Enter Property Address" value="<?php echo set_value('property-address'); ?>" name="property-address" required="required" data-name="property-address"></input>
            
            <label>Property State:</label>
            <select name="property-state" class="w-select">  
                <option selected="">Select your state...</option>  
                <?php foreach($states as $key => $value) { ?>  
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>  
                <?php } ?>  
            </select>
            
            <label>Property&nbsp;City:</label>
            <input class="w-input" type="text" placeholder="Enter Property City" value="<?php echo set_value('property-city'); ?>" name="property-city" required="required" data-name="property-city"></input>
            
            <label>Property ZIP:</label>
            <input class="w-input" type="text" placeholder="Enter Property ZIP" value="<?php echo set_value('property-zip'); ?>" name="property-zip" required="required" data-name="property-zip"></input>
            <br /><hr />
            <label>Administrator Email:</label>
            <input class="w-input" type="text" placeholder="Enter Administrator Email" value="<?php echo set_value('admin-email'); ?>" name="admin-email" required="required" data-name="admin-email"></input>
            <label>Administrator Password:</label>
            <input class="w-input" type="password" placeholder="Enter Administrator Password" value="" name="admin-password" required="required" data-name="admin-password"></input>
            <label>Administrator Phone #:</label>
            <input class="w-input" type="text" placeholder="Enter Administrator Phone # (e.x. xxx-xxx-xxxx)" value="<?php echo set_value('admin-phone'); ?>" name="admin-phone" required="required" data-name="admin-phone"></input>
            <hr />
            <input class="w-button" type="submit" value="Next: Select Features" data-wait="Please wait..."></input>
          </form>
          <div class="w-form-done">
            <p>Thank you! Your submission has been received!</p>
          </div>
          <div class="w-form-fail">
            <p>Oops! Something went wrong while submitting the form :(</p>
          </div>
        </div>
      </div>
      <div class="footer-section">
        <div class="italic-text footer">Some footer text can go here.&nbsp;Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>
      </div>
    </div>
  </div>
    
<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGNy2z9EBDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->
    
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>setup_assets/js/webflow.js"></script>
</body>
</html>