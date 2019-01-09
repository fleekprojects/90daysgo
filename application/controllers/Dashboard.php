<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
			$this->load->library('session'); 
		}
		
		public function index(){
			$this->Dmodel->checkUserLogin();
			$viewdata['weeks']=$this->Dmodel->get_tbl('course_weeks');
			$this->LoadView('dashboard',$viewdata);
		}
		public function thankyou()
		{

			if(count($this->cart->contents()) > 0):
				$this->cart->destroy();
				$this->session->unset_userdata('code');
			 $viewdata="";
			 $this->LoadView('thankyou',$viewdata);
			else:
             redirect(base_url());
			endif;

		}
		
		
	}

