<div>
    <a href="#" onclick="loadNotificationUI2('home');">Select Different Audience</a>
</div>
<br />
<div id="selected-unit" style="display: none;">
    <h3></h3>
</div>

<div class="accordion" id="accordion2" style="font-weight: bold;">
    <?php $floor_count = ($tower_info[0]['tow_floor_count'] + 0); ?>
    <?php for($i = 1; $i <= $floor_count; $i++): ?>
        <div class="accordion-group"> 
                <div class="accordion-heading">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#floor<?= $i; ?>" class="accordion-toggle collapsed">Floor <?= $i; ?></a>
                </div>
                <div class="accordion-body collapse" id="floor<?= $i; ?>" style="height: 0px;">
                    <div class="accordion-inner">
                        <?php foreach($tower_units as $row): ?>
                            <?php if($row['tun_floor'] == $i): ?>
                                <div class="span3 building-box" style="margin-top: 15px; height: 140px;">
                                    <h4 style="text-align: center;">Room/Unit #: <?= $row['tun_number']; ?></h4>
                                    <ul class="unstyled">
                                        <li><span class="awe-caret-right"></span> Unit Capacity:&nbsp;&nbsp;<span style="color: red;"><?= $unit_capacity = $row['tun_capacity']; ?></span></li>
                                        <li><span class="awe-caret-right"></span> Unit Vacancies:&nbsp;&nbsp;<span style="color: green;"><?= $unit_tenants = $row['tun_capacity'] - $row['Occupancies']; ?></span></li>
                                    </ul>
                                    <center><a href="#" class="btn btn-wuxia btn-warning" onclick="selectUnit(<?= $row['tun_id']; ?>, <?= $row['tun_number']; ?>);">Notify Unit</a></center>

                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
    <?php endfor; ?>
</div>
