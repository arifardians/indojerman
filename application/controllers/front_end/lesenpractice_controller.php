<?php

/**
* 
*/
class Lesenpractice_controller extends CI_Controller
{
	private $limit;
	private $breadcrumbs;
	function __construct()
	{
		parent::__construct();
		$this->load->model('lesen_1');
		$this->load->model('statement_lesen_1');
		$this->limit = 1;

		$titles  = array('Home', 'Pages', 'Latihan Membaca');
		$links 	 = array(base_url().'', '', '');
		$this->breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($this->breadcrumbs, $breadcrumb);			
		}
		
	}

	function intro(){
		
		$content 	= "";
		$path_file 	= APPPATH.'views/front_end/practice/introduction/intro_lesen_1'.EXT;
		
		if (file_exists($path_file)){
			$content = read_file($path_file); 
		}else{
			// Whoops, we don't have a page for that!
			$content = "<p> Page Not Found!!!!</p>";
		}

		$data['title'] 		 = "Latihan Membaca";
		$data['subtitle'] 	 = "Bagian 1"; 
		$data['breadcrumbs'] = $this->breadcrumbs; 
		
		$data['link'] 	 = "lesen_practice/teil_1";
		$data['image']	 = "";
		$data['content'] = $content;

		$this->template_frontend->display('/front_end/practice/index', $data);
	}

	function teil_1_practice(){
		
		// get lesen 
		$lesens = $this->lesen_1->get_random_items($this->limit);

		$soals = array();
		$image_soals = array();
		$answers = array();

		foreach ($lesens as $lesen) {
			$statements = $this->statement_lesen_1->get_data_by_lesen_id($lesen->id);
			foreach ($statements as $statement) {
				array_push($soals, $statement);
				array_push($image_soals, $lesen->image);
				$answers[$statement->id] = -1; // -1 means not selected, 1 true, 0 false
			}
		}

		// remove session 
		$this->session->unset_userdata('lesen_1_soals'); 
		$this->session->unset_userdata('lesen_1_images');
		$this->session->unset_userdata('lesen_1_answers');

		$this->session->set_userdata('lesen_1_soals', $soals);
		$this->session->set_userdata('lesen_1_images', $image_soals);
		$this->session->set_userdata('lesen_1_answers', $answers);
		
		$data['title'] =  'Latihan Membaca ';
		$data['teil']	= 'Bagian 1';
		$data['subtitle'] = 'Membaca dan memahasi isi surat'; 
		$data['breadcrumbs'] = $this->breadcrumbs;
		$data['category'] = 'Latihan';
		$data['jumlah_soal'] = count($soals);


		$this->template_frontend->display('/front_end/practice/lesen/teil_1_practice', $data);
	}

	function prev_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_1_ajax', $data);
	}

	function next_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/lesen/teil_1_ajax', $data);
	}

	function submit_teil_1(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$soals = $this->session->userdata('lesen_1_soals');
		$soal = $soals[$no_soal];

		$answers = $this->session->userdata('lesen_1_answers');
		$answers[$soal->id] = $jawaban;

		$this->session->set_userdata('lesen_1_answers', $answers);
		$no_soal = $no_soal + 1; 
		$data["i"] = $no_soal;

		$jumlah_soal = count($soals);
		if($no_soal < $jumlah_soal){
			$this->load->view('front_end/practice/lesen/teil_1_ajax', $data);
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

	function test_teil_1(){
		$titles  = array('Home', 'Pages', 'Latihan Lesen');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		$data['title'] = "Lesen 1 Practice"; 
		$data['breadcrumbs'] = $breadcrumbs;

		$data['soal'] = "Karin wartet den ganzen Vormittag vor der Auskunft."; 
		$data['image'] = base_url()."upload/images/lesen_2.JPG";


		$this->template_frontend->display('/front_end/practice/lesen/test', $data);
	}


}
