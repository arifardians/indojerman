<?php 

/**
* 
*/
class Home_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();	
	}

	function index(){
		$this->load->model('tutorial');
		$this->load->model('kategori');

		$kategoris = $this->kategori->get_all_data();
		$lastest_tutorial = $this->tutorial->get_lastest_tutorial();
		
		$data['tutorials'] = $lastest_tutorial;
		$data['kategoris'] = $kategoris;
		$this->template_frontend->display('/front_end/pages/index', $data);
	}

	function dashboard(){
		$this->load->model('user'); 
		$this->load->model('exam_user');
		$this->load->model('exam_horen');
		$this->load->model('exam_lesen');

		$email = $this->session->userdata('email'); 
		$user = $this->user->get_user_by_email($email);

		$avg_skill = $this->exam_user->get_avg_score_by_user_id($user->id);
		$avg_lesen = $this->exam_lesen->get_avg_score_by_user_id($user->id);
		$avg_horen = $this->exam_horen->get_avg_score_by_user_id($user->id);

		
		$titles  = array('Home', 'User', 'Dashboard');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}

		$data['title'] 			= "Dashboard"; 
		$data['breadcrumbs']	= $breadcrumbs;
		$data['avg_skill'] 		= $avg_skill->score; 
		$data['avg_horen']		= $avg_horen->score;
		$data['avg_lesen']		= $avg_lesen->score;

		$this->template_frontend->display('/front_end/dashboard/index', $data);
	}

	function review_progress(){
		
		$this->load->model('user'); 
		$this->load->model('exam_horen');
		$this->load->model('exam_lesen');

		$email = $this->session->userdata('email'); 
		$user = $this->user->get_user_by_email($email);

		$horen_items = $this->exam_horen->get_score_records_by_user_id($user->id);
		$lesen_items = $this->exam_lesen->get_score_records_by_user_id($user->id);
		
		$horen_scores = array(); 
		$lesen_scores = array();

		foreach ($horen_items as $item) {
			array_push($horen_scores, $item->score);
		}

		foreach ($lesen_items as $item) {
			array_push($lesen_scores, $item->score);
		}

		

		$titles  = array('Home', 'User', 'Review Progress');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}

		$data['title'] 			= "Review Progress"; 
		$data['breadcrumbs']	= $breadcrumbs;
		$data['horen_scores']	= $horen_scores; 
		$data['lesen_scores']	= $lesen_scores;

		$this->template_frontend->display('/front_end/dashboard/review_progress', $data);
	}


	function kategori_tutorial($id_kategori)
	{
		$this->load->model('kategori');
		$this->load->model('tutorial');
		$kategori 	= $this->kategori->get_data_by_id($id_kategori);
		$tutorials 	= $this->tutorial->get_data_by_kategori($id_kategori);

		$lastest_tutorial = $this->tutorial->get_lastest_tutorial();

		$titles  = array('Home', 'Pages', 'Tutorial');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		$data['title'] 			= $kategori->nama; 
		$data['breadcrumbs']	= $breadcrumbs;
		$data['kategori']		= $kategori;
		$data['tutorials']		= $tutorials;
		$data['lastest_tutorial'] = $lastest_tutorial;

		$this->template_frontend->display('front_end/tutorial/kategori_detail', $data);
	}

	function detail_tutorial($id_tutorial)
	{
		$this->load->model('tutorial');
		$this->load->model('kategori');

		$tutorial = $this->tutorial->get_data_by_id($id_tutorial);
		$kategori = $this->kategori->get_data_by_id($tutorial->id_kategori);
		$lastest_tutorial = $this->tutorial->get_lastest_tutorial();

		$titles  = array('Home', $kategori->nama, $tutorial->judul);
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		$data['title'] 			= $tutorial->judul; 
		$data['breadcrumbs']	= $breadcrumbs;
		$data['tutorial']		= $tutorial;
		$data['lastest_tutorial'] = $lastest_tutorial;

		$this->template_frontend->display('front_end/tutorial/tutorial_detail', $data);
	} 

	function contacts(){
		$titles  = array('Home', 'Pages', 'Contacts');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		$data['title'] 			= 'Hubungi Kami'; 
		$data['breadcrumbs']	= $breadcrumbs;

		$this->template_frontend->display('front_end/pages/contacts', $data);
	}


	function latihan($kode_latihan = 1){
		$this->load->model('tutorial');
		
		$lastest_tutorial = $this->tutorial->get_lastest_tutorial();
		$title 	 = $this->get_latihan_title($kode_latihan);
		$titles  = array('Home', 'Pages', $title);
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}


		$content_text = $this->get_latihan_desc($kode_latihan);

		$link = base_url()."do_structure_exercise";

		$data['title']  	 		= $title; 
		$data['breadcrumbs'] 		= $breadcrumbs;
		$data['lastest_tutorial'] 	= $lastest_tutorial;
		$data['content_text'] 		= $content_text;
		$data['link']				= $link;
		$this->template_frontend->display('front_end/structure_test/index_latihan', $data); 
	}

	private function get_latihan_title($kode_latihan = 1){
		switch ($kode_latihan) {
			case 1:
				return "Latihan Reading";
				break;
			case 2:
				return "Latihan Struktur";
				break;
			case 3:
				return "Latihan Listening";
				break;
			default:
				return "Latihan Struktur";
				break;
		}
	}

	private function get_latihan_desc($kode_latihan = 1){

		$structure_desc = "Latih dan asah kemampuan struktur bahasa jerman-mu. Latihan struktur berisi tentang grammar (tata bahasa), tenses (bentuk waktu), penggunaan kata ganti orang.Untuk menggunakan fitur latihan Anda akan diuji dengan lima buah pertanyaan. Setiap pertanyaan diikuti oleh sejumlah pilihan ganda. Untuk menjawab silahkan memilih satu jawaban yang Anda anggap paling benar diantara pilihan jawaban yang tersedia.";
		$reading_desc = "Latih dan asah kemampuan reading(membaca) bahasa jerman-mu. Latihan reading akan menguji kemampuanmu dalam memahami inti dari teks bacaan dan menentukan topik yang sesuai dengan teks.Untuk menggunakan fitur latihan Anda akan diuji dengan sebuah artikal yang diikuti oleh beberapa pertanyaan. Setiap pertanyaan diikuti oleh sejumlah pilihan ganda. Untuk menjawab silahkan memilih satu jawaban yang Anda anggap paling benar diantara pilihan jawaban yang tersedia.";

		$listening_desc = "Latih dan asah kemampuan listening(mendengar) bahasa jerman-mu. Latihan listening akan menguji kemampuanmu dalam memahami inti dari percakapan dan dialog yang diputar.Untuk menggunakan fitur latihan Anda akan diuji dengan beberapa dialog yang diikuti oleh beberapa pertanyaan. Setiap pertanyaan diikuti oleh sejumlah pilihan ganda. Untuk menjawab silahkan memilih satu jawaban yang Anda anggap paling benar diantara pilihan jawaban yang tersedia.";
		switch ($kode_latihan) {
			case 1:
				return $reading_desc;
				break;
			case 2: 
				return $structure_desc;
				break;
			case 3: 
				return $listening_desc; 
				break;
			default:
				return $structure_desc;
				break;
		}

	}

	function do_latihan_struktur()
	{
	
		
		$this->load->model('soal_structure');
		$this->load->model('opsi_soal_structure');

		$soals 	 = $this->soal_structure->get_latihan();

		$options = array();
		$answers = array();
		foreach ($soals as $soal) {
			$opsi = $this->opsi_soal_structure->get_data_by_soal_id($soal->id);
			$options[$soal->id] = json_decode(json_encode($opsi));
			$answers[$soal->id] = '';
		}

		
		$titles  = array('Home', 'Pages', 'Latihan Struktur');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
		$this->session->unset_userdata('options');
		$this->session->unset_userdata('soals');

		$this->session->set_userdata('soals', $soals);
		$this->session->set_userdata('options', $options);
		$this->session->set_userdata('answers', $answers);

		$data['title']  = 'Latihan Struktur'; 
		$data['breadcrumbs'] = $breadcrumbs;

		/*echo "<pre>"; 
		print_r($soals); 
		print_r($options); 
		print_r($answers);*/

		$this->template_frontend->display('front_end/structure_test/latihan_struktur2', $data); 	
	}

	function latihan_reading(){
		$this->load->model('tutorial');
		
		$lastest_tutorial = $this->tutorial->get_lastest_tutorial();

		$titles  = array('Home', 'Pages', 'Latihan Reading');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}

		$data['title']  = 'Latihan Struktur'; 
		$data['breadcrumbs'] = $breadcrumbs;
		$data['lastest_tutorial'] = $lastest_tutorial;

		$this->template_frontend->display('front_end/structure_test/index_latihan', $data);
	}

	function test_ajax(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];
