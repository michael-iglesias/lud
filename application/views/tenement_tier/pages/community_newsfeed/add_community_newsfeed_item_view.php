<!-- Page header -->
<div class="page-header">
    <h1><span class="<?= $page_header_icon; ?>"></span> <?= $page_header_title; ?></h1>
    <ul class="page-header-actions">
        <li class="active"><a href="#add-entry" class="btn btn-wuxia">Add News/Event</a></li>
        <li class=""><a href="<?= base_url(); ?>index.php/community_feed/entries" class="btn btn-wuxia">Community News Feed</a></li>
    </ul>
</div>
<!-- /Page header -->

<!-- Page container -->
<div class="page-container">
    <div class="tab-pane active" id="add-entry">
        <div id="entry-added-alert" class="alert alert-success hide">
            <strong>News/Event Entry Has Been Created!</strong> Entry has been added to the community news feed.
        </div>
        <input type="hidden" name="stime-selected" id="stime-selected" value="no"/>
        <input type="hidden" name="etime-selected" id="etime-selected" value="no" />
        <div class="controls">
            <label for="input" class="control-label">News/Event Date: <i>(optional)</i></label>
            <input id="entry-date" name="entry-date" type="text" value="<?php date("m/d/y");  ?>" class="datepicker">
        </div>
        <div class="controls">
            <label for="item-stime-hour" class="control-label"><input type="checkbox" id="stime-selection-checkbox" style="vertical-align: top;" />&nbsp;&nbsp;News/Event Start Time: </label>
            <div id="stime-selection" style="display: none;">
                <select class="input-mini" id="entry-stime-hour">
                    <option value="1">1:00</option>
                    <option value="2">2:00</option>
                    <option value="3">3:00</option>
                    <option value="4">4:00</option>
                    <option value="5">5:00</option>
                    <option value="6">6:00</option>
                    <option value="7">7:00</option>
                    <option value="8">8:00</option>
                    <option value="9">9:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                </select>
                :
                <select class="input-mini" id="entry-stime-minute">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>

                <select class="input-mini" id="entry-stime-ampm">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                </select>
            </div>
        </div>
        <div class="controls">
            <label for="item-etime-hour" class="control-label"><input type="checkbox" id="etime-selection-checkbox" style="vertical-align: top;" />&nbsp;&nbsp;News/Event End Time: <i>(optional)</i></label>
            <div id="etime-selection" style="display: none;">
                <select class="input-mini" id="entry-etime-hour">
                    <option value="1">1:00</option>
                    <option value="2">2:00</option>
                    <option value="3">3:00</option>
                    <option value="4">4:00</option>
                    <option value="5">5:00</option>
                    <option value="6">6:00</option>
                    <option value="7">7:00</option>
                    <option value="8">8:00</option>
                    <option value="9">9:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                </select>
                :
                <select class="input-mini" id="entry-etime-minute">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>

                <select class="input-mini" id="entry-etime-ampm">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                </select>
            </div>
        </div>
        <hr />

        <div class="controls">
            <label for="input" class="control-label">News/Event Title</label>
            <div class="controls">
                <input name="entry-title" id="entry-title" class="input-xxlarge" type="text" required>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="controls">
            <label for="input" class="control-label">News/Event Description</label>
            <div class="controls">
                <textarea class="input-xxlarge" id="entry-description"></textarea>

            </div>
        </div>
        <br />
        <span onclick="addNewsFeedEntry();" class="btn btn-wuxia btn-large btn-primary" type="submit">Add to News Feed</span>

    </div>
    
</div>
<script src="<?= base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
(function() {
    $('.datepicker').datepicker({
        "autoclose": true
    });
    
    $('#stime-selection-checkbox').click(function(){
    if (this.checked) {
        $('#stime-selected').val('yes');
        $('#stime-selection').show();
    } else {
        $('#stime-selection').hide();
        $('#stime-selected').val('no');
    }
    });
    
    $('#etime-selection-checkbox').click(function(){
        if (this.checked) {
            $('#etime-selected').val('yes');
            $('#etime-selection').show();
        } else {
            $('#etime-selection').hide();
            $('#etime-selected').val('no');
        }
    
    }); 
    
})();
</script>