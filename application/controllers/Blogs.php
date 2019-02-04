<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Blogs extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
		}
		
		public function index(){
			$viewdata['blogs']=$this->Dmodel->get_tbl_whr_arr('posts',array('post_type'=>'blog','status'=>1));
			$this->LoadView('blogs',$viewdata);
		}
		
		public function detail($slug){
			$post=$this->Dmodel->get_tbl_whr_arr('posts',array('slug'=>'blog/'.$slug,'post_type'=>'blog','status'=>1));
			if(empty($post)){
				redirect(base_url());
			}
			$viewdata['post']=$post[0];
			$this->LoadView('blog-details',$viewdata);
		}
		
		public function page($slug){
			$post=$this->Dmodel->get_tbl_whr_arr('posts',array('slug'=>$slug,'post_type'=>'page'));
			if(empty($post)){
				redirect(base_url());
			}
			$viewdata['post']=$post[0];
			$this->LoadView('page',$viewdata);
		}
		
	}

