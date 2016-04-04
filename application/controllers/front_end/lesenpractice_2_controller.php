<?php

/**
* 
*/
class Lesenpractice_2_controller extends CI_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct();
		$this->load->model('lesen_2');
		$this->load->model('opsi_lesen_2');
		$this->limit = 3; 
	}

	function teil_2_practice(){
		$titles  = array('Home', 'Pages', 'Latihan Lesen');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		
		// get lesen 
		$lesens = $this->lesen_2->get_random_items($this->limit);

		// options
		$options = array();
		$answers = array();

		foreach ($lesens as $lesen) {
			$options[$lesen->id] = $this->opsi_lesen_2->get_data_by_lesen_id($lesen->id);
			$answers[$lesen->id] = -1;	
		}

		$this->session->unset_userdata('lesen_2_soals');
		$this->session->unset_userdata('lesen_2_options');
		$this->session->unset_userdata('lesen_2_answers');

		$this->session->set_userdata('lesen_2_soals', $lesens);
		$this->session->set_userdata('lesen_2_options', $options);
		$this->session->set_userdata('lesen_2_answers', $answers);
		
		$data['title'] =  'Latihan Membaca ';
		$data['teil']	= 'Bagian 2';
		$data['subtitle'] = 'Memilih poster/pengumuman'; 
		$data['breadcrumbs'] = $breadcrumbs;
		$data['category'] = 'Latihan';
		$data['jumlah_soal'] = count($lesens);

		$this->template_frontend->display('/front_end/practice/lesen/teil_2_practice', $data); 
	}

	function prev_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_2_ajax', $data);
	}

	function next_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_2_ajax', $data);
	}

	function submit_teil_2(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$soals = $this->session->userdata('lesen_2_soals');
		$soal = $soals[$no_soal];

		$answers = $this->session->userdata('lesen_2_answers');
		$answers[$soal->id] = $jawaban;

		$this->session->set_userdata('lesen_2_answers', $answers);
		$no_soal = $no_soal + 1; 
		$data["i"] = $no_soal;

		$jumlah_soal = count($soals);
		if($no_soal < $jumlah_soal){
			$this->load->view('front_end/practice/lesen/teil_2_ajax', $data);
		}else{
			// evaluate test result 
			$nilai_benar = 0; 
			$i = 0;

			// echo "<pre>";

			foreach ($soals as $soal) {
				if($answers[$soal->id] != -1){
					$answer_id   = $answers[$soal->id];
					$answer_data = $this->opsi_lesen_2->get_data_by_id($answer_id);

					// print_r($answer_data);

					if($answer_data->value == 1){
						$nilai_benar++;
					}
				}
				
			}

			$nilai_akhir = ($nilai_benar/$jumlah_soal) * 100;
			$data['nilai_akhir'] = round($nilai_akhir,2);
			$this->load->view('front_end/structure_test/result', $data);
		}

	}
}
