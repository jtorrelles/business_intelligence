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

    document.getElementById("LGRDW1").value = number_format(-(ESGRW1/(1-LGRDII))+ESGRW1,2);
    document.getElementById("LGRDW2").value = number_format(-(ESGRW2/(1-LGRDII))+ESGRW2,2);
    document.getElementById("LGRDW3").value = number_format(-(ESGRW3/(1-LGRDII))+ESGRW3,2);
    document.getElementById("LGRDW4").value = number_format(-(ESGRW4/(1-LGRDII))+ESGRW4,2);
    document.getElementById("LGRDR1").value = number_format(-(ESGRR1/(1-LGRDII))+ESGRR1,2);
    document.getElementById("LGRDR2").value = number_format(-(ESGRR2/(1-LGRDII))+ESGRR2,2);
    document.getElementById("LGRDR3").value = number_format(-(ESGRR3/(1-LGRDII))+ESGRR3,2);
    document.getElementById("LGRDR4").value = number_format(-(ESGRR4/(1-LGRDII))+ESGRR4,2);
    document.getElementById("LGRDTT").value = number_format(-(ESGRTT/(1-LGRDII))+ESGRTT,2);

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
    document.getElementById("AGPPTT").value = number_format((AGROTT/WGPOII)*100,2) + '%';

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

    INSUII = strtonum(document.getElementById("INSUII").value);

    document.getElementById("INSUW1").value = number_format(TISOW1*INSUII,2);
    document.getElementById("INSUW2").value = number_format(TISOW2*INSUII,2);
    document.getElementById("INSUW3").value = number_format(TISOW3*INSUII,2);
    document.getElementById("INSUW4").value = number_format(TISOW4*INSUII,2);
    document.getElementById("INSUR1").value = number_format(TISOR1*INSUII,2);
    document.getElementById("INSUR2").value = number_format(TISOR2*INSUII,2);
    document.getElementById("INSUR3").value = number_format(TISOR3*INSUII,2);
    document.getElementById("INSUR4").value = number_format(TISOR4*INSUII,2);
    document.getElementById("INSUTT").value = number_format(TISOTT*INSUII);

    TIPRII = strtonum(document.getElementById("TIPRII").value);

    document.getElementById("TIPRW1").value = number_format(TISOW1*TIPRII,2);
    document.getElementById("TIPRW2").value = number_format(TISOW2*TIPRII,2);
    document.getElementById("TIPRW3").value = number_format(TISOW3*TIPRII,2);
    document.getElementById("TIPRW4").value = number_format(TISOW4*TIPRII,2);
    document.getElementById("TIPRR1").value = number_format(TISOR1*TIPRII,2);
    document.getElementById("TIPRR2").value = number_format(TISOR2*TIPRII,2);
    document.getElementById("TIPRR3").value = number_format(TISOR3*TIPRII,2);
    document.getElementById("TIPRR4").value = number_format(TISOR4*TIPRII,2);
    document.getElementById("TIPRTT").value = number_format(TISOTT*TIPRII);

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

    document.getElementById("TLEXW1").value = number_format((GUA1II*EXRAII)+(NABRW1*VGUAII)+ADVEII+STINII+STOTII+STRUII+WHINII+WHOTII+WHRUII+LACAII+MUSIII+(TISOW1*INSUII)+(TISOW1*TIPRII)+OTH1II+ADEXII+BOOFII+DRICII+FIMAII+HOWAII+HOSTII+LIPEII+LIAUII+PITUII+POSEII+PRPRII+PRAFII+PROGII+RENTII+SOLIII+TEINII+PAERII+TRPAII+OTH2II+OTH3II+OTH4II+OTH5II+LOFIII);
    document.getElementById("TLEXW2").value = number_format((GUA1II*EXRAII)+(NABRW2*VGUAII)+ADVEII+STINII+STOTII+STRUII+WHINII+WHOTII+WHRUII+LACAII+MUSIII+(TISOW2*INSUII)+(TISOW2*TIPRII)+OTH1II+ADEXII+BOOFII+DRICII+FIMAII+HOWAII+HOSTII+LIPEII+LIAUII+PITUII+POSEII+PRPRII+PRAFII+PROGII+RENTII+SOLIII+TEINII+PAERII+TRPAII+OTH2II+OTH3II+OTH4II+OTH5II+LOFIII);
    document.getElementById("TLEXW3").value = number_format((GUA1II*EXRAII)+(NABRW3*VGUAII)+ADVEII+STINII+STOTII+STRUII+WHINII+WHOTII+WHRUII+LACAII+MUSIII+(TISOW3*INSUII)+(TISOW3*TIPRII)+OTH1II+ADEXII+BOOFII+DRICII+FIMAII+HOWAII+HOSTII+LIPEII+LIAUII+PITUII+POSEII+PRPRII+PRAFII+PROGII+RENTII+SOLIII+TEINII+PAERII+TRPAII+OTH2II+OTH3II+OTH4II+OTH5II+LOFIII);
    document.getElementById("TLEXW4").value = number_format((GUA1II*EXRAII)+(NABRW4*VGUAII)+ADVEII+STINII+STOTII+STRUII+WHINII+WHOTII+WHRUII+LACAII+MUSIII+(TISOW4*INSUII)+(TISOW4*TIPRII)+OTH1II+ADEXII+BOOFII+DRICII+FIMAII+HOWAII+HOSTII+LIPEII+LIAUII+PITUII+POSEII+PRPRII+PRAFII+PROGII+RENTII+SOLIII+TEINII+PAERII+TRPAII+OTH2II+OTH3II+OTH4II+OTH5II+LOFIII);    
    document.getElementById("TLEXR1").value = number_format((GUA1II*EXRAII*NOW1II)+(NABRR1*VGUAII)+(ADVEII*NOW1II)+(STINII*NOW1II)+(STOTII*NOW1II)+(STRUII*NOW1II)+(WHINII*NOW1II)+(WHOTII*NOW1II)+(WHRUII*NOW1II)+(LACAII*NOW1II)+(MUSIII*NOW1II)+(TISOR1*INSUII)+(TISOR1*TIPRII)+(OTH1II*NOW1II)+(ADEXII*NOW1II)+(BOOFII*NOW1II)+(DRICII*NOW1II)+(FIMAII*NOW1II)+(HOWAII*NOW1II)+(HOSTII*NOW1II)+(LIPEII*NOW1II)+(LIAUII*NOW1II)+(PITUII*NOW1II)+(POSEII*NOW1II)+(PRPRII*NOW1II)+(PRAFII*NOW1II)+(PROGII*NOW1II)+(RENTII*NOW1II)+(SOLIII*NOW1II)+(TEINII*NOW1II)+(PAERII*NOW1II)+(TRPAII*NOW1II)+(OTH2II*NOW1II)+(OTH3II*NOW1II)+(OTH4II*NOW1II)+(OTH5II*NOW1II)+(LOFIII*NOW1II));
    document.getElementById("TLEXR2").value = number_format((GUA1II*EXRAII*NOW1II)+(NABRR2*VGUAII)+(ADVEII*NOW1II)+(STINII*NOW1II)+(STOTII*NOW1II)+(STRUII*NOW1II)+(WHINII*NOW1II)+(WHOTII*NOW1II)+(WHRUII*NOW1II)+(LACAII*NOW1II)+(MUSIII*NOW1II)+(TISOR2*INSUII)+(TISOR2*TIPRII)+(OTH1II*NOW1II)+(ADEXII*NOW1II)+(BOOFII*NOW1II)+(DRICII*NOW1II)+(FIMAII*NOW1II)+(HOWAII*NOW1II)+(HOSTII*NOW1II)+(LIPEII*NOW1II)+(LIAUII*NOW1II)+(PITUII*NOW1II)+(POSEII*NOW1II)+(PRPRII*NOW1II)+(PRAFII*NOW1II)+(PROGII*NOW1II)+(RENTII*NOW1II)+(SOLIII*NOW1II)+(TEINII*NOW1II)+(PAERII*NOW1II)+(TRPAII*NOW1II)+(OTH2II*NOW1II)+(OTH3II*NOW1II)+(OTH4II*NOW1II)+(OTH5II*NOW1II)+(LOFIII*NOW1II));
    document.getElementById("TLEXR3").value = number_format((GUA1II*EXRAII*NOW1II)+(NABRR3*VGUAII)+(ADVEII*NOW1II)+(STINII*NOW1II)+(STOTII*NOW1II)+(STRUII*NOW1II)+(WHINII*NOW1II)+(WHOTII*NOW1II)+(WHRUII*NOW1II)+(LACAII*NOW1II)+(MUSIII*NOW1II)+(TISOR3*INSUII)+(TISOR3*TIPRII)+(OTH1II*NOW1II)+(ADEXII*NOW1II)+(BOOFII*NOW1II)+(DRICII*NOW1II)+(FIMAII*NOW1II)+(HOWAII*NOW1II)+(HOSTII*NOW1II)+(LIPEII*NOW1II)+(LIAUII*NOW1II)+(PITUII*NOW1II)+(POSEII*NOW1II)+(PRPRII*NOW1II)+(PRAFII*NOW1II)+(PROGII*NOW1II)+(RENTII*NOW1II)+(SOLIII*NOW1II)+(TEINII*NOW1II)+(PAERII*NOW1II)+(TRPAII*NOW1II)+(OTH2II*NOW1II)+(OTH3II*NOW1II)+(OTH4II*NOW1II)+(OTH5II*NOW1II)+(LOFIII*NOW1II));
    document.getElementById("TLEXR4").value = number_format((GUA1II*EXRAII*NOW1II)+(NABRR4*VGUAII)+(ADVEII*NOW1II)+(STINII*NOW1II)+(STOTII*NOW1II)+(STRUII*NOW1II)+(WHINII*NOW1II)+(WHOTII*NOW1II)+(WHRUII*NOW1II)+(LACAII*NOW1II)+(MUSIII*NOW1II)+(TISOR4*INSUII)+(TISOR4*TIPRII)+(OTH1II*NOW1II)+(ADEXII*NOW1II)+(BOOFII*NOW1II)+(DRICII*NOW1II)+(FIMAII*NOW1II)+(HOWAII*NOW1II)+(HOSTII*NOW1II)+(LIPEII*NOW1II)+(LIAUII*NOW1II)+(PITUII*NOW1II)+(POSEII*NOW1II)+(PRPRII*NOW1II)+(PRAFII*NOW1II)+(PROGII*NOW1II)+(RENTII*NOW1II)+(SOLIII*NOW1II)+(TEINII*NOW1II)+(PAERII*NOW1II)+(TRPAII*NOW1II)+(OTH2II*NOW1II)+(OTH3II*NOW1II)+(OTH4II*NOW1II)+(OTH5II*NOW1II)+(LOFIII*NOW1II));
    document.getElementById("TLEXTT").value = number_format((GUA1II*EXRAII)+(NABRTT*VGUAII)+ADVEII+STINII+STOTII+STRUII+WHINII+WHOTII+WHRUII+LACAII+MUSIII+(TISOTT*INSUII)+(TISOTT*TIPRII)+OTH1II+ADEXII+BOOFII+DRICII+FIMAII+HOWAII+HOSTII+LIPEII+LIAUII+PITUII+POSEII+PRPRII+PRAFII+PROGII+RENTII+SOLIII+TEINII+PAERII+TRPAII+OTH2II+OTH3II+OTH4II+OTH5II+LOFIII);

    TLEXW1 = strtonum(document.getElementById("TLEXW1").value);
    TLEXW2 = strtonum(document.getElementById("TLEXW2").value);
    TLEXW3 = strtonum(document.getElementById("TLEXW3").value);
    TLEXW4 = strtonum(document.getElementById("TLEXW4").value);
    TLEXR1 = strtonum(document.getElementById("TLEXR1").value);
    TLEXR2 = strtonum(document.getElementById("TLEXR2").value);
    TLEXR3 = strtonum(document.getElementById("TLEXR3").value);
    TLEXR4 = strtonum(document.getElementById("TLEXR4").value);
    TLEXTT = strtonum(document.getElementById("TLEXTT").value);
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

