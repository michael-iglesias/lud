<script type="text/javascript">
    var Keen=Keen||{configure:function(e){this._cf=e},addEvent:function(e,t,n,i){this._eq=this._eq||[],this._eq.push([e,t,n,i])},setGlobalProperties:function(e){this._gp=e},onChartsReady:function(e){this._ocrq=this._ocrq||[],this._ocrq.push(e)}};(function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src=("https:"==document.location.protocol?"https://":"http://")+"dc8na2hxrj29i.cloudfront.net/code/keen-2.1.0-min.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();

    // Configure the Keen object with your Project ID and (optional) access keys.
    Keen.configure({
        projectId: "52b3bce536bf5a240d000000",
        readKey: "3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78"    // required for doing analysis
    });
    
    (function() {
        loadNarrowedAnalytics('impressions', '<?= $timeframe; ?>', 'building');
    })();
</script>
<script type="text/javascript">
Keen.onChartsReady(function() {
    // COUNTER
    var metricImpressionsToday = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "<?= $timeframe; ?>",
        targetProperty: "keen.id"
    });
    // Initialize Number Display For Total Impressions Today
    var visualImpressionsToday = new Keen.Number(metricImpressionsToday, {
        label: "Total Page Impressions",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });
    
    // Unique Tenant Visits COUNTER
    var metricImpressionsTodayUnique = new Keen.Metric("impressions", {
        analysisType: "count_unique",
        timeframe: "<?= $timeframe; ?>",
        targetProperty: "tntID"
    });
    // Initialize Number Display For Total Unique Tenant Imppressions For Today
    var visualImpressionsTodayUnique = new Keen.Number(metricImpressionsTodayUnique, {
        label: "Unique Tenant Visits",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });

    // Unique Unit Visits COUNTER
    var metricImpressionsTodayUniqueUnit = new Keen.Metric("impressions", {
        analysisType: "count_unique",
        timeframe: "<?= $timeframe; ?>",
        targetProperty: "tunID"
    });
    // Initialize Number Display For Total Unique Unit Imppressions For Today
    var visualImpressionsTodayUniqueUnit = new Keen.Number(metricImpressionsTodayUniqueUnit, {
        label: "Unique Unit Visits",
        "number-background-color": "#78CC80",
        "label-background-color": "#98D19E"
    });
    
// PIECHART
    var metricImpressionsTodayPieChart = new Keen.Metric("impressions", {
        analysisType: "count",
        timeframe: "<?= $timeframe; ?>",
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
        timeframe: "<?= $timeframe; ?>",
        interval: "<?php if($timeframe != 'today') { echo 'daily'; } else { echo 'hourly'; } ?>",
        targetProperty: "page",
        groupBy: "page"
    });
    
    
    // Draw Elements
    visualImpressionsToday.draw(document.getElementById("impression_count_today_analysis"));
    visualImpressionsTodayUnique.draw(document.getElementById("impression_count_today_unique_analysis"));
    visualImpressionsTodayUniqueUnit.draw(document.getElementById("impression_count_today_unique_unit_analysis"));
    visualImpressionsTodayPieChart.draw(document.getElementById("impression_count_today_analysis_piechart"));
    visualImpressionsTodayLineChart.draw(document.getElementById("impression_count_today_analysis_linechart"));
    
});
</script>

<div class="span6">
<h1> 
    <?php
        if($timeframe == 'today') {
            echo 'Today';
        } else if($timeframe == 'last_7_days') {
            echo 'Last 7 Days';
        } else if($timeframe == 'last_30_days') {
            echo 'Last 30 Days';
        } else if($timeframe == 'last_90_days') {
            echo 'Last 90 Days';
        } else if($timeframe == 'this_100_years') {
            echo 'All-Time';
        }
    ?>
</h1>
</div>
<div class="clearfix"></div>

<div class="span4" id="impression_count_today_analysis"></div>
<div class="span4" id="impression_count_today_unique_analysis"></div>
<div class="span4" id="impression_count_today_unique_unit_analysis"></div>

<div class="span6" id="top5towers">
    <section>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Building</th>
            <th>Total # of Impressions</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($top5TowersByImpressions as $row): ?>
            <tr>
                <th><?= $i; ?></th>
                <td style="text-align: center;">Building <?= $row['info'][0]['tow_name']; ?></td>
                <td style="text-align: center;"><?= $row['impressions']; ?></td>
                <td style="text-align: center;"><a onclick="loadNarrowedAnalytics('impressions', 'last_7_days', 'building');" href="#top5towers<?= $row['info'][0]['tow_id']; ?>">View Building</a></td>
            </tr>
            <?php $i += 1; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    </section>
</div>

<div class="span6" id="top5units">
    <section>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Unit #</th>
            <th>Total # of Impressions</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php  $i = 1; ?>
        <?php foreach($top5UnitsByImpressions as $r): ?>
            <tr>
                <th><?= $i; ?></th>
                <td style="text-align: center;"><?= $r['info']['unit_info'][0]['tun_number']; ?></td>
                <td style="text-align: center;"><?= $r['impressions']; ?></td>
                <td style="text-align: center;"><a href="#top5units<?= $r['info']['unit_info'][0]['tun_id']; ?>">View Building</a></td>
            </tr>
            <?php $i += 1; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    </section>
</div>

<div id="breakdown-by-buildings" class="span12" style="background: #f9f9f9;"></div>



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
<style>
    table tbody tr td, table tbody tr th {text-align: center;}    
</style>