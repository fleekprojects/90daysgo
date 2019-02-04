<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){

			
			$viewdata['cart']=$this->cart->contents();
			$viewdata['mens']=$this->Dmodel->get_tbl_whr_row('parents',1);
			$viewdata['womens']=$this->Dmodel->get_tbl_whr_row('parents',2);
			if($userid=$this->session->userdata('user_id')):
				$user_orders=$this->Dmodel->get_tbl_whr_arr('orders',array('user_id'=>$userid));
				if(count($user_orders)>0):
				foreach($user_orders as $user_order):
					$uord[]=$user_order['course_name'];
				endforeach;
				$viewdata['uorder']=$uord;
				endif;
			endif;
				
					$viewdata['course_mens']=$this->m_form->get_home_course_men();
				$viewdata['course_womens']=$this->m_form->get_home_course_women();
				// foreach($viewdata['course_mens'] as $course_men):
				// 		if($hell=array_search($course_men['title'],$viewdata['uorder'])):
				// 			echo $hell;
				// 		endif;
				// endforeach;
				// die;
			

			$this->LoadView('cart',$viewdata);
		}
		public function AddOrder()
		{
			
				
				if($this->session->userdata('user_id')):
					$data['user_id']=$this->session->userdata('user_id');
					$data['course_id']=$_POST['courseid'];
					$data['course_name']=$_POST['course'];
					$data['parent_name']=$_POST['course_cat'];
					$data['total_amount']=$_POST['price'];
					$data['discount_code']=$_POST['discount'];
					if(isset($_POST['payment_gateway']) && $_POST['payment_gateway']=='stripe'):
						$data['payment_gateway']=2;
					else:
						$data['payment_gateway']=1;
					endif;
					$data['created_at']=datetime_now;
					$orderid= $this->m_form->insertdatatoid('orders',$data);
					
					echo $orderid;
				else:
					echo 0;
				endif;
		

		}
		public function Paymentdone()
		{
				
			$data=$_GET;
			$orrarr['order_code']='90DAYS00'.$data['item_number'];
			$orrarr['transaction_id']=$data['tx'];
			$orrarr['paid_amount']=$data['amt'];
			$orrarr['transaction_status']=1;
			
				$orderdetails=$this->Dmodel->get_tbl_whr_row('orders',$data['item_number']);
				$coursedetails=$this->Dmodel->get_tbl_whr_row('courses',$orderdetails->course_id);
				$startworkoutarr=array('user_id'=>$orderdetails->user_id,'course_name'=>$coursedetails->slug,'start_workout_time'=>datetime_now);
				$this->m_form->insertdatatoid('users_start_workout',$startworkoutarr);
				$userdetails=$this->Dmodel->get_tbl_whr_row('users',$orderdetails->user_id);
			  $message =  "Hello ".$userdetails->user_name.",<br><br>Your Order Details : <br>
		Order No : ".$orrarr['order_code']."<br>
		Workout Name : ".$orderdetails->parent_name."(".$orderdetails->course_name.")<br>
		Total Amount : $".$data['amt']."<br>
		Payment Method : Paypal<br>
	<br><br>Thanks & Regards<br><br>".site_title;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: '.site_title.'<'.site_email.'>' . "\r\n";
                $to = $userdetails->email;
                $subject = "Thanks For Ordering";
                $mail = mail($to,$subject,$message,$headers);
			$this->Dmodel->update_data('orders',$data['item_number'],$orrarr,'id');

			redirect(base_url().'thankyou');
				

		}
		
	}

