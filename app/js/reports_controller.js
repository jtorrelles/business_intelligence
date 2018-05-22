
var globalDate = "";

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

function getAllRoutes(inid,endd,country,state,city,fields,weekending) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getAllRoutes&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&fields=' + fields + '&weekending=' + weekending;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var counter2 = 0;    
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="allroutestable">'
    var htmlexc = '<table>'
    var columns = '';
    var hcolumns = '<tr><th>DATE</th>'; 
    var files = '';
    var hfiles = '<tr>';
    var showid = '';
    var datei = new Date(inid.replace(/-/, '/').replace(/-/, '/'));
    var datee = new Date(endd.replace(/-/, '/').replace(/-/, '/'));
    var ini = datei.valueOf();
    var end = datee.valueOf();
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
        	size = data.result['head'].length; 
            while(counter1 < size){
                columns = '<th>' + data.result['head'][counter1].name + '</th>';
                hcolumns = hcolumns + columns;
            	counter1++;
            }
            hcolumns = hcolumns + '</tr>';
            htmlpdf = htmlpdf + hcolumns;
            htmlexc = htmlexc + hcolumns;
            $("#header").append(hcolumns);
            counter1 = 0;
            while(ini <= end){  
                sunday = new Date(ini).getUTCDay();
                if(weekending == 0 || sunday == 0){
                    dt = ("0" + (new Date(ini).getMonth() + 1)).slice(-2) + '/' + ("0" + new Date(ini).getDate()).slice(-2) + '/' + new Date(ini).getFullYear();
                    hfiles = hfiles + '<td>' + dt + '</td>';
                    while(counter2 < size){
                        files = '<td>' + data.result['body'][counter2][counter1].citystate + '</td>';
                        hfiles = hfiles + files;                                         
                        counter2++;
                    }                    
                    hfiles = hfiles + '</tr><tr>';                    
                    counter2 = 0;
                }
                ini = ini + 86400000;                 
                counter1++;               
            }
            hfiles = hfiles + '</tr>';
            htmlpdf = htmlpdf + hfiles + '</table>';
            htmlexc = htmlexc + hfiles + '</table>';
            $('.htmlpdf').val(htmlpdf);
            $('.htmlexc').val(htmlexc);
            $("#body").append(hfiles);
            $("#loader").hide();
            $("#export").show();
        }else{
            alert(data.msg);            
            $("#loader").hide();
        }
    }); 
}

