<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "front_end/home_controller/index";

/* alias route for soal reading */

$route['read_text']		 		= "back_end/soalreading_controller/index";
$route['read_text_add']		 	= "back_end/soalreading_controller/add";
$route['read_text_prev/(:num)']	= "back_end/soalreading_controller/view/$1";
$route['read_text/(:num)']		= "back_end/soalreading_controller/edit/$1";

$route['soal_reading_add/(:num)']  = "back_end/soalreading_controller/add_soal/$1";
$route['soal_reading_edit/(:num)'] = "back_end/soalreading_controller/edit_soal/$1";

/* end alias route for soal reading */

/* alias route for soal structure */
$route['soal_str']  			= "back_end/soalstructure_controller/index";
$route['soal_str_add']  		= "back_end/soalstructure_controller/add";
$route['soal_str_prev/(:num)']  = "back_end/soalstructure_controller/view/$1";
$route['soal_str/(:num)']  		= "back_end/soalstructure_controller/edit/$1";
/* end alias route for soal structure */

/* alias route for soal listening */
$route['soal_lst']  			= "back_end/soallistening_controller/index";
$route['soal_lst_add']  		= "back_end/soallistening_controller/add";
$route['soal_lst_prev/(:num)']  = "back_end/soallistening_controller/view/$1";
$route['soal_lst/(:num)']  		= "back_end/soallistening_controller/edit/$1";
/* end alias route for soal listening */


/* alias route for lesen 1*/
$route['lesen_1'] 				= "back_end/lesen_1_controller/index";
$route['lesen_1_add']			= "back_end/lesen_1_controller/add";
$route['lesen_1_prev/(:num)']	= "back_end/lesen_1_controller/view/$1";
$route['lesen_1/(:num)']		= "back_end/lesen_1_controller/edit/$1";
$route['lesen_1_del/(:num)']	= "back_end/lesen_1_controller/delete/$1";

$route['lesen_1_add_soal/(:num)'] = "back_end/lesen_1_controller/add_soal/$1";
$route['lesen_1_soal/(:num)']	  = "back_end/lesen_1_controller/edit_soal/$1";
$route['lesen_1_soal_del/(:num)'] = "back_end/lesen_1_controller/delete_soal/$1";
/* end alias route for lesen 1*/

/* alias route for lesen 2*/
$route['lesen_2'] 				= "back_end/lesen_2_controller/index";
$route['lesen_2_add']			= "back_end/lesen_2_controller/add";
$route['lesen_2_prev/(:num)']	= "back_end/lesen_2_controller/view/$1";
$route['lesen_2/(:num)']		= "back_end/lesen_2_controller/edit/$1";
$route['lesen_2_del/(:num)']	= "back_end/lesen_2_controller/delete/$1";

$route['lesen_2_opsi_add/(:num)'] = "back_end/lesen_2_controller/add_opsi/$1";
$route['lesen_2_opsi/(:num)']	  = "back_end/lesen_2_controller/edit_opsi/$1";
$route['lesen_2_opsi_del/(:num)'] = "back_end/lesen_2_controller/delete_opsi/$1";
/* end alias route for lesen 1*/

/* alias route for lesen 3*/
$route['lesen_3'] 				= "back_end/lesen_3_controller/index";
$route['lesen_3_add']			= "back_end/lesen_3_controller/add";
$route['lesen_3_prev/(:num)']	= "back_end/lesen_3_controller/view/$1";
$route['lesen_3/(:num)']		= "back_end/lesen_3_controller/edit/$1";
$route['lesen_3_del/(:num)']	= "back_end/lesen_3_controller/delete/$1";
/*end of alias lesen 3*/

/* alias route for horen 1*/
$route['horen_1'] 				= "back_end/horen_1_controller/index";
$route['horen_1_add']			= "back_end/horen_1_controller/add";
$route['horen_1_prev/(:num)']	= "back_end/horen_1_controller/view/$1";
$route['horen_1/(:num)']		= "back_end/horen_1_controller/edit/$1";
$route['horen_1_del/(:num)']	= "back_end/horen_1_controller/delete/$1";
$route['horen_1_opsi_add/(:num)']= "back_end/horen_1_controller/add_opsi/$1";
$route['horen_1_opsi/(:num)']	= "back_end/horen_1_controller/edit_opsi/$1";
$route['horen_1_opsi_del/(:num)']	= "back_end/horen_1_controller/delete_opsi/$1";
$route['horen_1_ajax/(:num)']	= "back_end/horen_1_controller/ajax_view/$1";

/* end alias route for lesen 1*/

/* alias route for horen 1*/
$route['horen_2'] 				= "back_end/horen_2_controller/index";
$route['horen_2_add']			= "back_end/horen_2_controller/add";
$route['horen_2_prev/(:num)']	= "back_end/horen_2_controller/view/$1";
$route['horen_2/(:num)']		= "back_end/horen_2_controller/edit/$1";
$route['horen_2_del/(:num)']	= "back_end/horen_2_controller/delete/$1";
$route['horen_2_ajax/(:num)']	= "back_end/horen_2_controller/ajax_view/$1";
/* end alias route for lesen 1*/

