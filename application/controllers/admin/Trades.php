<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Trades extends MY_Controller{
		var $table='orders';
		var $pagetitle='Trade Ins';
		var $viewname='admin/trades';
	
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_admin','Amodel');
			$this->load->library('user_agent');
		}
			
		public function index(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['records']=$this->Amodel->get_current_trades();
			$viewdata['conditions']=$this->Dmodel->get_tbl_whr_arr('conditions',array('status'=>1));
			$this->LoadAdminView($this->viewname,$viewdata);
		}
			
		public function passed_trades(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['records']=$this->Amodel->get_passed_trades();
			$this->LoadAdminView($this->viewname,$viewdata);
		}
			
		public function past_trades(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$array = array('paid','recycled','returned','cancelled');
			$viewdata['pstatus']=1;
			$viewdata['records']=$this->Dmodel->get_tbl_whr_in($this->table,'status',$array);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function get_order(){
			$order_id=$_POST['id'];
			$viewdata['order']=$this->Dmodel->get_tbl_whr('orders',$order_id);
			$viewdata['odetails']=$this->Dmodel->get_tbl_whr_arr('order_details',array('order_id'=>$order_id));
			foreach($viewdata['odetails'] as $odet){
				if($odet['action']==3){
					$req_det=$this->Dmodel->get_tbl_whr_arr('order_requote',array('order_detail_id'=>$odet['id']));
					$viewdata['req_status']=$req_det[0]['status'];
				}
				if($odet['action']==4){
					$req_det=$this->Dmodel->get_tbl_whr_arr('order_seller_issue',array('order_detail_id'=>$odet['id']));
					$viewdata['req_status']=$req_det[0]['status'];
				}
			}
			$this->load->view('admin/order_details',$viewdata);
		}
		
		public function get_order_details(){
			$odetail_id=$_POST['id'];
			$result = $this->Amodel->get_order_to_details($odetail_id);
			echo json_encode($result);
		}
		
		public function ch_status(){
			$order_id=$_POST['id'];
			$status=$_POST['status'];
			$order = $this->Dmodel->get_tbl_whr_row($this->table,$order_id);
			$data=array('status'=>$status);
			$result=$this->Dmodel->update_data('orders',$order_id,$data,'id');
			if($status == ""){
				$result=$this->Dmodel->update_data('order_details',$order_id,array('action'=>''),'order_id');
			}
			if($status != "" && $status != "received" && $status != "cancelled"){
				
			  if($status == "paid"){
				$edata['heading']="Your payment is on its way. Your device was received and passed all inspections.";
				$edata['heading2']="Status Update For Trade In <b>".strtoupper($order->order_code)."</b>";
				$edata['firstp']="<p>How was your experience with us?  Please take the time to leave a review on any of the 3 links below about your experience. Your time is greatly appreciated and we rely heavily on customer reviews.<br/><br/>
				Trustpilot: <a href='https://www.trustpilot.com/review/www.ocbuyback.com'>https://www.trustpilot.com/review/www.ocbuyback.com</a><br/>
				Facebook: <a href='https://www.facebook.com/ocbuyback/'>https://www.facebook.com/ocbuyback/</a><br/>
				Google: <a href='https://g.co/kgs/ghhmyN'>https://g.co/kgs/ghhmyN</a><br/>
				<br/>
				<b>Thanks Again,<br/>- OCBuyBack.</b>";
			  }
			  
			  if($status == "returned"){
				$edata['heading']="We returned your device(s) for your order <b>".strtoupper($order->order_code)."</b>";
				$edata['heading2']="Status Update For Trade In <b>".strtoupper($order->order_code)."</b>";
				$edata['firstp']="<p>Hey <b>".$order->first_name.' '.$order->last_name."</b>,<br/><br/> Your OCBuyBack trade in (".$order->order_code.") has been returned. Any questions regarding this order please reply to this email. <br><br><b>- OCBuyBack.</b>";
			  }
			  
			  if($status == "recycled"){
				$edata['heading']="We recycled your device(s) for your order (".strtoupper($order->order_code).")";
				$edata['heading2']="Status Update For Trade In <b>".strtoupper($order->order_code)."</b>";
				$edata['firstp']="<p>Hey <b>".$order->first_name.' '.$order->last_name."</b>,<br/><br/> Your OCBuyBack trade in (".$order->order_code.") has been recycled. Any questions regarding this order please reply to this email.<br><br><b>- OCBuyBack.</b>";
			  }
				
				$ebody = $this->load->view('admin/status_email',$edata,TRUE);
				$maildata= array(
					'from_name'=>Site_Title,
					'from_email'=>Site_Email,
					'to_name'=>$order->first_name.' '.$order->last_name,
					'to_email'=>$order->email,
					'subject'=>"Status update for your OCBuyBack trade in",
					'message'=>$ebody
				);
				echo $this->Dmodel->send_mail($maildata);
			}
			else{
				echo $result;
			}
		}
		
		public function Ch_action(){
			$action=($_POST['action'] == "passed" ? 1 : 2);
			$id=$_POST['id'];
			$data=array('action'=>$action);
			$result=$this->Dmodel->update_data('order_details',$id,$data,'id');
			return true;
		}
		
		public function requestsubmit(){
			$odetails= $this->Dmodel->get_tbl_whr_row('order_details',$_POST['order_detail_id']);
			$order = $this->Dmodel->get_tbl_whr_row($this->table,$odetails->order_id);
			$guid='OC'.rand(10000,99999).$_POST['order_detail_id'];
			
			if(isset($_POST['requote_reason'])){
				$actiondata=array('action'=>3);
				$edata['heading']='The device we received does not match the condition of the trade in submitted.';
				
				if($_POST['requote_reason']=='Wrong Condition'){
					$requote_arr= $this->Amodel->get_requote_price($odetails, $_POST['req_condition']);
					
					if($this->Dmodel->IFExist('order_requote','order_detail_id',$_POST['order_detail_id'])){
						$arrdata=array('order_detail_id'=>$_POST['order_detail_id'],'reason'=>$_POST['requote_reason'],'new_price'=>$requote_arr['price'],'condition_received'=>$requote_arr['condition'],'description'=>$_POST['requote_details'],'guid'=>$guid);
						$exec=$this->Dmodel->insertdata('order_requote',$arrdata);
					}
					else{
						$arrdata=array('reason'=>$_POST['requote_reason'],'new_price'=>$requote_arr['price'],'condition_received'=>$requote_arr['condition'],'description'=>$_POST['requote_details'],'guid'=>$guid);
						$exec=$this->Dmodel->update_data('order_requote',$_POST['order_detail_id'],$arrdata,'order_detail_id');	
					}
					
					$edata['firstp']='The device we received is actually <b>'.$requote_arr['condition'].' ($'.$requote_arr['price'].')</b> rather than <b>'.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.' ($'.$odetails->subtotal.'</b>). <br><br>Reason : <b>'.$_POST['requote_details'].'</b><br><br>We will provide images upon request. Our current offer for this device condition is <b>$'.$requote_arr['price'].'</b>.<br><br>
					Please let us know if you accept this offer, or if you prefer to have your device returned.';
					$edata['Opt']='<br><a href="//ocbuyback.tk/trade/requote/accept/'.$guid.'" style="color:#2EB835;text-decoration:none;float:left;" rel="nofollow"><u>I accept this new offer</u></a><a href="//ocbuyback.tk/trade/requote/reject/'.$guid.'" style="color:#777;text-decoration:none;float:right;" rel="nofollow"><u>I want my device back</u></a>';
				}
				elseif($_POST['requote_reason']=='Device Missing'){
					$edata['firstp']= '<b>'.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.'</b> was not in the trade in you sent us and you will not be paid the original quote of <b>$'.$odetails->subtotal.'</b> for this device.';
					$edata['Opt']="";
				}
				elseif($_POST['requote_reason']=='Other'){
					$edata['firstp']= 'We have requoted your device ('.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.') for the following<br>reason:'.$_POST['requote_details'].'<br>Instead of our original offer of <b>$'.$odetails->offer.'</b>, we can now offer you <b>$'.$_POST['new_price'].'</b>. We will provide images upon request. <br><br>Please let us know if you accept this offer, or if you prefer to have your device returned. ';
					$edata['Opt']='<br><a href="//ocbuyback.tk/trade/requote/accept/'.$guid.'" style="color:#2EB835;text-decoration:none;float:left;" rel="nofollow"><u>I accept this new offer</u></a><a href="//ocbuyback.tk/trade/requote/reject/'.$guid.'" style="color:#777;text-decoration:none;float:right;" rel="nofollow"><u>I want my device back</u></a>';
				}
				
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Requote Requested ! Please check your mail.</b></div>');
			}
			else{
				$actiondata=array('action'=>4);
				$oexist=$this->Dmodel->IFExist('order_seller_issue','order_detail_id',$_POST['order_detail_id']);
				
				if($oexist=='true'){
					$arrdata=array('order_detail_id'=>$_POST['order_detail_id'],'issue'=>$_POST['issue'],'guid'=>$guid);
					$exec=$this->Dmodel->insertdata('order_seller_issue',$arrdata);
				}
				else{
					// $arrdata=array('issue'=>$_POST['issue'],'device_esn'=>$_POST['esn'],'guid'=>$guid);
					$arrdata=array('issue'=>$_POST['issue'],'guid'=>$guid);
					$exec=$this->Dmodel->update_data('order_seller_issue',$_POST['order_detail_id'],$arrdata,'order_detail_id');	
				}
				
				if($_POST['issue']==1){
					$edata['heading']='Your "'.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.'" is Google Locked.';
					$edata['firstp']= "<h2>Let's work together to find a solution!</h2>Your device is Google Locked. This prevents us from inspecting it because we are not able to get past the setup without an email and password.<br><br>The best option would be for us to set up a time to talk over the phone, as getting through the Google lock requires a two step verification process. We recommend that you temporarily change your password and give us the info while over the phone. Once the password is entered, you will receive a second verification step to let us enter the device and remove the lock. Once this is completed, you can change your password back.<br><br>Another option would be for us to return the device so you can get past the Google lock yourself. Once this is done, you can return the device back to us so we can inspect it.<br><br>Please let us know how you would like to proceed.";
					$edata['Opt']="";
				}
				elseif($_POST['issue']==2){
					$edata['heading']='Your "'.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.'" is iCloud Locked.';
					$edata['firstp']= "Let's work together to find a solution!</b><br><br> Your device is iCloud Locked. This would significantly lessen the value since it can only be used for parts. Fortunately, this can be deactivated remotely by following these instructions:<br><br> <b> STEP 1</b> <a target='_blank' href='//support.apple.com/'>  support.apple.com/</a><br><br> STEP 2</b>   Come back to this email and click:";
					$edata['Opt']='<br><a href="//ocbuyback.tk/trade/seller-action/accept/'.$guid.'" style="color:#2EB835;text-decoration:none;float:left;" rel="nofollow"><u>I have resolved the issue</u></a><a href="//ocbuyback.tk/trade/seller-action/reject/'.$guid.'" style="color:#777;text-decoration:none;float:right;" rel="nofollow"><u>I want my device back</u></a>';
				}
				elseif($_POST['issue']==3){
					$edata['heading']='Your "'.$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition.'" is ESN Financed.';
					$edata['firstp']= "The Electronic Serial Number (ESN) on your ".$odetails->device.' '.$odetails->provider.' '.$odetails->storage.' '.$odetails->condition." is showing that it is financed through your carrier payment plan and needs to be paid off so we can inspect it. Otherwise, your offer will drop since there is a balance still owed on the device. This can be done in two easy steps: <br><br><b>STEP 1 </b> Call your carrier and tell them to clear your account so you can sell your phone.<br><br> <b>STEP 2 </b> Come back to this email and click:";
					$edata['Opt']='<br><a href="//ocbuyback.tk/trade/seller-action/accept/'.$guid.'" style="color:#2EB835;text-decoration:none;float:left;" rel="nofollow"><u>I have resolved the issue</u></a><a href="//ocbuyback.tk/trade/seller-action/reject/'.$guid.'" style="color:#777;text-decoration:none;float:right;" rel="nofollow"><u>I want my device back</u></a>';
				}
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Seller Action Requested ! Please check your mail.</b></div>');
			}
			
			$updatestatus=$this->Dmodel->update_data('order_details',$odetails->id,$actiondata,'id');
			
			$ebody = $this->load->view('admin/requote_email',$edata,TRUE);
			
			  $maildata= array(
				'from_name'=>Site_Title,
				'from_email'=>Site_Email,
				'to_name'=>$order->first_name.' '.$order->last_name,
				'to_email'=>$order->email,
				'subject'=>"Problem with your OCBuyBack trade in",
				'message'=>$ebody);
			$this->Dmodel->send_mail($maildata);
			redirect($this->agent->referrer());
		}
	}