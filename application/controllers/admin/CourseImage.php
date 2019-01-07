<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CourseImage extends MY_Controller {
	
		var $table='course_images';
		var $pagetitle='Course Images';
		var $viewname='admin/course_images';

		public function __construct(){
			parent::__construct();
			$this->load->library('user_agent');
		}
		
		public function index($id){
			
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['course_id']=$id;
			$coursearr=array('course_id'=>$id);
			$viewdata['records']=$this->Dmodel->get_tbl_whr_arr($this->table,$coursearr);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function AddRecord(){
			
				$this->Dmodel->checkLogin();
				if($_FILES):
				$data=$_POST;
				$data['created_at']=datetime_now;

				$exec=$this->Dmodel->insertdata($this->table,$data);
				$last_id=$this->db->insert_id();
				
				if(isset($_FILES['beforeimg']) && $_FILES['beforeimg']['tmp_name']){
					
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseimages';

					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['beforeimg']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='beforeimg';
					$ldata['before_image']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['beforeimg']['name']=$ldata['before_image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['before_image'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['before_image']);
					}
					if ( ! $this->upload->do_upload('beforeimg')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}	
				if(isset($_FILES['afterimg']) && $_FILES['afterimg']['tmp_name']){

					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseimages';

					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['afterimg']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='afterimg';
					$ldata['after_image']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['afterimg']['name']=$ldata['after_image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['after_image'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['after_image']);
					}
					if ( ! $this->upload->do_upload('afterimg')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}

				echo $exec;
			else:
				echo 2;
			endif;
			
		}
		
		public function EditRecord(){
			
				$this->Dmodel->checkLogin();
				if($_FILES):
				$data=$_POST;
				$last_id=$data['id'];
				$ldata['updated_at']=datetime_now;
			
				if(isset($_FILES['before_image']) && $_FILES['before_image']['tmp_name']){
					
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseimages';

					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['before_image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='beforeimg';
					$ldata['before_image']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['before_image']['name']=$ldata['before_image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['before_image'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['before_image']);
					}
					if ( ! $this->upload->do_upload('before_image')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}	
				if(isset($_FILES['after_image']) && $_FILES['after_image']['tmp_name']){

					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses/courseimages';

					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['after_image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname='afterimg';
					$ldata['after_image']=$last_id.'-'.$lname.'.'.$ext;
					
					$_FILES['after_image']['name']=$ldata['after_image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['after_image'])){
						unlink(APPPATH.'../assets/front/uploads/courses/courseimages/'.$ldata['after_image']);
					}
					if ( ! $this->upload->do_upload('after_image')){
						$error = array('error' => $this->upload->display_errors());
						
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
						$data = array('upload_data' => $this->upload->data());
						
					}
				}

				echo $exec;
			else:
				echo 2;
			endif;
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