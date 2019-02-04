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
			$whr_arr=array('user_id'=>$userid);
			$chk_num=$this->Dmodel->chk_num('orders',$whr_arr);

			if($chk_num >0):
				
				$viewdata['ordercourses']=$this->m_form->get_order_courses($userid);
				
				

			else:
				redirect(base_url());
			endif;	
			
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
			$i=0;
			foreach($courseplans as $courseplan){
				?>
				<script type="text/javascript">
					$( document ).ready(function() {
					worout_finished('1','<?=$courseplan['day_no']?>','<?=$this->session->userdata('user_id')?>','<?=$courseplan['course_id']?>','<?=$courseplan['slug']?>','wk<?=$i?>');
					});	
				</script>
				<?php
				$html .='	<div id="wk'.$i++.'" class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday ">
					<div class="_week_day_inner">						
					<a class="chk_week_day" weekid="'.$data['weekid'].'" dayno="'.$courseplan['day_no'].'" userid="'.$this->session->userdata('user_id').'" coursid="'.$courseplan['course_id'].'" slg="'.$courseplan['slug'].'" href="javascript:void(0);">';
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
		public function check_workout()
		{
			$data=$_POST;
			$courseplans=$this->Dmodel->check_data_workout($data);
		}
		public function check_workout_finished()
		{
			$data=$_POST;
			$courseplans=$this->Dmodel->check_data_workout_finished($data);
		}
		public function weekdetails()
		{
			$data=$_POST;
			$weeks=$this->m_form->get_tbl_whr_key_row('course_weeks','id',$data['weekid']);						echo $weeks->content;
			
		}		
		
		
	}

