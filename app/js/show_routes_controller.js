
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
            $('.cityid').val(data['result'].cityid);
            $('.mileage').val(data['result'].mileage);
            $('.book_notes').val(data['result'].book_notes);
            $('.prod_notes').val(data['result'].prod_notes);
            $('.time_zone').val(data['result'].time_zone);
            $('.show_times').val(data['result'].show_times);
            $('.perf').val(data['result'].perf);
            $('.venueid').val(data['result'].venueid);
            $('.presenterid').val(data['result'].presenterid);
            $('.capacity').val(data['result'].capacity);
            $('.fixed_gntee').val(data['result'].fixed_gntee);
            $('.royalty').val(data['result'].royalty);
            $('.backend').val(data['result'].backend);
            $('.breakeven').val(data['result'].breakeven);
            $('.deal_notes').val(data['result'].deal_notes);
            $('.est_royalty').val(data['result'].est_royalty);
            $('.on_sub').val(data['result'].on_sub);
            $('.date_conf').val(data['result'].date_conf);

            if(data['result'].holiday == 1){
                $('.holiday').prop('checked', true);
            };

            if(data['result'].repeat == 1){
                $('.repeat').prop('checked', true);
            };

            if(data['result'].on_sub == 1){
                $('.on_sub').prop('checked', true);
            };

            if(data['result'].date_conf == 1){
                $('.date_conf').prop('checked', true);
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

            if(data['result'].deal_nemo == 1){
                $('.deal_nemo').prop('checked', true);
            };

            if(data['result'].contract == 1){
                $('.contract').prop('checked', true);
            };         

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
    var url = '../routes/show_routes_route.php?type=getUploadProcess';
    var method = "POST";
    var data = dataForm;
    call.sendUpload(data, url, method, function(data_response) {
        if(data_response.tp == 1){

            console.log(data_response);

            $('.showtorouteid').val(data_response['result'].showtorouteid);  
            $('.showtoroute').val(data_response['result'].showtoroute); 
            $('.numberoftrucks').val(data_response['result'].numberoftrucks); 
            $('.weeklynut').val(data_response['result'].weeklynut);
            $('.date_route').val(data_response['result'].date_route);
            for(i = 0; i < 364; i++){
              $('.presentation_date' + i).val(eval("data_response['result'].presentation_date" + i));
              $('.holiday' + i).val(eval("data_response['result'].holiday" + i));
              $('.city' + i).val(eval("data_response['result'].city" + i));
              $('.repeat' + i).val(eval("data_response['result'].repeat" + i));
              $('.mileage' + i).val(eval("data_response['result'].mileage" + i));
              $('.book_notes' + i).val(eval("data_response['result'].book_notes" + i));
              $('.prod_notes' + i).val(eval("data_response['result'].prod_notes" + i));
              $('.time_zone' + i).val(eval("data_response['result'].time_zone" + i));
              $('.show_times' + i).val(eval("data_response['result'].show_times" + i));
              $('.perf' + i).val(eval("data_response['result'].perf" + i));
              $('.venue' + i).val(eval("data_response['result'].venue" + i));
              $('.presenter' + i).val(eval("data_response['result'].presenter" + i));
              $('.capacity' + i).val(eval("data_response['result'].capacity" + i));
              $('.fixed_gntee' + i).val(eval("data_response['result'].fixed_gntee" + i));
              $('.royalty' + i).val(eval("data_response['result'].royalty" + i));
              $('.backend' + i).val(eval("data_response['result'].backend" + i));
              $('.breakeven' + i).val(eval("data_response['result'].breakeven" + i));
              $('.deal_notes' + i).val(eval("data_response['result'].deal_notes" + i));
              $('.est_royalty' + i).val(eval("data_response['result'].est_royalty" + i));
              $('.on_sub' + i).val(eval("data_response['result'].on_sub" + i));
              $('.date_conf' + i).val(eval("data_response['result'].date_conf" + i));
              $('.offer' + i).val(eval("data_response['result'].offer" + i));
              $('.price_scales' + i).val(eval("data_response['result'].price_scales" + i));
              $('.expenses' + i).val(eval("data_response['result'].expenses" + i));
              $('.deal_memo' + i).val(eval("data_response['result'].deal_memo" + i));
              $('.contract' + i).val(eval("data_response['result'].contract" + i));
            } 

            $("#route_data").show();
            $("#route_uploadfile").hide();
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
        $("#route_data").hide();
        $("#route_uploadfile").show();
        $("#back_to_upload").hide();
    });

});