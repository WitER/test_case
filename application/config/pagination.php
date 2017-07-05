<?php if(!defined('BASEPATH')) exit('Direct Access Not Allowed');

/* This Application Must Be Used With BootStrap 3 *  */
$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] ="</ul>";
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
$config['next_tag_open'] = "<li>";
$config['next_tag_close'] = "</li>";
$config['prev_tag_open'] = "<li>";
$config['prev_tag_close'] = "</li>";
$config['first_tag_open'] = "<li>";
$config['first_link'] = "&lsaquo; Первая";
$config['first_tag_close'] = "</li>";
$config['last_tag_open'] = "<li>";
$config['last_link'] = "Последняя &rsaquo;";
$config['last_tag_close'] = "</li>";
$config['use_page_numbers'] = true;
$config['page_query_string'] = false;
$config['query_string_segment'] = 'page';
$config['num_links'] = 10;