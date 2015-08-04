<?php

/**
* 
*/
class User_exam_controller extends CI_Controller
{
	
	private $title; 
	private $breadcrumbs;
	private $limit;
	function __construct()
	{
		parent::__construct();
		$titles  = array('Home', 'Pages', 'Online Test');
		$links 	 = array(base_url().'', '', '');
		$this->breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($this->breadcrumbs, $breadcrumb);			
		}
		
		$this->title = 'Ujian Online';
		$this->limit = 2; 

		$this->load->model('horen_1');
		$this->load->model('horen_2');
		$this->load->model('horen_3');
		$this->load->model('opsi_horen_1');
		$this->load->model('opsi_horen_3');

		$this->load->model('lesen_1');
		$this->load->model('statement_lesen_1');
		$this->load->model('lesen_2');
		$this->load->model('opsi_lesen_2');
		$this->load->model('lesen_3');

		$this->load->model('user');
		$this->load->model('exam_user');
		$this->load->model('exam_horen');
		$this->load->model('exam_lesen');
		
		$this->load->model('exam_horen_1');
		$this->load->model('exam_horen_2');
		$this->load->model('exam_horen_3');	

		$this->load->model('detail_exam_horen_1');
		$this->load->model('detail_exam_horen_2');
		$this->load->model('detail_exam_horen_3');

		$this->load->model('exam_lesen_1');
		$this->load->model('exam_lesen_2');
		$this->load->model('exam_lesen_3');
		
