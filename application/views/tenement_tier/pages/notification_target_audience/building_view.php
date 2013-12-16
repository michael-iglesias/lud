<div>
    <a href="#" onclick="loadNotificationUI2('home');">Select Different Audience</a>
</div>
<br />

<div id="selected-building" style="display: none;">
    <h3></h3>
</div>
<div id="building-list">
    <?php if($tenement_towers != FALSE): ?>
        <?php foreach($tenement_towers as $row): ?>
            <div class="span2 building-box" style="text-align: center;">
                <h3>Building: <?= $row['tow_name']; ?></h3>
                <ul style="list-style-type: none; text-align: center; margin-left: 0px;">
                    <li># of Units: <?= $row['tow_units_per_floor'] * $row['tow_floor_count']; ?></li>
                </ul>
                <p style="margin-bottom: -15px;">&nbsp;</p>
                <?php if($audience == 'tower'): ?>
                    <a class="btn btn-wuxia btn-warning" onclick="selectBuilding(<?= $row['tow_id']; ?>, <?= $row['tow_name']; ?>);" href="#">Select Building</a>
                <?php else: ?>
                    <a class="btn btn-wuxia btn-warning" onclick="loadUnitSelection(<?= $row['tow_id']; ?>);" href="#">Select Building</a>
                <?php endif; ?>
                <p>&nbsp;</p>
            </div>    
        <?php endforeach; ?>
    <?php else: ?>
    <div class="span12"><h1>Property Has Not Added Any Buildings</h1></div>

    <?php endif; ?>
</div>