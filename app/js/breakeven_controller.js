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
                    tableSet = tableSet + '<td><input type="hidden" class="data" id="sett'+x+'"><input type="button" class="button" id="btnSett'+x+'" onclick="setDataSettlementsToBreakeven('+x+')" value="Select"></td>';
                    tableSet = tableSet + "</tr>";

                    $("#body_settlements").append(tableSet);

                    tableSet = "";

                    document.getElementById("sett"+x).value = JSON.stringify(data.result['settlements'][x]);
                }

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
                    tableCont = tableCont + '<td><input type="hidden" class="data" id="cont'+x+'"><input type="button" class="button" id="btnCont'+x+'" onclick="setDataContractsToBreakeven('+x+')" value="Select"></td>';
                    tableCont = tableCont + "</tr>";

                    $("#body_contracts").append(tableCont);

                    tableCont = "";

                    document.getElementById("cont"+x).value  = JSON.stringify(data.result['contracts'][x]);
                }

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
                    tableRoutes = tableRoutes + '<td><input type="hidden" class="data" id="route'+x+'"><input type="button" class="button" id="btnRoute'+x+'" onclick="setDataRoutesToBreakeven('+x+')" value="Select"></td>';
                    tableRoutes = tableRoutes + "</tr>";

                    $("#body_routes").append(tableRoutes);

                    tableRoutes = "";

                    document.getElementById("route"+x).value  = JSON.stringify(data.result['routes'][x]);
                }

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
    
    document.getElementById("HOCAW1").value = number_format((NSPWII*SPSHII));
    document.getElementById("HOCAW2").value = number_format((NSPWII*SPSHII));
    document.getElementById("HOCAW3").value = number_format((NSPWII*SPSHII));
    document.getElementById("HOCAW4").value = number_format((NSPWII*SPSHII));
    document.getElementById("HOCAR1").value = number_format((NSPWII*NOW1II*SPSHII));
    document.getElementById("HOCAR2").value = number_format((NSPWII*NOW1II*SPSHII));
    document.getElementById("HOCAR3").value = number_format((NSPWII*NOW1II*SPSHII));
    document.getElementById("HOCAR4").value = number_format((NSPWII*NOW1II*SPSHII));
    document.getElementById("HOCATT").value = number_format((NSPWII*SPSHII));

    document.getElementById("PECAR1").value = document.getElementById("PECAW1").value; 
    document.getElementById("PECAR2").value = document.getElementById("PECAW2").value;
    document.getElementById("PECAR3").value = document.getElementById("PECAW3").value;
    document.getElementById("PECAR4").value = document.getElementById("PECAW4").value;

    document.getElementById("TISOW1").value = number_format(HOCAW1*PECAW1);
    document.getElementById("TISOW2").value = number_format(HOCAW2*PECAW2);
    document.getElementById("TISOW3").value = number_format(HOCAW3*PECAW3);
    document.getElementById("TISOW4").value = number_format(HOCAW4*PECAW4);
    document.getElementById("TISOR1").value = number_format(NOW1II*HOCAR1*PECAR1);
    document.getElementById("TISOR2").value = number_format(NOW1II*HOCAR2*PECAR2);
    document.getElementById("TISOR3").value = number_format(NOW1II*HOCAR3*PECAR3);
    document.getElementById("TISOR4").value = number_format(NOW1II*HOCAR4*PECAR4);
    document.getElementById("TISOTT").value = number_format(HOCATT*PECATT);

    TISOW1 = strtonum(document.getElementById("TISOW1").value);
    TISOW2 = strtonum(document.getElementById("TISOW2").value);
    TISOW3 = strtonum(document.getElementById("TISOW3").value);
    TISOW4 = strtonum(document.getElementById("TISOW4").value);
    TISOR1 = strtonum(document.getElementById("TISOR1").value);
    TISOR2 = strtonum(document.getElementById("TISOR2").value);
    TISOR3 = strtonum(document.getElementById("TISOR3").value);
    TISOR4 = strtonum(document.getElementById("TISOR4").value);
    TISOTT = strtonum(document.getElementById("TISOTT").value);

    document.getElementById("NOW2R1").value = number_format(NOW1II);
    document.getElementById("NOW2R2").value = number_format(NOW1II);
    document.getElementById("NOW2R3").value = number_format(NOW1II);
    document.getElementById("NOW2R4").value = number_format(NOW1II);

    document.getElementById("BOGRW1").value = number_format(WGPOII*PECAW1);
    document.getElementById("BOGRW2").value = number_format(WGPOII*PECAW2);
    document.getElementById("BOGRW3").value = number_format(WGPOII*PECAW3);
    document.getElementById("BOGRW4").value = number_format(WGPOII*PECAW4);    
    document.getElementById("BOGRR1").value = number_format(NOW1II*WGPOII*PECAR1);
    document.getElementById("BOGRR2").value = number_format(NOW1II*WGPOII*PECAR2);
    document.getElementById("BOGRR3").value = number_format(NOW1II*WGPOII*PECAR3);
    document.getElementById("BOGRR4").value = number_format(NOW1II*WGPOII*PECAR4);
    document.getElementById("BOGRTT").value = number_format(WGPOII*PECATT);

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
    document.getElementById("SLINR1").value = number_format(SLINW0*NOW1II);
    document.getElementById("SLINR2").value = number_format(SLINW0*NOW1II);
    document.getElementById("SLINR3").value = number_format(SLINW0*NOW1II);
    document.getElementById("SLINR4").value = number_format(SLINW0*NOW1II);
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

    ESSIW1 = strtonum(document.getElementById("ESSIW1").value);
    ESSIW2 = strtonum(document.getElementById("ESSIW2").value);
    ESSIW3 = strtonum(document.getElementById("ESSIW3").value);
    ESSIW4 = strtonum(document.getElementById("ESSIW4").value);
    ESSIR1 = strtonum(document.getElementById("ESSIR1").value);
    ESSIR2 = strtonum(document.getElementById("ESSIR2").value);
    ESSIR3 = strtonum(document.getElementById("ESSIR3").value);
    ESSIR4 = strtonum(document.getElementById("ESSIR4").value);
    ESSITT = strtonum(document.getElementById("ESSITT").value);

    LSUDII = strtonum(document.getElementById("LSUDII").value)/100;

    document.getElementById("LSUDW1").value = number_format(-(SLINW1/(1-LSUDII))+SLINW1);
    document.getElementById("LSUDW2").value = number_format(-(SLINW2/(1-LSUDII))+SLINW2);
    document.getElementById("LSUDW3").value = number_format(-(SLINW3/(1-LSUDII))+SLINW3);
    document.getElementById("LSUDW4").value = number_format(-(SLINW4/(1-LSUDII))+SLINW4);
    document.getElementById("LSUDR1").value = number_format(-(SLINR1/(1-LSUDII))+SLINR1);
    document.getElementById("LSUDR2").value = number_format(-(SLINR2/(1-LSUDII))+SLINR2);
    document.getElementById("LSUDR3").value = number_format(-(SLINR3/(1-LSUDII))+SLINR3);
    document.getElementById("LSUDR4").value = number_format(-(SLINR4/(1-LSUDII))+SLINR4);
    document.getElementById("LSUDTT").value = number_format(-(SLINTT/(1-LSUDII))+SLINTT);

    LSUDW1 = strtonum(document.getElementById("LSUDW1").value);
    LSUDW2 = strtonum(document.getElementById("LSUDW2").value);
    LSUDW3 = strtonum(document.getElementById("LSUDW3").value);
    LSUDW4 = strtonum(document.getElementById("LSUDW4").value);
    LSUDR1 = strtonum(document.getElementById("LSUDR1").value);
    LSUDR2 = strtonum(document.getElementById("LSUDR2").value);
    LSUDR3 = strtonum(document.getElementById("LSUDR3").value);
    LSUDR4 = strtonum(document.getElementById("LSUDR4").value);
    LSUDTT = strtonum(document.getElementById("LSUDTT").value);

    LGRDII = strtonum(document.getElementById("LGRDII").value)/100;

    document.getElementById("LGRDW1").value = number_format(-(ESGRW1/(1-LGRDII))+ESGRW1);
    document.getElementById("LGRDW2").value = number_format(-(ESGRW2/(1-LGRDII))+ESGRW2);
    document.getElementById("LGRDW3").value = number_format(-(ESGRW3/(1-LGRDII))+ESGRW3);
    document.getElementById("LGRDW4").value = number_format(-(ESGRW4/(1-LGRDII))+ESGRW4);
    document.getElementById("LGRDR1").value = number_format(-(ESGRR1/(1-LGRDII))+ESGRR1);
    document.getElementById("LGRDR2").value = number_format(-(ESGRR2/(1-LGRDII))+ESGRR2);
    document.getElementById("LGRDR3").value = number_format(-(ESGRR3/(1-LGRDII))+ESGRR3);
    document.getElementById("LGRDR4").value = number_format(-(ESGRR4/(1-LGRDII))+ESGRR4);
    document.getElementById("LGRDTT").value = number_format(-(ESGRTT/(1-LGRDII))+ESGRTT);

    LGRDW1 = strtonum(document.getElementById("LGRDW1").value);
    LGRDW2 = strtonum(document.getElementById("LGRDW2").value);
    LGRDW3 = strtonum(document.getElementById("LGRDW3").value);
    LGRDW4 = strtonum(document.getElementById("LGRDW4").value);
    LGRDR1 = strtonum(document.getElementById("LGRDR1").value);
    LGRDR2 = strtonum(document.getElementById("LGRDR2").value);
    LGRDR3 = strtonum(document.getElementById("LGRDR3").value);
    LGRDR4 = strtonum(document.getElementById("LGRDR4").value);
    LGRDTT = strtonum(document.getElementById("LGRDTT").value);

    LSIDII = strtonum(document.getElementById("LSIDII").value)/100;

    document.getElementById("LSIDW1").value = number_format(-ESSIW1*LSIDII);
    document.getElementById("LSIDW2").value = number_format(-ESSIW2*LSIDII);
    document.getElementById("LSIDW3").value = number_format(-ESSIW3*LSIDII);
    document.getElementById("LSIDW4").value = number_format(-ESSIW4*LSIDII);
    document.getElementById("LSIDR1").value = number_format(-ESSIR1*LSIDII);
    document.getElementById("LSIDR2").value = number_format(-ESSIR2*LSIDII);
    document.getElementById("LSIDR3").value = number_format(-ESSIR3*LSIDII);
    document.getElementById("LSIDR4").value = number_format(-ESSIR4*LSIDII);
    document.getElementById("LSIDTT").value = number_format(-ESSITT*LSIDII);

    LSIDW1 = strtonum(document.getElementById("LSIDW1").value);
    LSIDW2 = strtonum(document.getElementById("LSIDW2").value);
    LSIDW3 = strtonum(document.getElementById("LSIDW3").value);
    LSIDW4 = strtonum(document.getElementById("LSIDW4").value);
    LSIDR1 = strtonum(document.getElementById("LSIDR1").value);
    LSIDR2 = strtonum(document.getElementById("LSIDR2").value);
    LSIDR3 = strtonum(document.getElementById("LSIDR3").value);
    LSIDR4 = strtonum(document.getElementById("LSIDR4").value);
    LSIDTT = strtonum(document.getElementById("LSIDTT").value);

    document.getElementById("AGROW1").value = number_format(SLINW1+ESGRW1+ESSIW1+LSUDW1+LGRDW1+LSIDW1);
    document.getElementById("AGROW2").value = number_format(SLINW2+ESGRW2+ESSIW2+LSUDW2+LGRDW2+LSIDW2);
    document.getElementById("AGROW3").value = number_format(SLINW3+ESGRW3+ESSIW3+LSUDW3+LGRDW3+LSIDW3);
    document.getElementById("AGROW4").value = number_format(SLINW4+ESGRW4+ESSIW4+LSUDW4+LGRDW4+LSIDW4);
    document.getElementById("AGROR1").value = number_format(SLINR1+ESGRR1+ESSIR1+LSUDR1+LGRDR1+LSIDR1);
    document.getElementById("AGROR2").value = number_format(SLINR2+ESGRR2+ESSIR2+LSUDR2+LGRDR2+LSIDR2);
    document.getElementById("AGROR3").value = number_format(SLINR3+ESGRR3+ESSIR3+LSUDR3+LGRDR3+LSIDR3);
    document.getElementById("AGROR4").value = number_format(SLINR4+ESGRR4+ESSIR4+LSUDR4+LGRDR4+LSIDR4);
    document.getElementById("AGROTT").value = number_format(SLINTT+ESGRTT+ESSITT+LSUDTT+LGRDTT+LSIDTT);

    AGROW1 = strtonum(document.getElementById("AGROW1").value);
    AGROW2 = strtonum(document.getElementById("AGROW2").value);
    AGROW3 = strtonum(document.getElementById("AGROW3").value);
    AGROW4 = strtonum(document.getElementById("AGROW4").value);
    AGROR1 = strtonum(document.getElementById("AGROR1").value);
    AGROR2 = strtonum(document.getElementById("AGROR2").value);
    AGROR3 = strtonum(document.getElementById("AGROR3").value);
    AGROR4 = strtonum(document.getElementById("AGROR4").value);
    AGROTT = strtonum(document.getElementById("AGROTT").value);

    document.getElementById("AGPPW1").value = number_format((AGROW1/WGPOII)*100) + '%';
    document.getElementById("AGPPW2").value = number_format((AGROW2/WGPOII)*100) + '%';
    document.getElementById("AGPPW3").value = number_format((AGROW3/WGPOII)*100) + '%';
    document.getElementById("AGPPW4").value = number_format((AGROW4/WGPOII)*100) + '%';
    document.getElementById("AGPPR1").value = number_format((AGROR1/(WGPOII*NOW1II))*100) + '%';
    document.getElementById("AGPPR2").value = number_format((AGROR2/(WGPOII*NOW1II))*100) + '%';
    document.getElementById("AGPPR3").value = number_format((AGROR3/(WGPOII*NOW1II))*100) + '%';
    document.getElementById("AGPPR4").value = number_format((AGROR4/(WGPOII*NOW1II))*100) + '%';
    document.getElementById("AGPPTT").value = number_format((AGROTT/WGPOII)*100) + '%';

    AGPPW1 = strtonum(document.getElementById("AGPPW1").value)/100;
    AGPPW2 = strtonum(document.getElementById("AGPPW2").value)/100;
    AGPPW3 = strtonum(document.getElementById("AGPPW3").value)/100;
    AGPPW4 = strtonum(document.getElementById("AGPPW4").value)/100;
    AGPPR1 = strtonum(document.getElementById("AGPPR1").value)/100;
    AGPPR2 = strtonum(document.getElementById("AGPPR2").value)/100;
    AGPPR3 = strtonum(document.getElementById("AGPPR3").value)/100;
    AGPPR4 = strtonum(document.getElementById("AGPPR4").value)/100;
    AGPPTT = strtonum(document.getElementById("AGPPTT").value)/100;

    document.getElementById("CUEBII").value = '$ ' + number_format(AGROTT*NOW1II);

    TAX1II = strtonum(document.getElementById("TAX1II").value)/100;

    document.getElementById("TAX1W1").value = number_format(-AGROW1/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1W2").value = number_format(-AGROW2/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1W3").value = number_format(-AGROW3/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1W4").value = number_format(-AGROW4/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1R1").value = number_format(-AGROR1/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1R2").value = number_format(-AGROR2/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1R3").value = number_format(-AGROR3/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1R4").value = number_format(-AGROR4/(1+TAX1II)*TAX1II);
    document.getElementById("TAX1TT").value = number_format(-AGROTT/(1+TAX1II)*TAX1II);

    TAX1W1 = strtonum(document.getElementById("TAX1W1").value);
    TAX1W2 = strtonum(document.getElementById("TAX1W2").value);
    TAX1W3 = strtonum(document.getElementById("TAX1W3").value);
    TAX1W4 = strtonum(document.getElementById("TAX1W4").value);
    TAX1R1 = strtonum(document.getElementById("TAX1R1").value);
    TAX1R2 = strtonum(document.getElementById("TAX1R2").value);
    TAX1R3 = strtonum(document.getElementById("TAX1R3").value);
    TAX1R4 = strtonum(document.getElementById("TAX1R4").value);
    TAX1TT = strtonum(document.getElementById("TAX1TT").value);

    TAX2II = strtonum(document.getElementById("TAX2II").value)/100;

    document.getElementById("TAX2W1").value = number_format(-AGROW1/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2W2").value = number_format(-AGROW2/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2W3").value = number_format(-AGROW3/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2W4").value = number_format(-AGROW4/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2R1").value = number_format(-AGROR1/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2R2").value = number_format(-AGROR2/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2R3").value = number_format(-AGROR3/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2R4").value = number_format(-AGROR4/(1+TAX2II)*TAX2II);
    document.getElementById("TAX2TT").value = number_format(-AGROTT/(1+TAX2II)*TAX2II);

    TAX2W1 = strtonum(document.getElementById("TAX2W1").value);
    TAX2W2 = strtonum(document.getElementById("TAX2W2").value);
    TAX2W3 = strtonum(document.getElementById("TAX2W3").value);
    TAX2W4 = strtonum(document.getElementById("TAX2W4").value);
    TAX2R1 = strtonum(document.getElementById("TAX2R1").value);
    TAX2R2 = strtonum(document.getElementById("TAX2R2").value);
    TAX2R3 = strtonum(document.getElementById("TAX2R3").value);
    TAX2R4 = strtonum(document.getElementById("TAX2R4").value);
    TAX2TT = strtonum(document.getElementById("TAX2TT").value);

    FAF1II = strtonum(document.getElementById("FAF1II").value.replace("$",""));

    document.getElementById("FAF1W1").value = number_format(-TISOW1*FAF1II);
    document.getElementById("FAF1W2").value = number_format(-TISOW2*FAF1II);
    document.getElementById("FAF1W3").value = number_format(-TISOW3*FAF1II);
    document.getElementById("FAF1W4").value = number_format(-TISOW4*FAF1II);
    document.getElementById("FAF1R1").value = number_format(-TISOW1*FAF1II*NOW1II);
    document.getElementById("FAF1R2").value = number_format(-TISOW2*FAF1II*NOW1II);
    document.getElementById("FAF1R3").value = number_format(-TISOW3*FAF1II*NOW1II);
    document.getElementById("FAF1R4").value = number_format(-TISOW4*FAF1II*NOW1II);
    document.getElementById("FAF1TT").value = number_format(-TISOTT*FAF1II);

    FAF1W1 = strtonum(document.getElementById("FAF1W1").value);
    FAF1W2 = strtonum(document.getElementById("FAF1W2").value);
    FAF1W3 = strtonum(document.getElementById("FAF1W3").value);
    FAF1W4 = strtonum(document.getElementById("FAF1W4").value);
    FAF1R1 = strtonum(document.getElementById("FAF1R1").value);
    FAF1R2 = strtonum(document.getElementById("FAF1R2").value);
    FAF1R3 = strtonum(document.getElementById("FAF1R3").value);
    FAF1R4 = strtonum(document.getElementById("FAF1R4").value);
    FAF1TT = strtonum(document.getElementById("FAF1TT").value);

    FAF2II = strtonum(document.getElementById("FAF2II").value.replace("$",""));

    document.getElementById("FAF2W1").value = number_format(-TISOW1*FAF2II);
    document.getElementById("FAF2W2").value = number_format(-TISOW2*FAF2II);
    document.getElementById("FAF2W3").value = number_format(-TISOW3*FAF2II);
    document.getElementById("FAF2W4").value = number_format(-TISOW4*FAF2II);
    document.getElementById("FAF2R1").value = number_format(-TISOW1*FAF2II*NOW1II);
    document.getElementById("FAF2R2").value = number_format(-TISOW2*FAF2II*NOW1II);
    document.getElementById("FAF2R3").value = number_format(-TISOW3*FAF2II*NOW1II);
    document.getElementById("FAF2R4").value = number_format(-TISOW4*FAF2II*NOW1II);
    document.getElementById("FAF2TT").value = number_format(-TISOTT*FAF2II);

    FAF2W1 = strtonum(document.getElementById("FAF2W1").value);
    FAF2W2 = strtonum(document.getElementById("FAF2W2").value);
    FAF2W3 = strtonum(document.getElementById("FAF2W3").value);
    FAF2W4 = strtonum(document.getElementById("FAF2W4").value);
    FAF2R1 = strtonum(document.getElementById("FAF2R1").value);
    FAF2R2 = strtonum(document.getElementById("FAF2R2").value);
    FAF2R3 = strtonum(document.getElementById("FAF2R3").value);
    FAF2R4 = strtonum(document.getElementById("FAF2R4").value);
    FAF2TT = strtonum(document.getElementById("FAF2TT").value);

    SUBCII = strtonum(document.getElementById("SUBCII").value)/100;

    document.getElementById("SUBCW1").value = number_format(-SLINW1*SUBCII);
    document.getElementById("SUBCW2").value = number_format(-SLINW2*SUBCII);
    document.getElementById("SUBCW3").value = number_format(-SLINW3*SUBCII);
    document.getElementById("SUBCW4").value = number_format(-SLINW4*SUBCII);
    document.getElementById("SUBCR1").value = number_format(-SLINR1*SUBCII);
    document.getElementById("SUBCR2").value = number_format(-SLINR2*SUBCII);
    document.getElementById("SUBCR3").value = number_format(-SLINR3*SUBCII);
    document.getElementById("SUBCR4").value = number_format(-SLINR4*SUBCII);
    document.getElementById("SUBCTT").value = number_format(-SLINTT*SUBCII);

    SUBCW1 = strtonum(document.getElementById("SUBCW1").value);
    SUBCW2 = strtonum(document.getElementById("SUBCW2").value);
    SUBCW3 = strtonum(document.getElementById("SUBCW3").value);
    SUBCW4 = strtonum(document.getElementById("SUBCW4").value);
    SUBCR1 = strtonum(document.getElementById("SUBCR1").value);
    SUBCR2 = strtonum(document.getElementById("SUBCR2").value);
    SUBCR3 = strtonum(document.getElementById("SUBCR3").value);
    SUBCR4 = strtonum(document.getElementById("SUBCR4").value);
    SUBCTT = strtonum(document.getElementById("SUBCTT").value);

    GSACII = strtonum(document.getElementById("GSACII").value)/100;

    document.getElementById("GSACW1").value = number_format(-GSACII*ESGRW1);
    document.getElementById("GSACW2").value = number_format(-GSACII*ESGRW2);
    document.getElementById("GSACW3").value = number_format(-GSACII*ESGRW3);
    document.getElementById("GSACW4").value = number_format(-GSACII*ESGRW4);
    document.getElementById("GSACR1").value = number_format(-GSACII*ESGRR1);
    document.getElementById("GSACR2").value = number_format(-GSACII*ESGRR2);
    document.getElementById("GSACR3").value = number_format(-GSACII*ESGRR3);
    document.getElementById("GSACR4").value = number_format(-GSACII*ESGRR4);
    document.getElementById("GSACTT").value = number_format(-GSACII*ESGRTT);

    GSACW1 = strtonum(document.getElementById("GSACW1").value);
    GSACW2 = strtonum(document.getElementById("GSACW2").value);
    GSACW3 = strtonum(document.getElementById("GSACW3").value);
    GSACW4 = strtonum(document.getElementById("GSACW4").value);
    GSACR1 = strtonum(document.getElementById("GSACR1").value);
    GSACR2 = strtonum(document.getElementById("GSACR2").value);
    GSACR3 = strtonum(document.getElementById("GSACR3").value);
    GSACR4 = strtonum(document.getElementById("GSACR4").value);
    GSACTT = strtonum(document.getElementById("GSACTT").value);

    CCOCII = strtonum(document.getElementById("CCOCII").value)/100;

    if((AGROW1-ESGRW1-SLINW1)>0){
        CCOCW1 = -(AGROW1-ESGRW1-SLINW1)*CCOCII;
    }else{
        CCOCW1 = '0';
    }

    if((AGROW2-ESGRW2-SLINW2)>0){
        CCOCW2 = -(AGROW2-ESGRW2-SLINW2)*CCOCII;
    }else{
        CCOCW2 = '0';
    }

    if((AGROW3-ESGRW3-SLINW3)>0){
        CCOCW3 = -(AGROW3-ESGRW3-SLINW3)*CCOCII;
    }else{
        CCOCW3 = '0';
    }

    if((AGROW4-ESGRW4-SLINW4)>0){
        CCOCW4 = -(AGROW4-ESGRW4-SLINW4)*CCOCII;
    }else{
        CCOCW4 = '0';
    }

    document.getElementById("CCOCW1").value = number_format(CCOCW1);
    document.getElementById("CCOCW2").value = number_format(CCOCW2);
    document.getElementById("CCOCW3").value = number_format(CCOCW3);
    document.getElementById("CCOCW4").value = number_format(CCOCW4);

    CCOCW1 = strtonum(document.getElementById("CCOCW1").value);
    CCOCW2 = strtonum(document.getElementById("CCOCW2").value);
    CCOCW3 = strtonum(document.getElementById("CCOCW3").value);
    CCOCW4 = strtonum(document.getElementById("CCOCW4").value);

    if((AGROR1-ESGRR1-SLINR1)>0){
        CCOCR1 = -(AGROR1-ESGRR1-SLINR1)*CCOCII;
    }else{
        CCOCR1 = '0';
    }

    if((AGROR2-ESGRR2-SLINR2)>0){
        CCOCR2 = -(AGROR2-ESGRR2-SLINR2)*CCOCII;
    }else{
        CCOCR2 = '0';
    }

    if((AGROR3-ESGRR3-SLINR3)>0){
        CCOCR3 = -(AGROR3-ESGRR3-SLINR3)*CCOCII;
    }else{
        CCOCR3 = '0';
    }

    if((AGROR4-ESGRR4-SLINR4)>0){
        CCOCR4 = -(AGROR4-ESGRR4-SLINR4)*CCOCII;
    }else{
        CCOCR4 = '0';
    }

    document.getElementById("CCOCR1").value = number_format(CCOCR1);
    document.getElementById("CCOCR2").value = number_format(CCOCR2);
    document.getElementById("CCOCR3").value = number_format(CCOCR3);
    document.getElementById("CCOCR4").value = number_format(CCOCR4);

    CCOCR1 = strtonum(document.getElementById("CCOCR1").value);
    CCOCR2 = strtonum(document.getElementById("CCOCR2").value);
    CCOCR3 = strtonum(document.getElementById("CCOCR3").value);
    CCOCR4 = strtonum(document.getElementById("CCOCR4").value);

    if((AGROTT-ESGRTT-SLINTT)>0){
        CCOCTT = -(AGROTT-ESGRTT-SLINTT)*CCOCII;
    }else{
        CCOCTT = '0';
    }

    document.getElementById("CCOCTT").value = number_format(CCOCTT);

    CCOCTT = strtonum(document.getElementById("CCOCTT").value);

    document.getElementById("NABRW1").value = number_format(AGROW1+AGPPW1+TAX1W1+TAX2W1+FAF1W1+FAF2W1+SUBCW1+GSACW1+CCOCW1);
    document.getElementById("NABRW2").value = number_format(AGROW2+AGPPW2+TAX1W2+TAX2W2+FAF1W2+FAF2W2+SUBCW2+GSACW2+CCOCW2);
    document.getElementById("NABRW3").value = number_format(AGROW3+AGPPW3+TAX1W3+TAX2W3+FAF1W3+FAF2W3+SUBCW3+GSACW3+CCOCW3);
    document.getElementById("NABRW4").value = number_format(AGROW4+AGPPW4+TAX1W4+TAX2W4+FAF1W4+FAF2W4+SUBCW4+GSACW4+CCOCW4);
    document.getElementById("NABRR1").value = number_format(AGROR1+AGPPR1+TAX1R1+TAX2R1+FAF1R1+FAF2R1+SUBCR1+GSACR1+CCOCR1);
    document.getElementById("NABRR2").value = number_format(AGROR2+AGPPR2+TAX1R2+TAX2R2+FAF1R2+FAF2R2+SUBCR2+GSACR2+CCOCR2);
    document.getElementById("NABRR3").value = number_format(AGROR3+AGPPR3+TAX1R3+TAX2R3+FAF1R3+FAF2R3+SUBCR3+GSACR3+CCOCR3);
    document.getElementById("NABRR4").value = number_format(AGROR4+AGPPR4+TAX1R4+TAX2R4+FAF1R4+FAF2R4+SUBCR4+GSACR4+CCOCR4);
    document.getElementById("NABRTT").value = number_format(AGROTT+AGPPTT+TAX1TT+TAX2TT+FAF1TT+FAF2TT+SUBCTT+GSACTT+CCOCTT);

    NABRW1 = strtonum(document.getElementById("NABRW1").value);
    NABRW2 = strtonum(document.getElementById("NABRW2").value);
    NABRW3 = strtonum(document.getElementById("NABRW3").value);
    NABRW4 = strtonum(document.getElementById("NABRW4").value);
    NABRR1 = strtonum(document.getElementById("NABRR1").value);
    NABRR2 = strtonum(document.getElementById("NABRR2").value);
    NABRR3 = strtonum(document.getElementById("NABRR3").value);
    NABRR4 = strtonum(document.getElementById("NABRR4").value);
    NABRTT = strtonum(document.getElementById("NABRTT").value);

    GUA1II = strtonum(document.getElementById("GUA1II").value);

    document.getElementById("GUA1W1").value = number_format(GUA1II*EXRAII);
    document.getElementById("GUA1W2").value = number_format(GUA1II*EXRAII);
    document.getElementById("GUA1W3").value = number_format(GUA1II*EXRAII);
    document.getElementById("GUA1W4").value = number_format(GUA1II*EXRAII);
    document.getElementById("GUA1R1").value = number_format(GUA1II*EXRAII*NOW1II);
    document.getElementById("GUA1R2").value = number_format(GUA1II*EXRAII*NOW1II);
    document.getElementById("GUA1R3").value = number_format(GUA1II*EXRAII*NOW1II);
    document.getElementById("GUA1R4").value = number_format(GUA1II*EXRAII*NOW1II);
    document.getElementById("GUA1TT").value = number_format(GUA1II*EXRAII);

    GUA1W1 = strtonum(document.getElementById("GUA1W1").value);
    GUA1W2 = strtonum(document.getElementById("GUA1W2").value);
    GUA1W3 = strtonum(document.getElementById("GUA1W3").value);
    GUA1W4 = strtonum(document.getElementById("GUA1W4").value);
    GUA1R1 = strtonum(document.getElementById("GUA1R1").value);
    GUA1R2 = strtonum(document.getElementById("GUA1R2").value);
    GUA1R3 = strtonum(document.getElementById("GUA1R3").value);
    GUA1R4 = strtonum(document.getElementById("GUA1R4").value);
    GUA1TT = strtonum(document.getElementById("GUA1TT").value);

    VGUAII = strtonum(document.getElementById("VGUAII").value)/100;

    document.getElementById("VGUAW1").value = number_format(NABRW1*VGUAII);
    document.getElementById("VGUAW2").value = number_format(NABRW2*VGUAII);
    document.getElementById("VGUAW3").value = number_format(NABRW3*VGUAII);
    document.getElementById("VGUAW4").value = number_format(NABRW4*VGUAII);
    document.getElementById("VGUAR1").value = number_format(NABRR1*VGUAII);
    document.getElementById("VGUAR2").value = number_format(NABRR2*VGUAII);
    document.getElementById("VGUAR3").value = number_format(NABRR3*VGUAII);
    document.getElementById("VGUAR4").value = number_format(NABRR4*VGUAII);
    document.getElementById("VGUATT").value = number_format(NABRTT*VGUAII);

    VGUAW1 = strtonum(document.getElementById("VGUAW1").value);
    VGUAW2 = strtonum(document.getElementById("VGUAW2").value);
    VGUAW3 = strtonum(document.getElementById("VGUAW3").value);
    VGUAW4 = strtonum(document.getElementById("VGUAW4").value);
    VGUAR1 = strtonum(document.getElementById("VGUAR1").value);
    VGUAR2 = strtonum(document.getElementById("VGUAR2").value);
    VGUAR3 = strtonum(document.getElementById("VGUAR3").value);
    VGUAR4 = strtonum(document.getElementById("VGUAR4").value);
    VGUATT = strtonum(document.getElementById("VGUATT").value);

    ADVEII = strtonum(document.getElementById("ADVEII").value);

    document.getElementById("ADVEW1").value = number_format(ADVEII);
    document.getElementById("ADVEW2").value = number_format(ADVEII);
    document.getElementById("ADVEW3").value = number_format(ADVEII);
    document.getElementById("ADVEW4").value = number_format(ADVEII);
    document.getElementById("ADVER1").value = number_format(ADVEII*NOW1II);
    document.getElementById("ADVER2").value = number_format(ADVEII*NOW1II);
    document.getElementById("ADVER3").value = number_format(ADVEII*NOW1II);
    document.getElementById("ADVER4").value = number_format(ADVEII*NOW1II);
    document.getElementById("ADVETT").value = number_format(ADVEII);

    ADVEW1 = strtonum(document.getElementById("ADVEW1").value);
    ADVEW2 = strtonum(document.getElementById("ADVEW2").value);
    ADVEW3 = strtonum(document.getElementById("ADVEW3").value);
    ADVEW4 = strtonum(document.getElementById("ADVEW4").value);
    ADVER1 = strtonum(document.getElementById("ADVER1").value);
    ADVER2 = strtonum(document.getElementById("ADVER2").value);
    ADVER3 = strtonum(document.getElementById("ADVER3").value);
    ADVER4 = strtonum(document.getElementById("ADVER4").value);
    ADVETT = strtonum(document.getElementById("ADVETT").value);

    STINII = strtonum(document.getElementById("STINII").value);

    document.getElementById("STINW1").value = number_format(STINII);
    document.getElementById("STINW2").value = number_format(STINII);
    document.getElementById("STINW3").value = number_format(STINII);
    document.getElementById("STINW4").value = number_format(STINII);
    document.getElementById("STINR1").value = number_format(STINII*NOW1II);
    document.getElementById("STINR2").value = number_format(STINII*NOW1II);
    document.getElementById("STINR3").value = number_format(STINII*NOW1II);
    document.getElementById("STINR4").value = number_format(STINII*NOW1II);
    document.getElementById("STINTT").value = number_format(STINII);

    STINW1 = strtonum(document.getElementById("STINW1").value);
    STINW2 = strtonum(document.getElementById("STINW2").value);
    STINW3 = strtonum(document.getElementById("STINW3").value);
    STINW4 = strtonum(document.getElementById("STINW4").value);
    STINR1 = strtonum(document.getElementById("STINR1").value);
    STINR2 = strtonum(document.getElementById("STINR2").value);
    STINR3 = strtonum(document.getElementById("STINR3").value);
    STINR4 = strtonum(document.getElementById("STINR4").value);
    STINTT = strtonum(document.getElementById("STINTT").value);

    STOTII = strtonum(document.getElementById("STOTII").value);

    document.getElementById("STOTW1").value = number_format(STOTII);
    document.getElementById("STOTW2").value = number_format(STOTII);
    document.getElementById("STOTW3").value = number_format(STOTII);
    document.getElementById("STOTW4").value = number_format(STOTII);
    document.getElementById("STOTR1").value = number_format(STOTII*NOW1II);
    document.getElementById("STOTR2").value = number_format(STOTII*NOW1II);
    document.getElementById("STOTR3").value = number_format(STOTII*NOW1II);
    document.getElementById("STOTR4").value = number_format(STOTII*NOW1II);
    document.getElementById("STOTTT").value = number_format(STOTII);

    STOTW1 = strtonum(document.getElementById("STOTW1").value);
    STOTW2 = strtonum(document.getElementById("STOTW2").value);
    STOTW3 = strtonum(document.getElementById("STOTW3").value);
    STOTW4 = strtonum(document.getElementById("STOTW4").value);
    STOTR1 = strtonum(document.getElementById("STOTR1").value);
    STOTR2 = strtonum(document.getElementById("STOTR2").value);
    STOTR3 = strtonum(document.getElementById("STOTR3").value);
    STOTR4 = strtonum(document.getElementById("STOTR4").value);
    STOTTT = strtonum(document.getElementById("STOTTT").value);

    STRUII = strtonum(document.getElementById("STRUII").value);

    document.getElementById("STRUW1").value = number_format(STRUII);
    document.getElementById("STRUW2").value = number_format(STRUII);
    document.getElementById("STRUW3").value = number_format(STRUII);
    document.getElementById("STRUW4").value = number_format(STRUII);
    document.getElementById("STRUR1").value = number_format(STRUII*NOW1II);
    document.getElementById("STRUR2").value = number_format(STRUII*NOW1II);
    document.getElementById("STRUR3").value = number_format(STRUII*NOW1II);
    document.getElementById("STRUR4").value = number_format(STRUII*NOW1II);
    document.getElementById("STRUTT").value = number_format(STRUII);

    STRUW1 = strtonum(document.getElementById("STRUW1").value);
    STRUW2 = strtonum(document.getElementById("STRUW2").value);
    STRUW3 = strtonum(document.getElementById("STRUW3").value);
    STRUW4 = strtonum(document.getElementById("STRUW4").value);
    STRUR1 = strtonum(document.getElementById("STRUR1").value);
    STRUR2 = strtonum(document.getElementById("STRUR2").value);
    STRUR3 = strtonum(document.getElementById("STRUR3").value);
    STRUR4 = strtonum(document.getElementById("STRUR4").value);
    STRUTT = strtonum(document.getElementById("STRUTT").value);

    WHINII = strtonum(document.getElementById("WHINII").value);

    document.getElementById("WHINW1").value = number_format(WHINII);
    document.getElementById("WHINW2").value = number_format(WHINII);
    document.getElementById("WHINW3").value = number_format(WHINII);
    document.getElementById("WHINW4").value = number_format(WHINII);
    document.getElementById("WHINR1").value = number_format(WHINII*NOW1II);
    document.getElementById("WHINR2").value = number_format(WHINII*NOW1II);
    document.getElementById("WHINR3").value = number_format(WHINII*NOW1II);
    document.getElementById("WHINR4").value = number_format(WHINII*NOW1II);
    document.getElementById("WHINTT").value = number_format(WHINII);

    WHINW1 = strtonum(document.getElementById("WHINW1").value);
    WHINW2 = strtonum(document.getElementById("WHINW2").value);
    WHINW3 = strtonum(document.getElementById("WHINW3").value);
    WHINW4 = strtonum(document.getElementById("WHINW4").value);
    WHINR1 = strtonum(document.getElementById("WHINR1").value);
    WHINR2 = strtonum(document.getElementById("WHINR2").value);
    WHINR3 = strtonum(document.getElementById("WHINR3").value);
    WHINR4 = strtonum(document.getElementById("WHINR4").value);
    WHINTT = strtonum(document.getElementById("WHINTT").value);

    WHOTII = strtonum(document.getElementById("WHOTII").value);

    document.getElementById("WHOTW1").value = number_format(WHOTII);
    document.getElementById("WHOTW2").value = number_format(WHOTII);
    document.getElementById("WHOTW3").value = number_format(WHOTII);
    document.getElementById("WHOTW4").value = number_format(WHOTII);
    document.getElementById("WHOTR1").value = number_format(WHOTII*NOW1II);
    document.getElementById("WHOTR2").value = number_format(WHOTII*NOW1II);
    document.getElementById("WHOTR3").value = number_format(WHOTII*NOW1II);
    document.getElementById("WHOTR4").value = number_format(WHOTII*NOW1II);
    document.getElementById("WHOTTT").value = number_format(WHOTII);

    WHOTW1 = strtonum(document.getElementById("WHOTW1").value);
    WHOTW2 = strtonum(document.getElementById("WHOTW2").value);
    WHOTW3 = strtonum(document.getElementById("WHOTW3").value);
    WHOTW4 = strtonum(document.getElementById("WHOTW4").value);
    WHOTR1 = strtonum(document.getElementById("WHOTR1").value);
    WHOTR2 = strtonum(document.getElementById("WHOTR2").value);
    WHOTR3 = strtonum(document.getElementById("WHOTR3").value);
    WHOTR4 = strtonum(document.getElementById("WHOTR4").value);
    WHOTTT = strtonum(document.getElementById("WHOTTT").value);

    WHRUII = strtonum(document.getElementById("WHRUII").value);

    document.getElementById("WHRUW1").value = number_format(WHRUII);
    document.getElementById("WHRUW2").value = number_format(WHRUII);
    document.getElementById("WHRUW3").value = number_format(WHRUII);
    document.getElementById("WHRUW4").value = number_format(WHRUII);
    document.getElementById("WHRUR1").value = number_format(WHRUII*NOW1II);
    document.getElementById("WHRUR2").value = number_format(WHRUII*NOW1II);
    document.getElementById("WHRUR3").value = number_format(WHRUII*NOW1II);
    document.getElementById("WHRUR4").value = number_format(WHRUII*NOW1II);
    document.getElementById("WHRUTT").value = number_format(WHRUII);

    WHRUW1 = strtonum(document.getElementById("WHRUW1").value);
    WHRUW2 = strtonum(document.getElementById("WHRUW2").value);
    WHRUW3 = strtonum(document.getElementById("WHRUW3").value);
    WHRUW4 = strtonum(document.getElementById("WHRUW4").value);
    WHRUR1 = strtonum(document.getElementById("WHRUR1").value);
    WHRUR2 = strtonum(document.getElementById("WHRUR2").value);
    WHRUR3 = strtonum(document.getElementById("WHRUR3").value);
    WHRUR4 = strtonum(document.getElementById("WHRUR4").value);
    WHRUTT = strtonum(document.getElementById("WHRUTT").value);

    LACAII = strtonum(document.getElementById("LACAII").value);

    document.getElementById("LACAW1").value = number_format(LACAII);
    document.getElementById("LACAW2").value = number_format(LACAII);
    document.getElementById("LACAW3").value = number_format(LACAII);
    document.getElementById("LACAW4").value = number_format(LACAII);
    document.getElementById("LACAR1").value = number_format(LACAII*NOW1II);
    document.getElementById("LACAR2").value = number_format(LACAII*NOW1II);
    document.getElementById("LACAR3").value = number_format(LACAII*NOW1II);
    document.getElementById("LACAR4").value = number_format(LACAII*NOW1II);
    document.getElementById("LACATT").value = number_format(LACAII);

    LACAW1 = strtonum(document.getElementById("LACAW1").value);
    LACAW2 = strtonum(document.getElementById("LACAW2").value);
    LACAW3 = strtonum(document.getElementById("LACAW3").value);
    LACAW4 = strtonum(document.getElementById("LACAW4").value);
    LACAR1 = strtonum(document.getElementById("LACAR1").value);
    LACAR2 = strtonum(document.getElementById("LACAR2").value);
    LACAR3 = strtonum(document.getElementById("LACAR3").value);
    LACAR4 = strtonum(document.getElementById("LACAR4").value);
    LACATT = strtonum(document.getElementById("LACATT").value);

    MUSIII = strtonum(document.getElementById("MUSIII").value);

    document.getElementById("MUSIW1").value = number_format(MUSIII);
    document.getElementById("MUSIW2").value = number_format(MUSIII);
    document.getElementById("MUSIW3").value = number_format(MUSIII);
    document.getElementById("MUSIW4").value = number_format(MUSIII);
    document.getElementById("MUSIR1").value = number_format(MUSIII*NOW1II);
    document.getElementById("MUSIR2").value = number_format(MUSIII*NOW1II);
    document.getElementById("MUSIR3").value = number_format(MUSIII*NOW1II);
    document.getElementById("MUSIR4").value = number_format(MUSIII*NOW1II);
    document.getElementById("MUSITT").value = number_format(MUSIII);

    MUSIW1 = strtonum(document.getElementById("MUSIW1").value);
    MUSIW2 = strtonum(document.getElementById("MUSIW2").value);
    MUSIW3 = strtonum(document.getElementById("MUSIW3").value);
    MUSIW4 = strtonum(document.getElementById("MUSIW4").value);
    MUSIR1 = strtonum(document.getElementById("MUSIR1").value);
    MUSIR2 = strtonum(document.getElementById("MUSIR2").value);
    MUSIR3 = strtonum(document.getElementById("MUSIR3").value);
    MUSIR4 = strtonum(document.getElementById("MUSIR4").value);
    MUSITT = strtonum(document.getElementById("MUSITT").value);

    INSUII = strtonum(document.getElementById("INSUII").value);

    document.getElementById("INSUW1").value = number_format(TISOW1*INSUII);
    document.getElementById("INSUW2").value = number_format(TISOW2*INSUII);
    document.getElementById("INSUW3").value = number_format(TISOW3*INSUII);
    document.getElementById("INSUW4").value = number_format(TISOW4*INSUII);
    document.getElementById("INSUR1").value = number_format(TISOR1*INSUII);
    document.getElementById("INSUR2").value = number_format(TISOR2*INSUII);
    document.getElementById("INSUR3").value = number_format(TISOR3*INSUII);
    document.getElementById("INSUR4").value = number_format(TISOR4*INSUII);
    document.getElementById("INSUTT").value = number_format(TISOTT*INSUII);

    INSUW1 = strtonum(document.getElementById("INSUW1").value);
    INSUW2 = strtonum(document.getElementById("INSUW2").value);
    INSUW3 = strtonum(document.getElementById("INSUW3").value);
    INSUW4 = strtonum(document.getElementById("INSUW4").value);
    INSUR1 = strtonum(document.getElementById("INSUR1").value);
    INSUR2 = strtonum(document.getElementById("INSUR2").value);
    INSUR3 = strtonum(document.getElementById("INSUR3").value);
    INSUR4 = strtonum(document.getElementById("INSUR4").value);
    INSUTT = strtonum(document.getElementById("INSUTT").value);

    TIPRII = strtonum(document.getElementById("TIPRII").value);

    document.getElementById("TIPRW1").value = number_format(TISOW1*TIPRII);
    document.getElementById("TIPRW2").value = number_format(TISOW2*TIPRII);
    document.getElementById("TIPRW3").value = number_format(TISOW3*TIPRII);
    document.getElementById("TIPRW4").value = number_format(TISOW4*TIPRII);
    document.getElementById("TIPRR1").value = number_format(TISOR1*TIPRII);
    document.getElementById("TIPRR2").value = number_format(TISOR2*TIPRII);
    document.getElementById("TIPRR3").value = number_format(TISOR3*TIPRII);
    document.getElementById("TIPRR4").value = number_format(TISOR4*TIPRII);
    document.getElementById("TIPRTT").value = number_format(TISOTT*TIPRII);

    TIPRW1 = strtonum(document.getElementById("TIPRW1").value);
    TIPRW2 = strtonum(document.getElementById("TIPRW2").value);
    TIPRW3 = strtonum(document.getElementById("TIPRW3").value);
    TIPRW4 = strtonum(document.getElementById("TIPRW4").value);
    TIPRR1 = strtonum(document.getElementById("TIPRR1").value);
    TIPRR2 = strtonum(document.getElementById("TIPRR2").value);
    TIPRR3 = strtonum(document.getElementById("TIPRR3").value);
    TIPRR4 = strtonum(document.getElementById("TIPRR4").value);
    TIPRTT = strtonum(document.getElementById("TIPRTT").value);

    OTH1II = strtonum(document.getElementById("OTH1II").value);

    document.getElementById("OTH1W1").value = number_format(OTH1II);
    document.getElementById("OTH1W2").value = number_format(OTH1II);
    document.getElementById("OTH1W3").value = number_format(OTH1II);
    document.getElementById("OTH1W4").value = number_format(OTH1II);
    document.getElementById("OTH1R1").value = number_format(OTH1II*NOW1II);
    document.getElementById("OTH1R2").value = number_format(OTH1II*NOW1II);
    document.getElementById("OTH1R3").value = number_format(OTH1II*NOW1II);
    document.getElementById("OTH1R4").value = number_format(OTH1II*NOW1II);
    document.getElementById("OTH1TT").value = number_format(OTH1II);

    OTH1W1 = strtonum(document.getElementById("OTH1W1").value);
    OTH1W2 = strtonum(document.getElementById("OTH1W2").value);
    OTH1W3 = strtonum(document.getElementById("OTH1W3").value);
    OTH1W4 = strtonum(document.getElementById("OTH1W4").value);
    OTH1R1 = strtonum(document.getElementById("OTH1R1").value);
    OTH1R2 = strtonum(document.getElementById("OTH1R2").value);
    OTH1R3 = strtonum(document.getElementById("OTH1R3").value);
    OTH1R4 = strtonum(document.getElementById("OTH1R4").value);
    OTH1TT = strtonum(document.getElementById("OTH1TT").value);

    ADEXII = strtonum(document.getElementById("ADEXII").value);

    document.getElementById("ADEXW1").value = number_format(ADEXII);
    document.getElementById("ADEXW2").value = number_format(ADEXII);
    document.getElementById("ADEXW3").value = number_format(ADEXII);
    document.getElementById("ADEXW4").value = number_format(ADEXII);
    document.getElementById("ADEXR1").value = number_format(ADEXII*NOW1II);
    document.getElementById("ADEXR2").value = number_format(ADEXII*NOW1II);
    document.getElementById("ADEXR3").value = number_format(ADEXII*NOW1II);
    document.getElementById("ADEXR4").value = number_format(ADEXII*NOW1II);
    document.getElementById("ADEXTT").value = number_format(ADEXII);

    ADEXW1 = strtonum(document.getElementById("ADEXW1").value);
    ADEXW2 = strtonum(document.getElementById("ADEXW2").value);
    ADEXW3 = strtonum(document.getElementById("ADEXW3").value);
    ADEXW4 = strtonum(document.getElementById("ADEXW4").value);
    ADEXR1 = strtonum(document.getElementById("ADEXR1").value);
    ADEXR2 = strtonum(document.getElementById("ADEXR2").value);
    ADEXR3 = strtonum(document.getElementById("ADEXR3").value);
    ADEXR4 = strtonum(document.getElementById("ADEXR4").value);
    ADEXTT = strtonum(document.getElementById("ADEXTT").value);

    BOOFII = strtonum(document.getElementById("BOOFII").value);

    document.getElementById("BOOFW1").value = number_format(BOOFII);
    document.getElementById("BOOFW2").value = number_format(BOOFII);
    document.getElementById("BOOFW3").value = number_format(BOOFII);
    document.getElementById("BOOFW4").value = number_format(BOOFII);
    document.getElementById("BOOFR1").value = number_format(BOOFII*NOW1II);
    document.getElementById("BOOFR2").value = number_format(BOOFII*NOW1II);
    document.getElementById("BOOFR3").value = number_format(BOOFII*NOW1II);
    document.getElementById("BOOFR4").value = number_format(BOOFII*NOW1II);
    document.getElementById("BOOFTT").value = number_format(BOOFII);

    BOOFW1 = strtonum(document.getElementById("BOOFW1").value);
    BOOFW2 = strtonum(document.getElementById("BOOFW2").value);
    BOOFW3 = strtonum(document.getElementById("BOOFW3").value);
    BOOFW4 = strtonum(document.getElementById("BOOFW4").value);
    BOOFR1 = strtonum(document.getElementById("BOOFR1").value);
    BOOFR2 = strtonum(document.getElementById("BOOFR2").value);
    BOOFR3 = strtonum(document.getElementById("BOOFR3").value);
    BOOFR4 = strtonum(document.getElementById("BOOFR4").value);
    BOOFTT = strtonum(document.getElementById("BOOFTT").value);

    DRICII = strtonum(document.getElementById("DRICII").value);

    document.getElementById("DRICW1").value = number_format(DRICII);
    document.getElementById("DRICW2").value = number_format(DRICII);
    document.getElementById("DRICW3").value = number_format(DRICII);
    document.getElementById("DRICW4").value = number_format(DRICII);
    document.getElementById("DRICR1").value = number_format(DRICII*NOW1II);
    document.getElementById("DRICR2").value = number_format(DRICII*NOW1II);
    document.getElementById("DRICR3").value = number_format(DRICII*NOW1II);
    document.getElementById("DRICR4").value = number_format(DRICII*NOW1II);
    document.getElementById("DRICTT").value = number_format(DRICII);

    DRICW1 = strtonum(document.getElementById("DRICW1").value);
    DRICW2 = strtonum(document.getElementById("DRICW2").value);
    DRICW3 = strtonum(document.getElementById("DRICW3").value);
    DRICW4 = strtonum(document.getElementById("DRICW4").value);
    DRICR1 = strtonum(document.getElementById("DRICR1").value);
    DRICR2 = strtonum(document.getElementById("DRICR2").value);
    DRICR3 = strtonum(document.getElementById("DRICR3").value);
    DRICR4 = strtonum(document.getElementById("DRICR4").value);
    DRICTT = strtonum(document.getElementById("DRICTT").value);

    FIMAII = strtonum(document.getElementById("FIMAII").value);

    document.getElementById("FIMAW1").value = number_format(FIMAII);
    document.getElementById("FIMAW2").value = number_format(FIMAII);
    document.getElementById("FIMAW3").value = number_format(FIMAII);
    document.getElementById("FIMAW4").value = number_format(FIMAII);
    document.getElementById("FIMAR1").value = number_format(FIMAII*NOW1II);
    document.getElementById("FIMAR2").value = number_format(FIMAII*NOW1II);
    document.getElementById("FIMAR3").value = number_format(FIMAII*NOW1II);
    document.getElementById("FIMAR4").value = number_format(FIMAII*NOW1II);
    document.getElementById("FIMATT").value = number_format(FIMAII);

    FIMAW1 = strtonum(document.getElementById("FIMAW1").value);
    FIMAW2 = strtonum(document.getElementById("FIMAW2").value);
    FIMAW3 = strtonum(document.getElementById("FIMAW3").value);
    FIMAW4 = strtonum(document.getElementById("FIMAW4").value);
    FIMAR1 = strtonum(document.getElementById("FIMAR1").value);
    FIMAR2 = strtonum(document.getElementById("FIMAR2").value);
    FIMAR3 = strtonum(document.getElementById("FIMAR3").value);
    FIMAR4 = strtonum(document.getElementById("FIMAR4").value);
    FIMATT = strtonum(document.getElementById("FIMATT").value);

    HOWAII = strtonum(document.getElementById("HOWAII").value);

    document.getElementById("HOWAW1").value = number_format(HOWAII);
    document.getElementById("HOWAW2").value = number_format(HOWAII);
    document.getElementById("HOWAW3").value = number_format(HOWAII);
    document.getElementById("HOWAW4").value = number_format(HOWAII);
    document.getElementById("HOWAR1").value = number_format(HOWAII*NOW1II);
    document.getElementById("HOWAR2").value = number_format(HOWAII*NOW1II);
    document.getElementById("HOWAR3").value = number_format(HOWAII*NOW1II);
    document.getElementById("HOWAR4").value = number_format(HOWAII*NOW1II);
    document.getElementById("HOWATT").value = number_format(HOWAII);

    HOWAW1 = strtonum(document.getElementById("HOWAW1").value);
    HOWAW2 = strtonum(document.getElementById("HOWAW2").value);
    HOWAW3 = strtonum(document.getElementById("HOWAW3").value);
    HOWAW4 = strtonum(document.getElementById("HOWAW4").value);
    HOWAR1 = strtonum(document.getElementById("HOWAR1").value);
    HOWAR2 = strtonum(document.getElementById("HOWAR2").value);
    HOWAR3 = strtonum(document.getElementById("HOWAR3").value);
    HOWAR4 = strtonum(document.getElementById("HOWAR4").value);
    HOWATT = strtonum(document.getElementById("HOWATT").value);

    HOSTII = strtonum(document.getElementById("HOSTII").value);

    document.getElementById("HOSTW1").value = number_format(HOSTII);
    document.getElementById("HOSTW2").value = number_format(HOSTII);
    document.getElementById("HOSTW3").value = number_format(HOSTII);
    document.getElementById("HOSTW4").value = number_format(HOSTII);
    document.getElementById("HOSTR1").value = number_format(HOSTII*NOW1II);
    document.getElementById("HOSTR2").value = number_format(HOSTII*NOW1II);
    document.getElementById("HOSTR3").value = number_format(HOSTII*NOW1II);
    document.getElementById("HOSTR4").value = number_format(HOSTII*NOW1II);
    document.getElementById("HOSTTT").value = number_format(HOSTII);

    HOSTW1 = strtonum(document.getElementById("HOSTW1").value);
    HOSTW2 = strtonum(document.getElementById("HOSTW2").value);
    HOSTW3 = strtonum(document.getElementById("HOSTW3").value);
    HOSTW4 = strtonum(document.getElementById("HOSTW4").value);
    HOSTR1 = strtonum(document.getElementById("HOSTR1").value);
    HOSTR2 = strtonum(document.getElementById("HOSTR2").value);
    HOSTR3 = strtonum(document.getElementById("HOSTR3").value);
    HOSTR4 = strtonum(document.getElementById("HOSTR4").value);
    HOSTTT = strtonum(document.getElementById("HOSTTT").value);

    LIPEII = strtonum(document.getElementById("LIPEII").value);

    document.getElementById("LIPEW1").value = number_format(LIPEII);
    document.getElementById("LIPEW2").value = number_format(LIPEII);
    document.getElementById("LIPEW3").value = number_format(LIPEII);
    document.getElementById("LIPEW4").value = number_format(LIPEII);
    document.getElementById("LIPER1").value = number_format(LIPEII*NOW1II);
    document.getElementById("LIPER2").value = number_format(LIPEII*NOW1II);
    document.getElementById("LIPER3").value = number_format(LIPEII*NOW1II);
    document.getElementById("LIPER4").value = number_format(LIPEII*NOW1II);
    document.getElementById("LIPETT").value = number_format(LIPEII);

    LIPEW1 = strtonum(document.getElementById("LIPEW1").value);
    LIPEW2 = strtonum(document.getElementById("LIPEW2").value);
    LIPEW3 = strtonum(document.getElementById("LIPEW3").value);
    LIPEW4 = strtonum(document.getElementById("LIPEW4").value);
    LIPER1 = strtonum(document.getElementById("LIPER1").value);
    LIPER2 = strtonum(document.getElementById("LIPER2").value);
    LIPER3 = strtonum(document.getElementById("LIPER3").value);
    LIPER4 = strtonum(document.getElementById("LIPER4").value);
    LIPETT = strtonum(document.getElementById("LIPETT").value);

    LIAUII = strtonum(document.getElementById("LIAUII").value);

    document.getElementById("LIAUW1").value = number_format(LIAUII);
    document.getElementById("LIAUW2").value = number_format(LIAUII);
    document.getElementById("LIAUW3").value = number_format(LIAUII);
    document.getElementById("LIAUW4").value = number_format(LIAUII);
    document.getElementById("LIAUR1").value = number_format(LIAUII*NOW1II);
    document.getElementById("LIAUR2").value = number_format(LIAUII*NOW1II);
    document.getElementById("LIAUR3").value = number_format(LIAUII*NOW1II);
    document.getElementById("LIAUR4").value = number_format(LIAUII*NOW1II);
    document.getElementById("LIAUTT").value = number_format(LIAUII);

    LIAUW1 = strtonum(document.getElementById("LIAUW1").value);
    LIAUW2 = strtonum(document.getElementById("LIAUW2").value);
    LIAUW3 = strtonum(document.getElementById("LIAUW3").value);
    LIAUW4 = strtonum(document.getElementById("LIAUW4").value);
    LIAUR1 = strtonum(document.getElementById("LIAUR1").value);
    LIAUR2 = strtonum(document.getElementById("LIAUR2").value);
    LIAUR3 = strtonum(document.getElementById("LIAUR3").value);
    LIAUR4 = strtonum(document.getElementById("LIAUR4").value);
    LIAUTT = strtonum(document.getElementById("LIAUTT").value);

    PITUII = strtonum(document.getElementById("PITUII").value);

    document.getElementById("PITUW1").value = number_format(PITUII);
    document.getElementById("PITUW2").value = number_format(PITUII);
    document.getElementById("PITUW3").value = number_format(PITUII);
    document.getElementById("PITUW4").value = number_format(PITUII);
    document.getElementById("PITUR1").value = number_format(PITUII*NOW1II);
    document.getElementById("PITUR2").value = number_format(PITUII*NOW1II);
    document.getElementById("PITUR3").value = number_format(PITUII*NOW1II);
    document.getElementById("PITUR4").value = number_format(PITUII*NOW1II);
    document.getElementById("PITUTT").value = number_format(PITUII);

    PITUW1 = strtonum(document.getElementById("PITUW1").value);
    PITUW2 = strtonum(document.getElementById("PITUW2").value);
    PITUW3 = strtonum(document.getElementById("PITUW3").value);
    PITUW4 = strtonum(document.getElementById("PITUW4").value);
    PITUR1 = strtonum(document.getElementById("PITUR1").value);
    PITUR2 = strtonum(document.getElementById("PITUR2").value);
    PITUR3 = strtonum(document.getElementById("PITUR3").value);
    PITUR4 = strtonum(document.getElementById("PITUR4").value);
    PITUTT = strtonum(document.getElementById("PITUTT").value);

    POSEII = strtonum(document.getElementById("POSEII").value);

    document.getElementById("POSEW1").value = number_format(POSEII);
    document.getElementById("POSEW2").value = number_format(POSEII);
    document.getElementById("POSEW3").value = number_format(POSEII);
    document.getElementById("POSEW4").value = number_format(POSEII);
    document.getElementById("POSER1").value = number_format(POSEII*NOW1II);
    document.getElementById("POSER2").value = number_format(POSEII*NOW1II);
    document.getElementById("POSER3").value = number_format(POSEII*NOW1II);
    document.getElementById("POSER4").value = number_format(POSEII*NOW1II);
    document.getElementById("POSETT").value = number_format(POSEII);

    POSEW1 = strtonum(document.getElementById("POSEW1").value);
    POSEW2 = strtonum(document.getElementById("POSEW2").value);
    POSEW3 = strtonum(document.getElementById("POSEW3").value);
    POSEW4 = strtonum(document.getElementById("POSEW4").value);
    POSER1 = strtonum(document.getElementById("POSER1").value);
    POSER2 = strtonum(document.getElementById("POSER2").value);
    POSER3 = strtonum(document.getElementById("POSER3").value);
    POSER4 = strtonum(document.getElementById("POSER4").value);
    POSETT = strtonum(document.getElementById("POSETT").value);

    PRPRII = strtonum(document.getElementById("PRPRII").value);

    document.getElementById("PRPRW1").value = number_format(PRPRII);
    document.getElementById("PRPRW2").value = number_format(PRPRII);
    document.getElementById("PRPRW3").value = number_format(PRPRII);
    document.getElementById("PRPRW4").value = number_format(PRPRII);
    document.getElementById("PRPRR1").value = number_format(PRPRII*NOW1II);
    document.getElementById("PRPRR2").value = number_format(PRPRII*NOW1II);
    document.getElementById("PRPRR3").value = number_format(PRPRII*NOW1II);
    document.getElementById("PRPRR4").value = number_format(PRPRII*NOW1II);
    document.getElementById("PRPRTT").value = number_format(PRPRII);

    PRPRW1 = strtonum(document.getElementById("PRPRW1").value);
    PRPRW2 = strtonum(document.getElementById("PRPRW2").value);
    PRPRW3 = strtonum(document.getElementById("PRPRW3").value);
    PRPRW4 = strtonum(document.getElementById("PRPRW4").value);
    PRPRR1 = strtonum(document.getElementById("PRPRR1").value);
    PRPRR2 = strtonum(document.getElementById("PRPRR2").value);
    PRPRR3 = strtonum(document.getElementById("PRPRR3").value);
    PRPRR4 = strtonum(document.getElementById("PRPRR4").value);
    PRPRTT = strtonum(document.getElementById("PRPRTT").value);

    PRAFII = strtonum(document.getElementById("PRAFII").value);

    document.getElementById("PRAFW1").value = number_format(PRAFII);
    document.getElementById("PRAFW2").value = number_format(PRAFII);
    document.getElementById("PRAFW3").value = number_format(PRAFII);
    document.getElementById("PRAFW4").value = number_format(PRAFII);
    document.getElementById("PRAFR1").value = number_format(PRAFII*NOW1II);
    document.getElementById("PRAFR2").value = number_format(PRAFII*NOW1II);
    document.getElementById("PRAFR3").value = number_format(PRAFII*NOW1II);
    document.getElementById("PRAFR4").value = number_format(PRAFII*NOW1II);
    document.getElementById("PRAFTT").value = number_format(PRAFII);

    PRAFW1 = strtonum(document.getElementById("PRAFW1").value);
    PRAFW2 = strtonum(document.getElementById("PRAFW2").value);
    PRAFW3 = strtonum(document.getElementById("PRAFW3").value);
    PRAFW4 = strtonum(document.getElementById("PRAFW4").value);
    PRAFR1 = strtonum(document.getElementById("PRAFR1").value);
    PRAFR2 = strtonum(document.getElementById("PRAFR2").value);
    PRAFR3 = strtonum(document.getElementById("PRAFR3").value);
    PRAFR4 = strtonum(document.getElementById("PRAFR4").value);
    PRAFTT = strtonum(document.getElementById("PRAFTT").value);

    PROGII = strtonum(document.getElementById("PROGII").value);

    document.getElementById("PROGW1").value = number_format(PROGII);
    document.getElementById("PROGW2").value = number_format(PROGII);
    document.getElementById("PROGW3").value = number_format(PROGII);
    document.getElementById("PROGW4").value = number_format(PROGII);
    document.getElementById("PROGR1").value = number_format(PROGII*NOW1II);
    document.getElementById("PROGR2").value = number_format(PROGII*NOW1II);
    document.getElementById("PROGR3").value = number_format(PROGII*NOW1II);
    document.getElementById("PROGR4").value = number_format(PROGII*NOW1II);
    document.getElementById("PROGTT").value = number_format(PROGII);

    PROGW1 = strtonum(document.getElementById("PROGW1").value);
    PROGW2 = strtonum(document.getElementById("PROGW2").value);
    PROGW3 = strtonum(document.getElementById("PROGW3").value);
    PROGW4 = strtonum(document.getElementById("PROGW4").value);
    PROGR1 = strtonum(document.getElementById("PROGR1").value);
    PROGR2 = strtonum(document.getElementById("PROGR2").value);
    PROGR3 = strtonum(document.getElementById("PROGR3").value);
    PROGR4 = strtonum(document.getElementById("PROGR4").value);
    PROGTT = strtonum(document.getElementById("PROGTT").value);

    RENTII = strtonum(document.getElementById("RENTII").value);

    document.getElementById("RENTW1").value = number_format(RENTII);
    document.getElementById("RENTW2").value = number_format(RENTII);
    document.getElementById("RENTW3").value = number_format(RENTII);
    document.getElementById("RENTW4").value = number_format(RENTII);
    document.getElementById("RENTR1").value = number_format(RENTII*NOW1II);
    document.getElementById("RENTR2").value = number_format(RENTII*NOW1II);
    document.getElementById("RENTR3").value = number_format(RENTII*NOW1II);
    document.getElementById("RENTR4").value = number_format(RENTII*NOW1II);
    document.getElementById("RENTTT").value = number_format(RENTII);

    RENTW1 = strtonum(document.getElementById("RENTW1").value);
    RENTW2 = strtonum(document.getElementById("RENTW2").value);
    RENTW3 = strtonum(document.getElementById("RENTW3").value);
    RENTW4 = strtonum(document.getElementById("RENTW4").value);
    RENTR1 = strtonum(document.getElementById("RENTR1").value);
    RENTR2 = strtonum(document.getElementById("RENTR2").value);
    RENTR3 = strtonum(document.getElementById("RENTR3").value);
    RENTR4 = strtonum(document.getElementById("RENTR4").value);
    RENTTT = strtonum(document.getElementById("RENTTT").value);

    SOLIII = strtonum(document.getElementById("SOLIII").value);

    document.getElementById("SOLIW1").value = number_format(SOLIII);
    document.getElementById("SOLIW2").value = number_format(SOLIII);
    document.getElementById("SOLIW3").value = number_format(SOLIII);
    document.getElementById("SOLIW4").value = number_format(SOLIII);
    document.getElementById("SOLIR1").value = number_format(SOLIII*NOW1II);
    document.getElementById("SOLIR2").value = number_format(SOLIII*NOW1II);
    document.getElementById("SOLIR3").value = number_format(SOLIII*NOW1II);
    document.getElementById("SOLIR4").value = number_format(SOLIII*NOW1II);
    document.getElementById("SOLITT").value = number_format(SOLIII);

    SOLIW1 = strtonum(document.getElementById("SOLIW1").value);
    SOLIW2 = strtonum(document.getElementById("SOLIW2").value);
    SOLIW3 = strtonum(document.getElementById("SOLIW3").value);
    SOLIW4 = strtonum(document.getElementById("SOLIW4").value);
    SOLIR1 = strtonum(document.getElementById("SOLIR1").value);
    SOLIR2 = strtonum(document.getElementById("SOLIR2").value);
    SOLIR3 = strtonum(document.getElementById("SOLIR3").value);
    SOLIR4 = strtonum(document.getElementById("SOLIR4").value);
    SOLITT = strtonum(document.getElementById("SOLITT").value);

    TEINII = strtonum(document.getElementById("TEINII").value);

    document.getElementById("TEINW1").value = number_format(TEINII);
    document.getElementById("TEINW2").value = number_format(TEINII);
    document.getElementById("TEINW3").value = number_format(TEINII);
    document.getElementById("TEINW4").value = number_format(TEINII);
    document.getElementById("TEINR1").value = number_format(TEINII*NOW1II);
    document.getElementById("TEINR2").value = number_format(TEINII*NOW1II);
    document.getElementById("TEINR3").value = number_format(TEINII*NOW1II);
    document.getElementById("TEINR4").value = number_format(TEINII*NOW1II);
    document.getElementById("TEINTT").value = number_format(TEINII);

    TEINW1 = strtonum(document.getElementById("TEINW1").value);
    TEINW2 = strtonum(document.getElementById("TEINW2").value);
    TEINW3 = strtonum(document.getElementById("TEINW3").value);
    TEINW4 = strtonum(document.getElementById("TEINW4").value);
    TEINR1 = strtonum(document.getElementById("TEINR1").value);
    TEINR2 = strtonum(document.getElementById("TEINR2").value);
    TEINR3 = strtonum(document.getElementById("TEINR3").value);
    TEINR4 = strtonum(document.getElementById("TEINR4").value);
    TEINTT = strtonum(document.getElementById("TEINTT").value);

    PAERII = strtonum(document.getElementById("PAERII").value);

    document.getElementById("PAERW1").value = number_format(PAERII);
    document.getElementById("PAERW2").value = number_format(PAERII);
    document.getElementById("PAERW3").value = number_format(PAERII);
    document.getElementById("PAERW4").value = number_format(PAERII);
    document.getElementById("PAERR1").value = number_format(PAERII*NOW1II);
    document.getElementById("PAERR2").value = number_format(PAERII*NOW1II);
    document.getElementById("PAERR3").value = number_format(PAERII*NOW1II);
    document.getElementById("PAERR4").value = number_format(PAERII*NOW1II);
    document.getElementById("PAERTT").value = number_format(PAERII);

    PAERW1 = strtonum(document.getElementById("PAERW1").value);
    PAERW2 = strtonum(document.getElementById("PAERW2").value);
    PAERW3 = strtonum(document.getElementById("PAERW3").value);
    PAERW4 = strtonum(document.getElementById("PAERW4").value);
    PAERR1 = strtonum(document.getElementById("PAERR1").value);
    PAERR2 = strtonum(document.getElementById("PAERR2").value);
    PAERR3 = strtonum(document.getElementById("PAERR3").value);
    PAERR4 = strtonum(document.getElementById("PAERR4").value);
    PAERTT = strtonum(document.getElementById("PAERTT").value);

    TRPAII = strtonum(document.getElementById("TRPAII").value);

    document.getElementById("TRPAW1").value = number_format(TRPAII);
    document.getElementById("TRPAW2").value = number_format(TRPAII);
    document.getElementById("TRPAW3").value = number_format(TRPAII);
    document.getElementById("TRPAW4").value = number_format(TRPAII);
    document.getElementById("TRPAR1").value = number_format(TRPAII*NOW1II);
    document.getElementById("TRPAR2").value = number_format(TRPAII*NOW1II);
    document.getElementById("TRPAR3").value = number_format(TRPAII*NOW1II);
    document.getElementById("TRPAR4").value = number_format(TRPAII*NOW1II);
    document.getElementById("TRPATT").value = number_format(TRPAII);

    TRPAW1 = strtonum(document.getElementById("TRPAW1").value);
    TRPAW2 = strtonum(document.getElementById("TRPAW2").value);
    TRPAW3 = strtonum(document.getElementById("TRPAW3").value);
    TRPAW4 = strtonum(document.getElementById("TRPAW4").value);
    TRPAR1 = strtonum(document.getElementById("TRPAR1").value);
    TRPAR2 = strtonum(document.getElementById("TRPAR2").value);
    TRPAR3 = strtonum(document.getElementById("TRPAR3").value);
    TRPAR4 = strtonum(document.getElementById("TRPAR4").value);
    TRPATT = strtonum(document.getElementById("TRPATT").value);

    OTH2II = strtonum(document.getElementById("OTH2II").value);

    document.getElementById("OTH2W1").value = number_format(OTH2II);
    document.getElementById("OTH2W2").value = number_format(OTH2II);
    document.getElementById("OTH2W3").value = number_format(OTH2II);
    document.getElementById("OTH2W4").value = number_format(OTH2II);
    document.getElementById("OTH2R1").value = number_format(OTH2II*NOW1II);
    document.getElementById("OTH2R2").value = number_format(OTH2II*NOW1II);
    document.getElementById("OTH2R3").value = number_format(OTH2II*NOW1II);
    document.getElementById("OTH2R4").value = number_format(OTH2II*NOW1II);
    document.getElementById("OTH2TT").value = number_format(OTH2II);

    OTH2W1 = strtonum(document.getElementById("OTH2W1").value);
    OTH2W2 = strtonum(document.getElementById("OTH2W2").value);
    OTH2W3 = strtonum(document.getElementById("OTH2W3").value);
    OTH2W4 = strtonum(document.getElementById("OTH2W4").value);
    OTH2R1 = strtonum(document.getElementById("OTH2R1").value);
    OTH2R2 = strtonum(document.getElementById("OTH2R2").value);
    OTH2R3 = strtonum(document.getElementById("OTH2R3").value);
    OTH2R4 = strtonum(document.getElementById("OTH2R4").value);
    OTH2TT = strtonum(document.getElementById("OTH2TT").value);

    OTH3II = strtonum(document.getElementById("OTH3II").value);

    document.getElementById("OTH3W1").value = number_format(OTH3II);
    document.getElementById("OTH3W2").value = number_format(OTH3II);
    document.getElementById("OTH3W3").value = number_format(OTH3II);
    document.getElementById("OTH3W4").value = number_format(OTH3II);
    document.getElementById("OTH3R1").value = number_format(OTH3II*NOW1II);
    document.getElementById("OTH3R2").value = number_format(OTH3II*NOW1II);
    document.getElementById("OTH3R3").value = number_format(OTH3II*NOW1II);
    document.getElementById("OTH3R4").value = number_format(OTH3II*NOW1II);
    document.getElementById("OTH3TT").value = number_format(OTH3II);

    OTH3W1 = strtonum(document.getElementById("OTH3W1").value);
    OTH3W2 = strtonum(document.getElementById("OTH3W2").value);
    OTH3W3 = strtonum(document.getElementById("OTH3W3").value);
    OTH3W4 = strtonum(document.getElementById("OTH3W4").value);
    OTH3R1 = strtonum(document.getElementById("OTH3R1").value);
    OTH3R2 = strtonum(document.getElementById("OTH3R2").value);
    OTH3R3 = strtonum(document.getElementById("OTH3R3").value);
    OTH3R4 = strtonum(document.getElementById("OTH3R4").value);
    OTH3TT = strtonum(document.getElementById("OTH3TT").value);

    OTH4II = strtonum(document.getElementById("OTH4II").value);

    document.getElementById("OTH4W1").value = number_format(OTH4II);
    document.getElementById("OTH4W2").value = number_format(OTH4II);
    document.getElementById("OTH4W3").value = number_format(OTH4II);
    document.getElementById("OTH4W4").value = number_format(OTH4II);
    document.getElementById("OTH4R1").value = number_format(OTH4II*NOW1II);
    document.getElementById("OTH4R2").value = number_format(OTH4II*NOW1II);
    document.getElementById("OTH4R3").value = number_format(OTH4II*NOW1II);
    document.getElementById("OTH4R4").value = number_format(OTH4II*NOW1II);
    document.getElementById("OTH4TT").value = number_format(OTH4II);

    OTH4W1 = strtonum(document.getElementById("OTH4W1").value);
    OTH4W2 = strtonum(document.getElementById("OTH4W2").value);
    OTH4W3 = strtonum(document.getElementById("OTH4W3").value);
    OTH4W4 = strtonum(document.getElementById("OTH4W4").value);
    OTH4R1 = strtonum(document.getElementById("OTH4R1").value);
    OTH4R2 = strtonum(document.getElementById("OTH4R2").value);
    OTH4R3 = strtonum(document.getElementById("OTH4R3").value);
    OTH4R4 = strtonum(document.getElementById("OTH4R4").value);
    OTH4TT = strtonum(document.getElementById("OTH4TT").value);

    OTH5II = strtonum(document.getElementById("OTH5II").value);

    document.getElementById("OTH5W1").value = number_format(OTH5II);
    document.getElementById("OTH5W2").value = number_format(OTH5II);
    document.getElementById("OTH5W3").value = number_format(OTH5II);
    document.getElementById("OTH5W4").value = number_format(OTH5II);
    document.getElementById("OTH5R1").value = number_format(OTH5II*NOW1II);
    document.getElementById("OTH5R2").value = number_format(OTH5II*NOW1II);
    document.getElementById("OTH5R3").value = number_format(OTH5II*NOW1II);
    document.getElementById("OTH5R4").value = number_format(OTH5II*NOW1II);
    document.getElementById("OTH5TT").value = number_format(OTH5II);

    OTH5W1 = strtonum(document.getElementById("OTH5W1").value);
    OTH5W2 = strtonum(document.getElementById("OTH5W2").value);
    OTH5W3 = strtonum(document.getElementById("OTH5W3").value);
    OTH5W4 = strtonum(document.getElementById("OTH5W4").value);
    OTH5R1 = strtonum(document.getElementById("OTH5R1").value);
    OTH5R2 = strtonum(document.getElementById("OTH5R2").value);
    OTH5R3 = strtonum(document.getElementById("OTH5R3").value);
    OTH5R4 = strtonum(document.getElementById("OTH5R4").value);
    OTH5TT = strtonum(document.getElementById("OTH5TT").value);

    LOFIII = strtonum(document.getElementById("LOFIII").value);

    document.getElementById("LOFIW1").value = number_format(LOFIII);
    document.getElementById("LOFIW2").value = number_format(LOFIII);
    document.getElementById("LOFIW3").value = number_format(LOFIII);
    document.getElementById("LOFIW4").value = number_format(LOFIII);
    document.getElementById("LOFIR1").value = number_format(LOFIII*NOW1II);
    document.getElementById("LOFIR2").value = number_format(LOFIII*NOW1II);
    document.getElementById("LOFIR3").value = number_format(LOFIII*NOW1II);
    document.getElementById("LOFIR4").value = number_format(LOFIII*NOW1II);
    document.getElementById("LOFITT").value = number_format(LOFIII);

    LOFIW1 = strtonum(document.getElementById("LOFIW1").value);
    LOFIW2 = strtonum(document.getElementById("LOFIW2").value);
    LOFIW3 = strtonum(document.getElementById("LOFIW3").value);
    LOFIW4 = strtonum(document.getElementById("LOFIW4").value);
    LOFIR1 = strtonum(document.getElementById("LOFIR1").value);
    LOFIR2 = strtonum(document.getElementById("LOFIR2").value);
    LOFIR3 = strtonum(document.getElementById("LOFIR3").value);
    LOFIR4 = strtonum(document.getElementById("LOFIR4").value);
    LOFITT = strtonum(document.getElementById("LOFITT").value);

    document.getElementById("TLEXW1").value = number_format(GUA1W1+VGUAW1+ADVEW1+STINW1+STOTW1+STRUW1+WHINW1+WHOTW1+WHRUW1+LACAW1+MUSIW1+INSUW1+TIPRW1+OTH1W1+ADEXW1+BOOFW1+DRICW1+FIMAW1+HOWAW1+HOSTW1+LIPEW1+LIAUW1+PITUW1+POSEW1+PRPRW1+PRAFW1+PROGW1+RENTW1+SOLIW1+TEINW1+PAERW1+TRPAW1+OTH2W1+OTH3W1+OTH4W1+OTH5W1+LOFIW1);
    document.getElementById("TLEXW2").value = number_format(GUA1W2+VGUAW2+ADVEW2+STINW2+STOTW2+STRUW2+WHINW2+WHOTW2+WHRUW2+LACAW2+MUSIW2+INSUW2+TIPRW2+OTH1W2+ADEXW2+BOOFW2+DRICW2+FIMAW2+HOWAW2+HOSTW2+LIPEW2+LIAUW2+PITUW2+POSEW2+PRPRW2+PRAFW2+PROGW2+RENTW2+SOLIW2+TEINW2+PAERW2+TRPAW2+OTH2W2+OTH3W2+OTH4W2+OTH5W2+LOFIW2);
    document.getElementById("TLEXW3").value = number_format(GUA1W3+VGUAW3+ADVEW3+STINW3+STOTW3+STRUW3+WHINW3+WHOTW3+WHRUW3+LACAW3+MUSIW3+INSUW3+TIPRW3+OTH1W3+ADEXW3+BOOFW3+DRICW3+FIMAW3+HOWAW3+HOSTW3+LIPEW3+LIAUW3+PITUW3+POSEW3+PRPRW3+PRAFW3+PROGW3+RENTW3+SOLIW3+TEINW3+PAERW3+TRPAW3+OTH2W3+OTH3W3+OTH4W3+OTH5W3+LOFIW3);
    document.getElementById("TLEXW4").value = number_format(GUA1W4+VGUAW4+ADVEW4+STINW4+STOTW4+STRUW4+WHINW4+WHOTW4+WHRUW4+LACAW4+MUSIW4+INSUW4+TIPRW4+OTH1W4+ADEXW4+BOOFW4+DRICW4+FIMAW4+HOWAW4+HOSTW4+LIPEW4+LIAUW4+PITUW4+POSEW4+PRPRW4+PRAFW4+PROGW4+RENTW4+SOLIW4+TEINW4+PAERW4+TRPAW4+OTH2W4+OTH3W4+OTH4W4+OTH5W4+LOFIW4);    
    document.getElementById("TLEXR1").value = number_format(GUA1R1+VGUAR1+ADVER1+STINR1+STOTR1+STRUR1+WHINR1+WHOTR1+WHRUR1+LACAR1+MUSIR1+INSUR1+TIPRR1+OTH1R1+ADEXR1+BOOFR1+DRICR1+FIMAR1+HOWAR1+HOSTR1+LIPER1+LIAUR1+PITUR1+POSER1+PRPRR1+PRAFR1+PROGR1+RENTR1+SOLIR1+TEINR1+PAERR1+TRPAR1+OTH2R1+OTH3R1+OTH4R1+OTH5R1+LOFIR1);
    document.getElementById("TLEXR2").value = number_format(GUA1R2+VGUAR2+ADVER2+STINR2+STOTR2+STRUR2+WHINR2+WHOTR2+WHRUR2+LACAR2+MUSIR2+INSUR2+TIPRR2+OTH1R2+ADEXR2+BOOFR2+DRICR2+FIMAR2+HOWAR2+HOSTR2+LIPER2+LIAUR2+PITUR2+POSER2+PRPRR2+PRAFR2+PROGR2+RENTR2+SOLIR2+TEINR2+PAERR2+TRPAR2+OTH2R2+OTH3R2+OTH4R2+OTH5R2+LOFIR2);
    document.getElementById("TLEXR3").value = number_format(GUA1R3+VGUAR3+ADVER3+STINR3+STOTR3+STRUR3+WHINR3+WHOTR3+WHRUR3+LACAR3+MUSIR3+INSUR3+TIPRR3+OTH1R3+ADEXR3+BOOFR3+DRICR3+FIMAR3+HOWAR3+HOSTR3+LIPER3+LIAUR3+PITUR3+POSER3+PRPRR3+PRAFR3+PROGR3+RENTR3+SOLIR3+TEINR3+PAERR3+TRPAR3+OTH2R3+OTH3R3+OTH4R3+OTH5R3+LOFIR3);
    document.getElementById("TLEXR4").value = number_format(GUA1R4+VGUAR4+ADVER4+STINR4+STOTR4+STRUR4+WHINR4+WHOTR4+WHRUR4+LACAR4+MUSIR4+INSUR4+TIPRR4+OTH1R4+ADEXR4+BOOFR4+DRICR4+FIMAR4+HOWAR4+HOSTR4+LIPER4+LIAUR4+PITUR4+POSER4+PRPRR4+PRAFR4+PROGR4+RENTR4+SOLIR4+TEINR4+PAERR4+TRPAR4+OTH2R4+OTH3R4+OTH4R4+OTH5R4+LOFIR4);
    document.getElementById("TLEXTT").value = number_format(GUA1TT+VGUATT+ADVETT+STINTT+STOTTT+STRUTT+WHINTT+WHOTTT+WHRUTT+LACATT+MUSITT+INSUTT+TIPRTT+OTH1TT+ADEXTT+BOOFTT+DRICTT+FIMATT+HOWATT+HOSTTT+LIPETT+LIAUTT+PITUTT+POSETT+PRPRTT+PRAFTT+PROGTT+RENTTT+SOLITT+TEINTT+PAERTT+TRPATT+OTH2TT+OTH3TT+OTH4TT+OTH5TT+LOFITT);

    TLEXW1 = strtonum(document.getElementById("TLEXW1").value);
    TLEXW2 = strtonum(document.getElementById("TLEXW2").value);
    TLEXW3 = strtonum(document.getElementById("TLEXW3").value);
    TLEXW4 = strtonum(document.getElementById("TLEXW4").value);
    TLEXR1 = strtonum(document.getElementById("TLEXR1").value);
    TLEXR2 = strtonum(document.getElementById("TLEXR2").value);
    TLEXR3 = strtonum(document.getElementById("TLEXR3").value);
    TLEXR4 = strtonum(document.getElementById("TLEXR4").value);
    TLEXTT = strtonum(document.getElementById("TLEXTT").value);

    document.getElementById("FOCHW1").value = number_format(TLEXW1);
    document.getElementById("FOCHW2").value = number_format(TLEXW2);
    document.getElementById("FOCHW3").value = number_format(TLEXW3);
    document.getElementById("FOCHW4").value = number_format(TLEXW4);
    document.getElementById("FOCHR1").value = number_format(TLEXR1);
    document.getElementById("FOCHR2").value = number_format(TLEXR2);
    document.getElementById("FOCHR3").value = number_format(TLEXR3);
    document.getElementById("FOCHR4").value = number_format(TLEXR4);
    document.getElementById("FOCHTT").value = number_format(TLEXTT);

    if((NABRW1-TLEXW1)>0){
        MOREW1 = NABRW1-TLEXW1;
    }else{
        MOREW1 = '0';
    }

    if((NABRW2-TLEXW2)>0){
        MOREW2 = NABRW2-TLEXW2;
    }else{
        MOREW2 = '0';
    }

    if((NABRW3-TLEXW3)>0){
        MOREW3 = NABRW3-TLEXW3;
    }else{
        MOREW3 = '0';
    }

    if((NABRW4-TLEXW4)>0){
        MOREW4 = NABRW4-TLEXW4;
    }else{
        MOREW4 = '0';
    }

    if((NABRR1-TLEXR1)>0){
        MORER1 = NABRR1-TLEXR1;
    }else{
        MORER1 = '0';
    }

    if((NABRR2-TLEXR2)>0){
        MORER2 = NABRR2-TLEXR2;
    }else{
        MORER2 = '0';
    }

    if((NABRR3-TLEXR3)>0){
        MORER3 = NABRR3-TLEXR3;
    }else{
        MORER3 = '0';
    }

    if((NABRR4-TLEXR4)>0){
        MORER4 = NABRR4-TLEXR4;
    }else{
        MORER4 = '0';
    }

    if((NABRTT-TLEXTT)>0){
        MORETT = NABRTT-TLEXTT;
    }else{
        MORETT = '0';
    }

    document.getElementById("MOREW1").value = number_format(MOREW1);
    document.getElementById("MOREW2").value = number_format(MOREW2);
    document.getElementById("MOREW3").value = number_format(MOREW3);
    document.getElementById("MOREW4").value = number_format(MOREW4);
    document.getElementById("MORER1").value = number_format(MORER1);
    document.getElementById("MORER2").value = number_format(MORER2);
    document.getElementById("MORER3").value = number_format(MORER3);
    document.getElementById("MORER4").value = number_format(MORER4);
    document.getElementById("MORETT").value = number_format(MORETT);

    MOREW1 = strtonum(document.getElementById("MOREW1").value);
    MOREW2 = strtonum(document.getElementById("MOREW2").value);
    MOREW3 = strtonum(document.getElementById("MOREW3").value);
    MOREW4 = strtonum(document.getElementById("MOREW4").value);
    MORER1 = strtonum(document.getElementById("MORER1").value);
    MORER2 = strtonum(document.getElementById("MORER2").value);
    MORER3 = strtonum(document.getElementById("MORER3").value);
    MORER4 = strtonum(document.getElementById("MORER4").value);
    MORETT = strtonum(document.getElementById("MORETT").value);

    NPROBB = strtonum(document.getElementById("NPROBB").value.replace("$",""));
    NPROII = strtonum(document.getElementById("NPROII").value)/100;    

    
    if(MOREW1>NPROBB){
        NPROW1 = NPROBB*NPROII;
    }else{
        NPROW1 = MOREW1*NPROII;
    }  

    if(MOREW2>NPROBB){
        NPROW2 = NPROBB*NPROII;
    }else{
        NPROW2 = MOREW2*NPROII;
    }     

    if(MOREW3>NPROBB){
        NPROW3 = NPROBB*NPROII;
    }else{
        NPROW3 = MOREW3*NPROII;
    }

    if(MOREW4>NPROBB){
        NPROW4 = NPROBB*NPROII;
    }else{
        NPROW4 = MOREW4*NPROII;
    }   

    document.getElementById("NPROW1").value = number_format(NPROW1);
    document.getElementById("NPROW2").value = number_format(NPROW2);
    document.getElementById("NPROW3").value = number_format(NPROW3);
    document.getElementById("NPROW4").value = number_format(NPROW4);

    if(MORER1>NPROBB*NOW1II){
        NPROR1 = NPROBB*NPROII*NOW1II;
    }else{
        NPROR1 = MORER1*NPROII*NOW1II;
    } 

    if(MORER2>NPROBB*NOW1II){
        NPROR2 = NPROBB*NPROII*NOW1II;
    }else{
        NPROR2 = MORER2*NPROII*NOW1II;
    }     

    if(MORER3>NPROBB*NOW1II){
        NPROR3 = NPROBB*NPROII*NOW1II;
    }else{
        NPROR3 = MORER3*NPROII*NOW1II;
    }     

    if(MORER4>NPROBB*NOW1II){
        NPROR4 = NPROBB*NPROII*NOW1II;
    }else{
        NPROR4 = MORER4*NPROII*NOW1II;
    }     

    document.getElementById("NPROR1").value = number_format(NPROR1);
    document.getElementById("NPROR2").value = number_format(NPROR2);
    document.getElementById("NPROR3").value = number_format(NPROR3);
    document.getElementById("NPROR4").value = number_format(NPROR4);

    if(MORETT>NPROBB){
        NPROTT = NPROBB*NPROII;
    }else{
        NPROTT = MORETT*NPROII;
    }  

    document.getElementById("NPROTT").value = number_format(NPROTT);

    NPROW1 = strtonum(document.getElementById("NPROW1").value);
    NPROW2 = strtonum(document.getElementById("NPROW2").value);
    NPROW3 = strtonum(document.getElementById("NPROW3").value);
    NPROW4 = strtonum(document.getElementById("NPROW4").value);
    NPROR1 = strtonum(document.getElementById("NPROR1").value);
    NPROR2 = strtonum(document.getElementById("NPROR2").value);
    NPROR3 = strtonum(document.getElementById("NPROR3").value);
    NPROR4 = strtonum(document.getElementById("NPROR4").value);
    NPROTT = strtonum(document.getElementById("NPROTT").value);

    NPREBB = strtonum(document.getElementById("NPREBB").value.replace("$",""));
    NPREII = strtonum(document.getElementById("NPREII").value)/100;

    if(MOREW1>NPREBB){
        NPREW1 = NPREBB*NPREII;
    }else{
        NPREW1 = MOREW1*NPREII;
    }           

    if(MOREW2>NPREBB){
        NPREW2 = NPREBB*NPREII;
    }else{
        NPREW2 = MOREW2*NPREII;
    }          

    if(MOREW3>NPREBB){
        NPREW3 = NPREBB*NPREII;
    }else{
        NPREW3 = MOREW3*NPREII;
    }        

    if(MOREW4>NPREBB){
        NPREW4 = NPREBB*NPREII;
    }else{
        NPREW4 = MOREW4*NPREII;
    }  

    document.getElementById("NPREW1").value = number_format(NPREW1);
    document.getElementById("NPREW2").value = number_format(NPREW2);
    document.getElementById("NPREW3").value = number_format(NPREW3);
    document.getElementById("NPREW4").value = number_format(NPREW4);

    if(MORER1>NPREBB*NOW1II){
        NPRER1 = NPREBB*NPREII*NOW1II;
    }else{
        NPRER1 = MORER1*NPREII*NOW1II;
    }  

    if(MORER2>NPREBB*NOW1II){
        NPRER2 = NPREBB*NPREII*NOW1II;
    }else{
        NPRER2 = MORER2*NPREII*NOW1II;
    }   

    if(MORER3>NPREBB*NOW1II){
        NPRER3 = NPREBB*NPREII*NOW1II;
    }else{
        NPRER3 = MORER3*NPREII*NOW1II;
    } 

    if(MORER4>NPREBB*NOW1II){
        NPRER4 = NPREBB*NPREII*NOW1II;
    }else{
        NPRER4 = MORER4*NPREII*NOW1II;
    }

    document.getElementById("NPRER1").value = number_format(NPRER1);
    document.getElementById("NPRER2").value = number_format(NPRER2);
    document.getElementById("NPRER3").value = number_format(NPRER3);
    document.getElementById("NPRER4").value = number_format(NPRER4);

    if(MORETT>NPREBB){
        NPRETT = NPREBB*NPREII;
    }else{
        NPRETT = MORETT*NPREII;
    }    

    document.getElementById("NPRETT").value = number_format(NPRETT);

    NPREW1 = strtonum(document.getElementById("NPREW1").value);
    NPREW2 = strtonum(document.getElementById("NPREW2").value);
    NPREW3 = strtonum(document.getElementById("NPREW3").value);
    NPREW4 = strtonum(document.getElementById("NPREW4").value);
    NPRER1 = strtonum(document.getElementById("NPRER1").value);
    NPRER2 = strtonum(document.getElementById("NPRER2").value);
    NPRER3 = strtonum(document.getElementById("NPRER3").value);
    NPRER4 = strtonum(document.getElementById("NPRER4").value);
    NPRETT = strtonum(document.getElementById("NPRETT").value);

    document.getElementById("TEPRW1").value = number_format(MOREW1-NPROW1-NPREW1);
    document.getElementById("TEPRW2").value = number_format(MOREW2-NPROW2-NPREW2);
    document.getElementById("TEPRW3").value = number_format(MOREW3-NPROW3-NPREW3);
    document.getElementById("TEPRW4").value = number_format(MOREW4-NPROW4-NPREW4);
    document.getElementById("TEPRR1").value = number_format(MORER1-NPROR1-NPRER1);
    document.getElementById("TEPRR2").value = number_format(MORER2-NPROR2-NPRER2);
    document.getElementById("TEPRR3").value = number_format(MORER3-NPROR3-NPRER3);
    document.getElementById("TEPRR4").value = number_format(MORER4-NPROR4-NPRER4);
    document.getElementById("TEPRTT").value = number_format(MORETT-NPROTT-NPRETT);

    TEPRW1 = strtonum(document.getElementById("TEPRW1").value);
    TEPRW2 = strtonum(document.getElementById("TEPRW2").value);
    TEPRW3 = strtonum(document.getElementById("TEPRW3").value);
    TEPRW4 = strtonum(document.getElementById("TEPRW4").value);
    TEPRR1 = strtonum(document.getElementById("TEPRR1").value);
    TEPRR2 = strtonum(document.getElementById("TEPRR2").value);
    TEPRR3 = strtonum(document.getElementById("TEPRR3").value);
    TEPRR4 = strtonum(document.getElementById("TEPRR4").value);
    TEPRTT = strtonum(document.getElementById("TEPRTT").value);

    PREOII = strtonum(document.getElementById("PREOII").value)/100;

    if(TEPRW1>0){
        PREOW1 = TEPRW1*PREOII;        
    }else{
        PREOW1 = '0';
    }

    if(TEPRW2>0){
        PREOW2 = TEPRW2*PREOII;        
    }else{
        PREOW2 = '0';
    }

    if(TEPRW3>0){
        PREOW3 = TEPRW3*PREOII;        
    }else{
        PREOW3 = '0';
    }

    if(TEPRW4>0){
        PREOW4 = TEPRW4*PREOII;        
    }else{
        PREOW4 = '0';
    }

    if(TEPRR1>0){
        PREOR1 = TEPRR1*PREOII;        
    }else{
        PREOR1 = '0';
    }

    if(TEPRR2>0){
        PREOR2 = TEPRR2*PREOII;        
    }else{
        PREOR2 = '0';
    }

    if(TEPRR3>0){
        PREOR3 = TEPRR3*PREOII;        
    }else{
        PREOR3 = '0';
    }

    if(TEPRR4>0){
        PREOR4 = TEPRR4*PREOII;        
    }else{
        PREOR4 = '0';
    }

    if(TEPRTT>0){
        PREOTT = TEPRTT*PREOII;        
    }else{
        PREOTT = '0';
    }

    document.getElementById("PREOW1").value = number_format(PREOW1);
    document.getElementById("PREOW2").value = number_format(PREOW2);
    document.getElementById("PREOW3").value = number_format(PREOW3);
    document.getElementById("PREOW4").value = number_format(PREOW4);
    document.getElementById("PREOR1").value = number_format(PREOR1);
    document.getElementById("PREOR2").value = number_format(PREOR2);
    document.getElementById("PREOR3").value = number_format(PREOR3);
    document.getElementById("PREOR4").value = number_format(PREOR4);
    document.getElementById("PREOTT").value = number_format(PREOTT);

    PREOW1 = strtonum(document.getElementById("PREOW1").value);
    PREOW2 = strtonum(document.getElementById("PREOW2").value);
    PREOW3 = strtonum(document.getElementById("PREOW3").value);
    PREOW4 = strtonum(document.getElementById("PREOW4").value);
    PREOR1 = strtonum(document.getElementById("PREOR1").value);
    PREOR2 = strtonum(document.getElementById("PREOR2").value);
    PREOR3 = strtonum(document.getElementById("PREOR3").value);
    PREOR4 = strtonum(document.getElementById("PREOR4").value);
    PREOTT = strtonum(document.getElementById("PREOTT").value);

    document.getElementById("PROOW1").value = number_format(TEPRW1-PREOW1);
    document.getElementById("PROOW2").value = number_format(TEPRW2-PREOW2);
    document.getElementById("PROOW3").value = number_format(TEPRW3-PREOW3);
    document.getElementById("PROOW4").value = number_format(TEPRW4-PREOW4);
    document.getElementById("PROOR1").value = number_format(TEPRR1-PREOR1);
    document.getElementById("PROOR2").value = number_format(TEPRR2-PREOR2);
    document.getElementById("PROOR3").value = number_format(TEPRR3-PREOR3);
    document.getElementById("PROOR4").value = number_format(TEPRR4-PREOR4);
    document.getElementById("PROOTT").value = number_format(TEPRTT-PREOTT);

    PROOW1 = strtonum(document.getElementById("PROOW1").value);
    PROOW2 = strtonum(document.getElementById("PROOW2").value);
    PROOW3 = strtonum(document.getElementById("PROOW3").value);
    PROOW4 = strtonum(document.getElementById("PROOW4").value);
    PROOR1 = strtonum(document.getElementById("PROOR1").value);
    PROOR2 = strtonum(document.getElementById("PROOR2").value);
    PROOR3 = strtonum(document.getElementById("PROOR3").value);
    PROOR4 = strtonum(document.getElementById("PROOR4").value);
    PROOTT = strtonum(document.getElementById("PROOTT").value);

    document.getElementById("NEMOW1").value = number_format(NPROW1);
    document.getElementById("NEMOW2").value = number_format(NPROW2);
    document.getElementById("NEMOW3").value = number_format(NPROW3);
    document.getElementById("NEMOW4").value = number_format(NPROW4);
    document.getElementById("NEMOR1").value = number_format(NPROR1);
    document.getElementById("NEMOR2").value = number_format(NPROR2);
    document.getElementById("NEMOR3").value = number_format(NPROR3);
    document.getElementById("NEMOR4").value = number_format(NPROR4);
    document.getElementById("NEMOTT").value = number_format(NPROTT);

    document.getElementById("VAGUW1").value = number_format(VGUAW1);
    document.getElementById("VAGUW2").value = number_format(VGUAW2);
    document.getElementById("VAGUW3").value = number_format(VGUAW3);
    document.getElementById("VAGUW4").value = number_format(VGUAW4);
    document.getElementById("VAGUR1").value = number_format(VGUAR1);
    document.getElementById("VAGUR2").value = number_format(VGUAR2);
    document.getElementById("VAGUR3").value = number_format(VGUAR3);
    document.getElementById("VAGUR4").value = number_format(VGUAR4);
    document.getElementById("VAGUTT").value = number_format(VGUATT);

    document.getElementById("GUA2W1").value = number_format(GUA1W1);
    document.getElementById("GUA2W2").value = number_format(GUA1W2);
    document.getElementById("GUA2W3").value = number_format(GUA1W3);
    document.getElementById("GUA2W4").value = number_format(GUA1W4);
    document.getElementById("GUA2R1").value = number_format(GUA1R1);
    document.getElementById("GUA2R2").value = number_format(GUA1R2);
    document.getElementById("GUA2R3").value = number_format(GUA1R3);
    document.getElementById("GUA2R4").value = number_format(GUA1R4);
    document.getElementById("GUA2TT").value = number_format(GUA1TT);

    document.getElementById("TTPRW1").value = number_format(PROOW1+NPROW1+VGUAW1+GUA1W1);
    document.getElementById("TTPRW2").value = number_format(PROOW2+NPROW2+VGUAW2+GUA1W2);
    document.getElementById("TTPRW3").value = number_format(PROOW3+NPROW3+VGUAW3+GUA1W3);
    document.getElementById("TTPRW4").value = number_format(PROOW4+NPROW4+VGUAW4+GUA1W4);
    document.getElementById("TTPRR1").value = number_format(PROOR1+NPROR1+VGUAR1+GUA1R1);
    document.getElementById("TTPRR2").value = number_format(PROOR2+NPROR2+VGUAR2+GUA1R2);
    document.getElementById("TTPRR3").value = number_format(PROOR3+NPROR3+VGUAR3+GUA1R3);
    document.getElementById("TTPRR4").value = number_format(PROOR4+NPROR4+VGUAR4+GUA1R4);
    document.getElementById("TTPRTT").value = number_format(PROOTT+NPROTT+VGUATT+GUA1TT);

    TTPRW1 = strtonum(document.getElementById("TTPRW1").value);
    TTPRW2 = strtonum(document.getElementById("TTPRW2").value);
    TTPRW3 = strtonum(document.getElementById("TTPRW3").value);
    TTPRW4 = strtonum(document.getElementById("TTPRW4").value);
    TTPRR1 = strtonum(document.getElementById("TTPRR1").value);
    TTPRR2 = strtonum(document.getElementById("TTPRR2").value);
    TTPRR3 = strtonum(document.getElementById("TTPRR3").value);
    TTPRR4 = strtonum(document.getElementById("TTPRR4").value);
    TTPRTT = strtonum(document.getElementById("TTPRTT").value);

    document.getElementById("USRAW1").value = '$ ' + number_format(TTPRW1*EXRAII);
    document.getElementById("USRAW2").value = '$ ' + number_format(TTPRW2*EXRAII);
    document.getElementById("USRAW3").value = '$ ' + number_format(TTPRW3*EXRAII);
    document.getElementById("USRAW4").value = '$ ' + number_format(TTPRW4*EXRAII);
    document.getElementById("USRAR1").value = '$ ' + number_format(TTPRR1*EXRAII);
    document.getElementById("USRAR2").value = '$ ' + number_format(TTPRR2*EXRAII);
    document.getElementById("USRAR3").value = '$ ' + number_format(TTPRR3*EXRAII);
    document.getElementById("USRAR4").value = '$ ' + number_format(TTPRR4*EXRAII);
    document.getElementById("USRATT").value = '$ ' + number_format(TTPRTT*EXRAII);

    LIT1II = strtonum(document.getElementById("LIT1II").value)/100;

    document.getElementById("LIT1W1").value = number_format(-TTPRW1*LIT1II);
    document.getElementById("LIT1W2").value = number_format(-TTPRW2*LIT1II);
    document.getElementById("LIT1W3").value = number_format(-TTPRW3*LIT1II);
    document.getElementById("LIT1W4").value = number_format(-TTPRW4*LIT1II);
    document.getElementById("LIT1R1").value = number_format(-TTPRR1*LIT1II*NOW1II);
    document.getElementById("LIT1R2").value = number_format(-TTPRR2*LIT1II*NOW1II);
    document.getElementById("LIT1R3").value = number_format(-TTPRR3*LIT1II*NOW1II);
    document.getElementById("LIT1R4").value = number_format(-TTPRR4*LIT1II*NOW1II);
    document.getElementById("LIT1TT").value = number_format(-TTPRTT*LIT1II);

    LIT1W1 = strtonum(document.getElementById("LIT1W1").value);
    LIT1W2 = strtonum(document.getElementById("LIT1W2").value);
    LIT1W3 = strtonum(document.getElementById("LIT1W3").value);
    LIT1W4 = strtonum(document.getElementById("LIT1W4").value);
    LIT1R1 = strtonum(document.getElementById("LIT1R1").value);
    LIT1R2 = strtonum(document.getElementById("LIT1R2").value);
    LIT1R3 = strtonum(document.getElementById("LIT1R3").value);
    LIT1R4 = strtonum(document.getElementById("LIT1R4").value);
    LIT1TT = strtonum(document.getElementById("LIT1TT").value);

    LIT2II = strtonum(document.getElementById("LIT2II").value);

    document.getElementById("LIT2W1").value = number_format(-LIT2II);
    document.getElementById("LIT2W2").value = number_format(-LIT2II);
    document.getElementById("LIT2W3").value = number_format(-LIT2II);
    document.getElementById("LIT2W4").value = number_format(-LIT2II);
    document.getElementById("LIT2R1").value = number_format(-LIT2II*NOW1II);
    document.getElementById("LIT2R2").value = number_format(-LIT2II*NOW1II);
    document.getElementById("LIT2R3").value = number_format(-LIT2II*NOW1II);
    document.getElementById("LIT2R4").value = number_format(-LIT2II*NOW1II);
    document.getElementById("LIT2TT").value = number_format(-LIT2II*NOW1II);

    LIT2W1 = strtonum(document.getElementById("LIT2W1").value);
    LIT2W2 = strtonum(document.getElementById("LIT2W2").value);
    LIT2W3 = strtonum(document.getElementById("LIT2W3").value);
    LIT2W4 = strtonum(document.getElementById("LIT2W4").value);
    LIT2R1 = strtonum(document.getElementById("LIT2R1").value);
    LIT2R2 = strtonum(document.getElementById("LIT2R2").value);
    LIT2R3 = strtonum(document.getElementById("LIT2R3").value);
    LIT2R4 = strtonum(document.getElementById("LIT2R4").value);
    LIT2TT = strtonum(document.getElementById("LIT2TT").value);

    document.getElementById("NITPW1").value = number_format(TTPRW1+LIT1W1+LIT2W1);
    document.getElementById("NITPW2").value = number_format(TTPRW2+LIT1W2+LIT2W2);
    document.getElementById("NITPW3").value = number_format(TTPRW3+LIT1W3+LIT2W3);
    document.getElementById("NITPW4").value = number_format(TTPRW4+LIT1W4+LIT2W4);
    document.getElementById("NITPR1").value = number_format(TTPRR1+LIT1R1+LIT2R1);
    document.getElementById("NITPR2").value = number_format(TTPRR2+LIT1R2+LIT2R2);
    document.getElementById("NITPR3").value = number_format(TTPRR3+LIT1R3+LIT2R3);
    document.getElementById("NITPR4").value = number_format(TTPRR4+LIT1R4+LIT2R4);
    document.getElementById("NITPTT").value = number_format(TTPRTT+LIT1TT+LIT2TT);

    NITPW1 = strtonum(document.getElementById("NITPW1").value);
    NITPW2 = strtonum(document.getElementById("NITPW2").value);
    NITPW3 = strtonum(document.getElementById("NITPW3").value);
    NITPW4 = strtonum(document.getElementById("NITPW4").value);
    NITPR1 = strtonum(document.getElementById("NITPR1").value);
    NITPR2 = strtonum(document.getElementById("NITPR2").value);
    NITPR3 = strtonum(document.getElementById("NITPR3").value);
    NITPR4 = strtonum(document.getElementById("NITPR4").value);
    NITPTT = strtonum(document.getElementById("NITPTT").value);

    WOEXII = strtonum(document.getElementById("WOEXII").value);

    document.getElementById("WOEXW1").value = number_format(-WOEXII);
    document.getElementById("WOEXW2").value = number_format(-WOEXII);
    document.getElementById("WOEXW3").value = number_format(-WOEXII);
    document.getElementById("WOEXW4").value = number_format(-WOEXII);
    document.getElementById("WOEXR1").value = number_format(-WOEXII*NOW1II);
    document.getElementById("WOEXR2").value = number_format(-WOEXII*NOW1II);
    document.getElementById("WOEXR3").value = number_format(-WOEXII*NOW1II);
    document.getElementById("WOEXR4").value = number_format(-WOEXII*NOW1II);
    document.getElementById("WOEXTT").value = number_format(-WOEXII);

    WOEXW1 = strtonum(document.getElementById("WOEXW1").value);
    WOEXW2 = strtonum(document.getElementById("WOEXW2").value);
    WOEXW3 = strtonum(document.getElementById("WOEXW3").value);
    WOEXW4 = strtonum(document.getElementById("WOEXW4").value);
    WOEXR1 = strtonum(document.getElementById("WOEXR1").value);
    WOEXR2 = strtonum(document.getElementById("WOEXR2").value);
    WOEXR3 = strtonum(document.getElementById("WOEXR3").value);
    WOEXR4 = strtonum(document.getElementById("WOEXR4").value);
    WOEXTT = strtonum(document.getElementById("WOEXTT").value);

    ROMIII = strtonum(document.getElementById("ROMIII").value);

    document.getElementById("ROMIW1").value = number_format(-ROMIII);
    document.getElementById("ROMIW2").value = number_format(-ROMIII);
    document.getElementById("ROMIW3").value = number_format(-ROMIII);
    document.getElementById("ROMIW4").value = number_format(-ROMIII);
    document.getElementById("ROMIR1").value = number_format(-ROMIII*NOW1II);
    document.getElementById("ROMIR2").value = number_format(-ROMIII*NOW1II);
    document.getElementById("ROMIR3").value = number_format(-ROMIII*NOW1II);
    document.getElementById("ROMIR4").value = number_format(-ROMIII*NOW1II);
    document.getElementById("ROMITT").value = number_format(-ROMIII*NOW1II);

    ROMIW1 = strtonum(document.getElementById("ROMIW1").value);
    ROMIW2 = strtonum(document.getElementById("ROMIW2").value);
    ROMIW3 = strtonum(document.getElementById("ROMIW3").value);
    ROMIW4 = strtonum(document.getElementById("ROMIW4").value);
    ROMIR1 = strtonum(document.getElementById("ROMIR1").value);
    ROMIR2 = strtonum(document.getElementById("ROMIR2").value);
    ROMIR3 = strtonum(document.getElementById("ROMIR3").value);
    ROMIR4 = strtonum(document.getElementById("ROMIR4").value);
    ROMITT = strtonum(document.getElementById("ROMITT").value);

    VAROII = strtonum(document.getElementById("VAROII").value)/100;

    document.getElementById("VAROW1").value = number_format(-((NITPW1-WOEXW1)*VAROII)-ROMIW1);
    document.getElementById("VAROW2").value = number_format(-((NITPW2-WOEXW2)*VAROII)-ROMIW2);
    document.getElementById("VAROW3").value = number_format(-((NITPW3-WOEXW3)*VAROII)-ROMIW3);
    document.getElementById("VAROW4").value = number_format(-((NITPW4-WOEXW4)*VAROII)-ROMIW4);
    document.getElementById("VAROR1").value = number_format(-((NITPR1-WOEXR1)*VAROII)-ROMIR1);
    document.getElementById("VAROR2").value = number_format(-((NITPR2-WOEXR2)*VAROII)-ROMIR2);
    document.getElementById("VAROR3").value = number_format(-((NITPR3-WOEXR3)*VAROII)-ROMIR3);
    document.getElementById("VAROR4").value = number_format(-((NITPR4-WOEXR4)*VAROII)-ROMIR4);
    document.getElementById("VAROTT").value = number_format(-((NITPTT-WOEXTT)*VAROII)-ROMITT);

    VAROW1 = strtonum(document.getElementById("VAROW1").value);
    VAROW2 = strtonum(document.getElementById("VAROW2").value);
    VAROW3 = strtonum(document.getElementById("VAROW3").value);
    VAROW4 = strtonum(document.getElementById("VAROW4").value);
    VAROR1 = strtonum(document.getElementById("VAROR1").value);
    VAROR2 = strtonum(document.getElementById("VAROR2").value);
    VAROR3 = strtonum(document.getElementById("VAROR3").value);
    VAROR4 = strtonum(document.getElementById("VAROR4").value);
    VAROTT = strtonum(document.getElementById("VAROTT").value);

    document.getElementById("TSPRW1").value = number_format(NITPW1+WOEXW1+ROMIW1+VAROW1);
    document.getElementById("TSPRW2").value = number_format(NITPW2+WOEXW2+ROMIW2+VAROW2);
    document.getElementById("TSPRW3").value = number_format(NITPW3+WOEXW3+ROMIW3+VAROW3);
    document.getElementById("TSPRW4").value = number_format(NITPW4+WOEXW4+ROMIW4+VAROW4);
    document.getElementById("TSPRR1").value = number_format(NITPR1+WOEXR1+ROMIR1+VAROR1);
    document.getElementById("TSPRR2").value = number_format(NITPR2+WOEXR2+ROMIR2+VAROR2);
    document.getElementById("TSPRR3").value = number_format(NITPR3+WOEXR3+ROMIR3+VAROR3);
    document.getElementById("TSPRR4").value = number_format(NITPR4+WOEXR4+ROMIR4+VAROR4);
    document.getElementById("TSPRTT").value = number_format(NITPTT+WOEXTT+ROMITT+VAROTT);

}

function GoalSeek() {

    var TSPRTT_VEC;
    var PECATT_VEC;
    TSPRTT_VEC = [];
    PECATT_VEC = [];

    NSPWII = strtonum(document.getElementById("NSPWII").value);
    NOW1II = strtonum(document.getElementById("NOW1II").value);
    SPSHII = strtonum(document.getElementById("SPSHII").value);
    WGPOII = strtonum(document.getElementById("WGPOII").value);
    EXRAII = strtonum(document.getElementById("EXRAII").value);
    LSIDII = strtonum(document.getElementById("LSIDII").value)/100;
    TAX1II = strtonum(document.getElementById("TAX1II").value)/100;
    TAX2II = strtonum(document.getElementById("TAX2II").value)/100;
    FAF1II = strtonum(document.getElementById("FAF1II").value.replace("$",""));
    FAF2II = strtonum(document.getElementById("FAF2II").value.replace("$",""));
    CCOCII = strtonum(document.getElementById("CCOCII").value)/100;
    VGUAII = strtonum(document.getElementById("VGUAII").value)/100;
    ADVEII = strtonum(document.getElementById("ADVEII").value);
    STINII = strtonum(document.getElementById("STINII").value);
    STOTII = strtonum(document.getElementById("STOTII").value);
    STRUII = strtonum(document.getElementById("STRUII").value);
    WHINII = strtonum(document.getElementById("WHINII").value);
    WHOTII = strtonum(document.getElementById("WHOTII").value);
    WHRUII = strtonum(document.getElementById("WHRUII").value);
    LACAII = strtonum(document.getElementById("LACAII").value);
    MUSIII = strtonum(document.getElementById("MUSIII").value);
    INSUII = strtonum(document.getElementById("INSUII").value);
    TIPRII = strtonum(document.getElementById("TIPRII").value);
    OTH1II = strtonum(document.getElementById("OTH1II").value);
    ADEXII = strtonum(document.getElementById("ADEXII").value);
    BOOFII = strtonum(document.getElementById("BOOFII").value);
    DRICII = strtonum(document.getElementById("DRICII").value);
    FIMAII = strtonum(document.getElementById("FIMAII").value);
    HOWAII = strtonum(document.getElementById("HOWAII").value);
    HOSTII = strtonum(document.getElementById("HOSTII").value);
    LIPEII = strtonum(document.getElementById("LIPEII").value);
    LIAUII = strtonum(document.getElementById("LIAUII").value);
    PITUII = strtonum(document.getElementById("PITUII").value);
    POSEII = strtonum(document.getElementById("POSEII").value);
    PRPRII = strtonum(document.getElementById("PRPRII").value);
    PRAFII = strtonum(document.getElementById("PRAFII").value);
    PROGII = strtonum(document.getElementById("PROGII").value);
    RENTII = strtonum(document.getElementById("RENTII").value);
    SOLIII = strtonum(document.getElementById("SOLIII").value);
    TEINII = strtonum(document.getElementById("TEINII").value);
    PAERII = strtonum(document.getElementById("PAERII").value);
    TRPAII = strtonum(document.getElementById("TRPAII").value);
    OTH2II = strtonum(document.getElementById("OTH2II").value);
    OTH3II = strtonum(document.getElementById("OTH3II").value);
    OTH4II = strtonum(document.getElementById("OTH4II").value);
    OTH5II = strtonum(document.getElementById("OTH5II").value);
    LOFIII = strtonum(document.getElementById("LOFIII").value);
    LIT1II = strtonum(document.getElementById("LIT1II").value)/100;
    LIT2II = strtonum(document.getElementById("LIT2II").value);

    TSPRTT = strtonum(document.getElementById("TSPRTT").value);

    PECATT_ORIG = strtonum(document.getElementById("PECATT").value)/100;

    cont = 0;    

    while((cont<=100)&&(TSPRTT!=0)){ 

        if(TSPRTT>=0){
            TSPRTT_VEC[cont] = TSPRTT;  
        }else{
            TSPRTT_VEC[cont] = Infinity;
        }

        HOCATT = strtonum(document.getElementById("HOCATT").value);

        PECATT = strtonum(document.getElementById("PECATT").value)/100;

        if(cont == 0){
            PECATT = 0;
        }else{
            PECATT = PECATT + 0.01;
            PECATT_VEC[cont] = PECATT;
        }
        document.getElementById("PECATT").value = number_format(PECATT*100,2) + '%';

        document.getElementById("TISOTT").value = number_format(HOCATT*PECATT);
        TISOTT = strtonum(document.getElementById("TISOTT").value);

        document.getElementById("BOGRTT").value = number_format(WGPOII*PECATT); 
        BOGRTT = strtonum(document.getElementById("BOGRTT").value);

        SLINTT = strtonum(document.getElementById("SLINTT").value);
        ESGRTT = strtonum(document.getElementById("ESGRTT").value); 

        if((BOGRTT-SLINTT-ESGRTT)>0){
            ESSITT = (BOGRTT-SLINTT-ESGRTT);
        }else{
            ESSITT = '0';
        }
        document.getElementById("ESSITT").value = number_format(ESSITT);
        ESSITT = strtonum(document.getElementById("ESSITT").value); 

        LSUDTT = strtonum(document.getElementById("LSUDTT").value);    
        LGRDTT = strtonum(document.getElementById("LGRDTT").value);        

        document.getElementById("LSIDTT").value = number_format(-ESSITT*LSIDII);
        LSIDTT = strtonum(document.getElementById("LSIDTT").value);

        document.getElementById("AGROTT").value = number_format(SLINTT+ESGRTT+ESSITT+LSUDTT+LGRDTT+LSIDTT);
        AGROTT = strtonum(document.getElementById("AGROTT").value);

        document.getElementById("CUEBII").value = '$ ' + number_format(AGROTT*NOW1II);

        document.getElementById("AGPPTT").value = number_format((AGROTT/WGPOII)*100) + '%';
        AGPPTT = strtonum(document.getElementById("AGPPTT").value)/100;

        document.getElementById("TAX1TT").value = number_format(-AGROTT/(1+TAX1II)*TAX1II);   
        TAX1TT = strtonum(document.getElementById("TAX1TT").value);

        document.getElementById("TAX2TT").value = number_format(-AGROTT/(1+TAX2II)*TAX2II);
        TAX2TT = strtonum(document.getElementById("TAX2TT").value);

        document.getElementById("FAF1TT").value = number_format(-TISOTT*FAF1II);
        FAF1TT = strtonum(document.getElementById("FAF1TT").value);

        document.getElementById("FAF2TT").value = number_format(-TISOTT*FAF2II);
        FAF2TT = strtonum(document.getElementById("FAF2TT").value);

        SUBCTT = strtonum(document.getElementById("SUBCTT").value);
        GSACTT = strtonum(document.getElementById("GSACTT").value);        

        if((AGROTT-ESGRTT-SLINTT)>0){
            CCOCTT = -(AGROTT-ESGRTT-SLINTT)*CCOCII;
        }else{
            CCOCTT = '0';
        }
        document.getElementById("CCOCTT").value = number_format(CCOCTT);
        CCOCTT = strtonum(document.getElementById("CCOCTT").value);

        document.getElementById("NABRTT").value = number_format(AGROTT+AGPPTT+TAX1TT+TAX2TT+FAF1TT+FAF2TT+SUBCTT+GSACTT+CCOCTT);
        NABRTT = strtonum(document.getElementById("NABRTT").value);

        GUA1TT = strtonum(document.getElementById("GUA1TT").value);

        document.getElementById("VGUATT").value = number_format(NABRTT*VGUAII);
        VGUATT = strtonum(document.getElementById("VGUATT").value);

        document.getElementById("INSUTT").value = number_format(TISOTT*INSUII);        
        document.getElementById("TIPRTT").value = number_format(TISOTT*TIPRII); 
        
        ADVETT = strtonum(document.getElementById("ADVETT").value);
        STINTT = strtonum(document.getElementById("STINTT").value);
        STOTTT = strtonum(document.getElementById("STOTTT").value);
        STRUTT = strtonum(document.getElementById("STRUTT").value);
        WHINTT = strtonum(document.getElementById("WHINTT").value);
        WHOTTT = strtonum(document.getElementById("WHOTTT").value);
        WHRUTT = strtonum(document.getElementById("WHRUTT").value);
        LACATT = strtonum(document.getElementById("LACATT").value);
        MUSITT = strtonum(document.getElementById("MUSITT").value);
        INSUTT = strtonum(document.getElementById("INSUTT").value);
        TIPRTT = strtonum(document.getElementById("TIPRTT").value);
        OTH1TT = strtonum(document.getElementById("OTH1TT").value);
        ADEXTT = strtonum(document.getElementById("ADEXTT").value);
        BOOFTT = strtonum(document.getElementById("BOOFTT").value);
        DRICTT = strtonum(document.getElementById("DRICTT").value);
        FIMATT = strtonum(document.getElementById("FIMATT").value);
        HOWATT = strtonum(document.getElementById("HOWATT").value);
        HOSTTT = strtonum(document.getElementById("HOSTTT").value);
        LIPETT = strtonum(document.getElementById("LIPETT").value);
        LIAUTT = strtonum(document.getElementById("LIAUTT").value);
        PITUTT = strtonum(document.getElementById("PITUTT").value);
        POSETT = strtonum(document.getElementById("POSETT").value);
        PRPRTT = strtonum(document.getElementById("PRPRTT").value);
        PRAFTT = strtonum(document.getElementById("PRAFTT").value);
        PROGTT = strtonum(document.getElementById("PROGTT").value);
        RENTTT = strtonum(document.getElementById("RENTTT").value);
        SOLITT = strtonum(document.getElementById("SOLITT").value);
        TEINTT = strtonum(document.getElementById("TEINTT").value);
        PAERTT = strtonum(document.getElementById("PAERTT").value);
        TRPATT = strtonum(document.getElementById("TRPATT").value);
        OTH2TT = strtonum(document.getElementById("OTH2TT").value);
        OTH3TT = strtonum(document.getElementById("OTH3TT").value);
        OTH4TT = strtonum(document.getElementById("OTH4TT").value);
        OTH5TT = strtonum(document.getElementById("OTH5TT").value);
        LOFITT = strtonum(document.getElementById("LOFITT").value);       

        document.getElementById("TLEXTT").value = number_format(GUA1TT+VGUATT+ADVETT+STINTT+STOTTT+STRUTT+WHINTT+WHOTTT+WHRUTT+LACATT+MUSITT+INSUTT+TIPRTT+OTH1TT+ADEXTT+BOOFTT+DRICTT+FIMATT+HOWATT+HOSTTT+LIPETT+LIAUTT+PITUTT+POSETT+PRPRTT+PRAFTT+PROGTT+RENTTT+SOLITT+TEINTT+PAERTT+TRPATT+OTH2TT+OTH3TT+OTH4TT+OTH5TT+LOFITT);
        TLEXTT = strtonum(document.getElementById("TLEXTT").value);

        document.getElementById("FOCHTT").value = number_format(TLEXTT);

        if((NABRTT-TLEXTT)>0){
            MORETT = NABRTT-TLEXTT;
        }else{
            MORETT = '0';
        }

        document.getElementById("MORETT").value = number_format(MORETT);
        MORETT = strtonum(document.getElementById("MORETT").value);

        NPROTT = strtonum(document.getElementById("NPROTT").value);
        NPRETT = strtonum(document.getElementById("NPRETT").value);

        document.getElementById("TEPRTT").value = number_format(MORETT-NPROTT-NPRETT);
        TEPRTT = strtonum(document.getElementById("TEPRTT").value);

        PREOII = strtonum(document.getElementById("PREOII").value)/100;

        if(TEPRTT>0){
            PREOTT = TEPRTT*PREOII;        
        }else{
            PREOTT = '0';
        }

        document.getElementById("PREOTT").value = number_format(PREOTT);
        PREOTT = strtonum(document.getElementById("PREOTT").value);

        document.getElementById("PROOTT").value = number_format(TEPRTT-PREOTT);
        PROOTT = strtonum(document.getElementById("PROOTT").value);

        document.getElementById("TTPRTT").value = number_format(PROOTT+NPROTT+VGUATT+GUA1TT);
        TTPRTT = strtonum(document.getElementById("TTPRTT").value);

        document.getElementById("USRATT").value = '$ ' + number_format(TTPRTT*EXRAII);

        document.getElementById("LIT1TT").value = number_format(-TTPRTT*LIT1II);
        LIT1TT = strtonum(document.getElementById("LIT1TT").value);
        
        document.getElementById("LIT2TT").value = number_format(-LIT2II*NOW1II);
        LIT2TT = strtonum(document.getElementById("LIT2TT").value);

        document.getElementById("NITPTT").value = number_format(TTPRTT+LIT1TT+LIT2TT);
        NITPTT = strtonum(document.getElementById("NITPTT").value);

        WOEXTT = strtonum(document.getElementById("WOEXTT").value);
        ROMITT = strtonum(document.getElementById("ROMITT").value);

        document.getElementById("VAROTT").value = number_format(-((NITPTT-WOEXTT)*VAROII)-ROMITT);
        VAROTT = strtonum(document.getElementById("VAROTT").value);

        document.getElementById("TSPRTT").value = number_format(NITPTT+WOEXTT+ROMITT+VAROTT);
        TSPRTT = strtonum(document.getElementById("TSPRTT").value);        

        cont++;
    }
 
    min=Math.min.apply(Math,TSPRTT_VEC);

    if(min==Infinity){
        alert("Goal Seek failed");
        PECATT = PECATT_ORIG;
    }else{
        cont = 0;
        while(cont<=100){
            if(TSPRTT_VEC[cont]==min){  
                PECATT = PECATT_VEC[cont-1];
            }
            cont++;
        }
        conf = confirm("Goal Seek Result: " + number_format(PECATT*100,2) + "% - Insert the result into the variable cell?");
   
        if (conf != true) {
            PECATT = PECATT_ORIG;        
        }

    } 

    HOCATT = strtonum(document.getElementById("HOCATT").value);

    document.getElementById("PECATT").value = number_format(PECATT*100,2) + '%';

    document.getElementById("TISOTT").value = number_format(HOCATT*PECATT);
    TISOTT = strtonum(document.getElementById("TISOTT").value);

    document.getElementById("BOGRTT").value = number_format(WGPOII*PECATT); 
    BOGRTT = strtonum(document.getElementById("BOGRTT").value);

    SLINTT = strtonum(document.getElementById("SLINTT").value);    
    ESGRTT = strtonum(document.getElementById("ESGRTT").value); 

    if((BOGRTT-SLINTT-ESGRTT)>0){
        ESSITT = (BOGRTT-SLINTT-ESGRTT);
    }else{
        ESSITT = '0';
    }

    document.getElementById("ESSITT").value = number_format(ESSITT);
    ESSITT = strtonum(document.getElementById("ESSITT").value); 

    LSUDTT = strtonum(document.getElementById("LSUDTT").value);    
    LGRDTT = strtonum(document.getElementById("LGRDTT").value);

    document.getElementById("LSIDTT").value = number_format(-ESSITT*LSIDII);
    LSIDTT = strtonum(document.getElementById("LSIDTT").value);

    document.getElementById("AGROTT").value = number_format(SLINTT+ESGRTT+ESSITT+LSUDTT+LGRDTT+LSIDTT);
    AGROTT = strtonum(document.getElementById("AGROTT").value);

    document.getElementById("CUEBII").value = '$ ' + number_format(AGROTT*NOW1II);

    document.getElementById("AGPPTT").value = number_format((AGROTT/WGPOII)*100) + '%';
    AGPPTT = strtonum(document.getElementById("AGPPTT").value)/100;

    document.getElementById("TAX1TT").value = number_format(-AGROTT/(1+TAX1II)*TAX1II);   
    TAX1TT = strtonum(document.getElementById("TAX1TT").value);

    document.getElementById("TAX2TT").value = number_format(-AGROTT/(1+TAX2II)*TAX2II);
    TAX2TT = strtonum(document.getElementById("TAX2TT").value);

    document.getElementById("FAF1TT").value = number_format(-TISOTT*FAF1II);
    FAF1TT = strtonum(document.getElementById("FAF1TT").value);

    document.getElementById("FAF2TT").value = number_format(-TISOTT*FAF2II);
    FAF2TT = strtonum(document.getElementById("FAF2TT").value);

    SUBCTT = strtonum(document.getElementById("SUBCTT").value);
    GSACTT = strtonum(document.getElementById("GSACTT").value);

    if((AGROTT-ESGRTT-SLINTT)>0){
        CCOCTT = -(AGROTT-ESGRTT-SLINTT)*CCOCII;
    }else{
        CCOCTT = '0';
    }

    document.getElementById("CCOCTT").value = number_format(CCOCTT);
    CCOCTT = strtonum(document.getElementById("CCOCTT").value);

    document.getElementById("NABRTT").value = number_format(AGROTT+AGPPTT+TAX1TT+TAX2TT+FAF1TT+FAF2TT+SUBCTT+GSACTT+CCOCTT);
    NABRTT = strtonum(document.getElementById("NABRTT").value);

    GUA1TT = strtonum(document.getElementById("GUA1TT").value);

    document.getElementById("VGUATT").value = number_format(NABRTT*VGUAII);
    VGUATT = strtonum(document.getElementById("VGUATT").value);

    document.getElementById("INSUTT").value = number_format(TISOTT*INSUII);
    document.getElementById("TIPRTT").value = number_format(TISOTT*TIPRII);

    ADVETT = strtonum(document.getElementById("ADVETT").value);
    STINTT = strtonum(document.getElementById("STINTT").value);
    STOTTT = strtonum(document.getElementById("STOTTT").value);
    STRUTT = strtonum(document.getElementById("STRUTT").value);
    WHINTT = strtonum(document.getElementById("WHINTT").value);
    WHOTTT = strtonum(document.getElementById("WHOTTT").value);
    WHRUTT = strtonum(document.getElementById("WHRUTT").value);
    LACATT = strtonum(document.getElementById("LACATT").value);
    MUSITT = strtonum(document.getElementById("MUSITT").value);
    INSUTT = strtonum(document.getElementById("INSUTT").value);
    TIPRTT = strtonum(document.getElementById("TIPRTT").value);
    OTH1TT = strtonum(document.getElementById("OTH1TT").value);
    ADEXTT = strtonum(document.getElementById("ADEXTT").value);
    BOOFTT = strtonum(document.getElementById("BOOFTT").value);
    DRICTT = strtonum(document.getElementById("DRICTT").value);
    FIMATT = strtonum(document.getElementById("FIMATT").value);
    HOWATT = strtonum(document.getElementById("HOWATT").value);
    HOSTTT = strtonum(document.getElementById("HOSTTT").value);
    LIPETT = strtonum(document.getElementById("LIPETT").value);
    LIAUTT = strtonum(document.getElementById("LIAUTT").value);
    PITUTT = strtonum(document.getElementById("PITUTT").value);
    POSETT = strtonum(document.getElementById("POSETT").value);
    PRPRTT = strtonum(document.getElementById("PRPRTT").value);
    PRAFTT = strtonum(document.getElementById("PRAFTT").value);
    PROGTT = strtonum(document.getElementById("PROGTT").value);
    RENTTT = strtonum(document.getElementById("RENTTT").value);
    SOLITT = strtonum(document.getElementById("SOLITT").value);
    TEINTT = strtonum(document.getElementById("TEINTT").value);
    PAERTT = strtonum(document.getElementById("PAERTT").value);
    TRPATT = strtonum(document.getElementById("TRPATT").value);
    OTH2TT = strtonum(document.getElementById("OTH2TT").value);
    OTH3TT = strtonum(document.getElementById("OTH3TT").value);
    OTH4TT = strtonum(document.getElementById("OTH4TT").value);
    OTH5TT = strtonum(document.getElementById("OTH5TT").value);
    LOFITT = strtonum(document.getElementById("LOFITT").value);       

    document.getElementById("TLEXTT").value = number_format(GUA1TT+VGUATT+ADVETT+STINTT+STOTTT+STRUTT+WHINTT+WHOTTT+WHRUTT+LACATT+MUSITT+INSUTT+TIPRTT+OTH1TT+ADEXTT+BOOFTT+DRICTT+FIMATT+HOWATT+HOSTTT+LIPETT+LIAUTT+PITUTT+POSETT+PRPRTT+PRAFTT+PROGTT+RENTTT+SOLITT+TEINTT+PAERTT+TRPATT+OTH2TT+OTH3TT+OTH4TT+OTH5TT+LOFITT);
    TLEXTT = strtonum(document.getElementById("TLEXTT").value);

    document.getElementById("FOCHTT").value = number_format(TLEXTT);

    if((NABRTT-TLEXTT)>0){
        MORETT = NABRTT-TLEXTT;
    }else{
        MORETT = '0';
    }

    document.getElementById("MORETT").value = number_format(MORETT);
    MORETT = strtonum(document.getElementById("MORETT").value);

    NPROTT = strtonum(document.getElementById("NPROTT").value);
    NPRETT = strtonum(document.getElementById("NPRETT").value);

    document.getElementById("TEPRTT").value = number_format(MORETT-NPROTT-NPRETT);
    TEPRTT = strtonum(document.getElementById("TEPRTT").value);

    if(TEPRTT>0){
        PREOTT = TEPRTT*PREOII;        
    }else{
        PREOTT = '0';
    }

    document.getElementById("PREOTT").value = number_format(PREOTT);
    PREOTT = strtonum(document.getElementById("PREOTT").value);

    document.getElementById("PROOTT").value = number_format(TEPRTT-PREOTT);
    PROOTT = strtonum(document.getElementById("PROOTT").value);

    document.getElementById("TTPRTT").value = number_format(PROOTT+NPROTT+VGUATT+GUA1TT);
    TTPRTT = strtonum(document.getElementById("TTPRTT").value);

    document.getElementById("USRATT").value = '$ ' + number_format(TTPRTT*EXRAII);

    document.getElementById("LIT1TT").value = number_format(-TTPRTT*LIT1II);
    LIT1TT = strtonum(document.getElementById("LIT1TT").value);

    document.getElementById("LIT2TT").value = number_format(-LIT2II*NOW1II);
    LIT2TT = strtonum(document.getElementById("LIT2TT").value);

    document.getElementById("NITPTT").value = number_format(TTPRTT+LIT1TT+LIT2TT);
    NITPTT = strtonum(document.getElementById("NITPTT").value);

    WOEXTT = strtonum(document.getElementById("WOEXTT").value);
    ROMITT = strtonum(document.getElementById("ROMITT").value);

    document.getElementById("VAROTT").value = number_format(-((NITPTT-WOEXTT)*VAROII)-ROMITT);
    VAROTT = strtonum(document.getElementById("VAROTT").value);

    document.getElementById("TSPRTT").value = number_format(NITPTT+WOEXTT+ROMITT+VAROTT);
    TSPRTT = strtonum(document.getElementById("TSPRTT").value);

}    

function setDataSettlementsToBreakeven(value){

    var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
    var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));        

    var id = "#sett"+value;
    var data = JSON.parse($(id).val());

    $("#SHNAME").html("<b>SHOW NAME: </b>"+data.SHOWNAME);
    $("#CINAME").html("<b>CITY: </b>"+data.CITYNAME);
    $("#STNAME").html("<b>STATE: </b>"+data.STATENAME);
    $("#IDATE").html("<b>INIT DATE: </b>"+$.dateformat(finicio));
    $("#EDATE").html("<b>END DATE: </b>"+$.dateformat(ffin));
    $("#VENUE").html("<b>VENUE: </b>"+data.VENUENAME);

    $("#NSPWII").val(number_format(data.NUMBEROFSHOWSPERWEEKS));
    $("#NOW1II").val(number_format(data.NUMBEROFWEEKS));
    $("#WGPOII").val(number_format(data.WEEKLYGROSSPOTENTIAL));
    $("#NAPTII").val(number_format(data.NETAVERAGEPERTICKET));
    $("#EXRAII").val(number_format(data.EXCHANGERATE));
    $("#SPSHII").val(number_format(data.CAPACITY));
    $("#SLINII").val(number_format(data.SUBLOADIN));
    $("#ESGRII").val(number_format(data.ESTIMATEDGROUPS));
    $("#TAX1II").val(number_format(data.SALESTAX1,2)+'%');
    $("#TAX2II").val(number_format(data.SALESTAX2,2)+'%');
    $("#FAF1II").val('$ '+number_format(data.FACILITYFEE1,2));
    $("#SUBCII").val(number_format(data.SUBSCRIPTIONCOMMISION)+'%');
    $("#GSACII").val(number_format(data.GROUPSALESCOMMISION)+'%');
    $("#CCOCII").val(number_format(data.CREDITCARDCOMMISION)+'%');
    $("#GUA1II").val(number_format(data.GUARANTEE,2));
    $("#VGUAII").val(number_format(data.VARIABLEGUARANTEE,2)+'%');
    $("#ADVEII").val(number_format(data.ADVERTISING,2));
    $("#STINII").val(number_format(data.STAGEHANDSLOAINACTUAL,2));
    $("#STOTII").val(number_format(data.STAGEHANDSLOADOUTACTUAL,2));
    $("#STRUII").val(number_format(data.STAGEHANDSRUNNINGACTUAL,2));
    $("#WHINII").val(number_format(data.WARDROBELOADINACTUAL,2));
    $("#WHOTII").val(number_format(data.WARDROBELOADOUTACTUAL,2));
    $("#WHRUII").val(number_format(data.WARDROBERUNNINGACTUAL,2));   
    $("#LACAII").val(number_format(data.LABORCATERING,2));  
    $("#MUSIII").val(number_format(data.MUSICIANS,2)); 
    $("#INSUII").val(number_format(data.INSURANCE,2));  
    $("#TIPRII").val(number_format(data.TICKETPRINTING,2));
    $("#OTH1II").val(number_format(data.OTHER,2)); 
    $("#ADEXII").val(number_format(data.ADAEXPENSES,2));
    $("#BOOFII").val(number_format(data.BOXOFFICE,2));
    $("#DRICII").val(number_format(data.DRYICE,2));
    $("#HOWAII").val(number_format(data.HOSPITALITY,2));
    $("#HOSTII").val(number_format(data.HOUSESTAFF,2)); 
    $("#LIPEII").val(number_format(data.LICENSES,2));
    $("#LIAUII").val(number_format(data.LIMOS,2));
    $("#PITUII").val(number_format(data.PIANO,2));
    $("#POSEII").val(number_format(data.POLICESECURITY,2));
    $("#PRPRII").val(number_format(data.PRESENTERPROFIT,2));
    $("#PRAFII").val(number_format(data.PRESSAGENTFEE,2));
    $("#PROGII").val(number_format(data.PROGRAMS,2));
    $("#RENTII").val(number_format(data.RENT,2));
    $("#SOLIII").val(number_format(data.SOUND,2));
    $("#TEINII").val(number_format(data.TELEPHONES,2));
    $("#PAERII").val(number_format(data.EQUIPMENTRENTAL,2));
    $("#OTH2II").val(number_format(data.OTHERDACTUAL,2)); 
    $("#OTH3II").val(number_format(data.OTHEREACTUAL,2));
    $("#OTH4II").val(number_format(data.OTHERFACTUAL,2)); 
    $("#OTH5II").val(number_format(data.OTHERGACTUAL,2));
    $("#LOFIII").val(number_format(data.LOCALFIX,2));
    $("#LIT1II").val(number_format(data.LESSINCOMETAXES1,2)+'%');

    $("#SHNAMEID").val(data.SHOWNAME);
    $("#CINAMEID").val(data.CITYNAME);
    $("#STNAMEID").val(data.STATENAME);
    $("#IDATEID").val($.dateformat(finicio));
    $("#EDATEID").val($.dateformat(ffin));
    $("#VENUEID").val(data.VENUENAME);       

    $("#results").hide(); 
    $("#loader").hide(); 
    $("#selection_data").hide();

    $("#export").show(); 
    $("#breakeven_data").show(); 
    $("#back_to_selection").show();

    BCalc();

}

