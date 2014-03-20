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
        <a class="nav-link" href="#" target="_self">3. add buildings &amp;&nbsp;units</a>
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
        <h1 id="page-nav-Section 1">Feature Selection:</h1>
        <div class="w-form">
            <?php echo validation_errors(); ?>
          <form method="post" action="<?= base_url(); ?>index.php/setup/process_step2" data-name="property info">
            <label for="name">Maintenance Requests:</label>
            <select class="w-select" name="maintenance" data-name="maintenance" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Allow tenants to submit maintenance requests through the platform, while property management is able to track tickets and notify tenants of progress made via SMS &amp; Email.</p>
            <label for="email">Package Logging:</label>
            <select class="w-select" name="package" data-name="package">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Inbound package logging &amp; tracking system. Provides accurate timestamps of packages received and notifies tenants via SMS, Email, &amp;&nbsp;Push Notification that a package has been delivered and is awaiting pickup.</p>
            <label>Notification Center:</label>
            <select class="w-select" name="notification" data-name="notification" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Notification Center allows management to send Email/SMS alerts to individual tenants, units, building, or the entire property. Event notifications, reminders, security alerts are some of the types of messages that can be sent to tenants through
              the use of the Notification Center.</p>
            <label>Facility Reservations:</label>
            <select class="w-select" name="reservations" data-name="reservations" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Allow tenants to reserve facility amenities at their convienacne.</p>
            <label>Roommate Matching:</label>
            <select class="w-select" name="roommate-matching" data-name="roommate-matching" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Our simple but effective roommate matching makes it easy for tenants to fill out their personality questionnaire and for management to assign the roommates. Let Us Dorm's platform uses advanced algorithms to match tenants based on specific
              preferences and likes.</p>
            <label>Community Newsfeed:</label>
            <select class="w-select" name="newsfeed" data-name="newsfeed" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Keep tenants up to date with upcoming events and community news with a News Feed. Management will have the ability to curate this news feed with noteworthy events and news that is easily accessible by tenants.</p>
            <label>Guest Passes:</label>
            <select class="w-select" name="guest-passes" data-name="guest-passes" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>For properties that have controlled entry. This feature allows tenants to submit guest passes for visitors and food delivery services. Property security is provided with an interface that allows them to easily find tenant &amp;&nbsp;unit information
              as well as unclaimed guest passes that are to be issued upon arrival of these visitors.</p>
            <label>Social Shopping:</label>
            <select class="w-select" name="social-shopping" data-name="social-shopping" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Social Shopping allows tenants to purchase household appliances and the split the cost of the purchase amongst all roommates. This feature can also be another source of revenue making our platform profitable.</p>
            <label>Campus Carpool:</label>
            <select class="w-select" name="carpool" data-name="carpool" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Allow tenants to organize carpools to campus.</p>
            <label>Property Buy&amp;Sell Marketplace:</label>
            <select class="w-select" name="marketplace" data-name="marketplace" required="required">
              <option value="">Select one...</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <p>Allow tenants to list items for sale ranging from textbooks, matresses, and other household appliances. This private marketplace will allow tenants to easily sell and purchase items from a safe network as opposed to Craig’s List.</p>
            <input
            class="w-button" type="submit" value="Next: Select Features" data-wait="Please wait..."></input>
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