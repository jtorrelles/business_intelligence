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

function getAllCountries() {
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
            //$(".countries").val("231");
            //getStates(231);

            getVenuesFilters($("#countryId").val(),0,0);
        }
        else{
            alert(data.msg);
        }
    }); 
}

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

            getVenuesFilters($("#countryId").val(),0,0);
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

function getTemplates(module) {
    var call = new ajaxCall();
    $(".cities option:gt(0)").remove();
    var url = '../routes/templates_route.php?type=getByUser&module='+ module;
    var method = "GET";
    var data = {};
    $('.templates').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.templates').find("option:eq(0)").html("Select Template");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {             
                var option = $('<option />');
                option.attr('value', val.id).text(val.name);
                $('.templates').append(option);
            });
            $(".templates").prop("disabled",false);
			getTemplateFields(22);
        }
        else{
             alert(data.msg);
        }
    });
}

function getTemplateFields(templateId) {
    var call = new ajaxCall();
    var url = '../routes/templates_route.php?type=getFieldsById&templateId='+ templateId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var templatesKeys = [];
            $.each(data['result'], function(key, val) {         
                templatesKeys.push(val.field_name);
            });
            console.log(templatesKeys);
            $("#fields").multipleSelect('uncheckAll');
            $("#fields").multipleSelect("setSelects", templatesKeys);
        }
        else{
             alert(data.msg);
        }
    });
}

/*
    % - All shows
    Y - Active Shows
    N - Inactive Shows
*/
function getBasicShowsByStatus(status) {
    var call = new ajaxCall();
    var url = '../routes/shows_route.php?type=getShowsByStatus&status='+status;
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

function getShows(status) {
    var call = new ajaxCall();
    var url = '../routes/shows_route.php?type=getShowsByStatus&status='+status;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('#shows').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#shows').append($opt);
            });
            $("#shows").multipleSelect("refresh");
            $("#shows").remove("option[value='0']");
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
                $('#venues').append($opt);
            });
            $('#venues').multipleSelect("refresh");
            $("#venues").remove("option[value='0']");
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getPresenters() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getPresenters';
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('#presenters').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#presenters').append($opt);
            });
            $('#presenters').multipleSelect("refresh");
            $("#presenters").remove("option[value='0']");
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getParentPresenters() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getParentPresenters';
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
			$('.parentpresenters').find("option:eq(0)").html("Select Parent Company");
            //$('#parentpresenters').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#parentpresenters').append($opt);
            });
            $(".parentpresenters").prop("disabled",false);
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
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('#categories').find("option:eq(0)").remove();
            $.each(data['result'], function(key, val) {
                $opt = $("<option />", {
                    value: key,
                    text: val
                });
                $('#categories').append($opt);
            });
            $('#categories').multipleSelect("refresh");
            $("#categories").remove("option[value='0']");
        }
        else{
            alert(data.msg);
        }
    }); 
};

function getShowsByCategory(categories){
    var call = new ajaxCall();
    var url = '../routes/shows_route.php?type=getShowsByCategory&categoryId='+categories;
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
        }
        else{
            alert(data.msg);
        }
    });
}

function getVenuesFilters(countryId, stateId, cityId) {
    var call = new ajaxCall();
    var url = '../routes/venues_route.php?type=getVenuesFilter&countryId='+countryId+'&stateId='+stateId+'&cityId='+cityId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var venuesKeys = [];
            $.each(data['result'], function(key, val) {
                venuesKeys.push(key); 
            });
            $("#venues").multipleSelect('uncheckAll');
            $("#venues").multipleSelect("setSelects", venuesKeys);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function number_format(amount, decimals) {

    sign = '';
    amount += '';
    if(parseFloat(amount)<0){sign = '-';}
    amount = parseFloat(amount.replace(/[^0-9\.]/g, ''));
    decimals = decimals || 0; 

    if (isNaN(amount) || amount === 0) 
        return sign + parseFloat(0).toFixed(decimals);

    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return sign + amount_parts.join('.');
}

function strtonum(amount) {
    amount = amount.replace("%","");
    amount = amount.replace(/\,/g,"");
    amount = parseFloat(amount);
    return amount
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
	
    $('#presenters').multipleSelect({
        placeholder: "Select Presenters",
        filter:true,
        checkAll:false,
        width: '100%'
    });

    $('#categories').multipleSelect({
        placeholder: "Select Categories",
        filter:true,
        checkAll:false,
        selectAll: false,
        width: '100%',
        onClick: function(view) {
            $('#shows').multipleSelect("uncheckAll");
            getShowsByCategory($('#categories').multipleSelect("getSelects"));
        }
    });  

    $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        if(countryId != ''){
            getStates(countryId);
            getVenuesFilters(countryId,0,0); 
        }else{
            $(".states option:gt(0)").remove();
        }
    });

    $(".states").on("change", function(ev) {
        var stateId = $(this).val();
        if(stateId != ''){
            getCities(stateId);
            if(stateId == 0){
                var countryId = $("#countryId").val();
                getVenuesFilters(countryId,0,0); 
            }else{
                getVenuesFilters(0,stateId,0);
            } 
        }else{
            
            var countryId = $("#countryId").val();
            getVenuesFilters(countryId,0,0);  

            $(".cities option:gt(0)").remove();
        }
    });

    $(".cities").on("change", function(ev) {
        var cityId = $(this).val();

        if(cityId != ''){
            if(cityId == 0){
                var stateId = $("#stateId").val();
                getVenuesFilters(0,stateId,0); 
            }else{
                getVenuesFilters(0,0,cityId);
            } 
        }else{
            var stateId = $("#stateId").val();
            getVenuesFilters(0,stateId,0); 
        }

    });  

    $(".templates").on("change", function(ev) {
        var templateId = $(this).val();
        if(templateId != ''){
            getTemplateFields(templateId); 
        }else{
            $("#fields").multipleSelect('uncheckAll');
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
        $(".weekending").prop('checked',false);
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
        $("#header").empty();
        $("#body").empty();
        $("#loader").hide();
        $("#export").hide();
        $('#venues').multipleSelect("uncheckAll");
        $('#categories').multipleSelect("uncheckAll");
        $('#shows').multipleSelect("uncheckAll");
        $('#fields').multipleSelect("uncheckAll");
		$('#presenters').multipleSelect("uncheckAll");
		$(".parentpresenters").val("");
		getTemplateFields(22);
    });

    $("#btnCleanSalesSumary").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();
        $('#shows').multipleSelect("uncheckAll");
        $('#fields').multipleSelect("uncheckAll");

    }); 

    $("#btnCleanPlayedMarket").click(function (ev) {
        getCountries();

        $(".dateini").val("");
        $(".dateend").val("");
        $("#header").empty();
        $("#body").empty();

        $("#loader").hide();
        $("#export").hide();
        $('#categories').multipleSelect("uncheckAll");
        $('#shows').multipleSelect("uncheckAll");

    });    

});
