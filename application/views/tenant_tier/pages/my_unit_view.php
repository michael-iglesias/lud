<script src="http://static.opentok.com/v1.1/js/TB.min.js" ></script>
<script type="text/javascript" charset="utf-8">
		var apiKey = "24503601"; // Replace with your API key. See https://dashboard.tokbox.com/projects
		var sessionId = "<?= $session_data['tun_opentok_session']; ?>"; // Replace with your own session ID. See https://dashboard.tokbox.com/projects
		var token = "<?= $session_data['opentok_token']; ?>"; // Replace with a generated token. See https://dashboard.tokbox.com/projects
		
		var session;
		var publisher;
		var subscribers = {};
		var VIDEO_WIDTH = 170;
		var VIDEO_HEIGHT = 230;

		TB.addEventListener("exception", exceptionHandler);
		
		// Un-comment the following to set automatic logging:
		// TB.setLogLevel(TB.DEBUG);

		if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) {
			alert("You don't have the minimum requirements to run this application."
				  + "Please upgrade to the latest version of Flash.");
		} else {
			session = TB.initSession(sessionId);	// Initialize session

			// Add event listeners to the session
			session.addEventListener('sessionConnected', sessionConnectedHandler);
			session.addEventListener('sessionDisconnected', sessionDisconnectedHandler);
			session.addEventListener('connectionCreated', connectionCreatedHandler);
			session.addEventListener('connectionDestroyed', connectionDestroyedHandler);
			session.addEventListener('streamCreated', streamCreatedHandler);
			session.addEventListener('streamDestroyed', streamDestroyedHandler);
		}

		//--------------------------------------
		//  LINK CLICK HANDLERS
		//--------------------------------------

		/*
		If testing the app from the desktop, be sure to check the Flash Player Global Security setting
		to allow the page from communicating with SWF content loaded from the web. For more information,
		see http://www.tokbox.com/opentok/build/tutorials/helloworld.html#localTest
		*/
		function connect() {
			session.connect(apiKey, token);
		}

		function disconnect() {
			session.disconnect();
			hide('disconnectLink');
			hide('publishLink');
			hide('unpublishLink');
		}

		// Called when user wants to start publishing to the session
		function startPublishing() {
			if (!publisher) {
				var parentDiv = document.getElementById("myCamera");
				var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
				publisherDiv.setAttribute('id', 'opentok_publisher');
				parentDiv.appendChild(publisherDiv);
				var publisherProps = {width: VIDEO_WIDTH, height: VIDEO_HEIGHT};
				publisher = TB.initPublisher(apiKey, publisherDiv.id, publisherProps);  // Pass the replacement div id and properties
				session.publish(publisher);
				show('unpublishLink');
				hide('publishLink');
			}
		}

		function stopPublishing() {
			if (publisher) {
				session.unpublish(publisher);
			}
			publisher = null;

			show('publishLink');
			hide('unpublishLink');
		}

		//--------------------------------------
		//  OPENTOK EVENT HANDLERS
		//--------------------------------------

		function sessionConnectedHandler(event) {
			// Subscribe to all streams currently in the Session
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}
			show('disconnectLink');
			show('publishLink');
			hide('connectLink');
		}

		function streamCreatedHandler(event) {
			// Subscribe to the newly created streams
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}
		}

		function streamDestroyedHandler(event) {
			// This signals that a stream was destroyed. Any Subscribers will automatically be removed.
			// This default behaviour can be prevented using event.preventDefault()
		}

		function sessionDisconnectedHandler(event) {
			// This signals that the user was disconnected from the Session. Any subscribers and publishers
			// will automatically be removed. This default behaviour can be prevented using event.preventDefault()
			publisher = null;

			show('connectLink');
			hide('disconnectLink');
			hide('publishLink');
			hide('unpublishLink');
		}

		function connectionDestroyedHandler(event) {
			// This signals that connections were destroyed
		}

		function connectionCreatedHandler(event) {
			// This signals new connections have been created.
		}

		/*
		If you un-comment the call to TB.setLogLevel(), above, OpenTok automatically displays exception event messages.
		*/
		function exceptionHandler(event) {
			alert("Exception: " + event.code + "::" + event.message);
		}

		//--------------------------------------
		//  HELPER METHODS
		//--------------------------------------

		function addStream(stream) {
			// Check if this is the stream that I am publishing, and if so do not publish.
			if (stream.connection.connectionId == session.connection.connectionId) {
				return;
			}
			var subscriberDiv = document.createElement('div'); // Create a div for the subscriber to replace
			subscriberDiv.setAttribute('id', stream.streamId); // Give the replacement div the id of the stream as its id.
			document.getElementById("subscribers").appendChild(subscriberDiv);
			var subscriberProps = {width: VIDEO_WIDTH, height: VIDEO_HEIGHT};
			subscribers[stream.streamId] = session.subscribe(stream, subscriberDiv.id, subscriberProps);
		}

		function show(id) {
			document.getElementById(id).style.display = 'block';
		}

		function hide(id) {
			document.getElementById(id).style.display = 'none';
		}
        
