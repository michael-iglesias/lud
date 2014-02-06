<div class="row">
    <div class="span12">
        <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
            <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                <thead>
                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Last Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">First Name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Platform(s): activate to sort column ascending">Phone #</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Engine version: activate to sort column ascending">Unit</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php if($tenant_list != NULL): ?>
                        <?php foreach ($tenant_list as $row): ?>
                            <tr>
                                <td><?= ucfirst($row['tnt_lname']); ?></td>
                                <td><?= ucfirst($row['tnt_fname']); ?></td>
                                <td><?= $row['tnt_phone']; ?></td>
                                <td style="text-align: center;">
                                    <?php if($row['lease_id'] == NULL): ?>
                                        Pending Unit Assignment
                                    <?php else: ?>
                                        <?= 'Building: ' . $row['tow_name'] . '<br />Unit: '  . $row['tun_number'] . '<br />Unit Bedroom: ' . $row['urm_room_number']; ?>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center; font-weight: bold; color: #FA9300;">
                                    <a href="<?= base_url(); ?>index.php/tenement/view_tenant/<?= $row['tnt_id']; ?>">View Tenant Profile</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="<?= base_url(); ?>index.php/tenement/tenants" onclick="deleteTenant(<?= $row['tnt_id']; ?>); return false;">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
        </div>
    </div>
</div>
<div id="addTenantModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Add Tenant</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder-emp"></div>
        <fieldset>
            <div class="control-group">
                <label for="input" class="control-label">Tenant First Name</label>
                <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="45" id="tnt-fname">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label">Tenant Last Name</label>
                <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="45" id="tnt-lname">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label">Tenant Email</label>
                <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="45" id="tnt-email">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label">Tenant Phone #</label>
                <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="10" id="tnt-phone">
                </div>
            </div>
            
        </fieldset>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
            <a class="btn btn-wuxia btn-primary" href="#" onclick="addTenant();">Add Tenant</a>
    </div>
</div>


		<!-- Scripts -->
		<script src="<?= base_url(); ?>js/navigation.js"></script>
                <script src="<?= base_url(); ?>js/site/tenement.js"></script>
		<!-- Bootstrap scripts -->
		<!--
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-tab.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-button.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-collapse.js"></script>
		<script src="<?= base_url(); ?>js/bootstrap/bootstrap-transition.js"></script>
		-->
		
		
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