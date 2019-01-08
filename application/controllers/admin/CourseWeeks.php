<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CourseWeeks extends MY_Controller {
	
		var $table='course_weeks';
		var $pagetitle='Course Weeks';
		var $viewname='admin/course_weeks';

		public function __construct(){
			parent::__construct();
			$this->load->library('user_agent');
		}
		
		public function index($id){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['course_id']=$id;
			$coursearr=array('course_id'=>$id);
			$viewdata['parent']=$this->Dmodel->get_data("SELECT CONCAT(c.title,'(',p.title,')') AS title FROM courses c LEFT JOIN parents p ON c.parent_id=p.id WHERE c.id=".$id);
			$viewdata['records']=$this->Dmodel->get_tbl_whr_arr($this->table,$coursearr);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function AddCourseWeek($id)
		{
			$viewdata['course_id']=$id;
			$viewdata['title']='Add Course Week';
			$this->LoadAdminView('admin/add_course_week',$viewdata);
		}
		public function AddRecord(){

			$this->Dmodel->checkLogin();
			// $data=$_POST;
			$data=[];
			for($i=0; $i < count($_POST['title']); $i++){
				$data['title']=$_POST['title'][$i];
				$data['course_id']=$_POST['course_id'];
				$data['created_at']=datetime_now;
				$data['week_no']=$i+1;	
				$exec=$this->Dmodel->insertdata($this->table,$data);
			}
			 echo $exec;
			die;
			
			
		}
		
		public function EditRecord(){
			
				$this->Dmodel->checkLogin();
				
				$data=$_POST;
			if($this->Dmodel->IFExistEdit($this->table,'title',$data['title'],$data['id'])){
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
			redirect($this->agent->referrer()) ;
		}
		
		public function toggleStatus(){

			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		

	}