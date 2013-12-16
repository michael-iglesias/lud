<?php foreach($tenants as $row): ?>
<div class="building-box" style="padding: 10px; margin-bottom: 10px;">
    <h4>Bedroom #<?php echo $row['urm_room_number']; if($row['urm_master'] == 'yes') { echo '  <span style="color: #FA9300">{Master}</span>'; } ?> </h4>
    <div>
        <?php if($row['tnt_avatar'] == NULL): ?>
            <img src="<?= base_url(); ?>img/sample_content/sample-image-250x150.png" width="125" height="100" />
        <?php else: ?>
            <img src="<?= base_url() . 'uploadedmedia/tenant/avatars/tenant' . $row['tnt_id'] . '/' . $row['tnt_avatar']; ?>" width="250" height="150" />
        <?php endif; ?>
    </div>
    <h5><?= ucfirst($row['tnt_fname']) . ' ' . ucfirst($row['tnt_lname']); ?></h5>
    <a href="<?= base_url(); ?>index.php/tenement/view_tenant/<?= $row['tnt_id']; ?>" class="btn btn-wuxia btn-warning">View Tenant Profile</a>
</div>
<?php endforeach; ?>
