<style>
    .select-box {
        text-align: center;
        border: 2px solid #FA9300;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        cursor: pointer;
    }
</style>
<div class="row">
    
    <div id="selection-menu">
        <div class="span12"><h1>Select Time Frame:</h1></div>
        <div class="span2 select-box" onclick="loadNarrowedAnalytics('impressions', 'today', 'summary');">
            <h3><span>Today</span></h3>
        </div>

        <div class="span2 select-box" onclick="loadNarrowedAnalytics('impressions', 'last_7_days', 'summary');">
            <h3><span onclick="">Last 7 Days</span></h3>
        </div>

        <div class="span2 select-box" onclick="loadNarrowedAnalytics('impressions', 'last_30_days', 'summary');">
            <h3>Last 30 Days</h3>
        </div>

        <div class="span2 select-box" onclick="loadNarrowedAnalytics('impressions', 'last_90_days', 'summary');">
            <h3>Last 90 Days</h3>
        </div>

        <div class="span2 select-box" onclick="loadNarrowedAnalytics('impressions', 'this_100_years', 'summary');">
            <h3>All-time</h3>
        </div>
    </div>
    
    <div id="analytics-insert-here"></div>
    
    
</div>