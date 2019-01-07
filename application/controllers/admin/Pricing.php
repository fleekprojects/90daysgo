<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pricing extends My_Controller {
	
		var $table='pricing';
		var $pagetitle='Pricing';
		var $viewname='admin/pricing';

		function __construct() {
			parent::__construct();
			$this->load->model('Model_pricing','p_model');
		}
		
		public function index(){
			$this->Dmodel->checkLogin();
			$cat_id=(isset($_GET['category']) ? $_GET['category']: 0);
			if($this->Dmodel->IFExist('categories','id',$cat_id)){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Invalid Category.</b>
				</div>'); 
				redirect(base_url().'admin/categories') ;
			}
			else{
				$viewdata['title']=$this->pagetitle;
				$viewdata['category']=$this->Dmodel->get_tbl_whr('categories',$cat_id);
				$viewdata['records'] = $this->p_model->get_pricing($cat_id);
				$this->LoadAdminView($this->viewname,$viewdata);
			}
		}
		public function AddRecord(){
			$this->Dmodel->checkLogin();
			$exec=2;
			$data=$_POST;
			$arrlen=count($data['price']);
			for($i=0; $i<$arrlen; $i++){
			  foreach($data as $key => $val){
				$arrdata[$key]=$val[$i];
			  }
			  $checkdata=$arrdata;
			  unset($checkdata['price']);
			  $chknum=$this->db->get_where($this->table, $checkdata)->num_rows();
			  if($chknum==0){
				$arrdata['created_at']=DateTime_Now;
				$exec=$this->Dmodel->insertdata($this->table,$arrdata);
			  }
			}
			echo $exec;
		}
		
		public function EditRecord(){
			$this->Dmodel->checkLogin();
			$data=$_POST;
			unset($_POST['id'],$_POST['price']);
			$cdata=$_POST;
			$this->db->where('id !=', $data['id']);
			$chknum=$this->db->get_where($this->table, $cdata)->num_rows();
			if($chknum==0){
				$data['updated_at']=DateTime_Now;
				$exec=$this->Dmodel->update_data($this->table,$data['id'],$data,'id');
				$pdata=$this->p_model->edit_data($data['id']);
				$edata=array('success'=>$exec,'data'=>$pdata);
				echo json_encode($edata);
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
			//redirect($this->agent->referrer()) ;
		}
		
		public function toggleStatus(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->toggle_status($this->table,$id);
			echo $data; 
		}
		
		public function addPricingRow(){
			$data['cid']=$_POST['cat_id'];
			$data['mid']=(isset($_POST['mid']) ? $_POST['mid'] :"");
			$data['pid']=(isset($_POST['pid']) ? $_POST['pid'] :"");
			$data['sid']=(isset($_POST['sid']) ? $_POST['sid'] :"");
			$data['coid']=(isset($_POST['coid']) ? $_POST['coid'] :"");
			$get_active=array('Status'=>1);
			$data['condition']=$this->Dmodel->get_tbl_whr_arr('conditions',$get_active);
			$data['providers']=$this->Dmodel->get_tbl_whr_arr('providers',$get_active);
			$data['storage']=$this->Dmodel->get_tbl_whr_arr('storage',$get_active);
			$data['models']=$this->Dmodel->get_tbl_whr_arr('models',array('category_id'=>$data['cid'],'Status'=>1));
			$this->load->view('admin/pricing_row', $data);
		}
		
		public function editPricingRow(){
			$data['cid']=$_POST['cat_id'];
			$id=$_POST['id'];
			$get_active=array('Status'=>1);
			$data['conditions']=$this->Dmodel->get_tbl_whr_arr('conditions',$get_active);
			$data['providers']=$this->Dmodel->get_tbl_whr_arr('providers',$get_active);
			$data['storages']=$this->Dmodel->get_tbl_whr_arr('storage',$get_active);
			$data['models']=$this->Dmodel->get_tbl_whr_arr('models',array('category_id'=>$data['cid'],'Status'=>1));
			$data['pricing']=$this->Dmodel->get_tbl_whr($this->table,$id);
			$this->load->view('admin/pricing_row', $data);
		}
	}