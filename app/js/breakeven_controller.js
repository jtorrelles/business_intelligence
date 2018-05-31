
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

function getBreakevenSelection(inid,endd,country,state,city,showId) {    
    var call = new ajaxCall();
    var url = '../routes/breakeven_route.php?type=getAnalysisSelection&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&showId=' + showId;
    console.log(url);
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
    	console.log(data);
        /*if(data.tp == 1){

        }else{
            alert(data.msg);  
        }*/
    }); 
}

function BCalc() {

    var NSPWII = strtonum(document.getElementById("NSPWII").value);
    var NOW1II = strtonum(document.getElementById("NOW1II").value);
    var SPSHII = strtonum(document.getElementById("SPSHII").value);
    var WGPOII = strtonum(document.getElementById("WGPOII").value);
    var EXRAII = strtonum(document.getElementById("EXRAII").value);

    if(NSPWII!=0 && SPSHII!=0){
        NAPTII = WGPOII / (NSPWII * SPSHII);
    }else{
        NAPTII = '0.00';
    }

    document.getElementById("NAPTII").value = number_format(NAPTII,2) + '%';
}



$(function() {

	$("#btnFindBreakevenSelection").click(function (ev) {

		var countryId = $("#countryId").val();
		var stateId = $("#stateId").val();
		var cityId = $("#cityId").val();
		var showId = $("#showId").val();
		var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
		var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));

		if (isNaN(finicio.getTime()) || isNaN(ffin.getTime())) {
		    alert("INIT DATE and/or END DATE have invalid data, Please verify these values.");
		    $("#loader").hide();
		    return;
		}else{
		    
		    if(ffin.getTime() < finicio.getTime()){
		        alert("INIT DATE cannot be greater than END DATE, Please verify these values.");
		        $("#loader").hide();
		        return;
		    }
		}

		if((countryId == 0)||(countryId == "")||(countryId == null)){
            countryId = "%"
        }
        if((stateId == 0)||(stateId == "")||(stateId == null)){
            stateId = "%"
        }
        if((cityId == 0)||(cityId == "")||(cityId == null)){
            cityId = "%"
        }

        finicio = $(".dateini").val();
        ffin = $(".dateend").val();

        getBreakevenSelection(finicio,ffin,countryId,stateId,cityId,showId);
    });

});


$(document).ready(function(){  
  $('.money1').mask('000.000.000.000,00', {reverse: true});
  $('.money2').mask('000.000.000.000', {reverse: true});
  $('.money3').mask('000.000.000.000,00%', {reverse: true});
  $('.money4').mask('000.000.000.000%', {reverse: true});
  $('.money5').mask('000.000.000.000,00$', {reverse: true});
  $('.money6').mask('000.000.000.000$', {reverse: true});
});