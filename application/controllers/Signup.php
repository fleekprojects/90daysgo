<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signup extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
			$this->load->helper('string'); 
		}
		
		public function index(){
			if(empty($this->session->userdata('user_id'))):
			$viewdata="";
			$this->LoadView('signup',$viewdata);
			else:
			redirect(base_url());
			endif;
			
		}

		public function InsertRecord()
		{
			$data=$_POST;
			if($this->Dmodel->IFExist('users','email',$data['email'])){
				$email=explode('@', $data['email']);
				$data['user_name']=$email[0];
				$data['password']=md5($data['password']);
				$data['created_at']=datetime_now;
				$string=random_string('alnum', 16);
				// $string=md5(md5($data['password']));
				$data['reset_token']=$string;
				$content_msg='We have received a request to verify your account by clicking on this link: <a href="//'.$_SERVER['HTTP_HOST'].'/verify/'.$string.'/signup">click here</a>';
				$maildata= array(
				'from_email'=>site_email,
				'from_name'=>site_title,
				'to_email'=>$data['email'],
				'to_name'=>$data['user_name'],
				'subject'=>'Account Registered.',
				'message'=>$content_msg
			);
			$this->Dmodel->send_mail($maildata);
    			$exec=$this->Dmodel->insertdata('users',$data);
    			echo $exec;
			}
			else{
				echo 0;
			}
		}
		public function verify($slug,$check)
		{
			if($check=="signup"):
				if($this->Dmodel->IFExist('users','reset_token',$slug)){
					redirect(base_url());
				}
				else{
					$data=array('status'=>1);
					$this->Dmodel->update_data('users',$slug,$data,'reset_token');
					redirect(base_url().'login');
				}
			else:
					if($this->Dmodel->IFExist('users','reset_token',$slug)){
					redirect(base_url().'forgot');
				}
				else{
					$data=array('status'=>1);
					$this->Dmodel->update_data('users',$slug,$data,'reset_token');
					redirect(base_url().'login');
				}

			endif;



		}
			
	
	}