function setDataContractsToBreakeven(value){

    var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
    var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));        

    var id = "#cont"+value;
    var data = JSON.parse($(id).val());

    $("#SHNAME").html("<b>SHOW NAME: </b>"+data.SHOWNAME);
    $("#CINAME").html("<b>CITY: </b>"+data.CITYNAME);
    $("#STNAME").html("<b>STATE: </b>"+data.STATENAME);
    $("#IDATE").html("<b>INIT DATE: </b>"+$.dateformat(finicio));
    $("#EDATE").html("<b>END DATE: </b>"+$.dateformat(ffin));
    $("#VENUE").html("<b>VENUE: </b>"+data.VENUENAME);

    $("#NSPWII").val(number_format(data.NUMBEROFSHOWSPERWEEKS));
    $("#NOW1II").val(number_format(data.NUMBEROFWEEKS));
    $("#WGPOII").val(number_format(data.WEEKLYGROSSPOTENTIAL));
    $("#EXRAII").val(number_format(data.EXCHANGERATE));
    $("#TAX1II").val(number_format(data.SALESTAX1,2)+'%');
    $("#TAX2II").val(number_format(data.SALESTAX2,2)+'%');
    $("#FAF1II").val('$ '+number_format(data.FACILITYFEE1,2));
    $("#FAF2II").val('$ '+number_format(data.FACILITYFEE2,2));
    $("#SUBCII").val(number_format(data.SUBSCRIPTIONCOMMISION)+'%');
    $("#GSACII").val(number_format(data.GROUPSALESCOMMISION)+'%');
    $("#CCOCII").val(number_format(data.CREDITCARDCOMMISION)+'%');
    $("#GUA1II").val(number_format(data.GUARANTEE,2));
    $("#VGUAII").val(number_format(data.VARIABLEGUARANTEE,2)+'%');
    $("#LIT1II").val(number_format(data.LESSINCOMETAXES1,2)+'%'); 

    $("#SHNAMEID").val(data.SHOWNAME);
    $("#CINAMEID").val(data.CITYNAME);
    $("#STNAMEID").val(data.STATENAME);
    $("#IDATEID").val($.dateformat(finicio));
    $("#EDATEID").val($.dateformat(ffin));
    $("#VENUEID").val(data.VENUENAME);       

    $("#results").hide(); 
    $("#loader").hide(); 
    $("#selection_data").hide();

    $("#export").show();
    $("#breakeven_data").show(); 
    $("#back_to_selection").show();

    BCalc();  
}

