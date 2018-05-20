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

function getShows() {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getShows';
    var method = "GET";
    var data = {};
    //$('#shows').multipleSelect({placeholder:"Please wait.."});
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('#shows').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#shows').append($opt).multipleSelect("refresh");
            });

            $("#shows").remove("option[value='0']");
            //$("#shows").multipleSelect("checkAll");
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getBasicShows() {
    var call = new ajaxCall();
    var url = '../routes/contracts_route.php?type=getShows';
    var method = "GET";
    var data = {};
    $('.shows').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.shows').find("option:eq(0)").html("Select Shows");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('.shows').append($opt);
            });
            $(".shows").prop("disabled",false);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getVenues() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getVenues';
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('#venues').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#venues').append($opt).multipleSelect("refresh");
            });

            $("#venues").remove("option[value='0']");
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getCategories() {
    var call = new ajaxCall();
    var url = '../routes/categories_route.php?type=getCategories';
    var method = "GET";
    var data = {};
    $('.categories').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.categories').find("option:eq(0)").html("Select Category");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.categories').append(option);
            });
            $(".categories").prop("disabled",false);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getShowsByCategory(categoryId){
    var call = new ajaxCall();
    var url = '../routes/shows_route.php?type=getShowsByCategory&categoryId='+categoryId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var showsKeys = [];
            $.each(data['result'], function(key, val) {
                showsKeys.push(key); 
            });
            $("#shows").multipleSelect('uncheckAll');
            $("#shows").multipleSelect("setSelects", showsKeys);
            $(".categories").prop("disabled",false);
        }
        else{
            alert(data.msg);
        }
    });
}

$(function() {

    $('#shows').multipleSelect({
        placeholder: "Select Shows",
        filter:true,
        checkAll:false,
        width: '100%'
    });

    $('#fields').multipleSelect({
        placeholder: "Select Fields",
        filter:true,
        checkAll:false,
        width: '100%'
    });

    $('#venues').multipleSelect({
        placeholder: "Select Venues",
        filter:true,
        checkAll:false,
        width: '100%'
    }); 

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

    $(".categories").on("change", function(ev) {
        var categoryId = $(this).val();
        if(categoryId != ''){
            getShowsByCategory(categoryId);
        }else{
            $(".categories option:gt(0)").remove();
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
        $('#shows').multipleSelect("uncheckAll");
    });

    $("#btnCleanConflictsRoutes").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $(".reasons").val("0");
        
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();
    });

    $("#btnCleanMarketHistory").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $(".venues").val("0");
        $(".presenters").val("0");
        $(".categories").val("0");
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();
        $('#shows').multipleSelect("uncheckAll");
        $('#fields').multipleSelect("uncheckAll");

    });

    $("#btnCleanSalesSumary").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $(".shows").val("0");
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();

    });

});