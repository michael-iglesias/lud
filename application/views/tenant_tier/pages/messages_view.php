<!-- Tab #inbox -->
<div class="tab-pane active" id="inbox">
    <div class="row">
    <div class="span6">
        <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
            <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                <thead>
                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">From</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">Sent</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">

                    <?php if($private_messages != NULL): ?>
                        <?php foreach ($private_messages as $row): ?>
                            <?php if($row['pm_read'] == 'no'): ?>
                            <tr style="font-weight: bold;">
                            <?php else: ?>    
                            <tr>
                            <?php endif; ?>
                                <td style="text-align: center;">
                                    <h4><?= $row['tnt_fname'] . ' ' . $row['tnt_lname']; ?></h4>
                                </td>
                                <td style="text-align: center;"><?= $row['pm_date']; ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= base_url(); ?>index.php/tenant/view_message/<?= $row['pm_id']; ?>">View </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="#">Delete</a>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <center><h3>No Messages</h3></center>
                    <?php endif; ?>
                </tbody>
            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
        </div>
    </div>
    </div>
</div>
<!-- Tab #inbox -->
					
<!-- Tab #groupmessage -->
<div class="tab-pane" id="groupmessage">
    <div class="row">
        zz
    </div>
</div>
<!-- Tab #groupmessage -->

<!-- Scripts -->
<script src="<?= base_url(); ?>js/navigation.js"></script>

<!-- Bootstrap scripts -->
<!--
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-tooltip.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-dropdown.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-tab.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-button.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-alert.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-popover.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-collapse.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-modal.js"></script>
<script src="<?= base_url(); ?>js/bootstrap/bootstrap-transition.js"></script>
-->
<script src="<?= base_url(); ?>js/bootstrap/bootstrap.js"></script>

<!-- jQuery Snippet -->
<script src="<?= base_url(); ?>js/plugins/snippet/jquery.snippet.min.js"></script>

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
            });
            $('#example_length').hide();
            



            $('.typeahead').typeahead();
    });
</script>

<style type="text/css">
    .pm-container .span3 {text-align: center;}
</style>