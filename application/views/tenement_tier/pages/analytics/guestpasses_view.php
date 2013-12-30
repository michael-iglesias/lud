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
     * Today's guestpasses Requests 
     *************************************************************************/
    var metricguestpassesRequestToday = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "keen.id",
        label: "Issued guest Passes Today"
    });
    // Initialize Number Dispaly for guestpasses Requests Created Today
    var visualguestpassesToday = new Keen.Number(metricguestpassesRequestToday, {
        label: "Today's guestpasses Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    // PIECHART
    var metricguestpassesTodayPieChart = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total guestpasses Today
    var visualguestpassesTodayPieChart = new Keen.PieChart(metricguestpassesTodayPieChart, {
        height: "300",
        width: "500",
        title: "Guest Passes By Type",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualguestpassesTodayLineChart = new Keen.Series("guest_passes", {
        analysisType: "count",
        timeframe: "today",
        interval: "hourly",
        targetProperty: "type",
        groupBy: "type"
    });
    

    /**************************************************************************
     * Last 7 Days Total guestpasses
     *************************************************************************/
    // COUNTER
    var metricguestpasses7days = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total guestpasses Today
    var visualguestpasses7days = new Keen.Number(metricguestpasses7days, {
        label: "Issued Guest Passes",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    // PIECHART
    var metricguestpasses7daysPieChart = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total guestpasses Today
    var visualguestpasses7daysPieChart = new Keen.PieChart(metricguestpasses7daysPieChart, {
        height: "300",
        width: "500",
        title: "Guest Passes by Type",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualguestpasses7daysLineChart = new Keen.Series("guest_passes", {
        analysisType: "count",
        timeframe: "last_7_days",
        interval: "daily",
        targetProperty: "type",
        groupBy: "type"
    });


    /**************************************************************************
     * Last 5 WEEKS Total guestpasses
     *************************************************************************/
    // COUNTER
    var metricguestpasses5weeks = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total guestpasses Today
    var visualguestpasses5weeks = new Keen.Number(metricguestpasses5weeks, {
        label: "Submitted guestpasses Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    // PIECHART
    var metricguestpasses5weeksPieChart = new Keen.Metric("guest_passes", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total guestpasses Today
    var visualguestpasses5weeksPieChart = new Keen.PieChart(metricguestpasses5weeksPieChart, {
        height: "300",
        width: "500",
        title: "Guest Passes by Type",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualguestpasses5weeksLineChart = new Keen.Series("guest_passes", {
        analysisType: "count",
        timeframe: "last_30_days",
        interval: "weekly",
        targetProperty: "type",
        groupBy: "type"
    });




    // Draw Elements
    visualguestpassesToday.draw(document.getElementById("guestpasses_count_today_analysis"));
    visualguestpassesTodayPieChart.draw(document.getElementById("guestpasses_count_today_analysis_piechart"));
    visualguestpassesTodayLineChart.draw(document.getElementById("guestpasses_count_today_analysis_linechart"));

    visualguestpasses7days.draw(document.getElementById("guestpasses_count_7days_analysis"));
    visualguestpasses7daysPieChart.draw(document.getElementById("guestpasses_count_7days_analysis_piechart"));
    visualguestpasses7daysLineChart.draw(document.getElementById("guestpasses_count_7days_analysis_linechart"));
    
    visualguestpasses5weeks.draw(document.getElementById("guestpasses_count_5weeks_analysis"));
    visualguestpasses5weeksPieChart.draw(document.getElementById("guestpasses_count_5weeks_analysis_piechart"));
    visualguestpasses5weeksLineChart.draw(document.getElementById("guestpasses_count_5weeks_analysis_linechart"));
    
});
</script>


<div class="row">
    <div class="span4">
        <h2>Today:</h2>
    </div>
    <div class="clearfix"></div>
    <div class="span4"></div>
    <div class="span4">
        <div id="guestpasses_count_today" class="analysis-box">
            <div id="guestpasses_count_today_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="guestpasses_count_today_piechart" class="analysis-box">
            <div id="guestpasses_count_today_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="guestpasses_count_today_linchart" class="analysis-box">
            <div id="guestpasses_count_today_analysis_linechart"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="span4">
        <h2>Last 7 Days:</h2>
    </div>
    <div class="clearfix"></div>
    <div class="span4"></div>
    <div class="span4">
        <div id="guestpasses_count_7days" class="analysis-box">
            <div id="guestpasses_count_7days_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="guestpasses_count_7days_piechart" class="analysis-box">
            <div id="guestpasses_count_7days_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="guestpasses_count_7days_linchart" class="analysis-box">
            <div id="guestpasses_count_7days_analysis_linechart"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="span4">
        <h2>Last 5 Weeks:</h2>
    </div>
    <div class="clearfix"></div>
    <div class="span4"></div>
    <div class="span4">
        <div id="guestpasses_count_5weeks" class="analysis-box">
            <div id="guestpasses_count_5weeks_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="guestpasses_count_5weeks_piechart" class="analysis-box">
            <div id="guestpasses_count_5weeks_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="guestpasses_count_5weeks_linchart" class="analysis-box">
            <div id="guestpasses_count_5weeks_analysis_linechart"></div>
        </div>
    </div>
</div>

<style>
    .analysis-box {
        text-align: center;
    }    
</style>