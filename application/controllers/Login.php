<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		

		public function login(){
			$this->index();
		}

		
		public function index(){
	$exist=$this->m_form->get_tbl_whr_key_row('users_start_workout','user_id',$this->session->userdata('user_id'));


			if($this->session->userdata('user_id') && $this->session->userdata('user_name')){

				if(!empty($this->m_form->get_tbl_whr_key_row('users_start_workout','user_id',$this->session->userdata('user_id')))){
					$uworkout=$this->m_form->get_tbl_whr_key_row('users_start_workout','user_id',$this->session->userdata('user_id'));
					
					redirect(base_url().'dashboard-workout/'.$uworkout->current_workout);
				}
					else{
				redirect(base_url().'dashboard');
				}
			}
			else if($this->input->cookie('u_user') && $this->input->cookie('u_pass')){
				$data['user_name']=$this->input->cookie('u_user');     
				$data['password']=$this->input->cookie('u_pass');
				$result = $this->m_form->login($data);
				echo $result;
				if(!empty($uworkout=$this->m_form->get_tbl_whr_key_row('users_start_workout','user_id',$this->session->userdata('user_id')))){
						if(!empty($uworkout->current_workout)):
					redirect(base_url().'dashboard-workout/'.$uworkout->current_workout);
						else:
							redirect(base_url().'dashboard');
						endif;
				}
					else{
				redirect(base_url().'dashboard');
				}
			}
			
			else{
			$viewdata['mens']=$this->Dmodel->get_tbl_whr_row('parents',1);
			$viewdata['womens']=$this->Dmodel->get_tbl_whr_row('parents',2);
			$viewdata['course_mens']=$this->m_form->get_home_course_men();
			$viewdata['course_womens']=$this->m_form->get_home_course_women();
			$this->LoadView('login',$viewdata);
			}
		}
		
		public function login_auth(){
			
			$data['user_name']=$_POST['user_name']; 
			$data['password']=md5($_POST['password']);
			$data['remember_me']=$_POST['remember_me']; 
			$result = $this->m_form->login($data);
			echo $result;
		}
		public function logout(){
			$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
			$this->session->sess_destroy();
			redirect(base_url().'login');
		}
	}

