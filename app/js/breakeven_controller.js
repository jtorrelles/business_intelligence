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

function getBreakevenSelection(inid,endd,country,state,city,showId,venues) {    
    var call = new ajaxCall();
    var url = '../routes/breakeven_route.php?type=getAnalysisSelection&inid=' + inid + 
                                                                        '&endd=' + endd + 
                                                                        '&country=' + country + 
                                                                        '&state=' + state + 
                                                                        '&city=' + city + 
                                                                        '&showId=' + showId + 
                                                                        '&venues=' + venues;
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

    NSPWII = strtonum(document.getElementById("NSPWII").value);
    NOW1II = strtonum(document.getElementById("NOW1II").value);
    SPSHII = strtonum(document.getElementById("SPSHII").value);
    WGPOII = strtonum(document.getElementById("WGPOII").value);
    EXRAII = strtonum(document.getElementById("EXRAII").value);
    
    HOCAW1 = strtonum(document.getElementById("HOCAW1").value);
    HOCAW2 = strtonum(document.getElementById("HOCAW2").value);
    HOCAW3 = strtonum(document.getElementById("HOCAW3").value);
    HOCAW4 = strtonum(document.getElementById("HOCAW4").value);
    HOCAR1 = strtonum(document.getElementById("HOCAR1").value);
    HOCAR2 = strtonum(document.getElementById("HOCAR2").value);
    HOCAR3 = strtonum(document.getElementById("HOCAR3").value);
    HOCAR4 = strtonum(document.getElementById("HOCAR4").value);
    HOCATT = strtonum(document.getElementById("HOCATT").value);
    
    PECAW1 = strtonum(document.getElementById("PECAW1").value)/100;
    PECAW2 = strtonum(document.getElementById("PECAW2").value)/100;
    PECAW3 = strtonum(document.getElementById("PECAW3").value)/100;
    PECAW4 = strtonum(document.getElementById("PECAW4").value)/100;
    PECAR1 = strtonum(document.getElementById("PECAR1").value)/100;
    PECAR2 = strtonum(document.getElementById("PECAR2").value)/100;
    PECAR3 = strtonum(document.getElementById("PECAR3").value)/100;
    PECAR4 = strtonum(document.getElementById("PECAR4").value)/100;
    PECATT = strtonum(document.getElementById("PECATT").value)/100;
    
    if(NSPWII!=0 && SPSHII!=0){
        NAPTII = WGPOII / (NSPWII * SPSHII);
    }else{
        NAPTII = '0.00';
    }

    document.getElementById("NAPTII").value = '$ ' + number_format(NAPTII,2);
    
    document.getElementById("HOCAW1").value = number_format((NSPWII * SPSHII));
    document.getElementById("HOCAW2").value = number_format((NSPWII * SPSHII));
    document.getElementById("HOCAW3").value = number_format((NSPWII * SPSHII));
    document.getElementById("HOCAW4").value = number_format((NSPWII * SPSHII));
    document.getElementById("HOCAR1").value = number_format((NSPWII * NOW1II * SPSHII));
    document.getElementById("HOCAR2").value = number_format((NSPWII * NOW1II * SPSHII));
    document.getElementById("HOCAR3").value = number_format((NSPWII * NOW1II * SPSHII));
    document.getElementById("HOCAR4").value = number_format((NSPWII * NOW1II * SPSHII));
    document.getElementById("HOCATT").value = number_format((NSPWII * SPSHII));

    document.getElementById("PECAR1").value = document.getElementById("PECAW1").value; 
    document.getElementById("PECAR2").value = document.getElementById("PECAW2").value;
    document.getElementById("PECAR3").value = document.getElementById("PECAW3").value;
    document.getElementById("PECAR4").value = document.getElementById("PECAW4").value;

    document.getElementById("TISOW1").value = number_format(HOCAW1 * PECAW1);
    document.getElementById("TISOW2").value = number_format(HOCAW2 * PECAW2);
    document.getElementById("TISOW3").value = number_format(HOCAW3 * PECAW3);
    document.getElementById("TISOW4").value = number_format(HOCAW4 * PECAW4);
    document.getElementById("TISOR1").value = number_format(NOW1II * HOCAR1 * PECAR1);
    document.getElementById("TISOR2").value = number_format(NOW1II * HOCAR2 * PECAR2);
    document.getElementById("TISOR3").value = number_format(NOW1II * HOCAR3 * PECAR3);
    document.getElementById("TISOR4").value = number_format(NOW1II * HOCAR4 * PECAR4);
    document.getElementById("TISOTT").value = number_format(HOCATT * PECATT);

    document.getElementById("NOW2R1").value = number_format(NOW1II);
    document.getElementById("NOW2R2").value = number_format(NOW1II);
    document.getElementById("NOW2R3").value = number_format(NOW1II);
    document.getElementById("NOW2R4").value = number_format(NOW1II);

    document.getElementById("BOGRW1").value = number_format(WGPOII * PECAW1);
    document.getElementById("BOGRW2").value = number_format(WGPOII * PECAW2);
    document.getElementById("BOGRW3").value = number_format(WGPOII * PECAW3);
    document.getElementById("BOGRW4").value = number_format(WGPOII * PECAW4);    
    document.getElementById("BOGRR1").value = number_format(NOW1II * WGPOII * PECAR1);
    document.getElementById("BOGRR2").value = number_format(NOW1II * WGPOII * PECAR2);
    document.getElementById("BOGRR3").value = number_format(NOW1II * WGPOII * PECAR3);
    document.getElementById("BOGRR4").value = number_format(NOW1II * WGPOII * PECAR4);
    document.getElementById("BOGRTT").value = number_format(WGPOII * PECATT);

    BOGRW1 = strtonum(document.getElementById("BOGRW1").value);
    BOGRW2 = strtonum(document.getElementById("BOGRW2").value);
    BOGRW3 = strtonum(document.getElementById("BOGRW3").value);
    BOGRW4 = strtonum(document.getElementById("BOGRW4").value);
    BOGRR1 = strtonum(document.getElementById("BOGRR1").value);
    BOGRR2 = strtonum(document.getElementById("BOGRR2").value);
    BOGRR3 = strtonum(document.getElementById("BOGRR3").value);
    BOGRR4 = strtonum(document.getElementById("BOGRR4").value);
    BOGRTT = strtonum(document.getElementById("BOGRTT").value);

    SLINII = strtonum(document.getElementById("SLINII").value);
    ESGRII = strtonum(document.getElementById("ESGRII").value);

    if(NOW1II!=0){
        SLINW0 = SLINII / NOW1II;
        ESGRW0 = ESGRII / NOW1II;
    }else{
        SLINW0 = '0';
        ESGRW0 = '0';
    }

    document.getElementById("SLINW1").value = number_format(SLINW0);    
    document.getElementById("SLINW2").value = number_format(SLINW0);
    document.getElementById("SLINW3").value = number_format(SLINW0);
    document.getElementById("SLINW4").value = number_format(SLINW0);    
    document.getElementById("SLINR1").value = number_format(SLINW0 * NOW1II);
    document.getElementById("SLINR2").value = number_format(SLINW0 * NOW1II);
    document.getElementById("SLINR3").value = number_format(SLINW0 * NOW1II);
    document.getElementById("SLINR4").value = number_format(SLINW0 * NOW1II);
    document.getElementById("SLINTT").value = number_format(SLINW0);

    SLINW1 = strtonum(document.getElementById("SLINW1").value);
    SLINW2 = strtonum(document.getElementById("SLINW2").value);
    SLINW3 = strtonum(document.getElementById("SLINW3").value);
    SLINW4 = strtonum(document.getElementById("SLINW4").value);
    SLINR1 = strtonum(document.getElementById("SLINR1").value);
    SLINR2 = strtonum(document.getElementById("SLINR2").value);
    SLINR3 = strtonum(document.getElementById("SLINR3").value);
    SLINR4 = strtonum(document.getElementById("SLINR4").value);
    SLINTT = strtonum(document.getElementById("SLINTT").value);

    document.getElementById("ESGRW1").value = number_format(ESGRW0);
    document.getElementById("ESGRW2").value = number_format(ESGRW0);
    document.getElementById("ESGRW3").value = number_format(ESGRW0);
    document.getElementById("ESGRW4").value = number_format(ESGRW0);
    document.getElementById("ESGRR1").value = number_format(ESGRII);
    document.getElementById("ESGRR2").value = number_format(ESGRII);
    document.getElementById("ESGRR3").value = number_format(ESGRII);
    document.getElementById("ESGRR4").value = number_format(ESGRII);
    document.getElementById("ESGRTT").value = number_format(ESGRW0);

    ESGRW1 = strtonum(document.getElementById("ESGRW1").value);
    ESGRW2 = strtonum(document.getElementById("ESGRW2").value);
    ESGRW3 = strtonum(document.getElementById("ESGRW3").value);
    ESGRW4 = strtonum(document.getElementById("ESGRW4").value);
    ESGRR1 = strtonum(document.getElementById("ESGRR1").value);
    ESGRR2 = strtonum(document.getElementById("ESGRR2").value);
    ESGRR3 = strtonum(document.getElementById("ESGRR3").value);
    ESGRR4 = strtonum(document.getElementById("ESGRR4").value); 
    ESGRTT = strtonum(document.getElementById("ESGRTT").value);   

    if((BOGRW1-SLINW1-ESGRW1)>0){
        ESSIW1 = (BOGRW1-SLINW1-ESGRW1);
    }else{
        ESSIW1 = '0';
    }

    if((BOGRW2-SLINW2-ESGRW2)>0){
        ESSIW2 = (BOGRW2-SLINW2-ESGRW2);
    }else{
        ESSIW2 = '0';
    }

    if((BOGRW3-SLINW3-ESGRW3)>0){
        ESSIW3 = (BOGRW3-SLINW3-ESGRW3);
    }else{
        ESSIW3 = '0';
    }

    if((BOGRW4-SLINW4-ESGRW4)>0){
        ESSIW4 = (BOGRW4-SLINW4-ESGRW4);
    }else{
        ESSIW4 = '0';
    }

    document.getElementById("ESSIW1").value = number_format(ESSIW1);
    document.getElementById("ESSIW2").value = number_format(ESSIW2);
    document.getElementById("ESSIW3").value = number_format(ESSIW3);
    document.getElementById("ESSIW4").value = number_format(ESSIW4);

    if((BOGRR1-SLINR1-ESGRR1)>0){
        ESSIR1 = (BOGRR1-SLINR1-ESGRR1);
    }else{
        ESSIR1 = '0';
    }

    if((BOGRR2-SLINR2-ESGRR2)>0){
        ESSIR2 = (BOGRR2-SLINR2-ESGRR2);
    }else{
        ESSIR2 = '0';
    }

    if((BOGRR3-SLINR3-ESGRR3)>0){
        ESSIR3 = (BOGRR3-SLINR3-ESGRR3);
    }else{
        ESSIR3 = '0';
    }

    if((BOGRR4-SLINR4-ESGRR4)>0){
        ESSIR4 = (BOGRR4-SLINR4-ESGRR4);
    }else{
        ESSIR4 = '0';
    }

    document.getElementById("ESSIR1").value = number_format(ESSIR1);
    document.getElementById("ESSIR2").value = number_format(ESSIR2);
    document.getElementById("ESSIR3").value = number_format(ESSIR3);
    document.getElementById("ESSIR4").value = number_format(ESSIR4);

    if((BOGRTT-SLINTT-ESGRTT)>0){
        ESSITT = (BOGRTT-SLINTT-ESGRTT);
    }else{
        ESSITT = '0';
    }

    document.getElementById("ESSITT").value = number_format(ESSITT);

    LSUDII = strtonum(document.getElementById("LSUDII").value)/100;

    document.getElementById("LSUDW1").value = number_format(-(SLINW1/(1-LSUDII))+SLINW1,2);
    document.getElementById("LSUDW2").value = number_format(-(SLINW2/(1-LSUDII))+SLINW2,2);
    document.getElementById("LSUDW3").value = number_format(-(SLINW3/(1-LSUDII))+SLINW3,2);
    document.getElementById("LSUDW4").value = number_format(-(SLINW4/(1-LSUDII))+SLINW4,2);
    document.getElementById("LSUDR1").value = number_format(-(SLINR1/(1-LSUDII))+SLINR1,2);
    document.getElementById("LSUDR2").value = number_format(-(SLINR2/(1-LSUDII))+SLINR2,2);
    document.getElementById("LSUDR3").value = number_format(-(SLINR3/(1-LSUDII))+SLINR3,2);
    document.getElementById("LSUDR4").value = number_format(-(SLINR4/(1-LSUDII))+SLINR4,2);
    document.getElementById("LSUDTT").value = number_format(-(SLINTT/(1-LSUDII))+SLINTT,2);

}
    
