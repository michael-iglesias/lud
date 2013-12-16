<div class="row">
    <div class="span12">
        <a href="#addBuildingModal" data-toggle="modal" class="btn btn-wuxia btn-warning">Add Building</a>
    </div>
    <?php if($tenement_towers != FALSE): ?>
        <?php foreach($tenement_towers as $row): ?>
            <div class="span4 building-box" style="text-align: center;">
                <h1>Building: <?= $row['tow_name']; ?></h1>
                <ul>
                    <li># of Units: <?= $row['tow_units_per_floor'] * $row['tow_floor_count']; ?></li>
                    <li># of Units With Vacancies: 
                        <?php if($row['units_with_vacancies'] != 0): ?>
                            <span style="color: green; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                        <?php else: ?>
                            <span style="color: red; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                        <?php endif; ?>
                    </li>
                </ul>
                <a class="btn btn-wuxia btn-warning" href="<?= base_url(); ?>index.php/tenement/manage_building/<?= $row['tow_id']; ?>">Manage Building</a>
                <p>&nbsp;</p>
            </div>    
        <?php endforeach; ?>
    <?php else: ?>
    <div class="span12"><h1>Property Has Not Added Any Buildings</h1></div>
    
    <?php endif; ?>
</div>

<div id="addBuildingModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Add Building</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
        <fieldset>
            <div class="control-group">
                <label for="input" class="control-label">Building # or Building Name</label>
                <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="45" id="building-name">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label"># of Floors</label>
                <div class="controls">
                        <input type="text" value="1" class="input-xlarge num-spinner-input" id="building-floor-count">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label"># of Units Per Floor</label>
                <div class="controls">
                        <input type="text" value="1" class="input-xlarge num-spinner-input" id="building-units-per-floor">
                </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
            <a class="btn btn-wuxia btn-primary" href="#" onclick="addBuilding();">Add Building</a>
    </div>
</div>
<script type="text/javascript" src="http://http://jqueryui.com/resources/demos/external/jquery.mousewheel.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="<?= base_url();?>js/site/tenement.js"></script>
<script type="text/javascript"> 
    
$('.num-spinner-input').spinner({
    min: 1,
    max: 65535,
    step: 1
});    
</script>
<style type="text/css">
    .ui-spinner-button:hover {cursor: pointer;}
</style>