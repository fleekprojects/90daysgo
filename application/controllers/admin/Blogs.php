<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Blogs extends MY_Controller {
		
		var $table='blogs';
		var $pagetitle='Posts';
		var $viewname='admin/blogs';
		
		public function index(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$viewdata['records']=$this->Dmodel->get_tbl($this->table);
			$this->LoadAdminView($this->viewname,$viewdata);
		}
		
		public function AddNew(){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$this->LoadAdminView("admin/addBlog",$viewdata);
		}
		
		public function Edit($id){
			$this->Dmodel->checkLogin();
			$viewdata['title']=$this->pagetitle;
			$record=$this->Dmodel->get_tbl_whr($this->table,$id);
			$viewdata['rec']=$record[0];
			$this->LoadAdminView("admin/editBlog",$viewdata);
		}
		
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			if($this->Dmodel->IFExist($this->table,'title',$data['title'])){
				$data['created_at']=DateTime_Now;
				$data['slug']=$this->slugify($data['title']);
				if($data['post_type']=='blog'){
					$data['slug']='blog/'.$data['slug'];
				}
				$exec=$this->Dmodel->insertdata($this->table,$data);
				$last_id=$this->db->insert_id();
				if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
					$config['upload_path']          = APPPATH.'../assets/uploads/blogs';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 10240;
					$config['max_height']           = 7680;
					$filename=$_FILES['image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $data['title']));
					$ldata['image']=$last_id.'-blog.'.$ext;
					$_FILES['image']['name']=$ldata['image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/uploads/blogs/'.$ldata['image'])){
						unlink(APPPATH.'../assets/uploads/blogs/'.$ldata['image']);
					}
					if ( ! $this->upload->do_upload('image')){
						$exec = 3;
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
			if($this->Dmodel->IFExistEdit($this->table,'title',$data['title'],$data['id'])){
				$data['updated_at']=DateTime_Now;
				$exec=$this->Dmodel->update_data($this->table,$data['id'],$data,'id');
				if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
					$config['upload_path']          = APPPATH.'/../assets/uploads/blogs';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$filename=$_FILES['image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$lname=strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $data['title']));
					$ldata['image']=$data['id'].'-blog.'.$ext;
					$_FILES['image']['name']=$ldata['image'];
					$this->load->library('upload', $config);
					if(file_exists(APPPATH.'../assets/uploads/blogs/'.$ldata['image'])){
						unlink(APPPATH.'../assets/uploads/blogs/'.$ldata['image']);
					}
					if ( ! $this->upload->do_upload('image')){
						$exec = 3;
					}
					else{
						$exec=$this->Dmodel->update_data($this->table,$data['id'],$ldata,'id');
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
			redirect(base_url().'admin/posts') ;
		}
		
		public function toggleStatus(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		
		public function get_record(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->get_tbl_whr_row($this->table,$id);
			$rec=array('id'=>$data->id,'title'=>$data->title,'description'=>$data->description);
			echo json_encode($rec); 
		}
	}