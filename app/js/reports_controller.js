
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


function getAllRoutes(inid,endd,country,state,city,fields) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getAllRoutes&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&fields=' + fields;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var counter2 = 0;    
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="tablecss">'
    var htmlexc = '<table>'
    var columns = '';
    var hcolumns = '<tr><th>DATE / SHOW NAME</th>'; 
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
            while(ini < end){  
                dt = ("0" + (new Date(ini).getMonth() + 1)).slice(-2) + '/' + ("0" + new Date(ini).getDate()).slice(-2) + '/' + new Date(ini).getFullYear();
                hfiles = hfiles + '<td>' + dt + '</td>';
                while(counter2 < size){
                    files = '<td>' + data.result['body'][counter2][counter1].citystate + '</td>';
                    hfiles = hfiles + files;                                         
                    counter2++;
                }
                ini = ini + 86400000;
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
    var htmlpdf = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="tablecss">'
    var htmlexc = '<table>'
    var columns = '<tr><th>CITY / STATE</th>' + 
                  '<th>SHOW(1)</th>' +
                  '<th>SHOW(2)</th>' + 
                  '<th>CONFLICTS REASON</th></tr>';
    var files = '';
    console.log(url);
    call.send(data, url, method, function(data) {
        if(data.tp == 1){  
            htmlpdf = htmlpdf + columns; 
            htmlexc = htmlexc + columns;         
            $("#header").append(columns);
            size = data.result['body'].length; 
            while(counter1 < size){
                ind = data.result['body'][counter1].ind;
                if(ind != 0){
                    if(reason == 0 || reason == data.result['body'][counter1].notes){ 
                        files = files + 
                        '<tr><td rowspan="2">' + 
                        data.result['body'][counter1].citysta +                
                        '</td><td>' + 
                        data.result['body'][counter1].show1 +
                        '</td><td>' + 
                        data.result['body'][counter1].show2 +
                        '</td><td rowspan="2"><b>' + 
                        data.result['body'][counter1].color +
                        data.result['body'][counter1].notes +
                        '</font></b></td></tr>' + 
                        '<tr><td>' + 
                        data.result['body'][counter1].date1 +
                        ' / ' +
                        data.result['body'][counter1].venue1 +
                        '</td><td>' + 
                        data.result['body'][counter1].date2 +
                        ' / ' +
                        data.result['body'][counter1].venue2 +
                        '</td></tr>';
                    }    
                }    
                counter1++;
            }
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

function getMarketHistory(inid,endd,country,state,city,fields,shows,venues) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getMarketHistory&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city + '&fields=' + fields + '&shows=' + shows + '&venues=' + venues;
    var method = "GET";
    var data = {};
    var counter1 = 0;
    var counter2 = 0;
    var columns = '';
    var hcolumns = '<tr><th>SHOW NAME</th>' +
                   '<th>OPENINGDATE</th>' + 
                   '<th>CLOSINGDATE</th>' +
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
                    files = '<td>' + eval("data.result['body'][counter1]." + col) + '</td>';
                    hfiles = hfiles + files;                                         
                    counter2++;
                }
                hfiles = hfiles + '</tr><tr>';
                counter1++;
                counter2 = 0;
            }
            hfiles = hfiles + '</tr>';
            $("#body").append(hfiles);
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

        //var fields = "1,2,3,4,5,6,7,8,9,10";
        var fields = "";

        getAllRoutes(finicio,ffin,countryId,stateId,cityId,fields)
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
        
        var fields = "'DROPCOUNT','PAIDATTENDANCE','COMPS','TOTALATTENDANCE','CAPACITY','GROSSSUBSCRIPTIONSALES','GROSSPHONESALES','GROSSINTERNETSALES','GROSSCREDITCARDSALES'";
        //var fields = "";

        var shows = "1,2,3";
        //var shows = "";

        var venues = "6,7,8";
        //var venues = "";

        getMarketHistory(finicio,ffin,countryId,stateId,cityId,fields,shows,venues)
    });

});