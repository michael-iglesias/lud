<div>
    <a href="#" onclick="loadNotificationUI2('home');">Select Different Audience</a>
</div>
<br />

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
                $('#targetAudience').val('tnt'); 
                $('#audienceID').val(recipient_id)
            }

        }; 
}


</script>