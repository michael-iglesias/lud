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
    var visualMaintenanceToday = new Keen.Number(metricMaintenanceRequestToday, {
        label: "Today's Maintenance Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    
    
    // PIECHART
    var metricMaintenanceTodayPieChart = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total Maintenance Today
    var visualMaintenanceTodayPieChart = new Keen.PieChart(metricMaintenanceTodayPieChart, {
        height: "300",
        width: "500",
        title: "Maintenance By Type",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualMaintenanceTodayLineChart = new Keen.Series("maintenance_requests", {
        analysisType: "count",
        timeframe: "today",
        interval: "hourly",
        targetProperty: "type",
        groupBy: "type"
    });
    

    /**************************************************************************
     * Last 7 Days Total Maintenance
     *************************************************************************/
    // COUNTER
    var metricMaintenance7days = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Maintenance Today
    var visualMaintenance7days = new Keen.Number(metricMaintenance7days, {
        label: "Submitted Maintenance Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    // PIECHART
    var metricMaintenance7daysPieChart = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total Maintenance Today
    var visualMaintenance7daysPieChart = new Keen.PieChart(metricMaintenance7daysPieChart, {
        height: "300",
        width: "500",
        title: "Maintenance Requests Type",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualMaintenance7daysLineChart = new Keen.Series("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_7_days",
        interval: "daily",
        targetProperty: "type",
        groupBy: "type"
    });


    /**************************************************************************
     * Last 5 WEEKS Total Maintenance
     *************************************************************************/
    // COUNTER
    var metricMaintenance5weeks = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Maintenance Today
    var visualMaintenance5weeks = new Keen.Number(metricMaintenance5weeks, {
        label: "Submitted Maintenance Requests",
        "number-background-color": "#CCB178",
        "label-background-color": "#D6C698"
    });
    
    // PIECHART
    var metricMaintenance5weeksPieChart = new Keen.Metric("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "type",
        groupBy: "type"
    });
    // Initialize Number Display For Total Maintenance Today
    var visualMaintenance5weeksPieChart = new Keen.PieChart(metricMaintenance5weeksPieChart, {
        height: "300",
        width: "500",
        title: "Maintenance By Page",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualMaintenance5weeksLineChart = new Keen.Series("maintenance_requests", {
        analysisType: "count",
        timeframe: "last_30_days",
        interval: "weekly",
        targetProperty: "type",
        groupBy: "type"
    });




    // Draw Elements
    visualMaintenanceToday.draw(document.getElementById("maintenance_count_today_analysis"));
    visualMaintenanceTodayPieChart.draw(document.getElementById("maintenance_count_today_analysis_piechart"));
    visualMaintenanceTodayLineChart.draw(document.getElementById("maintenance_count_today_analysis_linechart"));

    visualMaintenance7days.draw(document.getElementById("maintenance_count_7days_analysis"));
    visualMaintenance7daysPieChart.draw(document.getElementById("maintenance_count_7days_analysis_piechart"));
    visualMaintenance7daysLineChart.draw(document.getElementById("maintenance_count_7days_analysis_linechart"));
    
    visualMaintenance5weeks.draw(document.getElementById("maintenance_count_5weeks_analysis"));
    visualMaintenance5weeksPieChart.draw(document.getElementById("maintenance_count_5weeks_analysis_piechart"));
    visualMaintenance5weeksLineChart.draw(document.getElementById("maintenance_count_5weeks_analysis_linechart"));
    
});
</script>


<div class="row">
    <div class="span4">
        <h2>Today:</h2>
    </div>
    <div class="clearfix"></div>
    <div class="span4"></div>
    <div class="span4">
        <div id="maintenance_count_today" class="analysis-box">
            <div id="maintenance_count_today_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="maintenance_count_today_piechart" class="analysis-box">
            <div id="maintenance_count_today_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="maintenance_count_today_linchart" class="analysis-box">
            <div id="maintenance_count_today_analysis_linechart"></div>
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
        <div id="maintenance_count_7days" class="analysis-box">
            <div id="maintenance_count_7days_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="maintenance_count_7days_piechart" class="analysis-box">
            <div id="maintenance_count_7days_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="maintenance_count_7days_linchart" class="analysis-box">
            <div id="maintenance_count_7days_analysis_linechart"></div>
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
        <div id="maintenance_count_5weeks" class="analysis-box">
            <div id="maintenance_count_5weeks_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="maintenance_count_5weeks_piechart" class="analysis-box">
            <div id="maintenance_count_5weeks_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="maintenance_count_5weeks_linchart" class="analysis-box">
            <div id="maintenance_count_5weeks_analysis_linechart"></div>
        </div>
    </div>
</div>

<style>
    .analysis-box {
        text-align: center;
    }    
</style>