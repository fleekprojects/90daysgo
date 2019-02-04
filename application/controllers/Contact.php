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
			$viewdata="";
			$this->LoadView('contact-us',$viewdata);
		}
		
		public function AddRecord(){
			$data=$_POST;
			$data['created_at']=datetime_now;
			$exec=$this->Dmodel->insertdata('contact',$data);
			
			// $maildata= array(
				// 'from_name'=>site_title,
				// 'from_email'=>site_email,
				// 'to_name'=>site_title,
				// 'to_email'=>Site_Email,
				// 'to_email'=>'saad@yopmail.com',
				// 'subject'=>'New Query received',
				// 'message'=>'You have received a new query from your website contact form. <br/>Following are the details:<br/><br/>
				// Full Name:'.$data['full_name'].'<br/>
				// Email Address:'.$data['email'].'<br/>
				// Subject:'.$data['subject'].'<br/>
				// Message:'.$data['message']
			// );
			
			// print_r($maildata);
			// $this->Dmodel->send_mail($maildata);
			
			 $message =  'You have received a new query from your website contact form. <br/>Following are the details:<br/><br>
				Full Name:'.$data['full_name'].'<br/>
				Email Address:'.$data['email'].'<br/>
				Subject:'.$data['subject'].'<br/>
				Message:'.$data['message'].'<br><br>Thanks & Regards<br><br>'.site_title;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: '.site_title.'<'.site_email.'>' . "\r\n";
                $to = '90days@yopmail.com';
                $subject = "New Query received";
                $mail = mail($to,$subject,$message,$headers);
			echo $exec;
		}
		
	}

