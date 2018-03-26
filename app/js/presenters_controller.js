
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

function getCities(id) {
    var call = new ajaxCall();

    $(".cities option:gt(0)").remove();
    var url = '../routes/presenters_route.php?type=getCities&stateId=' + id;
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

function getStates(id) {
    var call = new ajaxCall();

    $(".states option:gt(0)").remove(); 
    $(".cities option:gt(0)").remove(); 
    var url = '../routes/presenters_route.php?type=getStates&countryId=' + id;
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

function getCountries() {
    var call = new ajaxCall();

    var url = '../routes/presenters_route.php?type=getCountries';
    var method = "GET";
    var data = {};
    $('.countries').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.countries').find("option:eq(0)").html("Select Country");
        console.log(data);
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

function getPresenters(id) {
    var call = new ajaxCall();
    $(".presenter option:gt(0)").remove(); 
    var url = '../routes/presenters_route.php?type=getPresenters&stateId=' + id;
    var method = "GET";
    var data = {};
    $('.presenter').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.presenter').find("option:eq(0)").html("Select Presenter");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.presenter').append(option);
            });
            $(".presenter").prop("disabled",false);
        }
        else{
            alert(data.msg);
        }
    }); 
};

function findData(){

    var call = new ajaxCall();
    var presenterId = $('.presenter').val();
    var url = '../routes/presenters_route.php?type=getDataPresenters&presenterId=' + presenterId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            $('.id').val(data['result'].id);
            $('.name').val(data['result'].name);
            $('.address1').val(data['result'].address_1);
            $('.address2').val(data['result'].address_2);
            $('.zip').val(data['result'].zip);
            $('.fax').val(data['result'].fax);
            $('.email').val(data['result'].email);
            $('.notes').val(data['result'].notes);
            $(".active").val(data['result'].active);

            $("#datapresenter").show();
        }
        else{
            alert(data.msg);
        }
    }); 

};

$(function() {

getCountries();

 $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        if(countryId != ''){
            getStates(countryId);
        }
        else{
            $(".states option:gt(0)").remove();
        }
    });
     
$(".states").on("change", function(ev) {
    var selectID = $(this).attr('id');
    var stateId = $(this).val();
    if(selectID === 'stateId'){
        if(stateId != ''){
            getCities(stateId);
        }else{
            $(".cities option:gt(0)").remove();
        }
    }else{
        if(stateId != ''){
            getPresenters(stateId);
        }else{
            $(".presenter option:gt(0)").remove();
        }
    }
});

});


