var total_seconds = 60 *10; 
var c_minutes  = parseInt(total_seconds / 60);
var c_seconds  = parseInt(total_seconds % 60);

var minutes_text = document.getElementById('minutes');
var seconds_text = document.getElementById('seconds');

function checkTime(){
    minutes.innerHTML = ''+c_minutes; 
    seconds.innerHTML = ''+c_seconds;
    if(total_seconds <= 0){
        alert("Waktu Habis!!!");
    }else{
        total_seconds = total_seconds -1; 
        c_minutes = parseInt(total_seconds / 60); 
        c_seconds = parseInt(total_seconds % 60); 
        if($("#btn_jawab").is(":visible")){
            setTimeout("checkTime()", 1000);
        }
    }
}
setTimeout("checkTime()", 1000);