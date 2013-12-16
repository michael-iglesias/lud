function processProfileCompletion() {
    var formErrors = false;
    var profMajor = $("#prof-major").val();
    var profAcademicFocus = $("#prof-academic-focus").val();
    var profNeatness = $("#prof-neatness").val();
    var profActive = $("#prof-active").val();
    var profTv = $("#prof-tv").val();
    var profVisitors = $("#prof-visitors").val();
    var profSmoker = $("#prof-smoker").val();
    var profLiveWithSmoker = $("#prof-live-with-smoker").val();
    var profPet = $("#prof-pet").val();
    var profLiveWithPet = $("#prof-live-with-pet").val();
    var profFrat = $("#prof-frat").val();
    var packEmail = $("#pack-email").val();
    var packSMS = $("#pack-sms").val();
    var packPIN = $("#pack-pin").val();
    
    if(packPIN == '') {
        $('#pack-pin').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#pack-pin').css('border', '1px solid #CCCCCC');
    }
    if(packSMS == '') {
        $('#pack-sms').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#pack-sms').css('border', '1px solid #CCCCCC');
    }
    if(packEmail == '') {
        $('#pack-email').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#pack-email').css('border', '1px solid #CCCCCC');
    }
    if(profMajor == '') {
        $('#prof-major').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-major').css('border', '1px solid #CCCCCC');
    }
    if(profAcademicFocus == '') {
        $('#prof-academic-focus').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-academic-focus').css('border', '1px solid #CCCCCC');
    }
    if(profNeatness == '') {
        $('#prof-neatness').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-neatness').css('border', '1px solid #CCCCCC');
    }
    if(profActive == '') {
        $('#prof-active').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-active').css('border', '1px solid #CCCCCC');
    }
    if(profTv == '') {
        $('#prof-tv').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-tv').css('border', '1px solid #CCCCCC');
    }
    if(profVisitors == '') {
        $('#prof-visitors').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-visitors').css('border', '1px solid #CCCCCC');
    }
    if(profSmoker == '') {
        $('#prof-smoker').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-smoker').css('border', '1px solid #CCCCCC');
    }
    if(profLiveWithSmoker == '') {
        $('#prof-live-with-smoker').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-live-with-smoker').css('border', '1px solid #CCCCCC');
    }
    if(profLiveWithPet == '') {
        $('#prof-live-with-pet').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-live-with-pet').css('border', '1px solid #CCCCCC');
    }
    if(profFrat == '') {
        $('#prof-frat').css('border', '1px solid red');
        formErrors = true;
    } else {
        $('#prof-frat').css('border', '1px solid #CCCCCC');
    }
    
    // If ALL fields are validated insert new user
    if(formErrors != true) {
        $('#display-errors').hide();
        $.ajax({
            type: "POST",
            url: 'http://localhost/LetUsDorm/index.php/tenant/process_complete_profile',
            data: {packEmail: packEmail, packSMS: packSMS, packPIN: packPIN, profMajor: profMajor, profAcademicFocus: profAcademicFocus, profNeatness: profNeatness, profActive: profActive, profTv: profTv, profVisitors: profVisitors, profSmoker: profSmoker, profLiveWithSmoker: profLiveWithSmoker, profPet: profPet, profLiveWithPet: profLiveWithPet, profFrat: profFrat},
            success: function(data) {
                if(data == 1) {
                    $('div#step-2').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Profile Successfully Submitted!</div>');
                    window.location = 'http://localhost/LetUsDorm/index.php/tenant/dashboard';
                }
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
    } else {
        // Display Errors are present alert
        $('#display-errors').show();
        $('#display-errors').html('<div class="alert alert-error"><button type="button" data-dismiss="alert" class="close">×</button><strong>Ooopps!</strong> There are some form errors! Make sure you have filled everything out! :)</div>');
    }
}

function loadTenantList(tnt_id) {
        $.ajax({
            type: "POST",
            url: 'http://localhost/LetUsDorm/index.php/tenant/load_tenant_item_list',
            data: {tntID: tnt_id},
            success: function(data) {
                $('#viewTenantListModal div.modal-body').html(data);
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
}

function addItemToList() {
    var itemTitle = $('#addUnitItem-image').val();
    var itemImage = $("#addUnitItem-image").val();
    
    $.ajax({
            type: "POST",
            url: 'http://localhost/LetUsDorm/index.php/tenant/add_item_list',
            data: {itemTitle: itemTitle, itemImage: itemImage},
            success: function(data) {
                $('#viewTenantListModal div.modal-body').html('<div class="alert alert-success"><button type="button" data-dismiss="alert" class="close">×</button><strong>Item Added!</strong> </div>');
                location.reload();
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
} // ***END addItemToList()

function addItemToTenantList(aobject, urua_id) {
        var fname = $('#tenantFName').val();
        var lname = $('#tenantLName').val();
        var pObject = aobject.parentNode
        pObject.innerHTML='<h4>In ' + fname + ' ' + lname[0] + '\'s List</h4>';
        
        $.ajax({
            type: "POST",
            url: 'http://localhost/LetUsDorm/index.php/tenant/add_item_tenant_list',
            data: {uruaID: urua_id},
            success: function(data) {
                
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call   
}

function updateRecipient(tnt_id) {
    $('#recipientID').val(tnt_id);
} // ***END updateRecipient() 


function loadPersonalityProfile() {
    $.ajax({
        type: "POST",
        url: 'http://localhost/LetUsDorm/index.php/tenant/load_personality_profile',
        data: {},
        success: function(data) {
            $('#personality-profile').html(data);
            $('#gender').hide();
        }, 
        error: function() {
                alert('System Error! Please try again.');
        },
        complete: function() {
                console.log('completed')
        }
    }); // ***END $.ajax call
}


function personalityProfile(question, answer) {
    if(question == 'study') {
        $('#studyVal').val(answer);
        $('#study').hide();
        $('#neat').show();
    }
    if(question == 'neat') {
        $('#neatVal').val(answer);
        $('#neat').hide();
        $('#smoke').show();
    }
    if(question == 'smoke') {
        $('#smokeVal').val(answer);
        $('#smoke').hide();
        $('#party').show();
    }
    if(question == 'party') {
        $('#partyVal').val(answer);
        $('#party').hide();
        $('#chef').show();
    }
    if(question == 'chef') {
        $('#chefVal').val(answer);
        $('#chef').hide();
        $('#gym').show();
    }
    if(question == 'gym') {
        $('#gymVal').val(answer);
        $('#gym').hide();
        $('#sports').show();
    }
    if(question == 'sports') {
        $('#sportsVal').val(answer);
        $('#sports').hide();
        $('#movies').show();
    }
    if(question == 'movies') {
        $('#moviesVal').val(answer);
        $('#movies').hide();
        $('#pets').show();
    }
    if(question == 'pets') {
        $('#petsVal').val(answer);
        $('#pets').hide();
        $('#tv').show();
    }
    if(question == 'tv') {
        $('#tvVal').val(answer);
        $('#tv').hide();
        $('#greek').show();
    }
    if(question == 'greek') {
        $('#greekVal').val(answer);
        $('#greek').hide();
        $('#ati').show();
    }
    if(question == 'ati') {
        $('#atiVal').val(answer);
        $('#ati').hide();
        
        // Submit Profile
        $.ajax({
            type: "POST",
            url: 'http://localhost/LetUsDorm/index.php/tenant/process_personality_profile',
            data: {study: $('#studyVal').val(), neat: $('#neatVal').val(), smoke: $('#smokeVal').val(), party: $('#partyVal').val(), chef: $('#chefVal').val(), gym: $('#gymVal').val(), sports: $('#sportsVal').val(), movies: $('#moviesVal').val(), pets: $('#petsVal').val(), tv: $('#tvVal').val(), greek: $('#greekVal').val(), ati: $('#atiVal').val() },
            success: function(data) {
                $('#personality-profile-complete').show();
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
    }
    
} // ***END personalityProfile()