function getRoutesConf(inid,endd,country,state,city,reason) { 
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getRoutesConf&inid=' + inid + 
                                                            '&endd=' + endd + 
                                                            '&country=' + country + 
                                                            '&state=' + state + 
                                                            '&city=' + city + 
                                                            '&reason=' + reason;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var counter2 = 0;
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css">'
    var htmlexc = '<table>'
    var columns = '<tr><th>CITY / STATE</th>' + 
                  '<th>SHOW</th>' +
                  '<th>SHOW</th>' + 
                  '<th>SHOW</th>' + 
                  '<th>SHOW</th>' + 
                  '<th>SHOW</th>' + 
                  '<th>CONFLICT REASON</th></tr>';
    var files = '';
    var files2 = '';
    call.send(data, url, method, function(data) {
        if(data.tp == 1){  
            htmlexc = htmlexc + columns;         
            $("#header").append(columns);
            size = data.result['body'].length; 
            while(counter1 < size){
                ind1 = data.result['body'][counter1].ind1;
                ind2 = data.result['body'][counter1].ind2;
                if(ind2 == 0){
                    data.result['body'][counter1].show3 = '';
                    data.result['body'][counter1].datevenue3 = '';
                    data.result['body'][counter1].show4 = '';
                    data.result['body'][counter1].datevenue4 = '';
                    data.result['body'][counter1].show5 = '';
                    data.result['body'][counter1].datevenue5 = '';
                }
                if(ind1 == 1){
                    if(reason == 0 || reason == data.result['body'][counter1].notes){ 
                        files = '<tr>' + 
                            '<td rowspan="2">' + 
                                data.result['body'][counter1].citysta + 
                            '</td>' + 
                            '<td>' + 
                                '<b>' + 
                                    '<font size="4">' + 
                                        data.result['body'][counter1].show1 + 
                                    '</font>' +
                                '</b>' + 
                            '</td>' + 
                            '<td>' + 
                                '<b>' + 
                                    '<font size="4">' + 
                                        data.result['body'][counter1].show2 + 
                                    '</font>' +
                                '</b>' + 
                            '</td>' + 
                            '<td>' + 
                                '<b>' + 
                                    '<font size="4">' + 
                                        data.result['body'][counter1].show3 + 
                                    '</font>' +
                                '</b>' + 
                            '</td>' + 
                            '<td>' + 
                                '<b>' + 
                                    '<font size="4">' + 
                                        data.result['body'][counter1].show4 + 
                                    '</font>' +
                                '</b>' + 
                            '</td>' + 
                            '<td>' + 
                                '<b>' + 
                                    '<font size="4">' + 
                                        data.result['body'][counter1].show5 + 
                                    '</font>' +
                                '</b>' + 
                            '</td>' + 
                            '<td rowspan="2">' +
                                '<b>' + 
                                    data.result['body'][counter1].color + 
                                    data.result['body'][counter1].notes + 
                                    '</font>' + 
                                '</b>' +
                            '</td>' +
                        '</tr>' + 
                        '<tr>' +
                            '<td>' + 
                                data.result['body'][counter1].datevenue1 + 
                            '</td>' +
                            '<td>' + 
                                data.result['body'][counter1].datevenue2 + 
                            '</td>' +
                            '<td>' + 
                                data.result['body'][counter1].datevenue3 + 
                            '</td>' +
                            '<td>' + 
                                data.result['body'][counter1].datevenue4 + 
                            '</td>' +
                            '<td>' + 
                                data.result['body'][counter1].datevenue5 + 
                            '</td>' +
                        '</tr>';

                        files2 = files2 + files

                        if (counter2 % 7 == 0){
                            if (counter2 == 0){
                                htmlpdf = htmlpdf + '<table id="allroutestable">' + columns + files;
                            }else{
                                htmlpdf = htmlpdf + '</table><br><table style="page-break-after:always;"></br></table><br><table id="allroutestable">' + columns + files;
                            }
                        }else{                           
                            htmlpdf = htmlpdf + files;
                        }  
                        counter2++; 
                    }    
                }    
                counter1++;
            }
            htmlpdf = htmlpdf + '</table>';
            htmlexc = htmlexc + files + '</table>';
            $('.htmlpdf').val(htmlpdf);
            $('.htmlexc').val(htmlexc);
            $("#body").append(files2);
            $("#loader").hide();
            $("#export").show();
        }else{
            alert(data.msg);
            $("#loader").hide();
        }
    }); 
}

function getMarketHistory(inid,endd,country,state,city,fields,shows,venues) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getMarketHistory&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&fields=' + fields + '&shows=' + shows + '&venues=' + venues;
    var method = "GET";
    var data = {};
    var counter1 = 0;
    var counter2 = 0;
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="allroutestable">'
    var htmlexc = '<table>'
    var columns = '';
    var hcolumns = '<tr><th>SHOW NAME</th>' +
                   '<th>OPENING DATE</th>' + 
                   '<th>CLOSING DATE</th>' +
                   '<th>COUNTRY</th>' +
                   '<th>STATE</th>' +
                   '<th>CITY</th>' +                    
                   '<th>VENUE NAME</th>'; 
    var files = '';
    var hfiles = '<tr>';
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            size = data.result['head'].length; 
            while(counter1 < size){
                columns = '<th>' + data.result['head'][counter1].column + '</th>';
                hcolumns = hcolumns + columns;
                counter1++;
            }
            hcolumns = hcolumns + '</tr>';
            htmlpdf = htmlpdf + hcolumns; 
            htmlexc = htmlexc + hcolumns;    
            $("#header").append(hcolumns);
            size2 = data.result['body'].length; 
            counter1 = 0;
            while(counter1 < size2){  
                hfiles = hfiles + '<td>' + data.result['body'][counter1].showname + '</td>' + 
                                  '<td>' + data.result['body'][counter1].openingdate + '</td>' + 
                                  '<td>' + data.result['body'][counter1].closingdate + '</td>' + 
                                  '<td>' + data.result['body'][counter1].country + '</td>' + 
                                  '<td>' + data.result['body'][counter1].state + '</td>' + 
                                  '<td>' + data.result['body'][counter1].city + '</td>' + 
                                  '<td>' + data.result['body'][counter1].venuename + '</td>';
                while(counter2 < size){ 
                    col = data.result['head'][counter2].column;
                    if(col=='NOTES'){
                        files = '<td>' + eval("data.result['body'][counter1]." + col) + '</td>';
                    }else{
                        files = '<td>' + number_format(eval("data.result['body'][counter1]." + col),2) + '</td>';
                    }
                    hfiles = hfiles + files;                                         
                    counter2++;
                }
                hfiles = hfiles + '</tr><tr>';
                counter1++;
                counter2 = 0;                
            }
            hfiles = hfiles + '</tr>';
            htmlpdf = htmlpdf + hfiles + '</table>';
            htmlexc = htmlexc + hfiles + '</table>';
            $('.htmlpdf').val(htmlpdf);
            $('.htmlexc').val(htmlexc);
            $("#body").append(hfiles);
            $("#loader").hide();
            $("#export").show();
        }else{
            alert(data.msg);            
            $("#loader").hide();
        }
    }); 
}

