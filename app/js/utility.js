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

            //Sel United States
            $(".countries").val("231");
            getStates(231);
        }
        else{
            alert(data.msg);
        }
    }); 
}

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
            
        }
        else{
            alert(data.msg);
        }
    }); 
}

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
        }
        else{
             alert(data.msg);
        }
    });
}

$(function() {

    $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        if(countryId != ''){
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

    $("#btnCleanAllRoutes").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();

    });

});