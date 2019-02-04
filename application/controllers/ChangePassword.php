<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ChangePassword extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->library('cart'); 
			$this->load->model('Model_form','m_form');
			$this->load->helper('string'); 
		}
		
		public function index(){
			$this->Dmodel->checkUserLogin();
			$viewdata="";
			$this->LoadView('change-password',$viewdata);
		}
		public function changepasssubmit()
		{
			$oldpass=md5($_POST['opassword']);
			$userid=$this->session->userdata('user_id');
			$exist=$this->Dmodel->chk_num('users',array('id'=>$userid,'password'=>$oldpass));
			if($exist==0){
				echo 0;

			}
			else{
			$data['password']=md5($_POST['password']);
			$data['reset_token'] = random_string('alnum', 16);

			$this->Dmodel->update_data('users',$userid,$data,'id');
			echo 1;
			}
					
			}
		
		
	}

