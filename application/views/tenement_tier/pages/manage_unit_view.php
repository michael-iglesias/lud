<div class="row">
    <?php
        $capacity = (int) $unit_info['unit_details'][0]['tun_capacity'];
        $occupancies = (int) $unit_info['unit_details'][0]['Occupancies'];
        $available = $capacity - $occupancies;
    ?>
    
    <?php if($available != 0): ?>
    <div class="span2">
        <a data-toggle="modal" onclick="getPossibleRoommates(<?= $unit_info['unit_info'][0]['tun_id']; ?>);" href="#assignTenantsToUnit">Add Roommates</a>
    </div>    
    <div class="clearfix"></div>
    <?php endif; ?>
    
    
    <?php if($unit_tenants != NULL): ?>
        <?php foreach($unit_tenants as $t): ?>
        <div class="span2 building-box">
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
    <?php endif; ?>
    
</div>

<div class="row">
    
    <div class="span12">
        <div class="accordion huge" id="accordion2" style="font-weight: bold;">
            <div class="accordion-group"> 
                <div class="accordion-heading">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#maintenance" class="accordion-toggle collapsed">Maintenance Requests<span class="badge badge-inverse"><?= $unit_info['unit_details'][0]['Maintenance_Tickets']; ?></span></a>
                </div>
                <div class="accordion-body collapse" id="maintenance" style="height: 0px;">
                    <div class="accordion-inner">
                        <?php if($maintenance_requests == NULL): ?>
                        <center><h2>No Open Maintenance Requests</h2></center>
                        <?php else: ?>
                        <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
                            <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                                <thead>
                                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Last Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">First Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Platform(s): activate to sort column ascending">Phone #</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Engine version: activate to sort column ascending">Unit</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                                </thead>

                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    
                                    <?php foreach ($maintenance_requests as $row): ?>
                                        <tr>
                                            <td><?= ucfirst($row['mticket_status']); ?></td>
                                            <td><?= ucfirst($row['mticket_title']); ?></td>
                                            <td><?= $row['mticket_open_date']; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>            
            <div class="accordion-group"> 
                <div class="accordion-heading">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#packages" class="accordion-toggle collapsed">Packages<span class="badge badge-inverse"><?= $unit_info['unit_details'][0]['Pending_Packages']; ?></span></a>
                </div>
                <div class="accordion-body collapse" id="packages" style="height: 0px;">
                    <div class="accordion-inner">
                        <?php if($packages == NULL): ?>
                        <center><h2>No Packages</h2></center>
                        <?php else: ?>
                        <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
                            <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                                <thead>
                                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Last Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">First Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Platform(s): activate to sort column ascending">Phone #</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Engine version: activate to sort column ascending">Unit</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                                </thead>

                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    
                                    <?php foreach ($packages as $row): ?>
                                        <tr>
                                            <td><?= $row['pack_delivery_service']; ?></td>
                                            <td><?= $row['pack_item']; ?></td>
                                            <td><?= $row['pack_date_delivered']; ?></td>
                                            <td>asdf</td>
                                            <td>asdf</td>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="accordion-group"> 
                <div class="accordion-heading">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#passes" class="accordion-toggle collapsed">Guest Passes<span class="badge badge-inverse"><?= $unit_info['unit_details'][0]['Guest_Passes']; ?></span></a>
                </div>
                <div class="accordion-body collapse" id="passes" style="height: 0px;">
                    <div class="accordion-inner">
                        asdfasdfasdf
                    </div>
                </div>
            </div>
            
            <div class="accordion-group"> 
                <div class="accordion-heading">
                        <a data-toggle="collapse" onclick="insertAnalytics(<?= $unit_info['unit_info'][0]['tun_id']; ?>);" data-parent="#accordion2" href="#analytics" class="accordion-toggle collapsed">Analytics</a>
                </div>
                <div class="accordion-body collapse" id="analytics" style="height: 0px;">
                    <div class="accordion-inner">
                        
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

