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
			$viewdata['course_mens']=$this->m_form->get_home_course_men();
			$viewdata['course_womens']=$this->m_form->get_home_course_women();
			$this->LoadView('cart',$viewdata);
		}
		public function AddOrder()
		{


			$data['user_id']=$this->session->userdata('user_id');
			$data['course_id']=$_POST['cid'];
			$data['total_amount']=$_POST['price'];
			$data['discount_id']=$_POST['did'];
			$data['order_code']='90DAYS'.$data['user_id'].$data['course_id'];
			$data['payment_gateway']=1;
			$orderid= $this->m_form->insertdatatoid('orders',$data);
			
			echo $orderid;

		}
		
	}

