<script type="text/javascript">
    var Keen=Keen||{configure:function(e){this._cf=e},addEvent:function(e,t,n,i){this._eq=this._eq||[],this._eq.push([e,t,n,i])},setGlobalProperties:function(e){this._gp=e},onChartsReady:function(e){this._ocrq=this._ocrq||[],this._ocrq.push(e)}};(function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src=("https:"==document.location.protocol?"https://":"http://")+"dc8na2hxrj29i.cloudfront.net/code/keen-2.1.0-min.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();

    // Configure the Keen object with your Project ID and (optional) access keys.
    Keen.configure({
        projectId: "52b3bce536bf5a240d000000",
        readKey: "3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78"    // required for doing analysis
    });
</script>
<script type="text/javascript">
Keen.onChartsReady(function() {
    
    /**************************************************************************
     * Today's Maintenance Requests 
     *************************************************************************/
    var metricMaintenanceRequestToday = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "keen.id",
        label: "Requests Today"
    });
    // Initialize Number Dispaly for Maintenance Requests Created Today
    var visualMaintenanceRequestToday = new Keen.Number(metricMaintenanceRequestToday, {
        label: "Today's Maintenance Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });

    /**************************************************************************
     * Today's Guest Passes
     *************************************************************************/
    var metricGuestPassesToday = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "keen.id"
    });
    // Initialize Number Dispaly for Maintenance Requests Created Today
    var visualGuestPassesToday = new Keen.Number(metricGuestPassesToday, {
        label: "Issued Guest Passes - Today",
        "number-background-color": "#7899CC",
        "label-background-color": "#98B0D3"
    });

    /**************************************************************************
     * Todays Total Impressions
     *************************************************************************/
    var metricImpressionsToday = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressionsToday = new Keen.Number(metricImpressionsToday, {
        label: "Tenant Page Impressions - Today",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });


    // Draw Elements
    visualMaintenanceRequestToday.draw(document.getElementById("maintenance_request_count_today_analysis"));
    visualGuestPassesToday.draw(document.getElementById("guest_pass_count_today_analysis"));
    visualImpressionsToday.draw(document.getElementById("impression_count_today_analysis"));
});
</script>


<div class="row">
    <div class="span4">
        <div id="maintenance_request_count_today" class="analysis-box">
            <div id="maintenance_request_count_today_analysis"></div>
        </div>
    </div>
    
    <div class="span4">
        <div id="guest_pass_count_today" class="analysis-box">
            <div id="guest_pass_count_today_analysis"></div>
        </div>
    </div>
    
    <div class="span4">
        <div id="impression_count_today" class="analysis-box">
            <div id="impression_count_today_analysis"></div>
        </div>
    </div>
</div>
<style>
    .analysis-box {
        text-align: center;
    }    
</style>
    