/* alias route for horen 1*/
$route['horen_3'] 				= "back_end/horen_3_controller/index";
$route['horen_3_add']			= "back_end/horen_3_controller/add";
$route['horen_3_prev/(:num)']	= "back_end/horen_3_controller/view/$1";
$route['horen_3/(:num)']		= "back_end/horen_3_controller/edit/$1";
$route['horen_3_del/(:num)']	= "back_end/horen_3_controller/delete/$1";
$route['horen_3_ajax/(:num)']	= "back_end/horen_3_controller/ajax_view/$1";
/* end alias route for lesen 1*/


/* alias route for kategori */
$route['kategori']  			= "back_end/kategori_controller/index";
$route['kategori_add']  		= "back_end/kategori_controller/add";
$route['kategori_prev/(:num)']  = "back_end/kategori_controller/view/$1";
$route['kategori/(:num)']  		= "back_end/kategori_controller/edit/$1";
/* end alias route for kategori */

/* alias route for tutorial */
$route['tutorial']  			= "back_end/tutorial_controller/index";
$route['tutorial_add']  		= "back_end/tutorial_controller/add";
$route['tutorial_prev/(:num)']  = "back_end/tutorial_controller/view/$1";
$route['tutorial/(:num)']  		= "back_end/tutorial_controller/edit/$1";
/* end alias route for tutorial */

/* alias route for tutorial */
$route['user']  				= "back_end/user_controller/index";
$route['user_add']  			= "back_end/user_controller/add";
$route['user_prev/(:num)']  	= "back_end/user_controller/view/$1";
$route['user/(:num)']  			= "back_end/user_controller/edit/$1";
/* end alias route for tutorial */

/* alias route for tutorial */
$route['user_group']  				= "back_end/usergroup_controller/index";
$route['user_group_add']  			= "back_end/usergroup_controller/add";
$route['user_group_prev/(:num)']  	= "back_end/usergroup_controller/view/$1";
$route['user_group/(:num)']  		= "back_end/usergroup_controller/edit/$1";
/* end alias route for tutorial */

/* alias route for tutorial */
$route['berita']  				= "back_end/berita_controller/index";
$route['berita_add']  			= "back_end/berita_controller/add";
$route['berita_prev/(:num)']  	= "back_end/berita_controller/view/$1";
$route['berita/(:num)']  		= "back_end/berita_controller/edit/$1";
/* end alias route for tutorial */


/* alias route for tutorial */
$route['dashboard']  			= "back_end/dashboard_controller/index";
/* end alias route for tutorial */



/* alias route for login, sign up etc */
$route['login']  				= "front_end/login_controller/sign_in";
$route['register']  			= "front_end/login_controller/sign_up";
$route['logout']				= "front_end/login_controller/logout";
$route['login_user']			= "front_end/login_controller/login_user";	
$route['register_user']			= "front_end/login_controller/register_user";
/* end alias route for login, sign up etc */


/* alias route for application*/
$route['my_dashboard']				= "front_end/home_controller/dashboard";
$route['jenis_tutorial/(:num)'] 	= "front_end/home_controller/kategori_tutorial/$1";
$route['detail_tutorial/(:num)'] 	= "front_end/home_controller/detail_tutorial/$1";
$route['contacts']					= "front_end/home_controller/contacts";
$route['review_progress']			= "front_end/home_controller/review_progress";
$route['exercise/(:num)']			= "front_end/home_controller/latihan/$1";
$route['do_structure_exercise']		= "front_end/home_controller/do_latihan_struktur";
/* end alias route for application*/

/* alias for lesen practice */
$route['lesen_practice/teil_1'] 		= "front_end/lesenpractice_controller/teil_1_practice";
$route['lesen_practice/teil_2']			= "front_end/lesenpractice_2_controller/teil_2_practice";
$route['lesen_practice/teil_3']			= "front_end/lesenpractice_3_controller/teil_3_practice";

$route['lesen_practice/teil_1_intro'] 	= "front_end/lesenpractice_controller/intro";
$route['lesen_practice/teil_2_intro']	= "front_end/lesenpractice_2_controller/intro";
$route['lesen_practice/teil_3_intro']	= "front_end/lesenpractice_3_controller/intro";

/* end alias for lesen practice */

/* alias for horen practice */
$route['horen_practice/teil_1'] 	= "front_end/horenpractice_1_controller/teil_1_practice"; 
$route['horen_practice/teil_2'] 	= "front_end/horenpractice_2_controller/teil_2_practice"; 
$route['horen_practice/teil_3'] 	= "front_end/horenpractice_3_controller/teil_3_practice"; 


/* end alias for horen practice */

/* alias for horen practice */
$route['user_exam'] 		= "front_end/user_exam_controller/index"; 
$route['user_exam/start']	= "front_end/user_exam_controller/intro_horen";
$route['user_exam/start_lesen']	= "front_end/user_exam_controller/intro_lesen";
$route['user_exam/horen']	= "front_end/user_exam_controller/do_exam_horen";
$route['user_exam/lesen']	= "front_end/user_exam_controller/do_exam_lesen";
$route['user_exam/init']	= "front_end/user_exam_controller/initiate_exam";
$route['user_exam/recap']	= "front_end/user_exam_controller/show_recap";


/* end alias for horen practice */


$route['404_override'] = 'error_controller/show_error_404_2';


/* End of file routes.php */
/* Location: ./application/config/routes.php */