$(function() {

	$("#btnFindBreakevenSelection").click(function (ev) {

		var countryId = $("#countryId").val();
		var stateId = $("#stateId").val();
		var cityId = $("#cityId").val();
		var showId = $("#showId").val();
        var venues = $("#venues").multipleSelect("getSelects");
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
            alert("COUNTRY is not selected, Please verify these values.");
            $("#loader").hide();
            return;
        }
        if((stateId == 0)||(stateId == "")||(stateId == null)){
            alert("STATE is not selected, Please verify these values.");
            $("#loader").hide();
            return;
        }
        if((cityId == 0)||(cityId == "")||(cityId == null)){
            alert("CITY is not selected, Please verify these values.");
            $("#loader").hide();
            return;
        }        
        if((showId == 0)||(showId == "")||(showId == null)){
            alert("SHOW is not selected, Please verify these values.");
            $("#loader").hide();
            return;
        }
        if((venues == 0)||(venues == "")||(venues == null)){
            alert("VENUES is not selected, Please verify these values.");
            $("#loader").hide();
            return;
        }

        finicio = $(".dateini").val();
        ffin = $(".dateend").val();

        getBreakevenSelection(finicio,ffin,countryId,stateId,cityId,showId,venues);
    });

});

$(document).ready(function(){  
  $(".m1").maskMoney({precision:2, allowNegative:true});
  $(".m2").maskMoney({precision:0, allowNegative:true});
  $(".m3").maskMoney({precision:2});
  $(".m4").maskMoney({precision:0});
  $(".m5").maskMoney({precision:2, suffix:'%'});
  $(".m6").maskMoney({precision:0, suffix:'%'});
  $(".m7").maskMoney({precision:2, prefix:'$ '});
  $(".m8").maskMoney({precision:0, prefix:'$ '});
});

