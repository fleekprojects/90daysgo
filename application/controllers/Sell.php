<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sell extends MY_Controller {
		public function __construct(){
			parent::__construct();
			
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){
			$get_active=array('Status'=>1);
			$viewdata['categories']=$this->Dmodel->get_tbl_whr_arr('categories',$get_active);
			$this->LoadView('sell',$viewdata);
		}
		
		public function models($slug){
			$data=$this->m_form->ret_id('categories',$slug);
			if(empty($data)){
				redirect($this->agent->referrer()) ;
			}
			else{
				$viewdata['models']=$this->m_form->get_models($data[0]['id']);
				$viewdata['slug']=$slug;
				$viewdata['cat_title']=$data[0]['title'];
				$viewdata['cat_slug']=$data[0]['slug'];
				$this->LoadView('models',$viewdata);
			}
		}
		
		public function providers($cat,$slug){
			$cdata=$this->m_form->ret_id('categories',$cat);
			$data=$this->m_form->ret_id('models',$slug);
			if(empty($cdata) || empty($data)){
				redirect($this->agent->referrer()) ;
			}
			else{
				$viewdata['providers']=$this->m_form->get_providers($data[0]['id']);
				$viewdata['slug']=$slug;
				$viewdata['cat_title']=$cdata[0]['title'];
				$viewdata['cat_slug']=$cdata[0]['slug'];
				$viewdata['mod_title']=$data[0]['title'];
				$viewdata['mod_slug']=$data[0]['slug'];
				$this->LoadView('providers',$viewdata);
			}
		}
		
		public function storage($cat,$mod,$slug){
			$cdata=$this->m_form->ret_id('categories',$cat);
			$mdata=$this->m_form->ret_id('models',$mod);
			$data=$this->m_form->ret_id('providers',$slug);
			if(empty($cdata) || empty($mdata) || empty($data)){
				redirect($this->agent->referrer()) ;
			}
			else{
				$viewdata['storage']=$this->m_form->get_storage($mdata[0]['id'],$data[0]['id']);
				$viewdata['slug']=$slug;
				$viewdata['cat_title']=$cdata[0]['title'];
				$viewdata['cat_slug']=$cdata[0]['slug'];
				$viewdata['mod_title']=$mdata[0]['title'];
				$viewdata['mod_slug']=$mdata[0]['slug'];
				$viewdata['pro_title']=$data[0]['title'];
				$viewdata['pro_slug']=$data[0]['slug'];
				$this->LoadView('storage',$viewdata);
			}
		}
		
		public function condition($cat,$mod,$pro,$slug){
			$cdata=$this->m_form->ret_id('categories',$cat);
			$mdata=$this->m_form->ret_id('models',$mod);
			$pdata=$this->m_form->ret_id('providers',$pro);
			$data=$this->m_form->ret_id('storage',$slug);
			if(empty($cdata) || empty($mdata) || empty($pdata) || empty($data)){
				redirect($this->agent->referrer()) ;
			}
			else{
				$viewdata['condition']=$this->m_form->get_condition($mdata[0]['id'],$pdata[0]['id'],$data[0]['id']);
				$viewdata['cdata']=$cdata[0];
				$viewdata['mdata']=$mdata[0];
				$viewdata['pdata']=$pdata[0];
				$viewdata['data']=$data[0];
				$viewdata['slug']=$slug;
				$this->LoadView('condition',$viewdata);
			}
		}
		
		public function get_crecord(){
			$id=$this->input->post('id');
			$data=$this->Dmodel->get_tbl_whr_row('conditions',$id);
			$rec=array('description'=>$data->description);
			echo json_encode($rec); 
		}
		
		public function get_pricing(){
			$arr_pri['model_id']=$this->input->post('mod_id');
			$arr_pri['provider_id']=$this->input->post('pro_id');
			$arr_pri['storage_id']=$this->input->post('sto_id');
			$arr_pri['condition_id']=$this->input->post('con_id');
			$arr_pri['status']=1;
			$data=$this->Dmodel->get_tbl_whr_arr('pricing',$arr_pri);
			$rec=array('pricing'=>$data[0]['price'],'pid'=>$data[0]['id']);
			echo json_encode($rec); 
		}
	}

