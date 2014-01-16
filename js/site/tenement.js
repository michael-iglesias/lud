// Function: addBuilding()
// Description: Allows tenement administrators to add new buildings to their property
function addBuilding() {
    var buildingName = $('#building-name').val();
    var buildingFloorCount = $('#building-floor-count').val();
    var buildingUnitsPerFloor = $('#building-units-per-floor').val();
    var formErrors = false;
    // Perform form validation
    if(buildingName == '') {
        $('#building-name').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#building-name').css('border', '1px solid #CCCCCC');
    }
    if(isNaN(buildingFloorCount)) {
        $('#building-floor-count').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#building-floor-count').css('border', '1px solid #CCCCCC');
    }
    if(isNaN(buildingUnitsPerFloor)) {
        $('#building-units-per-floor').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#building-units-per-floor').css('border', '1px solid #CCCCCC');
    }    
    
    
    if(formErrors != true) {
        $.ajax({
                type: "POST",
                url: '../../index.php/tenement/add_building',
                data: {buildingName: buildingName, buildingFloorCount: buildingFloorCount, buildingUnitsPerFloor: buildingUnitsPerFloor},
                success: function(data) {
                    $('#building-name').val('');
                    $('#building-floor-count').val(1);
                    $('#building-units-per-floor').val(1);
                    $('#success-placeholder').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Building Added! You can Continue Adding New Buildings.</div>');
                    window.location.href = '../../index.php/tenement/manage_building/' + data;

                    
                }, 
                error: function() {
                        alert('System Error! Please try again.');
                },
                complete: function() {
                        console.log('completed')
                }
        }); // ***END $.ajax call
    }
    
    
} // ***END addBuilding()

// Function: displayUnitTenants()
// Description: Asynchronously Load <div id="unitoccupancies-modal"> with the Tenants whom reside in the 
//              unit that has been selected
function displayUnitTenants(tun_id, tun_number) {
    $('#unit-occupancies-modaltitle').html(tun_number);
    
    if(isNaN(tun_id) == false) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/load_unit_tenants',
            data: {tunID: tun_id},
            success: function(data) {
                $("#unitoccupancies-modal-body").html(data);
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
    }
} // ***END unitoccupancies-modal()

