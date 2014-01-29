<div class="span11">
    <h3>Breakdown By Buildings:</h3>
    <?php foreach($tower_data as $td): ?>
        <div class="span3 building-box" style="text-align: center;">
            <h2><span class="awe-table"></span> &nbsp;Building: <?= $td['tow_name']; ?></h2>
            <h6>Impression Page Count: <?= $td['impressions']; ?></h6>
            <h6><?= round((float)($td['impressions'] / $total_impressions) * 100 ) . '%'; ?> Of Total Impressions</h6>
            <button onclick="loadNarrowedAnalytics('impressions', '<?= $timeframe; ?>', 'unit', <?= $td['tow_id']; ?>);" class="btn btn-mini btn-wuxia btn-warning">Impressions By Unit</button><br /><br />
        </div>

    <?php endforeach; ?>
    <div class="clearfix"></div><br />
</div>
<style>
    .analysis-box {
        text-align: center;
    }    
</style>