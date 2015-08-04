<?php

/**
* 
*/
class Lesenpractice_3_controller extends CI_Controller
{
	private $limit;
	function __construct()
	{
		parent::__construct();
		$this->load->model('lesen_3');
		$this->limit = 3;
	}

	function teil_3_practice(){
		$titles  = array('Home', 'Pages', 'Latihan Lesen');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		$lesens = $this->lesen_3->get_random_items($this->limit);
		
		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		

		$answers = array();

		foreach ($lesens as $lesen) {
			$answers[$lesen->id] = -1;
		}

		$this->session->unset_userdata('lesen_3_soals');
		$this->session->unset_userdata('lesen_3_answers');

		$this->session->set_userdata('lesen_3_soals', $lesens);
		$this->session->set_userdata('lesen_3_answers', $answers);

		$data['title'] =  'Latihan Membaca ';
		$data['teil']	= 'Bagian 3';
		$data['subtitle'] = 'Memahami isi pengumuman/poster'; 
		$data['breadcrumbs'] = $breadcrumbs;
		$data['category'] = 'Latihan';
		$data['jumlah_soal'] = count($lesens);

		$this->template_frontend->display('/front_end/practice/lesen/teil_3_practice', $data);
	}

	function prev_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_3_ajax', $data);
	}

	function next_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_3_ajax', $data);
	}

	function submit_teil_3(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$soals = $this->session->userdata('lesen_3_soals');
		$soal = $soals[$no_soal];

		$answers = $this->session->userdata('lesen_3_answers');
		$answers[$soal->id] = $jawaban;

		$this->session->set_userdata('lesen_3_answers', $answers);
		$no_soal = $no_soal + 1; 
		$data["i"] = $no_soal;

		$jumlah_soal = count($soals);
		if($no_soal < $jumlah_soal){
			$this->load->view('front_end/practice/lesen/teil_3_ajax', $data);
		}else{
			// evaluate test result 
			$nilai_benar = 0; 
			$i = 0;
			foreach ($soals as $soal) {
				if($answers[$soal->id] == $soal->value){
					$nilai_benar++;
				}
			}

			$nilai_akhir = ($nilai_benar/$jumlah_soal) * 100;
			$data['nilai_akhir'] = $nilai_akhir;
			$this->load->view('front_end/structure_test/result', $data);
		}

	}
}