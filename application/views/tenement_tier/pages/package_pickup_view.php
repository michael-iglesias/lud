<!-- Page header -->
<div class="page-header">
    <h1><span class="<?= $page_header_icon; ?>"></span> <?= $page_header_title; ?></h1>
    <ul class="page-header-actions">
        <li><a href="<?= base_url(); ?>index.php/tenement/package_logging" class="btn btn-wuxia">Log Packages</a></li>
        <li class="active"><a href="#pickup" class="btn btn-wuxia">Pending Pickups</a></li>
    </ul>
</div>
<!-- /Page header -->

<!-- Page container -->
<div class="page-container tab-content">
    <div class="tab-pane active" id="pickup">
        <h2>Pending Pickup:</h2>
        <br />
        <div id="package-delivered-alert" class="alert alert-success hide">
            <strong>Package Delivered!</strong> You have successfully updated this package as being Delivered/Picked up.
        </div>
        <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
            <table id="package-pickup" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                <thead>
                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">First Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">Last Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Platform(s): activate to sort column ascending">Unit #</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Engine version: activate to sort column ascending">Package Info</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php if($pending_pickups != NULL): ?>
                        <?php foreach ($pending_pickups as $row): ?>
                            <tr>
                                <td><?= ucfirst($row['tnt_fname']); ?></td>
                                <td><?= ucfirst($row['tnt_lname']); ?></td>
                                <td style="text-align: center;"><?= $row['tun_number']; ?></td>
                                <td style="text-align: center;">
                                    Service: <?= $row['pack_delivery_service']; ?><br />
                                    Type: <?= $row['pack_item']; ?><br />
                                    Tracking #: <?= $row['pack_tracking_number']; ?><br />
                                </td>
                                <td style="text-align: center; font-weight: bold; color: #FA9300;">
                                    <span onclick="markPackageDelivered(<?= $row['pack_id']; ?>, this);" class="btn btn-wuxia btn-primary remove-btn" type="submit">Mark as Delivered</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
        </div>
    </div>
    
    
</div>

<style>
    table tbody {
        font-weight: bold;
    }
</style>
<!-- jQuery DataTable -->
<script src="http://localhost/LetUsDorm/js/plugins/dataTables/jquery.datatables.min.js"></script>
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
            });
            $('.datatable remove-btn').click(function() {
                $(this).fnDeleteRow($(this).closest('tr'));
            });
    });
</script>