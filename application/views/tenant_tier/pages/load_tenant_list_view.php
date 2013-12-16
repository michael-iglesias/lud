<div class="row span6">
<div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
            <?php if($tenant_items_list != NULL): ?>    
            <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                    <thead>
                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Item</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">Photo</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php foreach ($tenant_items_list as $row): ?>
                                <tr>
                                    <?php if($row['uappt_id'] != NULL): ?>
                                    <td style="text-align: center; font-weight: bold;"><?= ucfirst($row['uappt_title']); ?></td>
                                    <td style="text-align: center;"><img src="<?= base_url() . 'img/items/' . $row['uappt_image']; ?>" /></td>
                                    <?php else: ?>
                                    <td style="text-align: center; font-weight: bold;"><?= ucfirst($row['urua_title']); ?></td>
                                    <td style="text-align: center;"><img src="<?= $row['ura_image']; ?>" /></td>
                                    <?php endif; ?>
                                    <!-- If Tenant is Viewing his/her Own List Display Certain Options -->
                                    <td style="text-align: center; font-weight: bold; color: #FA9300;">
                                    <?php if($session_data['tnt_id'] == $view_list_tnt_id): ?>
                                    <a href="#">Remove From My List</a><br /><br />
                                    <a href="#" onclick="(<?= $row['tun_id']; ?>); return false;">Transfer To Group List</a>
                                    <?php else: ?>
                                    Actions here
                                    <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
            <!-- IF Tenant List is Empty, Display No Items Message -->
            <?php else: ?>
            <center><h3>No Items</h3></center>
            <?php endif; ?>
            <!-- ***END if $tenant_items_list != NULL -->
</div>
</div>