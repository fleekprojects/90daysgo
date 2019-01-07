<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Track extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->library('cart'); 
			$this->load->model('Model_form','m_form');
		}
		
		public function index(){
			$this->LoadView('track-order',$viewdata);
		}
		
		public function search(){
			$keywords=$_POST['keywords'];
			$html="<hr noshade>";
			$orders=$this->m_form->search_order($keywords);
			if(!empty($orders)){
			  foreach($orders as $order){
				$html .= '<div class="col-md-7"><h2>'.$order['order_code'].'</h2></div>
				<div class="col-md-5"><p>Date Placed: '.date('jS M Y', strtotime($order['created_at'])).'<br/>
				Status: '.($order['status'] != "" ? strtoupper($order['status']) : 'Pending').'</p>
				</div><div class="col-md-12">'.($order["label_url"] != "" ? '<a target="_blank" href="'.$order['label_url'].'" class="btn btn-default">Print Shipping Label</a>' : '').($order["tracking_url"] != "" ? '<a target="_blank" href="'.$order['tracking_url'].'" class="btn btn-default">Track Your Package</a>' : '').'<a target="_blank" href="'.base_url().'contact-us" class="btn btn-default">Contact Support</a><hr noshade></div>';
			  }
			}
			else{
				$html .='<div class="col-md-12"><h2 style="text-transform: uppercase; text-align: center;">No Records Found</h2></div>';
			}
			
			echo json_encode($html); 
			
		}
		
	}

