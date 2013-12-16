<div class="row">
    <?php foreach($message as $row): ?>
    <div class="pm-container">
        <div class="span3">
            <?php if($row['tnt_avatar'] == NULL): ?>
                <img src="<?= base_url(); ?>img/sample_content/sample-image-250x150.png" width="125" height="100" />
            <?php else: ?>
                <img src="<?= base_url() . 'uploadedmedia/tenant/avatars/tenant' . $row['pm_author_tnt_id'] . '/' . $row['tnt_avatar']; ?>" width="250" height="150" />
            <?php endif; ?>
            <h4><?= $row['tnt_fname'] . ' ' . $row['tnt_lname']; ?></h4>
        </div>
        <div class="span9">
            <div class="building-box" style="width: 100%;">
                <?= $row['pm_message']; ?>
            </div>
            <br />
            <a href="#" class="btn btn-wuxia btn-warning">Reply</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>