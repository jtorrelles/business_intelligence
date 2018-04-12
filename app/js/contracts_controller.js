var setShowID = 0;
var setVenueID = 0;
var setPresenterID = 0;

function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = type||'json';

    var successRes = function(data) {
        success(data);
    };

    var errorRes = function(e) {
        console.log(e);
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
}

function getShows() {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getShows';
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

            //set value
            if(setShowID != 0){
                $('.shows').val(setShowID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getPresenters() {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getPresenters';
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

            //set value
            if(setPresenterID != 0){
                $('.presenters').val(setPresenterID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getVenues() {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getVenues';
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

            //set value
            if(setVenueID != 0){
                $('.venues').val(setVenueID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getCityOfVenues(venueId) {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getCityOfVenues&venueId=' + venueId;
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
    var url = '../routes/contracts_route.php?type=getData&contractId=' + id;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){

            $('.id').val(data['result'].contractid);
            $('.opening_date').val(data['result'].opening_date);
            $('.closing_date').val(data['result'].closing_date);
            $(".number_of_performances").val(data['result'].num_performances);
            $('.gross_potential').val(data['result'].gross_potential);
            $('.tax').val(data['result'].tax);
            $('.guarantee').val(data['result'].guarantee);
            $('.variable_guarantee').val(data['result'].variable_guarantee);
            $('.producer_overages').val(data['result'].producer_overages);
            $('.sales_tax_1').val(data['result'].sales_tax_1);
            $('.sales_tax_2').val(data['result'].sales_tax_2);
            $('.facility_fees_1').val(data['result'].facility_fees_1);
            $('.facility_fees_2').val(data['result'].facility_fees_2);
            $('.group_commission').val(data['result'].group_com);
            $('.subscription_commission').val(data['result'].subsc_com);
            $('.phone_commission').val(data['result'].phone_com);
            $('.internet_commission').val(data['result'].int_com);
            $(".credit_card_commission").val(data['result'].cc_com);
            $('.remotes_commission').val(data['result'].rem_com);
            $('.fixed_expense').val(data['result'].fix_com);
            $('.documented_expense').val(data['result'].doc_com);
            $('.total_presenter_expense').val(data['result'].pre_com);
            $('.notes').val(data['result'].notes);
            $(".cityname").val(data['result'].cityname);
            $(".statename").val(data['result'].statename);
            $(".cityid").val(data['result'].cityid);
            $(".cityname").prop("disabled",true);
            $(".statename").prop("disabled",true);

            setShowID = data['result'].showid;
            setPresenterID = data['result'].presenterid;
            setVenueID = data['result'].venueid;

            getPresenters();
            getVenues();
            getShows();

            $("#datacontract").show();
        }
        else{
            alert(data.msg);
        }
    }); 

}

function onloadManagement(){
    getShows();
    getPresenters();
    getVenues();
}

$(function() {

$(".venues").on("change", function(ev) {
    var venueId = $(this).val();
    if(venueId != ''){
        getCityOfVenues(venueId);
    }else{
        $(".venues option:gt(0)").remove();
    }
});

$(".fixed_exp").on("input", function(ev) {
    var fixed =  $(this).val();
    var doc = $(".document_exp").val();
    var total = parseFloat(fixed) + parseFloat(doc);
    $(".total_exp").val(total);
});

$(".document_exp").on("input", function(ev) {
    var fixed = $(".fixed_exp").val();
    var doc =  $(this).val();
    var total = parseFloat(fixed) + parseFloat(doc);
    $(".total_exp").val(total);
});

});