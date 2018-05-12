
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


function getAllRoutes(inid,endd,country,state,city) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getAllRoutes&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var counter2 = 0;
    var columns = '';
    var codhtml = '<link rel="stylesheet" type="text/css" href="../css/style.css"><table id="tablecss">'
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
            codhtml = codhtml + hcolumns;
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
            codhtml = codhtml + hfiles + '</table>';
            $('.codhtml').val(codhtml);
            $("#body").append(hfiles);
            $("#loader").hide();
            $("#export").show();
        }else{
            alert(data.msg);            
            $("#loader").hide();
        }
    }); 
}

function getRoutesConf(inid,endd,country,state,city) { 
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getRoutesConf&inid=' + inid + '&endd=' + endd + '&country=' + country + '&state=' + state + '&city=' + city;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var columns = '<tr><th>CITY / STATE</th>' + 
                  '<th>SHOW(1)</th>' +
                  '<th>SHOW(2)</th>' + 
                  //'<th>SHOW(3)</th>' + 
                  '<th>CONFLICTS REASON</th></tr>';
    var files = '';
    call.send(data, url, method, function(data) {
        if(data.tp == 1){            
            $("#header").append(columns);
            size = data.result['body'].length; 
            while(counter1 < size){
                ind = data.result['body'][counter1].ind;
                /*if(data.result['body'][counter1].show3 != ''){
                    slash = ' / ';
                }else{
                    slash = '';
                }*/
                if(ind != 0){
                    files = files + 
                    '<tr><td rowspan="2">' + 
                    data.result['body'][counter1].citysta +                
                    '</td><td>' + 
                    data.result['body'][counter1].show1 +
                    '</td><td>' + 
                    data.result['body'][counter1].show2 +
                    //'</td><td>' + 
                    //data.result['body'][counter1].show3 +
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
                    //'</td><td>' + 
                    //data.result['body'][counter1].date3 +
                    //slash +
                    //data.result['body'][counter1].venue3 +
                    '</td></tr>';
                }    
                counter1++;
            }
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

        if (isNaN(finicio.getTime()) || isNaN(ffin.getTime())) {
            alert("Please, verify the dates inputs");
            return;
        }else{
            if(finicio.getTime() < ftoday.getTime() || ffin.getTime() < ftoday.getTime()){
                alert("the final date can not be less than today's date");
                return;
            }
            if(ffin.getTime() < finicio.getTime()){
                alert("The final date can not be greater than the initial date, Verify");
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

        getAllRoutes(finicio,ffin,countryId,stateId,cityId)
    });

});