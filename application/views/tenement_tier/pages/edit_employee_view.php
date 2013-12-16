<div class="row">
    <div class="span12">
        <form enctype="multipart/form-data" method="post" action="<?= base_url() . 'index.php/tenement/upload_employee_avatar'; ?>" style="background: none;">
            <input type="hidden" name="temp_id" value="<?= $employee_info[0]['temp_id']; ?>" />
            <div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden" value="" name="">
                <h4>Employee Picture</h4>
                <div class="fileupload-new fileupload-large thumbnail">
                    <?php if($employee_info[0]['temp_avatar'] != NULL): ?>
                        <img src="<?= base_url() . 'uploadedmedia/employee/avatars/temp' . $employee_info[0]['temp_id'] . '/' . $employee_info[0]['temp_avatar']; ?>" width="250" height="150" />
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
    <hr />
    <div class="span12">
        <form method="post" action="<?= base_url(); ?>index.php/tenement/update_employee">
            <input type="hidden" name="temp_id" value="<?= $employee_info[0]['temp_id']; ?>" />
            <fieldset>
                <div class="control-group">
                    <label for="input" class="control-label">Employee First Name</label>
                    <div class="controls">
                            <input type="text" value="<?= $employee_info[0]['temp_fname']; ?>" class="input-xlarge" maxlength="45" id="temp-fname" name="temp-fname">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Employee Last Name</label>
                    <div class="controls">
                            <input type="text" value="<?= $employee_info[0]['temp_lname']; ?>" class="input-xlarge" maxlength="45" id="temp-lname" name="temp-lname">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Employee Email</label>
                    <div class="controls">
                            <input type="text" value="<?= $employee_info[0]['temp_email']; ?>" class="input-xlarge" maxlength="45" id="temp-email" name="temp-email">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Employee Phone #</label>
                    <div class="controls">
                            <input type="text" value="<?= $employee_info[0]['temp_phone']; ?>" class="input-xlarge" maxlength="10" id="temp-phone" name="temp-phone">
                    </div>
                </div>
                <div class="control-group">
                    <label for="input" class="control-label">Employee Position</label>
                    <div class="controls">
                        <?php
                            $options = array(
                                '' => 'Pick Employee Role',
                                'administrator' => 'Administrator',
                                'moderator' => 'Moderator',
                                'maintenance' => 'Maintenance'
                            );
                            $id = 'id="temp-position"';
                            echo form_dropdown('temp-position', $options, $employee_info[0]['temp_position'], $id);
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-wuxia btn-warning" value="Update Employee" />
                </div>
            </fieldset>
        </form>
    </div>
</div>





<!-- Fileupload and Inputmask plugin -->
<script src="<?= base_url(); ?>js/plugins/fileupload/bootstrap-fileupload.js"></script>
<script src="<?= base_url(); ?>js/plugins/inputmask/bootstrap-inputmask.js"></script>
