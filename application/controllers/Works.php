<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Works extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){
			$this->LoadView('how-it-works',$viewdata);
		}
		
	}

