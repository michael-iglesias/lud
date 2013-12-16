function loadNotificationUI2(audience) {
    $.ajax({
        type: "POST",
        url: 'http://localhost/LetUsDorm/index.php/tenement/notification_load_target_audience/',
        data: {targetAudience: audience},
        success: function(html) {
            if(html) {
                $('#target-audience-content').html(html);
                if(audience == 4) {
                    $('#targetAudience').val('all');
                }
            }
        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
} // ***END loadNotificationUI2() Function

function selectBuilding(towerID, towerName) {
    $('#targetAudience').val('tow'); 
    $('#audienceID').val(towerID)
    $('#selected-building h3').html('Building: ' + towerName);
    $('#selected-building').show();
    $('#building-list').hide();
} // ***END selectBuilding()

function selectUnit(unitID, unitName) {
    $('#targetAudience').val('tun'); 
    $('#audienceID').val(unitID)
    $('#selected-unit h3').html('Room/Unit #: ' + unitName);
    $('#selected-unit').show();
    $('#unit-list').hide();
    $('#accordion2').hide();
}

function loadUnitSelection(towID) {
    $.ajax({
        type: "POST",
        url: 'http://localhost/LetUsDorm/index.php/tenement/notification_load_unit_selection/',
        data: {towID: towID},
        success: function(html) {
            if(html) {
                $('#target-audience-content').html(html);
            }
        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
}


function sendNotification() {
    var targetAudience = $('#targetAudience').val();
    var audienceID = $('#audienceID').val();
    var title = $('#notification-title').val();
    var message = $('#notification-message').val();
    var deliveryMethod = $('#deliveryMethod').val();
    
    $.ajax({
        type: "POST",
        url: 'http://localhost/LetUsDorm/index.php/tenement/send_notification/',
        data: {deliveryMethod: deliveryMethod, targetAudience: targetAudience, audienceID: audienceID, title: title, message: message},
        success: function(html) {
            if(html) {
                $('#notification-created-alert').slideUp();
                $('#notification-created-alert').slideDown();
                $('#notification-created-alert').show();
            }
        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
} // ***END sendNotification() Function