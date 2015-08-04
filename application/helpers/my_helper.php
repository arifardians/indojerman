<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('kategori_helper'))
{
    function kategori_helper()
    {
        $ci = get_instance();
        $ci->load->model('kategori');
        return $ci->kategori->get_all_data();
    }   
}