<!-- START TowerUnit Tenets Modal Window -->
<div id="assignTenantsToUnit" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Assign Tenants To Unit</h3>
    </div>
    <div id="tenantassignment-modal-body" class="modal-body">
        
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
    </div>
</div>
<!-- ***END TowerUnit Tenets Modal Window -->

<script src="<?= base_url();?>js/site/tenement.js"></script>
<!-- jQuery DataTable -->
<script src="<?= base_url(); ?>js/plugins/dataTables/jquery.datatables.min.js"></script>
<script>
        /* Default class modification */
        $.extend( $.fn.dataTableExt.oStdClasses, {
                "sWrapper": "dataTables_wrapper form-inline"
        } );

        /* API method to get paging information */
        $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
        {
                return {
                        "iStart":         oSettings._iDisplayStart,
                        "iEnd":           oSettings.fnDisplayEnd(),
                        "iLength":        oSettings._iDisplayLength,
                        "iTotal":         oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
                        "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
                };
        }

        /* Bootstrap style pagination control */
        $.extend( $.fn.dataTableExt.oPagination, {
                "bootstrap": {
                        "fnInit": function( oSettings, nPaging, fnDraw ) {
                                var oLang = oSettings.oLanguage.oPaginate;
                                var fnClickHandler = function ( e ) {
                                        e.preventDefault();
                                        if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                                                fnDraw( oSettings );
                                        }
                                };

                                $(nPaging).addClass('pagination').append(
                                        '<ul>'+
                                                '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                                                '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                                        '</ul>'
                                );
                                var els = $('a', nPaging);
                                $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
                                $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
                        },

                        "fnUpdate": function ( oSettings, fnDraw ) {
                                var iListLength = 5;
                                var oPaging = oSettings.oInstance.fnPagingInfo();
                                var an = oSettings.aanFeatures.p;
                                var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

                                if ( oPaging.iTotalPages < iListLength) {
                                        iStart = 1;
                                        iEnd = oPaging.iTotalPages;
                                }
                                else if ( oPaging.iPage <= iHalf ) {
                                        iStart = 1;
                                        iEnd = iListLength;
                                } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                                        iStart = oPaging.iTotalPages - iListLength + 1;
                                        iEnd = oPaging.iTotalPages;
                                } else {
                                        iStart = oPaging.iPage - iHalf + 1;
                                        iEnd = iStart + iListLength - 1;
                                }

                                for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                                        // Remove the middle elements
                                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                                        // Add the new list items and their event handlers
                                        for ( j=iStart ; j<=iEnd ; j++ ) {
                                                sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                                                $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                                                        .insertBefore( $('li:last', an[i])[0] )
                                                        .bind('click', function (e) {
                                                                e.preventDefault();
                                                                oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                                                                fnDraw( oSettings );
                                                        } );
                                        }

                                        // Add / remove disabled classes from the static elements
                                        if ( oPaging.iPage === 0 ) {
                                                $('li:first', an[i]).addClass('disabled');
                                        } else {
                                                $('li:first', an[i]).removeClass('disabled');
                                        }

                                        if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                                                $('li:last', an[i]).addClass('disabled');
                                        } else {
                                                $('li:last', an[i]).removeClass('disabled');
                                        }
                                }
                        }
                }
        });

        /* Show/hide table column */
        function dtShowHideCol( iCol ) {
                var oTable = $('#example-2').dataTable();
                var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
                oTable.fnSetColumnVis( iCol, bVis ? false : true );
        };

        /* Table #example */
        $(document).ready(function() {
                $('.datatable').dataTable( {
                        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
                        "sPaginationType": "bootstrap",
                        "oLanguage": {
                                "sLengthMenu": "_MENU_ records per page"
                        }
                });
                $('.datatable-controls').on('click','li input',function(){
                        dtShowHideCol( $(this).val() );
                })
        });
</script>
                
<style>
.building-box {padding: 10px; margin-bottom: 10px; text-align: center;}
</style>