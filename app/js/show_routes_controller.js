
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

            //Sel United States
            $(".countries").val("231");
            getStates(231);
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
        }
        else{
             alert(data.msg);
        }
    });
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

function getNUTOfShow(showId) {
    var call = new ajaxCall();
    var url = '../routes/show_routes_route.php?type=getNUTOfShow&showId=' + showId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var nut = data['result'].nut;

            $(".weeklynut").prop("value",nut);
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