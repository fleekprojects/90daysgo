<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('Model_form','m_form');
			$this->load->library('user_agent');
			$this->load->library('cart'); 
			$this->load->library('session'); 
		}
		
		public function index(){
			$this->Dmodel->checkUserLogin();
			$userid=$this->session->userdata('user_id');
			$userorders=$this->m_form->get_tbl_whr_key_row('orders','user_id',$userid);
			$viewdata['coursedetails']=$this->m_form->get_tbl_whr_key_row('courses','title',$userorders->course_name);
			$courarr=array('course_id'=>$viewdata['coursedetails']->id);
			$viewdata['weeks']=$this->Dmodel->get_tbl_whr_arr('course_weeks',$courarr);

			$viewdata['courseplans']=$this->Dmodel->get_tbl_whr_arr('course_plan',array('week_id'=>$viewdata['weeks'][0]['id']));
			


			

			$this->LoadView('dashboard',$viewdata);
		}
		public function thankyou()
		{

			if(count($this->cart->contents()) > 0):
				$this->cart->destroy();
				$this->session->unset_userdata('code');
			 $viewdata="";
			 $this->LoadView('thankyou',$viewdata);
			else:
             redirect(base_url());
			endif;

		}
		public function weekShow()
		{
			$data=$_POST;
			$weekarr=array('week_id'=>$data['weekid']);
			$courseplans=$this->Dmodel->get_tbl_whr_arr('course_plan',$weekarr);
			$html="";
			foreach($courseplans as $courseplan){
				$html .='	<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday ">
					<div class="_week_day_inner">						<a href="'.base_url().'dashboard-workout/'.$courseplan['slug'].'">';
							if($courseplan['day_no']==1):
							$html .='<span class="_week_day_title">Monday</span>';
							elseif($courseplan['day_no']==2):
							$html .='<span class="_week_day_title">Tuesday</span>';
							elseif($courseplan['day_no']==3):
							$html .='<span class="_week_day_title">Wednesday</span>';
							elseif($courseplan['day_no']==4):
							$html .='<span class="_week_day_title">Thursday</span>';
							elseif($courseplan['day_no']==5):
							$html .='<span class="_week_day_title">Friday</span>';
							elseif($courseplan['day_no']==6):
							$html .='<span class="_week_day_title">Saturday</span>';
							else:
							$html .='<span class="_week_day_title">Sunday</span>';
							endif;	

							$html .='<span class="_week_day_workout">'.$courseplan['title'].'</span>						</a></div></div>';


					}
					echo $html;



		}
		
		
	}

