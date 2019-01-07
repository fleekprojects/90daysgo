<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Contact extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){
			$this->LoadView('contact-us',$viewdata);
		}
		
		public function AddRecord(){
			$data=$_POST;
			$data['created_at']=DateTime_Now;
			$exec=$this->Dmodel->insertdata('contact',$data);
			
			$maildata= array(
				'from_name'=>'OCBuyBack',
				'from_email'=>'contact@ocbuyback.com',
				'to_name'=>Site_Title,
				// 'to_email'=>Site_Email,
				'to_email'=>'qmerchant@yopmail.com',
				'subject'=>'New Query received',
				'message'=>'You have received a new query from your website contact form. <br/>Following are the details:<br/><br/>
				Full Name:'.$data['full_name'].'<br/>
				Email Address:'.$data['email'].'<br/>
				Subject:'.$data['subject'].'<br/>
				Message:'.$data['message']
			);
			
			// print_r($maildata);
			$this->Dmodel->send_mail($maildata);
			echo $exec;
		}
		
	}

