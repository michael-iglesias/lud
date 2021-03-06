<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Thu Mar 13 2014 16:14:29 GMT+0000 (UTC) -->
<html data-wf-site="531cd6478445bbe450000790">
<head>
  <meta charset="utf-8">
  <title>LUD - features</title>
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
        <a class="nav-link" href="#" target="_self" style="background-color: #CCC; color: #FFF;">1. property info</a>
        <a class="nav-link" href="#" target="_self" style="background-color: #CCC; color: #FFF;">2. select features</a>
        <a class="nav-link" href="#" target="_self" style="background-color: #CCC; color: #FFF;">3. add buildings &amp;&nbsp;units</a>
        <a class="nav-link" href="#">4. import tenants</a>
        <a class="nav-link" href="#">5. launch!!!</a>
      </div>
    </div>
    <div class="w-col w-col-8 content-column" style="padding-top: 10px;">
      <h3>Need Help?</h3>
      <p><strong><em><a href="http://google.com">Watch Step 1 Video Tutorial<br></a></em></strong>Phone #:&nbsp;(xxx)xxx-xxxx
        <br>Email: support@letusdorm.com
        <br>Chat:&nbsp;irc....</p>
      <div class="content-block">
          <div id="new-building">
            <div id="inserted-building-placeholder"></div>
            
          </div>
          
          
          
        <h1 id="page-nav-Section 1">Add Buildings:</h1>
        <div class="w-form">
            <?php echo validation_errors(); ?>

                <label for="building-name">Building # or Building Name</label>
                <input class="w-input" type="text" name="building-name" id="building-name" />

                <label for="building-floors"># of Floors</label>
                <input class="w-input" type="text" name="building-floor-count" id="building-floor-count" />
                
                <label for="building-units-per-floor"># of Units Per Floor</label>
                <input class="w-input" type="text" name="building-units-per-floor" id="building-units-per-floor" />
                
                <label for="building-default-bed-count">Default # of Beds Per Unit (NOTE: You can later edit the number of beds for individual units.)</label>
                <input class="w-input" type="text" name="building-default-bed-count" id="building-default-bed-count" />
                
                
                
                <br />
                <input class="w-button" onclick="addBuilding('setup');" type="submit" value="Add Building &rarr;" data-wait="Please wait..."></input>
            
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
  <script type="text/javascript" src="<?= base_url(); ?>js/site/tenement.js"></script>
</body>
</html>