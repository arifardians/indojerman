<?php


/**
* 
*/
class Horenpractice_3_controller extends CI_Controller
{
	private $limit_items;
	function __construct()
	{
		parent::__construct();
		$this->load->model('horen_3');
		$this->load->model('opsi_horen_3');
		$this->limit_items = 3;
	}

	function teil_3_practice(){
		$titles  = array('Home', 'Pages', 'Latihan hören');
		$links 	 = array(base_url().'', '', '');
		$breadcrumbs = array();

		for ($i=0; $i < count($titles) ; $i++) { 
			$breadcrumb = array('title' => $titles[$i], 'link' => $links[$i]);
			array_push($breadcrumbs, $breadcrumb);			
		}
			

		// get items horen
		$items = $this->horen_3->get_random_items($this->limit_items);
		$options = array(); 
		$answers = array();
		foreach ($items as $item) {
			$options[$item->id] = $this->opsi_horen_3->get_data_by_horen_id($item->id); // get options by horen id
			$answers[$item->id] = -1;
		}

		$this->session->unset_userdata('horen_3_soals');
		$this->session->unset_userdata('horen_3_options');
		$this->session->unset_userdata('horen_3_answers');

		$this->session->set_userdata('horen_3_soals', $items);
		$this->session->set_userdata('horen_3_options', $options);
		$this->session->set_userdata('horen_3_answers', $answers);

		$data['title'] =  'Latihan Mendengarkan ';
		$data['teil']	= 'Bagian 3';
		$data['subtitle'] = 'Memahami isi pengumuman/panggilan telepon'; 
		$data['breadcrumbs'] = $breadcrumbs;
		$data['category'] = 'Latihan';
		$data['jumlah_soal'] = count($items);

		$this->template_frontend->display('/front_end/practice/horen/teil_3_practice', $data);

	}

	function prev_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal - 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/horen/teil_3_ajax', $data);
	}

	function next_soal()
	{
		$no_soal = $_POST['no_soal']; 
		$no_soal = $no_soal + 1; 
		$data['i'] = $no_soal;
		$this->load->view('front_end/practice/horen/teil_3_ajax', $data);
	}

	function submit(){
		$no_soal = $_POST['no_soal'];
		$jawaban = $_POST['jawaban'];

		$soals = $this->session->userdata('horen_3_soals');
		$soal = $soals[$no_soal];

		$answers = $this->session->userdata('horen_3_answers');
		$answers[$soal->id] = $jawaban;

		$this->session->set_userdata('horen_3_answers', $answers);
		$no_soal = $no_soal + 1; 
		$data["i"] = $no_soal;

		$jumlah_soal = count($soals);
		if($no_soal < $jumlah_soal){
			$this->load->view('front_end/practice/horen/teil_3_ajax', $data);
		}else{
			// evaluate test result 
			$nilai_benar = 0; 
			$i = 0;

			// echo "<pre>";
			foreach ($soals as $soal) {
				if($answers[$soal->id] != -1){
					$answer_id   = $answers[$soal->id];
					$answer_data = $this->opsi_horen_3->get_data_by_id($answer_id);
					// print_r($answer_data);
					if($answer_data->value == 1){
						$nilai_benar++;
					}
				}
			}
			$nilai_akhir = ($nilai_benar/$jumlah_soal) * 100;
			$data['nilai_akhir'] = round($nilai_akhir, 2);
			$this->load->view('front_end/structure_test/result', $data);
		}

	}
}