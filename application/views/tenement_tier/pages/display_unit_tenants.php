<?php foreach($tenants as $t): ?>
<div class="building-box" style="padding: 10px; margin-bottom: 10px;">
    <h4>Bedroom #<?php echo $t['urm_room_number']; if($t['urm_master'] == 'yes') { echo '  <span style="color: #FA9300">{Master}</span>'; } ?> </h4>
    <div>
        <?php if($t['tnt_avatar'] == NULL): ?>
            <img src="<?= base_url(); ?>img/sample_content/sample-image-250x150.png" width="125" height="100" />
        <?php else: ?>
            <img src="<?= base_url() . 'uploadedmedia/tenant/avatars/tenant' . $t['tnt_id'] . '/' . $t['tnt_avatar']; ?>" width="250" height="150" />
        <?php endif; ?>
    </div>
    <h5><?= ucfirst($t['tnt_fname']) . ' ' . ucfirst($t['tnt_lname']); ?></h5>
    <a href="<?= base_url(); ?>index.php/tenement/view_tenant/<?= $t['tnt_id']; ?>" class="btn btn-wuxia btn-warning">View Tenant Profile</a>
</div>
<?php endforeach; ?>
