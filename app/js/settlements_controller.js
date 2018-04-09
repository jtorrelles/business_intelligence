
var setCityId = 0; 
var setStateId = 0;
var setCountryId = 0;
var setShowID = 0;
var setVenueID = 0;

function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = type||'json';

    var successRes = function(data) {
        success(data);
    };

    var errorRes = function(e) {
        alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
    };

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: successRes,
        error: errorRes,
        dataType: type,
        timeout: 60000
    });

    }
};

function ajaxCallUpload() {
    this.sendUpload = function(data, url, method, success, type) {
        type = type||'json';

    var successResUpload = function(data) {
        success(data);
    };

    var errorResUpload = function(e) {
        alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
    };

    $.ajax({
        url: url,
        type: method,
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        success: successResUpload,
        error: errorResUpload,
        dataType: type,
        cache: false,
        timeout: 60000000
    });

    }
};

function getCountries() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getCountries';
    var method = "GET";
    var data = {};
    $('.countries').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.countries').find("option:eq(0)").html("Select Country");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.countries').append(option);
            });
            $(".countries").prop("disabled",false);

            //set country value
            if(setCountryId != 0){
                $(".countries").val(setCountryId);
            }else{
                //Sel United States
                $(".countries").val("231");
                getStates(231);
            }

        }
        else{
            alert(data.msg);
        }
    }); 
};

function getStates(id) {
    var call = new ajaxCall();
    $(".states option:gt(0)").remove(); 
    $(".cities option:gt(0)").remove();
    var url = '../routes/settlements_route.php?type=getStates&countryId=' + id;
    var method = "GET";
    var data = {};
    $('.states').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.states').find("option:eq(0)").html("Select State");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.states').append(option);
            });
            $(".states").prop("disabled",false);

            //set states value
            if(setStateId != 0){ 
                $(".states").val(setStateId);
            }
            
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getCities(id) {
    var call = new ajaxCall();
    $(".cities option:gt(0)").remove();
    var url = '../routes/settlements_route.php?type=getCities&stateId=' + id;
    var method = "GET";
    var data = {};
    $('.cities').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.cities').find("option:eq(0)").html("Select City");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.cities').append(option);
            });
            $(".cities").prop("disabled",false);

            //set city value
            if(setCityId != 0){
                $(".cities").val(setCityId);
            }
        }
        else{
             alert(data.msg);
        }
    });
};

function getGlobalLocation(cityID) {
    if(cityID != 0){
        var call = new ajaxCall();
        var url = '../routes/settlements_route.php?type=getGlobalLocation&cityId=' + cityID;
        var method = "GET";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data.tp == 1){

                console.log(data);

                setCityId = data["result"].cityid;
                setStateId = data["result"].stateid;
                setCountryId = data["result"].countryid;

                getCities(data["result"].stateid);
                getStates(data["result"].countryid);
                getCountries();
            }
            else{
                 alert(data.msg);
            }
        });
    }else{
        getCountries();
    }

};

function getShows() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getShows';
    var method = "GET";
    var data = {};
    $('.shows').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.shows').find("option:eq(0)").html("Select Show");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.shows').append(option);
            });
            $(".shows").prop("disabled",false);

            //set venue value
            if(setShowID != 0){ 
                $(".shows").val(setShowID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getVenues() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getVenues';
    var method = "GET";
    var data = {};
    $('.venues').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.venues').find("option:eq(0)").html("Select Venues");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.venues').append(option);
            });
            $(".venues").prop("disabled",false);

            //set venue value
            if(setVenueID != 0){ 
                $(".venues").val(setVenueID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getCityOfVenues(venueId) {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getCityOfVenues&venueId=' + venueId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var city = data['result'].cityname;
            var state = data['result'].statename;
            var cityid = data['result'].cityid;

            $(".cityname").prop("value",city);
            $(".statename").prop("value",state);
            $(".cityid").prop("value",cityid);
            
            $(".cityname").prop("disabled",true);
            $(".statename").prop("disabled",true);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function findData(id){

    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getData&settlementId=' + id;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){

            $('.id').val(data['result'].settlementid);
            $('.show_name').val(data['result'].show_name);
            $('.venue_name').val(data['result'].venue_name);
            $('.opening_date').val(data['result'].opening_date);
            $('.closing_date').val(data['result'].closing_date);
            $('.number_performances').val(data['result'].num_performances);
            $('.gross_potential').val(data['result'].gross_potential);
            $('.actual_gross').val(data['result'].actual_gross);
            $(".tickets_sold").val(data['result'].tickets_sold);
            $('.tickets_compd').val(data['result'].tickets_compd);
            $('.subsc').val(data['result'].subsc);
            $('.tax').val(data['result'].tax);
            $('.subsc_com').val(data['result'].subsc_com);
            $('.phone_com').val(data['result'].phone_com);
            $('.int_com').val(data['result'].int_com);
            $('.cc_com').val(data['result'].cc_com);
            $(".remotes_com").val(data['result'].remotes_com);
            $('.group_sales_com').val(data['result'].group_sales_com);
            $('.overage').val(data['result'].overage);
            $('.advertising').val(data['result'].advertising);
            $('.ticket_insurance').val(data['result'].insurance_ticket);
            $('.total_ticket_insurance').val(data['result'].total_insurance);
            $('.catering').val(data['result'].catering);
            $('.catering2').val(data['result'].catering2);
            $('.stage_hands').val(data['result'].stage_hands);
            $(".musicians").val(data['result'].musicians);
            $('.wardrobe_hair').val(data['result'].wardrobe_hair);
            $('.ticket_print').val(data['result'].ticket_print);
            $('.total_ticket_print').val(data['result'].total_ticket_print);
            $('.other_doc').val(data['result'].other_doc_expenses);
            $('.total_doc').val(data['result'].total_doc_expenses);
            $('.ada_expenses').val(data['result'].ada);
            $('.box_office').val(data['result'].box_office);
            $('.cleaning').val(data['result'].cleaning);
            $('.direct_mail').val(data['result'].direct_mail);
            $('.equipment_rental').val(data['result'].equipment_rental);
            $('.group_sales').val(data['result'].group_sales);
            $('.houseman_td').val(data['result'].houseman);
            $(".house_staff").val(data['result'].house_staff);
            $('.league_fees').val(data['result'].league_fees);
            $('.licenses_permits').val(data['result'].licenses_permit);
            $('.limos_autos').val(data['result'].limos_autos);
            $('.miscellaneous').val(data['result'].miscellaneous);
            $('.presenter_profit').val(data['result'].presenter_profit);
            $('.police_security').val(data['result'].police_sec);
            $('.programs').val(data['result'].programs);
            $('.public_relations').val(data['result'].public_relations);
            $(".rent").val(data['result'].rent);
            $('.sound_lights').val(data['result'].sound_lights);
            $('.ticket_printing').val(data['result'].ticket_printing);
            $('.phones').val(data['result'].phones);
            $('.other_expenses').val(data['result'].other_expenses);
            $('.local_fixed_expenses').val(data['result'].local_expenses);
            $('.total_fixed_expenses').val(data['result'].total_expenses);
            $('.presenter_expenses').val(data['result'].total_presenter);
            $('.restoration_charge').val(data['result'].total_restoration);
            $('.breakeven').val(data['result'].breakeven);

            setShowID = data['result'].showid;
            setVenueID = data['result'].venueid;

            getGlobalLocation(data['result'].cityid);
            getVenues(); 
            getShows();

            $("#datasettlements").show();
        }
        else{
            alert(data.msg);
        }
    }); 

}


