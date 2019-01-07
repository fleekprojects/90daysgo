<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Faqs extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){
			$viewdata['quotes']=$this->Dmodel->get_tbl_whr_arr('faqs',array('tag'=>'quotes-orders','status'=>1));
			$viewdata['iphones']=$this->Dmodel->get_tbl_whr_arr('faqs',array('tag'=>'iphones-ipads','status'=>1));
			$viewdata['shipping']=$this->Dmodel->get_tbl_whr_arr('faqs',array('tag'=>'shipping','status'=>1));
			$this->LoadView('faqs',$viewdata);
		}
		
	}

