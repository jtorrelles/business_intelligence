
var setCityId = 0; 
var setStateId = 0;
var setCountryId = 0;

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
    var url = '../routes/show_routes_route.php?type=getCountries';
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
    var url = '../routes/show_routes_route.php?type=getStates&countryId=' + id;
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
    var url = '../routes/show_routes_route.php?type=getCities&stateId=' + id;
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
        var url = '../routes/show_routes_route.php?type=getGlobalLocation&cityId=' + cityID;
        var method = "GET";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data.tp == 1){
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
    var url = '../routes/show_routes_route.php?type=getShows';
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
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getPresenters(presenterID) {
    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getPresenters';
    var method = "GET";
    var data = {};
    $('.presenters').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.presenters').find("option:eq(0)").html("Select Presenters");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.presenters').append(option);
            });
            $(".presenters").prop("disabled",false);

            //set presenters value
            $(".presenters").val(presenterID);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getVenues(venuesID) {
    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getVenues';
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

            //Set venues value
            $(".venues").val(venuesID);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getNUTOfShow(showId) {
    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getNUTOfShow&showId=' + showId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var nut = data['result'].nut;
            var trucks = data['result'].trucks;

            $(".weeklynut").prop("value",nut);
            $(".numberoftrucks").prop("value",trucks);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function findData(id){

    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getData&routeId=' + id;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){

            $('.id').val(data['result'].routeid);
            $('.show_name').val(data['result'].showname);
            $('.numberoftruck').val(data['result'].numberoftrucks);
            $('.created_date').val(data['result'].dateroute);
            $('.weeklynut').val(data['result'].nut);

            $("#dataroute").show();
        }
        else{
            alert(data.msg);
        }
    }); 

}

function findDetailData(id){

    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getDetailData&routeDetailId=' + id;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){

            $('.id').val(data['result'].routeid);
            $('.detid').val(data['result'].routedetid);
            $('.presentation_date').val(data['result'].presentation_date);
            //$('.cityid').val(data['result'].cityid);
            $('.mileage').val(data['result'].mileage);
            $('.book_notes').val(data['result'].book_notes);
            $('.prod_notes').val(data['result'].prod_notes);
            $('.time_zone').val(data['result'].time_zone);
            $('.show_times').val(data['result'].show_times);
            $('.perf').val(data['result'].perf);
            //$('.venueid').val(data['result'].venueid);
            //$('.presenterid').val(data['result'].presenterid);
            $('.capacity').val(data['result'].capacity);
            $('.fixed_gntee').val(data['result'].fixed_gntee);
            $('.royalty').val(data['result'].royalty);
            $('.backend').val(data['result'].backend);
            $('.breakeven').val(data['result'].breakeven);
            $('.deal_notes').val(data['result'].deal_notes);
            $('.est_royalty').val(data['result'].est_royalty);
            $('.team_drive').val(data['result'].teamdrive);

            if(data['result'].holiday == 1){
                $('.holiday').prop('checked', true);
            };

            if(data['result'].repeat == 1){
                $('.repeat').prop('checked', true);
            };

            if(data['result'].on_sub == 1){
                $('.onsub').prop('checked', true);
            };

            if(data['result'].date_conf == 1){
                $('.dateconf').prop('checked', true);
            };

            if(data['result'].offer == 1){
                $('.offer').prop('checked', true);
            };

            if(data['result'].price_scales == 1){
                $('.price_scales').prop('checked', true);
            };

            if(data['result'].expenses == 1){
                $('.expenses').prop('checked', true);
            };

            if(data['result'].deal_memo == 1){
                $('.deal_memo').prop('checked', true);
            };

            if(data['result'].contract == 1){
                $('.contract').prop('checked', true);
            };         

            getPresenters(data['result'].presenterid);
            getVenues(data['result'].venueid);
            getGlobalLocation(data['result'].cityid);

            $("#datadetailroute").show();
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
    getCountries();
}

$(function() {

    $(".shows").on("change", function(ev) {
        var showId = $(this).val();
        if(showId != ''){
            getNUTOfShow(showId);
        }else{
            $(".shows option:gt(0)").remove();
        }
    });

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

    $("#btnUpload").click(function (ev) {
        getUploadFile();
    });

    $("#btnBackUpload").click(function (ev) {
        $("#settlement_data").hide();
        $("#settlement_uploadfile").show();
        $("#back_to_upload").hide();
    });

});