// Function: addEmployee()
// Add new employee
function addEmployee() {
    var formErrors = false;
    var tempFName = $("#temp-fname").val();
    var tempLName = $("#temp-lname").val();
    var tempPhone = $("#temp-phone").val();
    var tempEmail = $("#temp-email").val();
    var tempPosition = $("#temp-position").val();
    
    if(tempFName == '') {
        $('#temp-fname').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#temp-fname').css('border', '1px solid #CCCCCC');
    }
    if(tempLName == '') {
        $('#temp-lname').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#temp-lname').css('border', '1px solid #CCCCCC');
    }
    if(tempPhone == '') {
        $('#temp-phone').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#temp-phone').css('border', '1px solid #CCCCCC');
    }
    if(tempEmail == '') {
        $('#temp-email').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#temp-email').css('border', '1px solid #CCCCCC');
    }
    if(tempPosition == '') {
        $('#temp-position').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#temp-position').css('border', '1px solid #CCCCCC');
    }
    // If ALL fields are validated insert new user
    if(formErrors != true) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/add_employee',
            data: {tempFName: tempFName, tempLName: tempLName, tempPhone: tempPhone, tempEmail: tempEmail, tempPosition: tempPosition},
            success: function(data) {
                if(data == 1) {
                    $('div#success-placeholder-emp').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Employee Added! You can Continue Adding New Employees.</div>');
                    setTimeout('delayedRedirect()', 2000);
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
    
} // ***END addEmployee() Method

// Function: deleteEmployee()
// Confirm Employee deletion
function deleteEmployee(employeeID) {
    var confirmDelete = confirm("Delete This Employee?");
    if(confirmDelete == true) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/delete_employee',
            data: {employeeID: employeeID},
            success: function(data) {
                if(data == 1) {
                    $('div#success-placeholder-emp').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Employee Deleted!</div>');
                    
                    setTimeout('delayedRedirect()', 0000);
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
} // ***END deleteEmployee()

// Function: addTenant()
// Add new Tenant
function addTenant() {
    var formErrors = false;
    var tntFName = $("#tnt-fname").val();
    var tntLName = $("#tnt-lname").val();
    var tntPhone = $("#tnt-phone").val();
    var tntEmail = $("#tnt-email").val();
    
    if(tntFName == '') {
        $('#tnt-fname').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#tnt-fname').css('border', '1px solid #CCCCCC');
    }
    if(tntLName == '') {
        $('#tnt-lname').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#tnt-lname').css('border', '1px solid #CCCCCC');
    }
    if(tntPhone == '') {
        $('#tnt-phone').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#tnt-phone').css('border', '1px solid #CCCCCC');
    }
    if(tntEmail == '') {
        $('#tnt-email').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#tnt-email').css('border', '1px solid #CCCCCC');
    }
    
    // If ALL fields are validated insert new user
    if(formErrors != true) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/add_tenant',
            data: {tntFName: tntFName, tntLName: tntLName, tntPhone: tntPhone, tntEmail: tntEmail},
            success: function(data) {
                if(data == 1) {
                    $('div#success-placeholder-emp').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Added! You can Continue Adding New Tenants.</div>');
                    setTimeout('delayedRedirect()', 2000);
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
    
} // ***END addTenant() Method




// Function: deleteTenant()
function deleteTenant(tenantID) {
    var confirmDelete = confirm("Delete This Tenant?");
    if(confirmDelete == true) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/delete_tenant',
            data: {tenantID: tenantID},
            success: function(data) {
                if(data == 1) {
                    $('div#success-placeholder-emp').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Deleted!</div>');   
                    setTimeout('delayedRedirect()', 0000);
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
} // ***END deleteEmployee()

function delayedRedirect() {
    location.reload();
}

function loadBuildingForTenantAddition(tow_id, tnt_id) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/manage_building_modal/' + tow_id,
            data: {towID: tow_id, tntID: tnt_id},
            success: function(data) {
                $('#unitAssignModal div.modal-body').html(data);
                    
                
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
}

function assignTenantToUnit(tnt_id, tun_id, tun_name) {
        $.ajax({
            type: "POST",
            url: '../../index.php/tenement/assign_tenant_to_unit/',
            data: {tntID: tnt_id, tunID: tun_id},
            success: function(data) {
                $('#unitAssignModal div.modal-body').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Assigned To Unit!</strong> </div>');
                delayedRedirect();
                
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
} // ***END assignTenantToUnit()

function loadTenantList(tnt_id) {
    $.ajax({
        type: "POST",
        url: '../../index.php/tenement/load_tenant_list/',
        data: {tntID: tnt_id, tunID: tun_id},
        success: function(data) {
            $('#unitAssignModal div.modal-body').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Assigned To Unit!</strong> </div>');
            delayedRedirect();

        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call    
} // ***END loadTenantList()

function getPossibleRoommates(tun_id) {
    $.ajax({
        type: "POST",
        url: '../../index.php/tenement/load_possible_roommates/',
        data: {tunID: tun_id},
        success: function(data) {
            //$('#unitAssignModal div.modal-body').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Assigned To Unit!</strong> </div>');
            $('#tenantassignment-modal-body').html(data);

        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call 
} // ***END getPossibleRoommates()

function insertAnalytics(tun_id) {
    $.ajax({
        type: "POST",
        url: '../../index.php/tenement/insert_unit_analytics/',
        data: {tunID: tun_id},
        success: function(data) {
            //$('#unitAssignModal div.modal-body').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Tenant Assigned To Unit!</strong> </div>');
            $('#analytics .accordion-inner').html(data);

        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
}

function logPackage() {
    var recipient = $('#recipientID').val();
    var deliveryService = $('#deliveryService').val();
    var deliveryItem = $('#deliveryItem').val();
    var trackingNumber = $('#trackingNumber').val();
    var deliveryNotes = $('#deliveryNotes').val();
    if(deliveryNotes == '') {
        deliveryNotes = 'none';
    }
    var deliveryVerification;
    if($('#deliveryVerification').is(":checked")) {
        deliveryVerification = 'yes';
    } else {
        deliveryVerification = 'no';
    }
    
    $.ajax({
        type: "POST",
        url: '../../index.php/tenement/log_package/',
        data: {recipient: recipient, deliveryService: deliveryService, deliveryItem: deliveryItem, trackingNumber: trackingNumber, deliveryNotes: deliveryNotes, deliveryVerification: deliveryVerification},
        success: function(status) {
            if(status == 1) {
                $('#package-added-alert').hide();
                $('#package-added-alert').slideDown();
                $('#recipient').val('');
                $('#deliveryService').val('');
                $('#deliveryItem').val('');
                $('#trackingNumber').val('');
                $('#deliveryNotes').val('');
                $('#deliveryVerification').prop('checked', false);
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

function markPackageDelivered(package_id, obj) {
    $.ajax({
        type: "POST",
        url: '../../index.php/tenement/package_delivered/',
        data: {packageID: package_id},
        success: function(status) {
            if(status == 1) {
                $(obj).closest('tr').remove();
                $('#package-delivered-alert').hide();
                $('#package-delivered-alert').slideDown();
                $('#package-delivered-alert').show();
                setTimeout('delayedRedirect()',1000);
            }
        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
} // ***END markPackageDelivered()

