<script src="<?= base_url(); ?>js/site/tenementNotification.js"></script>
<!-- Page header -->
<div class="page-header">
    <h1><span class="<?= $page_header_icon; ?>"></span> <?= $page_header_title; ?></h1>
    <ul class="page-header-actions">
        <li class="active"><a href="#logging" class="btn btn-wuxia">Create Notification</a></li>
        <li class=""><a href="<?= base_url(); ?>index.php/tenement/notification_history" class="btn btn-wuxia">Notification History</a></li>
    </ul>
</div>
<!-- /Page header -->

<!-- Page container -->
<div class="page-container">
    <div class="tab-pane active" id="logging">
        <div id="notification-created-alert" class="alert alert-success hide">
            <strong>Notification Created!</strong> This Notification Will Be Sent Automatically.
        </div>
        <h2 style="margin-bottom: -10px;">Who Are You Messaging?</h2>
        <br />

        <div id="target-audience-content">            
            <div class="target-audience span2" style="margin-left: 0px;" onclick="loadNotificationUI2(1);">
                <span style="font-size: 60px; color: #FA9606;" class="awe-user"></span>
                <h4>Single Resident</h4>
            </div>
            <div class="target-audience span2" onclick="loadNotificationUI2(2);">
                <span style="font-size: 60px; color: #FA9606;" class="awe-home"></span>
                <h4>Unit</h4>
            </div>
            <div class="target-audience span2" onclick="loadNotificationUI2(3);">
                <span style="font-size: 60px; color: #FA9606;" class="awe-table"></span>
                <h4>Building</h4>
            </div>
            <div class="target-audience span2" onclick="loadNotificationUI2(4);">
                <span style="font-size: 60px; color: #FA9606;" class="awe-group"></span>
                <h4>All Residents</h4>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <form style="background: none;">
            <input type="hidden" name="targetAudience" id="targetAudience" />
            <input type="hidden" name="audienceID" id="audienceID" />
                <div class="control-group" style="padding: 0px;">
                    <label for="select" class="control-label">Delivery Method</label>
                    <div class="controls">
                        <select id="deliveryMethod">
                            <option value="">Select Delivery Method</option>
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                            <option value="both">Email & SMS</option>
                        </select>
                    </div>
                </div>
            <div class="control-group" style="padding: 0px;">
                <label for="notification-title" class="control-label">Subject:</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="notification-title" id="notification-title">
                </div>
            </div>
            <div class="control-group" style="padding: 0px;">
                <label for="notification-message" class="control-label">Message:</label>
                <div class="controls">
                        <textarea rows="3" class="input-xlarge" name="notification-message" id="notification-message"></textarea>
                </div>
            </div>            
            
            <span onclick="sendNotification();" class="btn btn-wuxia btn-large btn-primary">Create Notification</span>
        </form>
    </div>
    
</div>