		$this->load->model('detail_exam_lesen_1');
		$this->load->model('detail_exam_lesen_2');
		$this->load->model('detail_exam_lesen_3');

	}

	function show_recap(){
		$user_exam_id  = $this->session->userdata('user_exam_id');
		$horen_exam_id = $this->session->userdata('horen_exam_id');
		$lesen_exam_id = $this->session->userdata('lesen_exam_id');

		$user_exam  = $this->exam_user->get_data_by_id($user_exam_id);
		$horen_exam = $this->exam_horen->get_data_by_id($horen_exam_id);
		$lesen_exam = $this->exam_lesen->get_data_by_id($lesen_exam_id);

		$horens = $this->session->userdata('horen_exams');
		$lesens = $this->session->userdata('lesen_exams');

		$data['title'] 			= 'Recap Hasil Ujian'; 
		$data['breadcrumbs']	= $this->breadcrumbs;
		$data['teil']			= 'Mendengar dan Membaca';
		$data['category'] 		= 'Ujian';
		$data['jumlah_soal']	= count($horens) + count($lesens);
		$data['nilai_ujian']	= $user_exam->score;
		$data['nilai_mendengar']= $horen_exam->score;
		$data['nilai_membaca']	= $lesen_exam->score;

		$data['button_label']	= "Lihat Progress Pencapaian"; 
		$data['button_link']	= base_url().'review_progress';

		$this->template_frontend->display('/front_end/exam/result/exam_final_recap', $data);
	}

	function index(){
		
		$data['title'] 			= $this->title; 
		$data['breadcrumbs']	= $this->breadcrumbs;
		$this->template_frontend->display('/front_end/exam/index', $data);
	}

	function intro_horen(){
		$content 	= "";
		$path_file 	= APPPATH.'views/front_end/pages/horen_intro'.EXT;
		if (file_exists($path_file)){
			$content = read_file($path_file); 
		}else{
			// Whoops, we don't have a page for that!
			$content = "<p> Page Not Found!!!!</p>";
		}
		

		$data['title'] 			= $this->title; 
		$data['breadcrumbs']	= $this->breadcrumbs;
		$data['content'] 		= $content;
		$this->template_frontend->display('/front_end/exam/intro_horen', $data);
	}

	function initiate_exam(){
		
		$email = $this->session->userdata('email'); 
		$user = $this->user->get_user_by_email($email);
		
		// exam user
		$data = array('user_id' => $user->id, 'score' => 0);
		$exam_user_id = $this->exam_user->insert($data);


		$horens = $this->get_random_horens();
		$lesens = $this->get_random_lesens();
		
		$json_horens =  json_encode($horens);		
		$json_lesens =  json_encode($lesens);
		
		$horen_answers = array();
		for ($i=0; $i < count($horens) ; $i++) { 
			$horen_answers[$i] = -1;
		}

		$lesen_answers = array();
		for ($i=0; $i < count($lesens) ; $i++) { 
			$lesen_answers[$i] = -1;
		}

		$data_exam_horen = array('exam_user_id' => $exam_user_id, 'score' => 0, 'horen_items' => $json_horens); 
		$data_exam_lesen = array('exam_user_id' => $exam_user_id, 'score' => 0, 'lesen_items' => $json_lesens); 
		$exam_horen_id  = $this->exam_horen->insert($data_exam_horen);
		$exam_lesen_id  = $this->exam_lesen->insert($data_exam_lesen);

		$this->session->unset_userdata('user_exam_id');
		$this->session->set_userdata('user_exam_id', $exam_user_id);

		$this->session->unset_userdata('horen_exam_id');
		$this->session->unset_userdata('horen_exams');
		$this->session->unset_userdata('horen_answers');

		$this->session->set_userdata('horen_exam_id', $exam_horen_id);
		$this->session->set_userdata('horen_exams', $horens);
		$this->session->set_userdata('horen_answers', $horen_answers);

		$this->session->unset_userdata('lesen_exam_id');
		$this->session->unset_userdata('lesen_exams');
		$this->session->unset_userdata('lesen_answers');

		$this->session->set_userdata('lesen_exam_id', $exam_lesen_id);
		$this->session->set_userdata('lesen_exams', $lesens);
		$this->session->set_userdata('lesen_answers', $lesen_answers);

		redirect(base_url().'user_exam/horen');
	}


	function get_random_horens(){
		$horen_1s =  $this->horen_1->get_random_items($this->limit);
		$horen_2s =  $this->horen_2->get_random_items($this->limit);
		$horen_3s =  $this->horen_3->get_random_items($this->limit);

		$horens = array();

		foreach ($horen_1s as $item) {
			$horen = new stdClass();
			$horen->sound = $item->sound; 
			$horen->item_id = $item->id; 
			$horen->question= $item->question; 
			$horen->answer = -1; 
			$horen->category = TEIL_1;
			array_push($horens, $horen);
		}
		
		foreach ($horen_2s as $item) {
			$horen = new stdClass();
			$horen->sound = $item->sound; 
			$horen->item_id = $item->id; 
			$horen->question= $item->statement; 
			$horen->answer = -1; 
			$horen->category = TEIL_2;
			array_push($horens, $horen);
		}
		
		foreach ($horen_3s as $item) {
			$horen = new stdClass();
			$horen->sound = $item->sound; 
			$horen->item_id = $item->id; 
			$horen->question= $item->question; 
			$horen->answer = -1; 
			$horen->category = TEIL_3;
			array_push($horens, $horen);
		}				
		return $horens;
	}
	
	function do_exam_horen(){
		
		$horens = $this->session->userdata('horen_exams');		
		$horen = $horens[0];
		$options = $this->get_options_horen($horen); 
		$view = $this->get_view_first_page_horen($horen);

		$data['horen'] 		= $horen;
		$data['options'] 	= $options;
		$data['title'] 		= $this->title ." Mendengar";
		$data['breadcrumbs']= $this->breadcrumbs;
		$data['answer'] 	= -1;
		$data['teil']		= 'Bagian 1, 2 & 3';
		$data['category'] 	= 'Ujian';
		$data['jumlah_soal']= count($horens);
		$this->template_frontend->display($view, $data);
	}

	function get_options_horen($horen){
		$options = array(); 
		
		switch ($horen->category) {
			case TEIL_1:
				$option_default = $this->opsi_horen_1->get_data_by_horen_id($horen->item_id);
				foreach ($option_default as $item) {
					$option = new stdClass();
					$option->value = $item->id; 
					$option->text = $item->text; 
					$option->image = $item->image;
					array_push($options, $option);
				}
				break;
			case TEIL_3: 
				$option_default = $this->opsi_horen_3->get_data_by_horen_id($horen->item_id);
				foreach ($option_default as $item) {
					$option = new stdClass();
					$option->value = $item->id; 
					$option->text = $item->text; 
					array_push($options, $option);
				}
				break;
			default:
				$richtig = array('value' => 1, 'text'=> 'Richtig');
				$falsch = array('value' => 0, 'text'=> 'Falsch');
				$option_default = array($falsch, $richtig);
				
				foreach ($option_default as $item) {
					$option = new stdClass();
					$option->value  = $item['value']; 
					$option->text 	= $item['text'];
					array_push($options, $option);
				}
				
				break;
		}
		return $options;
	}

	function get_view_first_page_horen($horen){
		$view = ''; 

		switch ($horen->category) {
			case TEIL_1:
				$view = '/front_end/exam/horen/teil_1_exam';
				break;
			case TEIL_2: 
				$view = '/front_end/exam/horen/teil_2_exam';
				break; 
			case TEIL_3:
				$view = '/front_end/exam/horen/teil_3_exam';
				break;
			default:
				$view = '/error/error_404';
				break;
		}
		return $view;
	}

	function get_view_ajax_page_horen($horen){
		$view = ''; 

		switch ($horen->category) {
			case TEIL_1:
				$view = '/front_end/exam/horen/teil_1_ajax';
				break;
			case TEIL_2: 
				$view = '/front_end/exam/horen/teil_2_ajax';
				break; 
			case TEIL_3:
				$view = '/front_end/exam/horen/teil_3_ajax';
				break;
			default:
				$view = '/error/error_404';
				break;
		}
		return $view;
	}

	function prev_soal_horen(){
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$horens  = $this->session->userdata('horen_exams');
		$horen 	 = $horens[$no_soal]; 
		
		$answers  = $this->session->userdata('horen_answers');
		$answer   = $answers[$no_soal];

		$options  = $this->get_options_horen($horen);
		$view  	 = $this->get_view_ajax_page_horen($horen);

		$data['i'] 		 = $no_soal;
		$data['options'] = $options;
		$data['horen']	 = $horen;
		$data['answer']  = $answer;

		/*echo "<pre>";
		print_r($data);
		*/
		$this->load->view($view, $data);
	}

	function next_soal_horen()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$horens  = $this->session->userdata('horen_exams');
		$horen 	 = $horens[$no_soal]; 
		
		$answers  = $this->session->userdata('horen_answers');
		$answer   = $answers[$no_soal];

		$options  = $this->get_options_horen($horen);
		$view  	 = $this->get_view_ajax_page_horen($horen);

		$data['i'] 		 = $no_soal;
		$data['options'] = $options;
		$data['horen']	 = $horen;
		$data['answer']  = $answer;

		$this->load->view($view, $data);
	}

	function submit_horen(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$horens  = $this->session->userdata('horen_exams');
		$answers = $this->session->userdata('horen_answers');
		$answers[$no_soal] = $jawaban;

		$this->session->set_userdata('horen_answers', $answers);
		

		$no_soal = $no_soal + 1; 

		$jumlah_soal = count($horens);
		if($no_soal < $jumlah_soal){
			$horen 	 = $horens[$no_soal];
		 	$options = $this->get_options_horen($horen);
			$view 	 = $this->get_view_ajax_page_horen($horen);
			
			$data["i"] 		= $no_soal;
			$data['options']= $options;
			$data['horen']	= $horen;
			$data['answer'] = $answers[$no_soal];

			$this->load->view($view, $data);
		}else{
			// evaluate test result 
			$nilai_benar = 0; 
			$i = 0;

			// echo "<pre>";
			foreach ($horens as $horen) {
				if($answers[$i] != -1){
					switch ($horen->category) {
						case TEIL_1:
							$answer_data = $this->opsi_horen_1->get_data_by_id($answers[$i]);
							if($answer_data->value == 1){
								$nilai_benar++;
							}
							break;
						case TEIL_3: 
							$answer_data = $this->opsi_horen_3->get_data_by_id($answers[$i]);
							if($answer_data->value == 1){
								$nilai_benar++;
							}
							break;
						default:
							// teil 2
							$answer_data = $this->horen_2->get_data_by_id($horen->item_id); 
							if($answers[$i] == $answer_data->value){
								$nilai_benar++;
							}
							break;
					}
				}
				$i++;
			}
			$nilai_akhir = ($nilai_benar/$jumlah_soal) * 100;
			$nilai_akhir = round($nilai_akhir, 2);

			// echo "<pre>"; 
			// print_r($nilai_benar); 
			// print_r($nilai_akhir);

			$horen_exam_id = $this->session->userdata('horen_exam_id');
			$lesen_exam_id = $this->session->userdata('lesen_exam_id');
			$user_exam_id  = $this->session->userdata('user_exam_id');

			$data_horen_exam = array('score' => $nilai_akhir);
			$this->exam_horen->update($horen_exam_id, $data_horen_exam);

			$lesen_exam = $this->exam_lesen->get_data_by_id($lesen_exam_id);
			$nilai_lesen = $lesen_exam->score; 

			$nilai_exam_user = round(($nilai_lesen+$nilai_akhir)/2, 2);

			$this->exam_user->update($user_exam_id, array('score' => $nilai_exam_user));

			//redirect(base_url().'user_exam/lesen');
			$data['nilai_akhir']  = round($nilai_akhir, 2);
			$data['i'] 			  = $no_soal;
			$data['title']		  = 'Hasil Ujian Mendengar';
			$data['jenis_ujian']  = 'Ujian Mendengar'; 
			$data['button_label'] = "Lanjut Ujian Lesen";
			$data['button_link']  = base_url().'user_exam/lesen';	
			$this->load->view('front_end/exam/result/exam_result', $data);
		}
	}

	function intro_lesen(){
		$content 	= "";
		$path_file 	= APPPATH.'views/front_end/pages/lesen_intro'.EXT;
		if (file_exists($path_file)){
			$content = read_file($path_file); 
		}else{
			// Whoops, we don't have a page for that!
			$content = "<p> Page Not Found!!!!</p>";
		}
		

		$data['title'] 			= $this->title; 
		$data['breadcrumbs']	= $this->breadcrumbs;
		$data['content'] 		= $content;
		$this->template_frontend->display('/front_end/exam/intro_lesen', $data);
	}


	function get_random_lesens(){
		$lesen_1_limit = 1;

		$lesen_1s =  $this->lesen_1->get_random_items($lesen_1_limit);
		$lesen_2s =  $this->lesen_2->get_random_items($this->limit);
		$lesen_3s =  $this->lesen_3->get_random_items($this->limit);

		$lesens = array();

		foreach ($lesen_3s as $item) {
			$lesen = new stdClass();
			$lesen->item_id  = $item->id; 
			$lesen->question = $item->statement; 
			$lesen->category = TEIL_3;
			$lesen->image 	 = $item->image;
			$lesen->answer 	 = -1; 
			array_push($lesens, $lesen);
		}

		foreach ($lesen_2s as $item) {
			$lesen = new stdClass();
			$lesen->item_id  = $item->id; 
			$lesen->question = $item->question; 
			$lesen->category = TEIL_2;
			$lesen->answer   = -1; 
			array_push($lesens, $lesen);
		}

		
		foreach ($lesen_1s as $item) {
			$statements = $this->statement_lesen_1->get_data_by_lesen_id($item->id);
			foreach ($statements as $statement) {
				$lesen = new stdClass(); 
				$lesen->item_id  = $statement->id; 
				$lesen->question = $statement->statement; 
				$lesen->category = TEIL_1; 
				$lesen->image 	 = $item->image; 
				$lesen->answer   = -1;
				array_push($lesens, $lesen);
			}
		}

		return $lesens;
	}

	function do_exam_lesen(){
		
		$lesens = $this->session->userdata('lesen_exams');
		
		$lesen  = $lesens[0];
		$options = $this->get_options_lesen($lesen); 
		$view = $this->get_view_first_page_lesen($lesen);

		$data['lesen'] 		= $lesen;
		$data['options'] 	= $options;
		$data['title'] 		= $this->title ." Membaca";
		$data['breadcrumbs']= $this->breadcrumbs;
		$data['answer'] 	= -1;
		$data['teil']		= 'Bagian 1, 2 & 3';
		$data['category'] 	= 'Ujian';
		$data['jumlah_soal']= count($lesens);
		$this->template_frontend->display($view, $data);
	}

	function get_options_lesen($lesen){
		$options = array(); 
		
		switch ($lesen->category) {
			case TEIL_2:
				$option_default = $this->opsi_lesen_2->get_data_by_lesen_id($lesen->item_id);
				foreach ($option_default as $item) {
					$option = new stdClass();
					$option->value = $item->id; 
					$option->text = $item->statement; 
					$option->image = $item->image;
					array_push($options, $option);
				}
				break;
			
			default:
				$richtig = array('value' => 1, 'text'=> 'Richtig');
				$falsch = array('value' => 0, 'text'=> 'Falsch');
				$option_default = array($falsch, $richtig);
				
				foreach ($option_default as $item) {
					$option = new stdClass();
					$option->value  = $item['value']; 
					$option->text 	= $item['text'];
					array_push($options, $option);
				}
				break;
		}
		return $options;
	}

	function get_view_first_page_lesen($lesen){
		$view = ''; 

		switch ($lesen->category) {
			case TEIL_1:
				$view = '/front_end/exam/lesen/teil_1_exam';
				break;
			case TEIL_2: 
				$view = '/front_end/exam/lesen/teil_2_exam';
				break; 
			case TEIL_3:
				$view = '/front_end/exam/lesen/teil_3_exam';
				break;
			default:
				$view = '/error/error_404';
				break;
		}
		return $view;
	}

	function get_view_ajax_page_lesen($lesen){
		$view = ''; 

		switch ($lesen->category) {
			case TEIL_1:
				$view = '/front_end/exam/lesen/teil_1_ajax';
				break;
			case TEIL_2: 
				$view = '/front_end/exam/lesen/teil_2_ajax';
				break; 
			case TEIL_3:
				$view = '/front_end/exam/lesen/teil_3_ajax';
				break;
			default:
				$view = '/error/error_404';
				break;
		}
		return $view;
	}


	function prev_soal_lesen(){
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$lesens  = $this->session->userdata('lesen_exams');
		$lesen 	 = $lesens[$no_soal]; 
		
		$answers  = $this->session->userdata('lesen_answers');
		$answer   = $answers[$no_soal];

		$options  = $this->get_options_lesen($lesen);
		$view  	 = $this->get_view_ajax_page_lesen($lesen);

		$data['i'] 		 = $no_soal;
		$data['options'] = $options;
		$data['lesen']	 = $lesen;
		$data['answer']  = $answer;

		$this->load->view($view, $data);
	}

	function next_soal_lesen()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$lesens  = $this->session->userdata('lesen_exams');
		$lesen 	 = $lesens[$no_soal]; 
		
		$answers  = $this->session->userdata('lesen_answers');
		$answer   = $answers[$no_soal];

		$options  = $this->get_options_lesen($lesen);
		$view  	 = $this->get_view_ajax_page_lesen($lesen);

		$data['i'] 		 = $no_soal;
		$data['options'] = $options;
		$data['lesen']	 = $lesen;
		$data['answer']  = $answer;

		$this->load->view($view, $data);
	}

	function submit_lesen(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$lesens  = $this->session->userdata('lesen_exams');
		$answers = $this->session->userdata('lesen_answers');
		$answers[$no_soal] = $jawaban;

		$this->session->set_userdata('lesen_answers', $answers);
		
		$no_soal = $no_soal + 1; 

		$jumlah_soal = count($lesens);
		if($no_soal < $jumlah_soal){
			$lesen 	 = $lesens[$no_soal];
		 	$options = $this->get_options_lesen($lesen);
			$view 	 = $this->get_view_ajax_page_lesen($lesen);
			
			$data["i"] 		= $no_soal;
			$data['options']= $options;
			$data['lesen']	= $lesen;
			$data['answer'] = $answers[$no_soal];

			$this->load->view($view, $data);
		}else{
			// evaluate test result 
			$nilai_benar = 0; 
			$i = 0;

			// echo "<pre>";
			foreach ($lesens as $lesen) {
				if($answers[$i] != -1){
					switch ($lesen->category) {
						case TEIL_1:
							$answer_data = $this->statement_lesen_1->get_data_by_id($lesen->item_id);
							if($answer_data->value == $answers[$i]){
								$nilai_benar++;
							}
							break;
						case TEIL_2: 
							$answer_data = $this->opsi_lesen_2->get_data_by_id($answers[$i]);
							if($answer_data->value == 1){
								$nilai_benar++;
							}
							break;
						default:
							// teil 3
							$answer_data = $this->lesen_3->get_data_by_id($lesen->item_id); 
							if($answers[$i] == $answer_data->value){
								$nilai_benar++;
							}
							break;
					}
				}
				$i++;
			}
			$nilai_akhir = ($nilai_benar/$jumlah_soal) * 100;

			$lesen_exam_id   = $this->session->userdata('lesen_exam_id');
			$horen_exam_id	 = $this->session->userdata('horen_exam_id');
			$user_exam_id    = $this->session->userdata('user_exam_id');

			$data_lesen_exam = array('score' => $nilai_akhir);
			$this->exam_lesen->update($lesen_exam_id, $data_lesen_exam);

			$horen_exam = $this->exam_horen->get_data_by_id($horen_exam_id);
			$nilai_horen = $horen_exam->score; 

			$nilai_exam_user = round(($nilai_horen+$nilai_akhir)/2, 2);

			$this->exam_user->update($user_exam_id, array('score' => $nilai_exam_user));

			$data['nilai_akhir'] = $nilai_exam_user;
			$data['i'] 		= $no_soal;
			$data['title']		  = 'Hasil Ujian Membaca';
			$data['jenis_ujian']  = 'Ujian Membaca'; 
			$data['button_label'] = "Lihat Rekap Ujian";
			$data['button_link']  = base_url().'user_exam/recap';	
			$this->load->view('front_end/exam/result/exam_result', $data);
		}
	}

}
