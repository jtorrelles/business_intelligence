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