function setDataRoutesToBreakeven(value){

    var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
    var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));    

    var id = "#route"+value;
    var data = JSON.parse($(id).val());

    $("#SHNAME").html("<b>SHOW NAME: </b>"+data.SHOWNAME);
    $("#CINAME").html("<b>CITY: </b>"+data.CITYNAME);
    $("#STNAME").html("<b>STATE: </b>"+data.STATENAME);
    $("#IDATE").html("<b>INIT DATE: </b>"+$.dateformat(finicio));
    $("#EDATE").html("<b>END DATE: </b>"+$.dateformat(ffin));
    $("#VENUE").html("<b>VENUE: </b>"+data.VENUENAME);

    $("#NSPWII").val(number_format(data.NUMBEROFSHOWSPERWEEKS));
    $("#NOW1II").val(number_format(data.NUMBEROFWEEKS));
    $("#WGPOII").val(number_format(data.WEEKLYGROSSPOTENTIAL));
    $("#EXRAII").val(number_format(data.EXCHANGERATE));
    $("#SPSHII").val(number_format(data.CAPACITY));
    $("#GUA1II").val(number_format(data.FIXED_GNTEE,2));
    $("#VGUAII").val(number_format(data.ROYALTY,2)+'%');      

    $("#SHNAMEID").val(data.SHOWNAME);
    $("#CINAMEID").val(data.CITYNAME);
    $("#STNAMEID").val(data.STATENAME);
    $("#IDATEID").val($.dateformat(finicio));
    $("#EDATEID").val($.dateformat(ffin));
    $("#VENUEID").val(data.VENUENAME);     

    $("#results").hide(); 
    $("#loader").hide(); 
    $("#selection_data").hide();

    $("#export").show();
    $("#breakeven_data").show(); 
    $("#back_to_selection").show();

    BCalc(); 
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

        if((cityId == 0)||(cityId == "")||(cityId == null)){
            cityId = "%"
        }

        if((stateId == 0)||(stateId == "")||(stateId == null)){
            stateId = "%"
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

    $("#btnBackSelection").click(function (ev) {

        $("#results").show(); 
        $("#selection_data").show();
        $("#loader").hide(); 

        $("#SHNAME").html("<b>SHOW NAME: </b>");
        $("#CINAME").html("<b>CITY: </b>");
        $("#STNAME").html("<b>STATE: </b>");
        $("#IDATE").html("<b>INIT DATE: </b>");
        $("#EDATE").html("<b>END DATE: </b>");
        $("#VENUE").html("<b>VENUE: </b>");

        $("#SHNAMEID").val(0);
        $("#CINAMEID").val(0);
        $("#STNAMEID").val(0);
        $("#IDATEID").val(0);
        $("#EDATEID").val(0);
        $("#VENUEID").val(0);

        $('#frmbreakeven')[0].reset();        

        $("#export").hide(); 
        $("#breakeven_data").hide(); 
        $("#back_to_selection").hide();

    });    

    $("#btnBreakevenManual").click(function (ev) {

        var countryText = $("#countryId option:selected").text();
        var countryId = $("#countryId").val();
        var stateText = $("#stateId option:selected").text();
        var stateId = $("#stateId").val();
        var cityText = $("#cityId option:selected").text();
        var cityId = $("#cityId").val();
        var showText = $("#showId option:selected").text();
        var showId = $("#showId").val();

        var venues = $("#venues").multipleSelect("getSelects");
        var venuesId = $("#venues").val();
        var venuesText = $("#venues").multipleSelect("getSelects", "text");

        var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
        var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));

        if((countryId == 0)||(countryId == "")||(countryId == null)){
            alert("COUNTRY is not selected, Please verify these values.");
            return;
        }        

        if((cityId == 0)||(cityId == "")||(cityId == null)){
            alert("CITY is not selected, Please verify these values.");
            return;
        }

        if((stateId == 0)||(stateId == "")||(stateId == null)){
            alert("STATE is not selected, Please verify these values.");
            return;
        }

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

        if((showId == 0)||(showId == "")||(showId == null)){
            alert("SHOW is not selected, Please verify these values.");
            return;
        }

        if((venues == 0)||(venues == "")||(venues == null)){
            alert("VENUES is not selected, Please verify these values.");
            return;
        }else{
            if(venuesId.length > 1){
                alert("In manual mode only one VENUE is allowed to be selected, Please Verify.");
                return;
            }
        }     

        $("#SHNAME").html("<b>SHOW NAME: </b>"+showText);
        $("#CINAME").html("<b>CITY: </b>"+cityText);
        $("#STNAME").html("<b>STATE: </b>"+stateText);
        $("#IDATE").html("<b>INIT DATE: </b>"+$.dateformat(finicio));
        $("#EDATE").html("<b>END DATE: </b>"+$.dateformat(ffin));
        $("#VENUE").html("<b>VENUE: </b>"+venuesText);

        $("#SHNAMEID").val(showText);
        $("#CINAMEID").val(cityText);
        $("#STNAMEID").val(stateText);
        $("#IDATEID").val($.dateformat(finicio));
        $("#EDATEID").val($.dateformat(ffin));
        $("#VENUEID").val(venuesText);

        $("#results").hide(); 
        $("#selection_data").hide();
        $("#loader").hide(); 

        $('#frmbreakeven')[0].reset();

        $("#export").show(); 
        $("#breakeven_data").show(); 
        $("#back_to_selection").show();        

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

    $(".botonExcel").click(function(event) {
        $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });
});

$.dateformat = function(dateObject) {

    var day = dateObject.getDate();
    var month = dateObject.getMonth() + 1;
    var year = dateObject.getFullYear();

    if (day < 10) {
        day = "0" + day;
    }

    if (month < 10) {
        month = "0" + month;
    }

    var date = month + "/" + day + "/" + year;

    return date;
};