function getUploadFile(){

    var call = new ajaxCallUpload();
    var form = $('#fileUploadForm')[0];
    var dataForm = new FormData(form);
    var url = '../routes/settlements_route.php?type=getUploadProcess';
    var method = "POST";
    var data = dataForm;
    call.sendUpload(data, url, method, function(data_response) {
        if(data_response.tp == 1){

            console.log(data_response);
            
            $('.opening_date').val(data_response['result'].opening_date);
            $('.closing_date').val(data_response['result'].closing_Date);
            $('.number_performances').val(data_response['result'].numberperformances);
            $('.subsc_com').val(data_response['result'].subscription_com);
            $('.phone_com').val(data_response['result'].phone_com);
            $('.int_com').val(data_response['result'].internet_com);
            $('.cc_com').val(data_response['result'].cc_com);
            $(".remotes_com").val(data_response['result'].remotes_com);
            $('.group_sales_com').val(data_response['result'].group_sales_com);
            $('.gross_potential').val(data_response['result'].gross_potential);
            $('.actual_gross').val(data_response['result'].actual_gross);
            $('.nagbor').val(data_response['result'].nagbor);
            $('.royality').val(data_response['result'].royality);
            $('.guarantee').val(data_response['result'].guarantee);

            //$('.address2').val(data['total_allowable_expenses'].address_2);
            //$('.notes').val(data['st_company_compensation'].notes);
            //$(".active").val(data['expense_budgeted'].active);
            //$('.id').val(data['expense_actual'].id);
            //$('.name').val(data['local_expense_budgeted'].name);
            //$('.address1').val(data['local_expense_actual'].address_1);
            //$('.address2').val(data['total_local_expense_budgeted'].address_2);
            //$('.zip').val(data['total_local_expense_actual'].zip);
            //$('.fax').val(data['total_engagement_expenses'].fax);
            //$('.email').val(data['money_remaining'].email);
            //$('.notes').val(data['total_company_percentage'].notes);
            //$(".active").val(data['total_company_share'].active);
            //$('.address1').val(data['less_direct_company_charges'].address_1);
            //$('.address2').val(data['adjusted_company_share'].address_2);
            //$('.zip').val(data['total_presenter_share'].zip);
            //$('.fax').val(data['presenter_facility_fee'].fax);
            //$('.email').val(data['adjusted_presenter_share'].email);
            //$('.notes').val(data['total_company_percentage'].notes);
            //$(".active").val(data['total_shares_equal'].active);

            $("#settlement_data").show();
            $("#settlement_uploadfile").hide();
            $("#back_to_upload").show();

            onloadManagement();

        }else{
            alert(data_response.msg);
        }
    });
}

function onloadManagement(){
    getShows();
    getVenues();
}

$(function() {

    $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        if(countryId != ''){
            setCityId = 0;
            setStateId = 0;
            getStates(countryId);
        }else{
            $(".states option:gt(0)").remove();
        }
    });

    $(".states").on("change", function(ev) {
        var stateId = $(this).val();
        if(stateId != ''){
            getCities(stateId);
        }else{
            $(".cities option:gt(0)").remove();
        }
    });

    $(".venues").on("change", function(ev) {
        var venueId = $(this).val();
        if(venueId != ''){
            getCityOfVenues(venueId);
        }else{
            $(".venues option:gt(0)").remove();
        }
    });

    $("#btnUpload").click(function (ev) {
        getUploadFile();
    });

    $("#btnBackUpload").click(function (ev) {
        $("#settlement_data").hide();
        $("#settlement_uploadfile").show();
        $("#back_to_upload").hide();
    });

});