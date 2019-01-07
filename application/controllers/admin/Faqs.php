<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Faqs extends My_Controller {
	
		var $table='faqs';
		var $pagetitle='Faqs';
		var $viewname='admin/faqs';
		
		public function index(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['records']=$this->Dmodel->get_tbl($this->table);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			if($this->Dmodel->IFExist($this->table,'question',$data['question'])){
				$data['created_at']=DateTime_Now;
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
			if($this->Dmodel->IFExistEdit($this->table,'question',$data['question'],$data['id'])){
				$data['updated_at']=DateTime_Now;
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
			echo '<script>window.location = "'.$this->agent->referrer().'"</script>';
			// redirect($this->agent->referrer()) ;
		}
		
		public function toggleStatus(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		
		public function get_record(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->get_tbl_whr_row($this->table,$id);
			$rec=array('id'=>$data->id,'tag'=>$data->tag,'question'=>$data->question,'answer'=>$data->answer);
			echo json_encode($rec); 
		}
	}