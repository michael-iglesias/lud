


<div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
    <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
        <thead>
                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">First Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">Last Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Platform(s): activate to sort column ascending">View Profile</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Engine version: activate to sort column ascending">Assign To Unit</th></tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">

            <?php foreach ($tenants as $row): ?>
                <tr>
                    <td><?= ucfirst($row['First Name']); ?></td>
                    <td><?= ucfirst($row['Last Name']); ?></td>
                    <td style="text-align: center;"><a href="<?= base_url(); ?>index.php/tenement/view_tenant/<?= $row['tnt_id']; ?>">View</a></td>
                    <td style="text-align: center;"><button class="btn btn-wuxia btn-warning btn-mini" onclick="assignTenantToUnit(<?= $row['tnt_id']; ?>, <?= $tun_id; ?>, null);">Assign</button></td>
                    
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
</div>

