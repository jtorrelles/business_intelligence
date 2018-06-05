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
    var method = "GET";
    var data = {};
    var tableSet;
    var tableCont;
    var tableRoutes;
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            settlementsSize = data.result['settlements'].length; 
            contractsSize = data.result['contracts'].length; 
            routesSize = data.result['routes'].length; 

            //Settlements
            if(settlementsSize > 0){
                for(var x=0; x<settlementsSize; x++){
                    tableSet = tableSet + "<tr>";
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].SHOWNAME  + '</td>';
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].OPENINGDATE  + '</td>';
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].CLOSINGDATE  + '</td>';
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].CITYNAME  + '</td>';
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].STATENAME  + '</td>';
                    tableSet = tableSet + '<td>' + data.result['settlements'][x].VENUENAME  + '</td>';
                    tableSet = tableSet + '<td><input type="button" class="button" id="btnSett'+data.result['settlements'][x].ID+'" value="Select"></td>';
                    tableSet = tableSet + "</tr>";
                }

                $("#body_settlements").append(tableSet);
                $("#settements_data").show();
                $("#settements_nodata").hide();

            }else{

                $("#settements_data").hide();
                $("#settements_nodata").show();
            }

            //Contracts
            if(contractsSize > 0){
                for(var x=0; x<contractsSize; x++){
                    tableCont = tableCont + "<tr>";
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].SHOWNAME  + '</td>';
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].OPENINGDATE  + '</td>';
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].CLOSINGDATE  + '</td>';
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].CITYNAME  + '</td>';
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].STATENAME  + '</td>';
                    tableCont = tableCont + '<td>' + data.result['contracts'][x].VENUENAME  + '</td>';
                    tableCont = tableCont + '<td><input type="button" class="button" id="btnSett'+data.result['contracts'][x].ID+'" value="Select"></td>';
                    tableCont = tableCont + "</tr>";
                }

                $("#body_contracts").append(tableCont);
                $("#contracts_data").show();
                $("#contracts_nodata").hide();
                
            }else{

                $("#contracts_data").hide();
                $("#contracts_nodata").show();
            } 

            //Routes
            if(routesSize > 0){
                for(var x=0; x<routesSize; x++){
                    tableRoutes = tableRoutes + "<tr>";
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].SHOWNAME  + '</td>';
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].OPENINGDATE  + '</td>';
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].CLOSINGDATE  + '</td>';
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].CITYNAME  + '</td>';
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].STATENAME  + '</td>';
                    tableRoutes = tableRoutes + '<td>' + data.result['routes'][x].VENUENAME  + '</td>';
                    tableRoutes = tableRoutes + '<td><input type="button" class="button" id="btnSett'+data.result['routes'][x].ID+'" value="Select"></td>';
                    tableRoutes = tableRoutes + "</tr>";
                }

                $("#body_routes").append(tableRoutes);
                $("#routes_data").show();
                $("#routes_nodata").hide();
                
            }else{
                $("#routes_data").hide();
                $("#routes_nodata").show();
            }  

            $("#loader").hide();
            $("#results").show();

        }else{
            alert(data.msg);  

            $("#loader").hide();
            $("#results").hide();
        }
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

    document.getElementById("NAPTII").value = number_format(NAPTII,2) + '$';
}

$(function() {

	$("#btnFindBreakevenSelection").click(function (ev) {

        $("#body_settlements").empty();
        $("#body_contracts").empty();
        $("#body_routes").empty();

        $("#routes_data").hide();
        $("#routes_nodata").hide();
        $("#settements_data").hide();
        $("#settements_nodata").hide();
        $("#contracts_data").hide();
        $("#contracts_nodata").hide();

        $("#results").hide(); 
        $("#loader").show();        

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
            cityId = "%"
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

    $("#btnCleanBreakevenSelection").click(function (ev) {

        getCountries();

        $("#body_settlements").empty();
        $("#body_contracts").empty();
        $("#body_routes").empty();

        $("#routes_data").hide();
        $("#routes_nodata").hide();
        $("#settements_data").hide();
        $("#settements_nodata").hide();
        $("#contracts_data").hide();
        $("#contracts_nodata").hide();

        $("#results").hide(); 
        $("#loader").hide();  

        $(".dateini").val("");
        $(".dateend").val("");
        $(".shows").val(0);
        $('#venues').multipleSelect("uncheckAll");

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