function getSalesSummary(inid,endd,country,state,city,fields,shows) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getSalesSummary&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&fields=' + fields + '&shows=' + shows;
    var method = "GET";
    var data = {};
    var counter = 0;
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="allroutestable">'
    var htmlexc = '<table>'
    var columns = '<tr><th>SHOW NAME</th>' +
                  '<th>OPENING DATE</th>' + 
                  '<th>CLOSING DATE</th>' +
                  '<th>COUNTRY</th>' +
                  '<th>STATE</th>' +
                  '<th>CITY</th>' +
                  '<th>GROSS POTENTIAL</th>' +
                  '<th>SUBSCRIPTION SALES</th>' +
                  '<th>GROUPS SALES</th>' +
                  '<th>SINGLE TICKET SALES</th>'; 
    var files = '<tr>';

    if(fields.indexOf("1")>=0){
       columns = columns + '<th>SUBS VS. GROSS %</th>';
    }
    if(fields.indexOf("2")>=0){
       columns = columns + '<th>SUBS VS. GROSS POTENTIAL %</th>';
    }
    if(fields.indexOf("3")>=0){
       columns = columns + '<th>GROUPS VS. GROSS %</th>';
    }
    if(fields.indexOf("4")>=0){
       columns = columns + '<th>GROUPS VS. GROSS POTENTIAL %</th>';
    }
    if(fields.indexOf("5")>=0){
       columns = columns + '<th>SINGLE VS. GROSS %</th>';
    }
    if(fields.indexOf("6")>=0){
       columns = columns + '<th>SINGLE VS. GROSS POTENTIAL %</th>';
    }
    columns = columns + '</tr>';

    call.send(data, url, method, function(data) {
        if(data.tp == 1){    
            htmlpdf = htmlpdf + columns; 
            htmlexc = htmlexc + columns;         
            $("#header").append(columns);
            size = data.result['body'].length;
            while(counter < size){
                gp = data.result['body'][counter].gp;
                ss = data.result['body'][counter].ss;
                gs = data.result['body'][counter].gs;
                st = data.result['body'][counter].st;

                files = files + '<td>' + data.result['body'][counter].showname + '</td>' + 
                                '<td>' + data.result['body'][counter].openingdate + '</td>' + 
                                '<td>' + data.result['body'][counter].closingdate + '</td>' + 
                                '<td>' + data.result['body'][counter].country + '</td>' + 
                                '<td>' + data.result['body'][counter].state + '</td>' + 
                                '<td>' + data.result['body'][counter].city + '</td>' + 
                                '<td>' + number_format(gp,2) + '</td>' + 
                                '<td>' + number_format(ss,2) + '</td>' + 
                                '<td>' + number_format(gs,2) + '</td>' + 
                                '<td>' + number_format(st,2) + '</td>';

                if(fields.indexOf("1")>=0){                    
                    if((ss+gs+st)>0){
                        files = files + '<td>' + number_format(ss/(ss+gs+st),2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }
                if(fields.indexOf("2")>=0){
                    if(gp>0){
                        files = files + '<td>' + number_format(ss/gp,2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }
                if(fields.indexOf("3")>=0){
                    if((ss+gs+st)>0){
                        files = files + '<td>' + number_format(gs/(ss+gs+st),2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }
                if(fields.indexOf("4")>=0){
                    if(gp>0){
                        files = files + '<td>' + number_format(gs/gp,2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }
                if(fields.indexOf("5")>=0){
                    if((ss+gs+st)>0){
                        files = files + '<td>' + number_format(st/(ss+gs+st),2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }
                if(fields.indexOf("6")>=0){
                    if(gp>0){
                        files = files + '<td>' + number_format(st/gp,2) + '%</td>';
                    }else{
                        files = files + '<td>' + number_format(0,2) + '%</td>';
                    }    
                }

                counter++;
                files = files + '</tr><tr>';
            }
            files = files + '</tr>';
            htmlpdf = htmlpdf + files + '</table>';
            htmlexc = htmlexc + files + '</table>';
            $('.htmlpdf').val(htmlpdf);
            $('.htmlexc').val(htmlexc);
            $("#body").append(files);
            $("#loader").hide();
            $("#export").show();
        }else{
            alert(data.msg);            
            $("#loader").hide();
        }
    }); 
}

function getTodayDate(){
    var ftoday = new Date();

    var dd = ftoday.getDate();
    var mm = ftoday.getMonth()+1; 
    var yyyy = ftoday.getFullYear();

    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 

    globalDate = mm+'/'+dd+'/'+yyyy;
}

$(function() {

    getTodayDate();

    $("#btnFindAllRoutes").click(function (ev) {

        $("#header").empty();
        $("#body").empty();
        $("#export").hide();
        $("#loader").show();
        
        var countryId = $("#countryId").val();
        var stateId = $("#stateId").val();
        var cityId = $("#cityId").val();
        var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
        var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));
        var ftoday = new Date(globalDate);
        var shows = $("#shows").multipleSelect("getSelects");
        var weekending = 0;
        if ($(".weekending").is(":checked")){weekending = 1;}

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

        getAllRoutes(finicio,ffin,countryId,stateId,cityId,shows,weekending);
    });

    $("#btnFindConflictsRoutes").click(function (ev) {

        $("#header").empty();
        $("#body").empty();
        $("#export").hide();
        $("#loader").show();
        
        var countryId = $("#countryId").val();
        var stateId = $("#stateId").val();
        var cityId = $("#cityId").val();
        var reasons = $("#reasonId").val();
        var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
        var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));
        var ftoday = new Date(globalDate);

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

        getRoutesConf(finicio,ffin,countryId,stateId,cityId,reasons);
    });

    $("#btnFindMarketHistory").click(function (ev) {

        $("#header").empty();
        $("#body").empty();
        $("#export").hide();
        $("#loader").show();
        
        var countryId = $("#countryId").val();
        var stateId = $("#stateId").val();
        var cityId = $("#cityId").val();
        var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
        var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));
        var ftoday = new Date(globalDate);
        var shows = $("#shows").multipleSelect("getSelects");
        var fields = $("#fields").multipleSelect("getSelects");
        var venues = $("#venues").multipleSelect("getSelects");

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

        getMarketHistory(finicio,ffin,countryId,stateId,cityId,fields,shows,venues)
    });

    $("#btnFindSalesSumary").click(function (ev) {

        $("#header").empty();
        $("#body").empty();
        $("#export").hide();
        $("#loader").show();
        
        var countryId = $("#countryId").val();
        var stateId = $("#stateId").val();
        var cityId = $("#cityId").val();
        var finicio = new Date($(".dateini").val().replace(/-/, '/').replace(/-/, '/'));
        var ffin = new Date($(".dateend").val().replace(/-/, '/').replace(/-/, '/'));
        var ftoday = new Date(globalDate);
        var showId = $("#showId").val();

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
        if((showId == 0)||(showId == "")||(showId == null)){
            showId = "%"
        }

        finicio = $(".dateini").val();
        ffin = $(".dateend").val();

        var shows = "1,2,3,4,5,6";
        var fields = "1,2,3,4,5,6";

        getSalesSummary(finicio,ffin,countryId,stateId,cityId,fields,shows)
    });    

});
