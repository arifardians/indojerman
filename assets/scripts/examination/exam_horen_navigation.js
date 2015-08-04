function prev_item(){
    event.preventDefault();
    var index_soal = $("#no_soal").val();
    var base_url = $("#base_url").val();
    var url = base_url+"index.php/front_end/user_exam_controller/prev_soal_horen";
    var nomor_soal = parseInt(index_soal); 
    if(nomor_soal > 0){
        var posting = $.post(url, {no_soal: nomor_soal});
        posting.done(function(data){
            $("#result").empty().append(data);
        });
    }
}

function next_item(){
    event.preventDefault();
    var index_soal = $("#no_soal").val(); 
    var jumlah_soal = $("#jumlah_soal").text();
    var base_url = $("#base_url").val();
    jumlah_soal = parseInt(jumlah_soal);
    var url = base_url + "index.php/front_end/user_exam_controller/next_soal_horen";
    var nomor_soal = parseInt(index_soal);
    var result = $("#result"); 
    if(nomor_soal < (jumlah_soal -1)){
        var posting = $.post(url, {no_soal: nomor_soal});
        posting.done(function(data){
            result.empty().append(data);
        });
    }
}

function action_jawab(){
    $("#soalForm").submit();
}

$('#soalForm').submit(function(event){
    event.preventDefault();
    var jawaban = $("input[name=jawaban]:checked").val();
    if(typeof(jawaban) == 'undefined'){
        jawaban = -1; 
    }
    // alert(jawaban);
   
    var form = $(this); 
    var i = $("#no_soal").val();
    var base_url = $("#base_url").val();
    var url = base_url + "index.php/front_end/user_exam_controller/submit_horen";
    var posting =  $.post(url, {no_soal: i, jawaban: jawaban});
    var result = $("#soalForm #result"); 
    posting.success(function(data){
        // console.log(data);
        result.empty();
        result.append(data);
    });
}); 