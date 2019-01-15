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
				$uorder=$this->m_form->get_tbl_whr_key_row('orders','user_id',$userid);
				if(!empty($uorder)):
				$viewdata['course_mens']=$this->m_form->get_home_course_men_id_not($uorder->course_name);
				$viewdata['course_womens']=$this->m_form->get_home_course_women_id_not($uorder->course_name);
				else:
					$viewdata['course_mens']=$this->m_form->get_home_course_men();
				$viewdata['course_womens']=$this->m_form->get_home_course_women();
				endif;
			else:
				$viewdata['course_mens']=$this->m_form->get_home_course_men();
				$viewdata['course_womens']=$this->m_form->get_home_course_women();
			endif;

			$this->LoadView('cart',$viewdata);
		}
		public function AddOrder()
		{
				
				if($this->session->userdata('user_id')):
					$data['user_id']=$this->session->userdata('user_id');
					$data['course_name']=$_POST['course'];
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

			$this->Dmodel->update_data('orders',$data['item_number'],$orrarr,'id');

			redirect(base_url().'thankyou');
				

		}
		
	}

