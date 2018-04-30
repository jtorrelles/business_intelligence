
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

function getShows() {
	console.log("llego");
    var call = new ajaxCall();
    var url = '../routes/reports_route.php?type=getShows';
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
        	var counter = 0;
        	var size = data.result['shows'].length;
        	//console.log(data.result['shows'][0].id);
            while(counter < size){
            	var tid = data.result['shows'][counter].id;
            	console.log(tid);
            	counter++;
            }
        }
        else{
            alert(data.msg);
        }
    }); 
}

$(function() {

});