</script>
<div class="row">
    
    <?php if($tenant_info[0]['lease_id'] == FALSE): ?>
        <center><h3>Search for roommates!!!</h3></center>
    <?php else : ?>
        <!-- Display All Unit Tenants -->
        <div class="span5">
            <?php foreach($tenants as $row): ?>
            <div class="building-box span2" style="padding: 10px; margin-bottom: 10px; text-align: center;">
                <h4>Bedroom #<?php echo $row['urm_room_number']; if($row['urm_master'] == 'yes') { echo '  <span style="color: #FA9300">{Master}</span>'; } ?> </h4>
                <div>
                    <?php if($row['tnt_avatar'] == NULL): ?>
                        <img src="<?= base_url(); ?>img/sample_content/sample-image-250x150.png" width="125" height="100" />
                    <?php else: ?>
                        <img src="<?= base_url() . 'uploadedmedia/tenant/avatars/tenant' . $row['tnt_id'] . '/' . $row['tnt_avatar']; ?>" width="250" height="150" />
                    <?php endif; ?>
                </div>
                <h5><?= ucfirst($row['tnt_fname']) . ' ' . ucfirst($row['tnt_lname']); ?><br /> (<a href="<?= base_url(); ?>index.php/tenement/view_tenant/<?= $row['tnt_id']; ?>">View Profile</a>)</h5>
                <!-- Do Not display 'Message Roomie' For the tenant logged in -->
                <?php if($row['tnt_id'] != $session_data['tnt_id']): ?>
                <a href="#messageRoomie2RoomieModal" class="btn btn-wuxia btn-primary" data-toggle="modal" onclick="updateRecipient(<?= $row['tnt_id']; ?>)">Message Roomie</a>
                <br /><br />
                <?php endif; ?>
                
                <a href="#viewTenantListModal" onclick="loadTenantList(<?= $row['tnt_id']; ?>);" data-toggle="modal" class="btn btn-wuxia btn-warning">View List</a>
                <br /><br />
                <!-- Display Video Chat Buttons if inside the logged in tenants box -->
                <?php if($row['tnt_id'] == $session_data['tnt_id']): ?>
                    <div id="opentok_console"></div>
                    <div id="links">
                        <center>                     
                            <input type="button" class="btn btn-wuxia btn-warning" value="Connect To Chat" id ="connectLink" onClick="javascript:connect()" />
                            <input type="button" class="btn btn-wuxia btn-warning btn-mini" style="display: none;" value="Leave Chat" id ="disconnectLink" onClick="javascript:disconnect()" />
                            <input type="button" class="btn btn-wuxia btn-warning btn-mini" style="display: none;" value="Start Video" id ="publishLink" onClick="javascript:startPublishing()" />
                            <input type="button" class="btn btn-wuxia btn-warning btn-mini" style="display: none;" value="Stop Video" id ="unpublishLink" onClick="javascript:stopPublishing()" />
                        </center>
                    </div>
                    <div id="myCamera" class="publisherContainer"></div>
                    <div id="subscribers"></div>
                    <script type="text/javascript" charset="utf-8">
                            show('connectLink');
                    </script>
                <?php endif; ?>
                </div>
                <?php endforeach; ?>

        </div>
        <!-- ***END Display All Unit Tenants -->
        
        
    
        <div class="span7" style="">
            <a href="#addUnitItemModal" data-toggle="modal">Add Item To Master List</a>
            <input type="hidden" id="tenantFName" value="<?= ucfirst($session_data['tnt_fname']); ?>" /><input type="hidden" id="tenantLName" value="<?= ucfirst($session_data['tnt_lname']); ?>" />
            <div role="grid" class="dataTables_wrapper form-inline" id="example_wrapper"><div class=""><div class="span6"></div><div class="span6"><div</div></div>
                <table id="example" class="datatable table table-striped table-bordered dataTable" aria-describedby="example_info">
                    <thead>
                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Item</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="Browser: activate to sort column ascending">Photo</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 0px;" aria-label="CSS grade: activate to sort column ascending">Actions</th></tr>
                    </thead>

                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        
                        <?php if($unit_items_list != NULL): ?>
                            <?php foreach ($unit_items_list as $row): ?>
                                <tr>
                                    <?php if($row['uappt_id'] != NULL): ?>
                                    <td style="text-align: center; font-weight: bold;"><?= ucfirst($row['uappt_title']); ?></td>
                                    <td style="text-align: center;"><img src="<?= base_url() . 'img/items/' . $row['uappt_image']; ?>" /></td>
                                    <?php else: ?>
                                    <td style="text-align: center; font-weight: bold;"><?= ucfirst($row['urua_title']); ?></td>
                                    <td style="text-align: center;"><img src="<?= $row['urua_image']; ?>" /></td>
                                    <?php endif; ?>
                                    <td style="text-align: center; font-weight: bold; color: #FA9300;">
                                        <?php if($row['tnt_fname'] == NULL): ?>    

                                        <a href="#" onclick="addItemToTenantList(this, <?= $row['urua_id']; ?>)">Add To My List</a><br /><br />
                                        <a href="<?= base_url(); ?>index.php/tenement/employees" onclick="(<?= $row['tun_id']; ?>); return false;">Add To Group List</a>

                                    <?php else: ?>
                                        <h4>In <?= ucfirst($row['tnt_fname']) . ' ' . substr(ucfirst($row['tnt_lname']), 0, 1) . '\'s'; ?> List</h4>
                                    <? endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table><div class="row"><div class="span6"><div class="dataTables_info" id="example_info"></div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"></div></div></div></div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <!-- START group messages -->
        <div class="span7">
            <a href="#notifyNeighborsModal" data-toggle="modal">Notify Neighbors of a Get-Together</a>
            
            <?php if($group_messages == NULL): ?>
            <h2>No Group Messages</h2>
            <?php else: ?>
            asdf
            <?php endif; ?>
            
        </div>
        <!-- ***END group messages -->
        <?php endif; ?>
