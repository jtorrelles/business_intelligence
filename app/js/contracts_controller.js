
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