<div class="row">
    <div class="span7">
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
                                        <div class="span3 building-box" style="margin-top: 15px; height: 190px;">
                                            <h4 style="text-align: center;">Room/Unit #: <?= $row['tun_number']; ?></h4>
                                            <ul class="unstyled">
                                                <li><span class="awe-caret-right"></span> Unit Capacity:&nbsp;&nbsp;<span style="color: red;"><?= $unit_capacity = $row['tun_capacity']; ?></span></li>
                                                <li><span class="awe-caret-right"></span> Unit Vacancies:&nbsp;&nbsp;<span style="color: green;"><?= $unit_tenants = $row['tun_capacity'] - $row['Occupancies']; ?></span></li>
                                                <li><span class="awe-caret-right"></span> Packages:&nbsp;&nbsp;<?= $row['Pending_Packages']; ?></li>
                                                <li><span class="awe-caret-right"></span> Open Maintenance Tickets:&nbsp;&nbsp;<?= $row['Maintenance_Tickets']; ?></li>
                                                <li></li>
                                                <?php if($row['Occupancies'] == $unit_capacity): ?>
                                                <center><a href="<?= base_url(); ?>index.php/tenement/manage_unit/<?= $row['tun_id']; ?>" class="btn disabled btn-wuxia btn-warning">Assign To Unit</a></center>
                                                <?php else: ?>
                                                <center><a href="#" class="btn btn-wuxia btn-warning" onclick="assignTenantToUnit(<?= $tnt_id; ?>, <?= $row['tun_id']; ?>, <?= $row['tun_number']; ?>);">Assign To Unit</a></center>
                                                <?php endif; ?>
                                            </ul>
                                            
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                </div>
            
            
            <?php endfor; ?>
        </div>
    
    </div>
</div>

<!-- START TowerUnit Tenets Modal Window -->
<div id="unitoccupanciesmodal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Room/Unit #: <span id="unit-occupancies-modaltitle"></span> Tenants</h3>
    </div>
    <div id="unitoccupancies-modal-body" class="modal-body">
        
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
    </div>
</div>
<!-- ***END TowerUnit Tenets Modal Window -->

<script src="<?= base_url();?>js/site/tenement.js"></script>