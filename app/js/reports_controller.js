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


function getAllRoutes(inid,endd) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getAllRoutes&inid=' + inid + '&endd=' + endd;
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
    var datei = new Date(inid.substring(6,10),inid.substring(0,2)-1,inid.substring(3,5));
    var datee = new Date(endd.substring(6,10),endd.substring(0,2)-1,endd.substring(3,5));
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
            while(ini < end + 1){  
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

function getRoutesConf(inid,endd) {    
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getRoutesConf&inid=' + inid + '&endd=' + endd;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var columns = '<tr><th>CITY / SHOW</th><th>SHOWS(1)</th><th>SHOWS(2)</th><th>NOTES</th></tr>';
    var files = '';
    call.send(data, url, method, function(data) {
        if(data.tp == 1){            
            $("#header").append(columns);
            size = data.result['body'].length; 
            while(counter1 < size){
                files = files + 
                '<tr><td>' + 
                data.result['body'][counter1].citysta + 
                '</td><td>' + 
                data.result['body'][counter1].showid1 + 
                ' / ' + 
                data.result['body'][counter1].presentation_date1 +
                '</td><td>' + 
                data.result['body'][counter1].showid2 + 
                ' / ' + 
                data.result['body'][counter1].presentation_date2 + 
                '</td><td>' + 
                data.result['body'][counter1].notes + 
                '</td></tr>';
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