<!-- Page header -->
<div class="page-header">
    <h1><span class="<?= $page_header_icon; ?>"></span> <?= $page_header_title; ?></h1>
    <ul class="page-header-actions">
        <li class="active"><a href="#logging" class="btn btn-wuxia">Log Packages</a></li>
        <li class=""><a href="<?= base_url(); ?>index.php/tenement/package_pickup" class="btn btn-wuxia">Pending Pickups</a></li>
    </ul>
</div>
<!-- /Page header -->

<!-- Page container -->
<div class="page-container">
    <div class="tab-pane active" id="logging">
        <h2>Log A Package:</h2>
        <br />
        <div id="package-added-alert" class="alert alert-success hide">
            
            <strong>Package Logged!</strong> This package has been logged and is awaiting Delivery/Pickup.
        </div>
        <form method="post" action="<?= base_url(); ?>" style="background: none;">
            <input type="hidden" value="" id="recipientID" name="recipientID" />
            <div class="controls">
                <select id="deliveryService" required>
                    <option value="">Delivery Service</option>
                    <option value="FedEx">FedEx</option>
                    <option value="UPS">UPS</option>
                    <option value="USPS">USPS</option>
                    <option value="DHL">DHL</option>
                    <option value="LaserShip">LaserShip</option>
                    <option value="InterOffice Mail">Interoffice Mail</option>
                    <option value="Campus Mail">Campus Mail</option>
                    <option value="Courier">Courier</option>
                    <option value="Concierge">Concierge</option>
                    <option value="Florist">Florist</option>
                </select>
                <select id="deliveryItem" required>
                    <option value="Box">Box</option>
                    <option value="Box (Extra Large)">Box (Extra Large)</option>
                    <option value="Box (Extra Small)">Box (Extra Small)</option>
                    <option value="Tube">Tube</option>
                    <option value="Tube (Extra Small)">Tube (Extra Small)</option>
                    <option value="Envelope">Envelope</option>
                    <option value="Envelope (Soft Pack)">Envelope (Soft Pack)</option>
                    <option value="Envelope (Extra Large)">Envelope (Extra Large)</option>
                    <option value="Perishable">Perishable</option>
                    <option value="Flowers">Flowers</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="controls">
                <label for="input" class="control-label">Recipient name or unit number...</label>
                <div class="controls">
                    <input name="recipient" id="recipient" class="input-xxlarge" type="text" onkeyup="lookup(this.value)" required>
                    
                    <div id="suggestions" style="display: none; margin-left: 0px;" class="span6">
                        <div class="autoSuggestionsList_l" id="autoSuggestionsList">
                            <table id="autocomplete-table" class="table table-bordered">
                                <thead>
                                        <tr>
                                                <th class="span2">Unit #</th>
                                                <th class="span3">Name</th>
                                                <th class="span1"></th>
                                        </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="controls">
                <label for="input" class="control-label">Tracking Number</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" id="trackingNumber" placeholder="NOTE: If you do not scan/add a tracking number, one will be generated">
                </div>
            </div>
            <br />
            <div class="controls">
                <select id="deliveryNotes" class="input-xxlarge">
                    <option value=''>Select notes for this package</option>
                    <option value="Crushed">Crushed</option>
                    <option value="Damaged">Damaged</option>
                    <option value="Empty">Empty</option>
                    <option value="Leaking">Leaking</option>
                    <option value="Open">Open</option>
                    <option value="Ripeed">Ripped</option>
                    <option value="Torn">Torn</option>
                    <option value="Wet">Wet</option>
                </select>
            </div>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="deliveryVerification" id="deliveryVerification">
                    Item requires additional verification at delivery
                </label>
            </div>
            <br /><br />
            <span onclick="logPackage();" class="btn btn-wuxia btn-large btn-primary" type="submit">Log Package</span>
        </form>
    </div>
    
</div>

<script type="text/javascript">
function lookup(inputString) {
    if(inputString.length == 0) {
        $('#suggestions').hide();
    } else {
        $.post("http://localhost/LetUsDorm/index.php/tenement/packagelog_autocomplete", {queryString: ""+inputString+""}, function(data){
            if(data.length > 0) {
                $('#suggestions').show();
                $('#autoSuggestionsList table tbody').html(data);
            }
        });
    }
}

function fill(thisValue) {
    $('#id_input').val(thisValue);
    setTimeout("$('#suggestions').hide();", 200);
}   
function updateInput(recipient_id) {
var table = document.getElementsByTagName("table")[0];
        var tbody = table.getElementsByTagName("tbody")[0];
        tbody.onclick = function (e) {
            e = e || window.event;
            var data = [];
            var target = e.srcElement || e.target;
            while (target && target.nodeName !== "TR") {
                target = target.parentNode;
            }
            if (target) {
                var cells = target.getElementsByTagName("td");
                for (var i = 0; i < cells.length; i++) {
                    if(i == 0) {
                        var unitNumber = cells[i].innerHTML;
                    } else if(i == 1) {
                        var residentName = cells[i].innerHTML;
                    }
                    
                }
                $('#recipient').val(residentName + " - Unit #:" + unitNumber);
                $('#suggestions').hide();
                $('#recipientID').val(recipient_id)
            }

        }; 
}


</script>