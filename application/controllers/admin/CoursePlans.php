<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CoursePlans extends MY_Controller {
	
		var $table='course_plan';
		var $pagetitle='Course Plans';
		var $viewname='admin/course_plans';

		public function __construct(){
			parent::__construct();
			$this->load->library('user_agent');

		}
		
		public function index($cid,$wid){			
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['course_id']=$cid;
			$viewdata['week_id']=$wid;
			$weekarr=array('week_id'=>$wid);
			$viewdata['parent']=$this->Dmodel->get_data("SELECT CONCAT('Week#',w.week_no,'-',c.title,'(',p.title,')') AS title FROM course_weeks w LEFT JOIN courses c ON w.course_id=c.id LEFT JOIN parents p ON c.parent_id=p.id WHERE w.id=".$wid);
			$viewdata['records']=$this->Dmodel->get_tbl_whr_arr($this->table,$weekarr);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			$arr=array('day_no'=>$data['day_no'], 'week_id'=>$data['week_id']);
			if($this->Dmodel->chk_num($this->table,$arr) == 0){
				$data['created_at']=datetime_now;
				$exec=$this->Dmodel->insertdata($this->table,$data);
				$last_id=$this->db->insert_id();
				if(isset($_FILES['video']) && $_FILES['video']['tmp_name']){
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseplans';
					$config['allowed_types']        = 'mov|avi|flv|wmv|mp4';
					$config['max_size']             = 100000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['video']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='courseplan';
					$ldata['video']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['video']['name']=$ldata['video'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseplans/'.$ldata['video'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseplans/'.$ldata['video']);
					}
					if ( ! $this->upload->do_upload('video')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}	
			
				echo $exec;
			}
			else{
				echo 2;
			}
		}
		
		public function EditRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			$arr=array('day_no'=>$data['day_no'], 'week_id'=>$data['week_id'], 'id !=' => $data['id']);
			if($this->Dmodel->chk_num($this->table,$arr) == 0){
				$last_id=$data['id'];
				$data['updated_at']=datetime_now;
				$exec=$this->Dmodel->update_data($this->table,$data['id'],$data,'id');
				
				if(isset($_FILES['video']) && $_FILES['video']['tmp_name']){
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseplans';
					$config['allowed_types']        = 'mov|avi|flv|wmv|mp4';
					$config['max_size']             = 602400000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['video']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='courseplan';
					$ldata['video']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['video']['name']=$ldata['video'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseplans/'.$ldata['video'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseplans/'.$ldata['video']);
					}
					if ( ! $this->upload->do_upload('video')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}
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
			redirect($this->agent->referrer()) ;
		}
		
		public function toggleStatus(){

			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		

	}