</div>


<!-- START Modals -->
<div id="messageRoomie2RoomieModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Message Roomie</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
        <fieldset>
            <input type="hidden" id="recipientID" value="" />
            <div class="control-group">
                <label for="input" class="control-label">Message</label>
                <div class="controls">
                    <textarea id="group-message" style="width: 90%;"></textarea>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
            <a class="btn btn-wuxia btn-primary" href="#" onclick="messageRoomieToRoomie();">Message Roomie</a>
    </div>
</div>

<div id="notifyNeighborsModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Planning a Get-Together?</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
        <p>Don't be rude.. Let your neighbors what's going on, and maybe even invite them over :)</p>
        <fieldset>
            
            <div class="control-group">
                <label for="input" class="control-label">Date</label>
                <div class="controls">
                        <input type="text" value="<?php date("m/d/y");  ?>" class="datepicker">
                </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
            <a class="btn btn-wuxia btn-primary" href="#" onclick="messageRoomieToRoomie();">Notify Neighbors</a>
    </div>
</div>

<div id="addUnitItemModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Add Item</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
        <fieldset>
            <div class="control-group">
                <label for="input" class="control-label">Item:</label>
                <div class="controls">
                    <input type="text" id="addUnitItem-image" data-source='<?= json_encode($item_typeahead); ?>' data-provide="typeahead">
                </div>
            </div>
            <div class="control-group">
                <label for="input" class="control-label">Image URL <i>(Optional)</i></label>
                <div class="controls">
                        <input type="text" id="addUnitItem-image" >
                </div>
            </div>
            <br /><br /><br /><br />
        </fieldset>
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
            <a class="btn btn-wuxia btn-primary" href="#" onclick="addItemToList();">Add Item</a>
    </div>
</div>

<div id="viewTenantListModal" class="modal fade hide" style="display: none;" aria-hidden="true">
    <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3>Item List</h3>
    </div>
    <div class="modal-body">
        <div id="success-placeholder"></div>
        
    </div>
    <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-wuxia" href="#">Close</a>
    </div>
</div>
<script src="<?= base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>js/site/tenant.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.datepicker').datepicker({
        "autoclose": true
    }); 
});
</script>

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
            $('#example_filter').hide();


            $('.typeahead').typeahead();
    });
</script>
                