/*		$this->load->model('soal_structure');
*/
		$soals = $this->session->userdata('soals');
		$soal = $soals[$no_soal];
		/*echo "<pre>";
		print_r($soal);
		print_r($jawaban);*/

		$jumlah_soal = count($soals);
		$answers = $this->session->userdata('answers');
		$answers[$soal->id] = $jawaban;

		$this->session->set_userdata('answers', $answers);
		$no_soal = $no_soal+1; 
		$data['i'] = $no_soal; 
		if($no_soal <= ($jumlah_soal-1))
		{
			$this->load->view('front_end/structure_test/latihan_struktur_ajax', $data);
		}else{
			$this->load->model('opsi_soal_structure');
			$nilai_benar = 0;
			$i=0;
		
			foreach ($answers as $answer) {
				if(isset($answer) && $answer != ''){
					$answer_data = $this->opsi_soal_structure->get_data_by_id($answer);
					if($answer_data->nilai==1){
						$nilai_benar++;
					}
				}
				$i++;
			}
		
			$nilai_akhir = ($nilai_benar/$jumlah_soal) *100;
			$data['nilai_akhir'] = $nilai_akhir;

			$this->load->view('front_end/structure_test/result', $data);
		}
	}

	function prev_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/structure_test/latihan_struktur_ajax', $data);
	}

	function next_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/structure_test/latihan_struktur_ajax', $data);
	}

}