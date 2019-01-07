<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Order extends MY_Controller {
		public function __construct(){
			parent::__construct();
			
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
			$this->load->library('encryption');
		}
		
		public function add_to_cart(){
			$pid=$_POST['pid'];
			$qty=$_POST['qty'];
			$pdata=$this->m_form->get_product($pid);
			
			$data = array(
					'id'      => $pdata['id'],
					'qty'     => $qty,
					'price'   => $pdata['price'],
					'name'    => $pdata['title'],
					'storage'    => $pdata['storage'],
					'condition' => $pdata['condition'],
					'provider' => $pdata['provider']
			);
			if($this->cart->insert($data)){
				echo 1;
			}
		}
		
		public function update_cart_item(){
			$data = array(
				'rowid' => $_POST["rowid"],
				'qty'   => $_POST["qty"],
			);
			if($this->cart->update($data)){
				echo 1;
			}
		}
		
		public function contact(){
			if($this->cart->contents() == NULL){
				redirect (base_url());
			}
			$viewdata['cdet']=(isset($_SESSION['contact_details']) ? $_SESSION['contact_details'] : "");
			$this->LoadView('contact',$viewdata);
		}
		
		public function payment(){
			if(isset($_POST['trade_type']) && !empty($_POST['trade_type'])){
				$_SESSION['contact_details'] = $_POST;
			}
			
			$viewdata['pay_type']=(isset($_SESSION['pay_details']['pay_type']) ?  $_SESSION['pay_details']['pay_type'] : 1);
			$viewdata['check_type']=(isset($_SESSION['pay_details']['check_type']) ?  $_SESSION['pay_details']['check_type'] : "");
			$viewdata['email']=(isset($_SESSION['pay_details']['email']) ?  $_SESSION['pay_details']['email'] : "");
			$viewdata['paypal_email']=(isset($_SESSION['pay_details']['paypal_email']) ?  $_SESSION['pay_details']['paypal_email'] : "");
			$viewdata['paypalemail']=(isset($_SESSION['pay_details']['paypalemail']) ?  $_SESSION['pay_details']['paypalemail'] : "");
			
			$this->LoadView('payment',$viewdata);
		}
		
		public function checkout(){
			
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$_SESSION['pay_details'] = $_POST;
			}
			if($this->cart->contents() == NULL){
				redirect (base_url());
			}
			else if(!isset($_SESSION['contact_details']) || empty($_SESSION['contact_details'])){
				redirect (base_url().'order/contact');
			}
			else if(!isset($_SESSION['pay_details']) || empty($_SESSION['pay_details'])){
				redirect (base_url().'order/payment');
			}
			else{
				$viewdata['pdet']= $_SESSION['pay_details'];
				$viewdata['cdet']= $_SESSION['contact_details'];
				$this->LoadView('checkout',$viewdata);
			}
		}
		
		
		public function place_order(){
			if($this->cart->contents() == NULL){
				redirect (base_url());
			}
			else if(!isset($_SESSION['pay_details']) || empty($_SESSION['pay_details'])){
				redirect (base_url().'order/payment');
			}
			else if(!isset($_SESSION['contact_details']) || empty($_SESSION['contact_details'])){
				redirect (base_url().'order/contact');
			}
			else{
				$address= (isset($_SESSION['contact_details']['unit']) ? $_SESSION['contact_details']['unit'].', ' : "").(isset($_SESSION['contact_details']['street']) ? $_SESSION['contact_details']['street'].', ' : "").(isset($_SESSION['contact_details']['state']) ? $_SESSION['contact_details']['state'].', ' : "");
				$trade_type=(isset($_SESSION['contact_details']['trade_type']) ? $_SESSION['contact_details']['trade_type'] : "");
				if($trade_type == "local_dropoff"){
					$trade_details= 'Local Drop Off ('.(isset($_SESSION['contact_details']['date']) ? date('jS M Y', strtotime($_SESSION['contact_details']['date'])) : "").' at '.(isset($_SESSION['contact_details']['time']) ? $_SESSION['contact_details']['time'] : "").')'; 
				}
				if($trade_type == "prepaid_label"){
					$trade_details= 'Prepaid Label'; 
				}
				else if($trade_type == "shipping_kit"){
					$trade_details= 'Shipping Kit with Prepaid Label'; 
				}
				
				$data=array(
					'email'=>$_SESSION['pay_details']['email'],
					'paypal_email'=>$_SESSION['pay_details']['paypal_email'],
					'pay_type'=>$_SESSION['pay_details']['pay_type'],
					'first_name	'=>$_SESSION['contact_details']['first_name'],
					'last_name'=>$_SESSION['contact_details']['last_name'],
					'trade_details'=>$trade_details,
					'address'=>$address,
					'city'=>$_SESSION['contact_details']['city'],
					'zip'=>$_SESSION['contact_details']['zip_code'],
					'phone'=>$_SESSION['contact_details']['phone'],
					'amount'=>$this->cart->total(),
					'created_at'=>DateTime_Now,
				);
				if($this->Dmodel->insertdata('orders',$data)){
				  $_SESSION['order_id']=$this->db->insert_id();
				  $udata['order_code']='oc-'.rand(1000,9999).$_SESSION['order_id'];
				  $exec=$this->Dmodel->update_data('orders',$_SESSION['order_id'],$udata,'id');
				  $_SESSION['tqty']=0;
				  foreach ($this->cart->contents() as $item){
					$data=array(
						'order_id'=>$_SESSION['order_id'],
						'provider'=>$item['provider'],
						'device'=>$item['name'],
						'condition'=>$item['condition'],
						'storage'=>$item['storage'],
						'offer'=>$item['price'],
						'quantity'=>$item['qty'],
						'subtotal'=>$item['subtotal']
					);
					$this->Dmodel->insertdata('order_details',$data);
					$_SESSION['tqty']=$_SESSION['tqty']+$item['qty'];
				  }
				}
				$this->cart->destroy();
				  
				redirect(base_url().'shipping');
			}
		}


		public function requote_accept($guid){
			if($this->Dmodel->IFExist('order_requote','guid',$guid) == false){
				$this->Dmodel->update_data('order_requote',$guid,array('status'=>1),'guid');
				$requotedetails=$this->Dmodel->get_tbl_whr_arr('order_requote',array('guid'=>$guid))[0];
				$tradedetails=$this->Dmodel->get_tbl_whr_arr('order_details',array('id'=>$requotedetails['order_detail_id']))[0];
				
				$subtotal=$requotedetails['new_price']*$tradedetails['quantity'];
				$trade_arr=array('offer'=>$requotedetails['new_price'],'subtotal'=>$subtotal);
				$this->Dmodel->update_data('order_details',$requotedetails['order_detail_id'],$trade_arr,'id');
				
				$this->m_form->update_total($tradedetails['order_id']);
				$data['content']="<h1><strong>Thank you for resolving this issue.</strong></h1>
				<h2><strong>We will initiate your payment within one business day. Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
			}
			else{
				$data['content']="<h1><strong>Thank you.</strong></h1>
				<h2><strong>Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
				
			}
		}

		public function requote_reject($guid){
			
			if($this->Dmodel->IFExist('order_requote','guid',$guid) == false){
				$this->Dmodel->update_data('order_requote',$guid,array('status'=>2),'guid');
				
				$data['content']="<h1><strong>Thank you.</strong></h1>
				<h2><strong>Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
			}
		}
		public function seller_accept($guid){
			if($this->Dmodel->IFExist('order_seller_issue','guid',$guid) == false){
				$this->Dmodel->update_data('order_seller_issue',$guid,array('status'=>1),'guid');
				$data['content']="<h1><strong>Thank you for resolving this issue.</strong></h1>
				<h2><strong>We will initiate your payment within one business day. Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
			}
			else{
				$data['content']="<h1><strong>Thank you.</strong></h1>
				<h2><strong>Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
			}
		}

		public function seller_reject($guid){
			if($this->Dmodel->IFExist('order_seller_issue','guid',$guid) == false){
				$this->Dmodel->update_data('order_seller_issue',$guid,array('status'=>2),'guid');
				$data['content']="<h1><strong>Thank you.</strong></h1>
				<h2><strong>Have a great day, from everyone at OCBuyBack!</strong></h2>";
				$this->LoadView('thankyou',$data);
			}
		}
	}

