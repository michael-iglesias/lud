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
     * Todays Total Impressions
     *************************************************************************/
    // COUNTER
    var metricImpressionsToday = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressionsToday = new Keen.Number(metricImpressionsToday, {
        label: "Total Page Impressions",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });
    
    
    
    // PIECHART
    var metricImpressionsTodayPieChart = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "today",
        targetProperty: "page",
        groupBy: "page"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressionsTodayPieChart = new Keen.PieChart(metricImpressionsTodayPieChart, {
        height: "300",
        width: "500",
        title: "Impressions By Page",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualImpressionsTodayLineChart = new Keen.Series("impressions", {
        analysisType: "count",
        timeframe: "today",
        interval: "hourly",
        targetProperty: "page",
        groupBy: "page"
    });
    

    /**************************************************************************
     * Last 7 Days Total Impressions
     *************************************************************************/
    // COUNTER
    var metricImpressions7days = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressions7days = new Keen.Number(metricImpressions7days, {
        label: "Total Page Impressions",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });
    
    // PIECHART
    var metricImpressions7daysPieChart = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "last_7_days",
        targetProperty: "page",
        groupBy: "page"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressions7daysPieChart = new Keen.PieChart(metricImpressions7daysPieChart, {
        height: "300",
        width: "500",
        title: "Impressions By Page",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualImpressions7daysLineChart = new Keen.Series("impressions", {
        analysisType: "count",
        timeframe: "last_7_days",
        interval: "daily",
        targetProperty: "page",
        groupBy: "page"
    });


    /**************************************************************************
     * Last 5 WEEKS Total Impressions
     *************************************************************************/
    // COUNTER
    var metricImpressions5weeks = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressions5weeks = new Keen.Number(metricImpressions5weeks, {
        label: "Total Page Impressions",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });
    
    // PIECHART
    var metricImpressions5weeksPieChart = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "last_30_days",
        targetProperty: "page",
        groupBy: "page"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressions5weeksPieChart = new Keen.PieChart(metricImpressions5weeksPieChart, {
        height: "300",
        width: "500",
        title: "Impressions By Page",
        minimumSlicePercentage: 1
    });
    
    
    // LINECHART    
    var visualImpressions5weeksLineChart = new Keen.Series("impressions", {
        analysisType: "count",
        timeframe: "last_30_days",
        interval: "weekly",
        targetProperty: "page",
        groupBy: "page"
    });




    // Draw Elements
    visualImpressionsToday.draw(document.getElementById("impression_count_today_analysis"));
    visualImpressionsTodayPieChart.draw(document.getElementById("impression_count_today_analysis_piechart"));
    visualImpressionsTodayLineChart.draw(document.getElementById("impression_count_today_analysis_linechart"));

    visualImpressions7days.draw(document.getElementById("impression_count_7days_analysis"));
    visualImpressions7daysPieChart.draw(document.getElementById("impression_count_7days_analysis_piechart"));
    visualImpressions7daysLineChart.draw(document.getElementById("impression_count_7days_analysis_linechart"));
    
    visualImpressions5weeks.draw(document.getElementById("impression_count_5weeks_analysis"));
    visualImpressions5weeksPieChart.draw(document.getElementById("impression_count_5weeks_analysis_piechart"));
    visualImpressions5weeksLineChart.draw(document.getElementById("impression_count_5weeks_analysis_linechart"));
    
});
</script>


<div class="row">
    <div class="span4">
        <h2>Today:</h2>
    </div>
    <div class="clearfix"></div>
    <div class="span4"></div>
    <div class="span4">
        <div id="impression_count_today" class="analysis-box">
            <div id="impression_count_today_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="impression_count_today_piechart" class="analysis-box">
            <div id="impression_count_today_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="impression_count_today_linchart" class="analysis-box">
            <div id="impression_count_today_analysis_linechart"></div>
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
        <div id="impression_count_7days" class="analysis-box">
            <div id="impression_count_7days_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="impression_count_7days_piechart" class="analysis-box">
            <div id="impression_count_7days_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="impression_count_7days_linchart" class="analysis-box">
            <div id="impression_count_7days_analysis_linechart"></div>
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
        <div id="impression_count_5weeks" class="analysis-box">
            <div id="impression_count_5weeks_analysis"></div>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="span5">
        <div id="impression_count_5weeks_piechart" class="analysis-box">
            <div id="impression_count_5weeks_analysis_piechart"></div>
        </div>
    </div>
    
    <div class="span5">
        <div id="impression_count_5weeks_linchart" class="analysis-box">
            <div id="impression_count_5weeks_analysis_linechart"></div>
        </div>
    </div>
</div>

<style>
    .analysis-box {
        text-align: center;
    }    
</style>