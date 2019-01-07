<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends MY_Controller {
	
	
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_admin','Amodel');
			$this->load->helper('cookie');
			$this->load->helper('string');
		}
			
		public function index(){
			if($this->session->userdata('admin_id') && $this->session->userdata('admin_user_name')){
				redirect(base_url().'admin/dashboard');
			}
			else if($this->input->cookie('a_user') && $this->input->cookie('a_pass')){
				$data['user_name']=$this->input->cookie('a_user');     
				$data['password']=$this->input->cookie('a_pass');
				$result = $this->Amodel->login($data);
				echo $result;
				redirect(base_url().'admin/dashboard');
			}
			else{
				$this->load->view('admin/login');
			}
		}
		
		public function login(){
			$this->index();
		}
		
		public function logout(){
			$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
			$this->session->sess_destroy();
			redirect(base_url().'admin');
		}
		
		public function login_auth(){
			$data['user_name']=$_POST['user_name']; 
			$data['password']=md5($_POST['password']);
			$data['remember_me']=$_POST['remember_me']; 
			$result = $this->Amodel->login($data);
			echo $result;
		}
		
		public function fpass(){
			$email=$_POST['email']; 
			$string = random_string('alnum', 16);
			$result = $this->Amodel->fpass($email,$string);
			echo $result;
		}
		public function verify($slug){
			
			echo $slug;
			die;
		}
		
		public function dashboard(){
			$this->Dmodel->checkLogin();
			$viewdata['title']="Trade Ins";
			$viewdata['counters']=$this->Amodel->get_counters();
			$this->LoadAdminView("admin/dashboard",$viewdata);
		}
		
		public function updatesettings(){
			$data=$this->input->post();
			$data['updated_at']=datetime_now;
			
			if(empty($this->input->post('smtp_password'))){
				unset($data['smtp_password']);
			}
			
			$result=$this->Dmodel->update_data('settings',1,$data,'id');
			if(isset($_FILES['site_logo']) && $_FILES['site_logo']['tmp_name']){
				$config['upload_path']          = APPPATH.'..\assets\front\img';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 100000;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;
				
				$filename=$_FILES['site_logo']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$ldata['site_logo']='logo.'.$ext;
				$_FILES['site_logo']['name']=$ldata['site_logo'];
				$this->load->library('upload', $config);
				if(file_exists(APPPATH.'../assets/front/img/'.$ldata['site_logo'])){
					unlink(APPPATH.'../assets/front/img/'.$ldata['site_logo']);
				}
				if (!$this->upload->do_upload('site_logo')){
					$error = array('error' => $this->upload->display_errors());
				}
				else{
					$exec=$this->Dmodel->update_data('settings',1,$ldata,'id');
					$error = array('upload_data' => $this->upload->data());
				}
			}		
			
			echo $result;
			die;
		}
		
		public function updateprofile(){
			$tbl="users";
			$ID=1;
			$key="ID";
			$user_name=$this->input->post('user_name');
			$user_email=$this->input->post('user_email');
			if(!empty($this->input->post('user_password'))){
				$user_password=md5($this->input->post('user_password'));
				$data=array('user_name'=>$user_name,'email'=>$user_email,'password'=>$user_password);
			}
			else {
				$data=array('user_name'=>$user_name,'email'=>$user_email);
			}
			$result=$this->Dmodel->update_data($tbl,$ID,$data,$key);
		
			echo $result;
			die;
		}
		
	}