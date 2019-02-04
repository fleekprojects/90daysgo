<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Courses extends MY_Controller {
	
		var $table='courses';
		var $pagetitle='Courses';
		var $viewname='admin/courses';
		
		public function index(){
			$this->Dmodel->checkLogin();
			$pid=(isset($_GET['parent']) ? $_GET['parent']: 0);
			if($this->Dmodel->IFExist('parents','id',$pid)){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Invalid Category.</b>
				</div>'); 
				redirect(base_url().'parents') ;
			}
			else{
				$viewdata['title']=$this->pagetitle;
				$viewdata['parent']=$this->Dmodel->get_tbl_whr('parents',$pid);
				$get_data=array('parent_id'=>$pid);
				$viewdata['records']=$this->Dmodel->get_tbl_whr_arr($this->table,$get_data);
				$this->LoadAdminView($this->viewname,$viewdata);
			}
		}
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			$existrow=$this->Dmodel->chk_num($this->table,array('title'=>$data['title'],'parent_id'=>$data['parent_id']));
			
			if($existrow==0){
				$data['created_at']= datetime_now;
				$data['slug']=$this->slugify($data['title']);
				$islug=$data['slug'];
				$exec=$this->Dmodel->insertdata($this->table,$data);
				$last_id=$this->db->insert_id();
				if(isset($_FILES)){
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 10240;
					$config['max_height']           = 7680;
					if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
						$filename=$_FILES['image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['image']=$last_id.'-'.$islug.'.'.$ext;
						$_FILES['image']['name']=$ldata['image'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses/'.$ldata['image'])){
							unlink(APPPATH.'../assets/front/uploads/courses/'.$ldata['image']);
						}
						if ( ! $this->upload->do_upload('image')){
							$error = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
					}
					if(isset($_FILES['demo_gif']) && $_FILES['demo_gif']['tmp_name']){
						$filename=$_FILES['demo_gif']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['demo_gif']=$last_id.'-'.$islug.'-demo.'.$ext;
						$_FILES['demo_gif']['name']=$ldata['demo_gif'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses/'.$ldata['demo_gif'])){
							unlink(APPPATH.'../assets/front/uploads/courses/'.$ldata['demo_gif']);
						}
						if ( ! $this->upload->do_upload('demo_gif')){
							$error = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
					}
					if(isset($_FILES['banner_image']) && $_FILES['banner_image']['tmp_name']){
						$filename=$_FILES['banner_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['banner_image']=$last_id.'-'.$islug.'-banner_image.'.$ext;
						$_FILES['banner_image']['name']=$ldata['banner_image'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses/'.$ldata['banner_image'])){
							unlink(APPPATH.'../assets/front/uploads/courses/'.$ldata['banner_image']);
						}
						if ( ! $this->upload->do_upload('banner_image')){
							$error = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$last_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
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
			$existrow=$this->Dmodel->chk_num($this->table,array('title'=>$data['title'],'id !='=>$data['id'],'parent_id'=>$data['parent_id']));
			
			if($existrow==0){
				$data['updated_at']=datetime_now;
				$data['slug']=$this->slugify($data['title']);
				$islug=$data['slug'];
				$rec_id=$data['id'];
				$exec=$this->Dmodel->update_data($this->table,$rec_id,$data,'id');
				if(isset($_FILES)){
					$config['upload_path']          = APPPATH.'../assets/front/uploads/courses';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 10240;
					$config['max_height']           = 7680;
					$config['overwrite'] = TRUE;
					if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
						$filename=$_FILES['image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['image']=$rec_id.'-'.$islug.'.'.$ext;
						$_FILES['image']['name']=$ldata['image'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses'.$ldata['image'])){
							unlink(APPPATH.'../assets/front/uploads/courses'.$ldata['image']);
						}
						if ( ! $this->upload->do_upload('image')){
							$exec = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$rec_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
					}
					if(isset($_FILES['demo_gif']) && $_FILES['demo_gif']['tmp_name']){
						$filename=$_FILES['demo_gif']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['demo_gif']=$rec_id.'-'.$islug.'-demo.'.$ext;
						$_FILES['demo_gif']['name']=$ldata['demo_gif'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses/'.$ldata['demo_gif'])){
							unlink(APPPATH.'../assets/front/uploads/courses/'.$ldata['demo_gif']);
						}
						if ( ! $this->upload->do_upload('demo_gif')){
							$exec = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$rec_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
					}
					if(isset($_FILES['banner_image']) && $_FILES['banner_image']['tmp_name']){
						$filename=$_FILES['banner_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$ldata['banner_image']=$rec_id.'-'.$islug.'-banner_image.'.$ext;
						$_FILES['banner_image']['name']=$ldata['banner_image'];
						$this->load->library('upload', $config);
						if(file_exists(APPPATH.'../assets/front/uploads/courses/'.$ldata['banner_image'])){
							unlink(APPPATH.'../assets/front/uploads/courses/'.$ldata['banner_image']);
						}
						if ( ! $this->upload->do_upload('banner_image')){
							$exec = array('error' => $this->upload->display_errors());
						}
						else{
							$exec=$this->Dmodel->update_data($this->table,$rec_id,$ldata,'id');
							$data = array('upload_data' => $this->upload->data());
						}
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
			echo '<script>window.location = "'.$this->agent->referrer().'"</script>';
			// redirect($this->agent->referrer()) ;
		}
		
		public function toggleStatus(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		
		public function addFeatureRow(){
			if(isset($_POST['course_id']) && $_POST['course_id']>0){
				$course_id=$_POST['course_id'];
				$data['features']=$this->Dmodel->get_tbl_whr_arr('course_features',array('course_id'=>$course_id));
			}
			$data['title']=(isset($_POST['title']) ? $_POST['title'] :"");
			$data['icon']=(isset($_POST['icon']) ? $_POST['icon'] :"");
			$get_active=array('status'=>1);
			$data['icons']=$this->Dmodel->get_tbl_whr_arr('icons',$get_active);
			$this->load->view('admin/features_row', $data);
		}
		
		public function saveFeature(){
			$data=$_POST;
			if($data['id'] == 0){
				$whr_arr=array('course_id'=>$data['course_id'],'title'=>$data['title']);
				$chk_num=$this->Dmodel->chk_num('course_features',$whr_arr);
				if($chk_num == 0){
					$data['created_at']= datetime_now;
					$exec=$this->Dmodel->insertdata('course_features',$data);
				}
			} 
			else{
				$whr_arr=array('course_id'=>$data['course_id'],'title'=>$data['title'],'id !=' => $data['id']);
				$chk_num=$this->Dmodel->chk_num('course_features',$whr_arr);
				if($chk_num == 0){
					$data['updated_at']=datetime_now;
					$rec_id=$data['id'];
					$exec=$this->Dmodel->update_data('course_features',$rec_id,$data,'id');
				}
			}
			echo $exec;
		}
		
		public function delFeature(){
			$exec=$this->Dmodel->delete_rec($_POST['id'],'id','course_features');
			echo $exec;
		}
	}