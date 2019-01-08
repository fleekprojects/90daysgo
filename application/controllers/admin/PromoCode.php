<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class PromoCode extends MY_Controller {
	
		var $table='promo_code';
		var $pagetitle='Promo Code';
		var $viewname='admin/promocode';
		
		public function index(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['records']=$this->Dmodel->get_tbl($this->table);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function AddRecord(){

			$this->Dmodel->checkLogin();
			$data=$_POST;
			if($this->Dmodel->IFExist($this->table,'code',$data['code'])){
				$data['created_at']=datetime_now;
				$data['status']=1;
				$exec=$this->Dmodel->insertdata($this->table,$data);		
				echo $exec;
			}
			else{
				echo 2;
			}
		}
		
		public function EditRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			if($this->Dmodel->IFExistEdit($this->table,'code',$data['code'],$data['id'])){
				$data['updated_at']=datetime_now;
				$exec=$this->Dmodel->update_data($this->table,$data['id'],$data,'id');
				echo $exec;
			}
			else{
				echo 2;
			}
		}
		
		public function DeleteRecord(){
			$whr_key="id";
			$ids=$this->input->post('ids');
			$result=$this->Dmodel->delete_multi_rec($ids,$whr_key,$this->table);
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable">
			<i class="fa fa-check"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Record Deleted.</b>
			</div>'); 
			redirect(base_url().$this->viewname) ;
		}
		
		public function toggleStatus(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
	}