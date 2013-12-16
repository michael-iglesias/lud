<div class="row">
    <div class="span6">
        <form enctype="multipart/form-data" method="post" action="<?= base_url() . 'index.php/tenement/upload_tenant_avatar'; ?>" style="background: none;">
            <input type="hidden" name="tnt_id" value="<?= $tenant_info[0]['tnt_id']; ?>" />
            <div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden" value="" name="">
                <h4>Tenant Picture</h4>
                <div class="fileupload-new fileupload-large thumbnail">
                    <?php if($tenant_info[0]['tnt_avatar'] != NULL): ?>
                        <img src="<?= base_url() . 'uploadedmedia/tenant/avatars/tenant' . $tenant_info[0]['tnt_id'] . '/' . $tenant_info[0]['tnt_avatar']; ?>" width="250" height="150" />
                    <?php else: ?>
                        <img src="<?= base_url(); ?>img/sample_content/sample-image-250x150.png">
                    <?php endif; ?>
                </div>
                <!-- START New Personal Picture Form Upload -->
                <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail" style=""></div>
                <div>
                        <span class="btn btn-alt btn-file">
                                <span class="fileupload-new">Select image</span>
                                <span class="fileupload-exists">Change</span>
                                <input type="file" name="userfile">

                        </span>
                        <span class="fileupload-exists"><input type="submit" class="btn btn-success" value="Upload New Photo" /></span>
                        <a href="#" data-dismiss="fileupload" class="btn btn-alt btn-danger fileupload-exists">Remove</a>

                </div>
            </div>
        </form>
    </div>
    <!-- ***END Tenant Avatar Div -->
    
    <!-- START User Personality Profile -->
    <div class="span5 well" style="text-align: center;">
        <div class="control-group">
            <label for="input" class="control-label">Tenant Unit Assigned</label>
            <div class="controls">
                <?php if($tenant_info[0]['lease_id'] == NULL): ?>
                    Pending Unit Assignment
                <?php else: ?>
                    <?= 'Building: ' . $tenant_info[0]['tow_name'] . '<br />Unit: '  . $tenant_info[0]['tun_number'] . '<br />Unit Bedroom: ' . $tenant_info[0]['urm_room_number']; ?>
                <?php endif; ?>
                    <hr style="border: none; margin-top: 0px;" />
                    <p><a href="#unitAssignModal" class="btn btn-wuxia btn-warning" data-toggle='modal'>Assign To Unit</a></p>
            </div>
        </div>
    </div>
    <!-- ***END User Personality Profile -->
    
    <div class="clearfix"></div>
    <div class="span6">
        <form method="post" action="<?= base_url(); ?>index.php/tenement/update_tenant">
            <input type="hidden" name="tnt_id" value="<?= $tenant_info[0]['tnt_id']; ?>" />
            <fieldset>
                <div class="control-group">
                    <label for="input" class="control-label">Tenant First Name</label>
                    <div class="controls">
                            <input type="text" value="<?= $tenant_info[0]['tnt_fname']; ?>" class="input-xlarge" maxlength="45" id="tnt-fname" name="tnt-fname">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Tenant Last Name</label>
                    <div class="controls">
                            <input type="text" value="<?= $tenant_info[0]['tnt_lname']; ?>" class="input-xlarge" maxlength="45" id="tnt-lname" name="tnt-lname">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Tenant Email</label>
                    <div class="controls">
                            <input type="text" value="<?= $tenant_info[0]['tnt_email']; ?>" class="input-xlarge" maxlength="45" id="tnt-email" name="tnt-email">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Tenant Phone #</label>
                    <div class="controls">
                            <input type="text" value="<?= $tenant_info[0]['tnt_phone']; ?>" class="input-xlarge" maxlength="10" id="tnt-phone" name="tnt-phone">
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-wuxia btn-warning" value="Update Tenant" />
                </div>
            </fieldset>
        </form>
    </div>
</div>

<div id="unitAssignModal" class="modal fade hide" style="display: none; width: 700px;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Assign To Unit</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
            <?php if($tenement_towers != FALSE): ?>
                <?php foreach($tenement_towers as $row): ?>
                    <div class="span3 building-box" style="text-align: center;">
                        <h3>Building: <?= $row['tow_name']; ?></h3>
                        <ul style="list-style-type: none;">
                            <li># of Units: <?= $row['tow_units_per_floor'] * $row['tow_floor_count']; ?></li>
                            <li># of Units With Vacancies: 
                                <?php if($row['units_with_vacancies'] != 0): ?>
                                    <span style="color: green; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                                <?php else: ?>
                                    <span style="color: red; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <p> </p>
                        <a class="btn btn-wuxia btn-warning" onclick="loadBuildingForTenantAddition(<?= $row['tow_id']; ?>, <?= $tenant_info[0]['tnt_id']; ?>); return false;" href="#">Manage Building</a>
                        <p>&nbsp;</p>
                    </div>    
                <?php endforeach; ?>
            <?php else: ?>
            <div class="span12"><h1>Property Has Not Added Any Buildings</h1></div>

            <?php endif; ?>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
    </div>
</div>

<!-- Fileupload and Inputmask plugin -->
<script src="<?= base_url(); ?>js/plugins/fileupload/bootstrap-fileupload.js"></script>
<script src="<?= base_url(); ?>js/plugins/inputmask/bootstrap-inputmask.js"></script>
<script src="<?= base_url(); ?>js/site/tenement.js"></script>