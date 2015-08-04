var no_soal = $("#no_soal").val(); 
// console.log("no soal : "+no_soal);
var jumlah_soal = $("#jumlah_soal").text();
jumlah_soal = parseInt(jumlah_soal);

var progress_bar = $("#progress_bar");
var progress_text = $("#progress_text");
var current_progress = (no_soal/jumlah_soal) *100; 
progress_bar.css('width', current_progress+'%');

var current_soal = $("#current_soal");
current_soal.text(parseInt(no_soal)+1);

var nomor_soal = parseInt(no_soal)+1; 
var btn_prev = $("#btn_prev");  
var btn_next = $("#btn_next"); 


if(nomor_soal == 1){
    btn_prev.attr("disabled");
}else if(nomor_soal ==  jumlah_soal){
    btn_next.attr("disabled");
}else{
   btn_prev.removeAttr("disabled");
   btn_next.removeAttr("disabled");
}