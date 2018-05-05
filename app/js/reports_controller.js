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


function getAllRoutes(fini,ffin) {
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getAllRoutes&fini=' + fini + '&ffin=' + ffin;
    var method = "GET";
    var data = {};   
    var counter1 = 0;
    var counter2 = 0;
    var columns = '';
    var hcolumns = '<tr><th>DATE / SHOW NAME</th>'; 
    var files = '';
    var hfiles = '<tr>';
    var showid = '';
    var fechai = new Date(fini.substring(6,10),fini.substring(0,2)-1,fini.substring(3,5));
    var fechaf = new Date(ffin.substring(6,10),ffin.substring(0,2)-1,ffin.substring(3,5));
    var inic = fechai.valueOf();
    var fin = fechaf.valueOf();
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
        	size = data.result['shows'].length;
            /*HEADER*/
            $("#header").html('');
            while(counter1 < size){
                columns = '<th>' + data.result['shows'][counter1].name + '</th>';
                hcolumns = hcolumns + columns;
            	counter1++;
            }
            hcolumns = hcolumns + '</tr>';
            $("#header").append(hcolumns);
            /*DETAILS*/
            counter1 = 0;
            while(inic < fin + 1){  
                dt = ("0" + (new Date(inic).getMonth() + 1)).slice(-2) + '/' + ("0" + new Date(inic).getDate()).slice(-2) + '/' + new Date(inic).getFullYear();
                hfiles = hfiles + '<td>' + dt + '</td>';
                while(counter2 < size){
                    files = '<td>' + data.result['body'][counter2][counter1].citystate + '</td>';
                    hfiles = hfiles + files;                                         
                    counter2++;
                }            
                inic = inic + 86400000;
                hfiles = hfiles + '</tr><tr>';
                counter1++;
                counter2 = 0;
            }
            hfiles = hfiles + '</tr>';
            $("#body").append(hfiles);
        }else{
            alert(data.msg);
        }
    }); 
}


