<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends MY_Controller {
	
		var $table='users';
		var $pagetitle='Users';
		var $viewname='admin/users';
		
		public function index(){
			$this->Dmodel->checkLogin();
				$viewdata['title']=$this->pagetitle;
				$users=$this->Dmodel->get_tbl_whr_arr($this->table,array('user_name !='=>'admin'));
				$a=array();
				foreach($users as $user =>$res):
					$ord=$this->Dmodel->chk_num('orders',array('user_id'=>$res['id']));
					$res['orders']=$ord;
						array_push($a,$res);
						
				endforeach;
				$viewdata['records']=$a;

				$this->LoadAdminView($this->viewname,$viewdata);
		}
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			if($this->Dmodel->IFExist($this->table,'email',$data['email'])){
				$data['created_at']= datetime_now;
				$data['password']= md5($data['password']);
				$data['status']= 1;
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
			if($this->Dmodel->IFExistEdit($this->table,'email',$data['email'],$data['id'])){
				$data['updated_at']=datetime_now;
				$data['password']= md5($data['password']);
				$rec_id=$data['id'];
				$exec=$this->Dmodel->update_data($this->table,$rec_id,$data,'id');
				
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
		
	
		
	
	}