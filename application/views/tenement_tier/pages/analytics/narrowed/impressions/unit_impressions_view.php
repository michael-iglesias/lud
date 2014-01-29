
    <div class="span11">
        <h3>Building: <?= $tower_info[0]['tow_name']; ?></h3>
        <div class="accordion huge" id="accordion2" style="font-weight: bold;">
            
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
                                    <?php $id = $row['tun_id']; ?>
                                    <div class="span3 building-box" style="margin-top: 15px; text-align: center;">
                                        <h4 style="text-align: center;">Room/Unit #: <?= $row['tun_number']; ?></h4>

                                        <span style="background-color: #FA9300; padding: 4px; font-size: 15px; color: white; border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px;"><?= round((float)($tower_unit_analytics[$id]['unit_total_impressions'] / $building_total_impressions) * 100 ) . '%'; ?></span><br />
                                        <span style="margin-top: 4px; font-size: 11px;">Of Total Building Impressions</span>
                                        <hr />

                                        <span style="background-color: #FA9300; padding: 4px; font-size: 15px; color: white; border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px;"><?php  if($tower_unit_analytics[$id]['unit_total_unique_tenant_visitors']) { echo $tower_unit_analytics[$id]['unit_total_unique_tenant_visitors'];} else {echo 0;} ?></span><br />
                                        <span style="margin-top: 4px; font-size: 11px;"># Of Unique Tenants</span>
                                        
                                        <br />
                                        <button onclick="loadNarrowedAnalytics('impressions', 'today', 'unit_tenants', <?= $row['tun_id']; ?>);" style="margin-top: 7px; margin-bottom: 5px;" class="btn btn-wuxia btn-mini btn-warning">Impressions By Tenant</button>
                                        
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>


