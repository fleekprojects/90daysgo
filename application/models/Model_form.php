<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_form extends CI_Model {
    function __construct() {
        parent::__construct();
    }
		
	function ret_id($tbl,$slug){
		$this->db->select('id, title, slug');
		$res=$this->db->get_where($tbl, array('slug' => $slug))->result_array();
		return $res;
	}
	function get_home_blogs(){
		$this->db->limit(6);
		$query = $this->db->get_where('blogs', array('status'=>1, 'post_type'=>'blog'));
		return $query->result_array();
	}	
	function get_home_course_men(){
		$this->db->limit(2);
		$query = $this->db->get_where('courses', array('courses.status'=>1,'parent_id'=>1));
		return $query->result_array();
	}
	function get_home_course_men_id_not($slug){

		$this->db->limit(2);
		$this->db->where('title !=',$slug);
		$query = $this->db->get_where('courses', array('courses.status'=>1,'parent_id'=>1));
		
		return $query->result_array();
	}
	function get_home_course_women(){
		$this->db->limit(2);
		$query = $this->db->get_where('courses', array('courses.status'=>1,'parent_id'=>2));
		return $query->result_array();
	}
	function get_home_course_women_id_not($slug){
		$this->db->limit(2);
		$this->db->where('title !=',$slug);
		$query = $this->db->get_where('courses', array('courses.status'=>1,'parent_id'=>2));
		return $query->result_array();
	}
	function get_courses_limit_whr_parentid($lim,$pid,$id){
		$this->db->limit($lim);
		$this->db->where("id !=",$id);
		$query = $this->db->get_where('courses', array('courses.status'=>1,'parent_id'=>$pid));
		return $query->result_array();
	}

		function login($data){
			
        $user_name = $data['user_name'];     
		$password = $data['password']; 
		$remember=$data['remember_me'];
		

		
		if($remember == "on"){
			$cookie = array(
				'name'   => 'user_name',
				'value'  => $user_name,                            
				'expire' => '2147483647',                                                               
				'secure' => TRUE
			);
		    $this->input->set_cookie($cookie);   
			$cookie = array(
				'name'   => 'password',
				'value'  => $password,                            
				'expire' => '2147483647',                                                               
				'secure' => TRUE
			);
			
		    $this->input->set_cookie($cookie);
		}
		$this->db->where('user_name',$user_name);
		$this->db->or_where('email',$user_name); 
		$query = $this->db->get('users');

        if($query->num_rows() == 1){
            $rows = $query->row();
            if($rows->password == $password){
				if($rows->status != 1){
				return 2;
				}else{
                $this->session->set_userdata('_user',true);
                $this->session->set_userdata('user_name',$rows->user_name);
                $this->session->set_userdata('user_id',$rows->id);
                $this->session->set_userdata('user_email',$rows->email);
				return $rows->id;
				}
            }
			
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
	
	function get_models($cat_id){	
		$this->db->distinct();
		$this->db->select('m.title, m.slug, m.image');
		$this->db->join('models m', 'p.model_id=m.id');
		$this->db->join('providers pr', 'p.provider_id=pr.id');
		$this->db->join('storage s', 'p.storage_id=s.id');
		$this->db->join('conditions c', 'p.condition_id=c.id');
		$query = $this->db->get_where('pricing p', array('p.category_id'=>$cat_id, 'p.status'=>1, 'pr.status'=>1, 's.status'=>1, 'c.status'=>1, 'm.status'=>1));
		return $query->result_array();
	}
		
	function get_providers($model_id){	
		$this->db->distinct();
		$this->db->select('pr.title, pr.slug, pr.logo');
		$this->db->join('providers pr', 'p.provider_id=pr.id');
		$query = $this->db->get_where('pricing p', array('p.model_id'=>$model_id, 'p.status'=>1, 'pr.status'=>1));
		return $query->result_array();
	}
		
	function get_storage($mod_id,$pro_id){	
		$this->db->distinct();
		$this->db->select('s.title, s.slug');
		$this->db->join('storage s', 'p.storage_id=s.id');
		$query = $this->db->get_where('pricing p', array('p.model_id'=>$mod_id, 'p.provider_id'=>$pro_id, 'p.status'=>1, 's.status'=>1));
		return $query->result_array();
	}
		
	function get_condition($mod_id,$pro_id,$sto_id){	
		$this->db->distinct();
		$this->db->select('c.title, c.slug, c.id');
		$this->db->join('conditions c', 'p.condition_id=c.id');
		$query = $this->db->get_where('pricing p', array('p.model_id'=>$mod_id, 'p.provider_id'=>$pro_id, 'p.storage_id'=>$sto_id, 'p.status'=>1, 'c.status'=>1));
		return $query->result_array();
	}
		
	function get_product($pid){	
		$this->db->select('p.id, m.title, m.slug, p.price, c.title AS condition, s.title AS storage, pr.title AS provider');
		$this->db->join('models m', 'p.model_id=m.id');
		$this->db->join('conditions c', 'p.condition_id=c.id');
		$this->db->join('storage s', 'p.storage_id=s.id');
		$this->db->join('providers pr', 'p.provider_id=pr.id');
		$query = $this->db->get_where('pricing p', array('p.id'=>$pid));
		return $query->result_array()[0];
	}
		
	function get_tbl_whr_key_row($tbl,$key,$value){	
		$this->db->where($key, $value);
			$query = $this->db->get($tbl);
			return $query->row();
	}function get_tbl_whr_key_arr($tbl,$arr){	
		$query=$this->db->get_where($tbl, $arr);
			return $query->row();
	}
	function get_nextcourseplan($dayno,$weekid){	
		$this->db->where('day_no >',$dayno);
		$this->db->where('week_id',$weekid);
		$this->db->order_by('day_no', 'ASC');
		$this->db->limit(1);
			$query = $this->db->get('course_plan');
			return $query->row();
	}
	function update_total($oid){	
		$this->db->select_sum('subtotal');
		$order_total= $this->db->get_where('order_details',array('order_id' => $oid))->row();
		
		$this->db->set('amount', $order_total->subtotal);
		$this->db->where('id', $oid);
		$this->db->update('orders');
		return true;
	}
		
	function search_order($keywords){
		$this->db->select('order_code,label_url,tracking_url,created_at,status');
		$this->db->where('order_code', $keywords);
		$this->db->or_where('email', $keywords); 
		$this->db->order_by('id', 'DESC'); 
		$orders= $this->db->get('orders')->result_array();
		return $orders;
	}

	function insertdatatoid($tbl,$data){
			 $this->db->insert($tbl,$data);
			 $query=$this->db->insert_id();
			 return $query;
	}
	
	function get_tbl_whr_arr_limit($tbl,$arr,$lim){
					$this->db->limit($lim);	
			$query = $this->db->get_where($tbl, $arr);
			return $query->result_array();
	}
	function get_order_courses($userid){	
		
			$this->db->select('c.*,p.slug as pslug');
			$this->db->from('orders as o');
			$this->db->join('courses as c', 'c.id = o.course_id');
			$this->db->join('parents as p', 'p.id = c.parent_id');
			$this->db->where('o.user_id',$userid);
			$this->db->where('o.transaction_status',1);
			
			$query = $this->db->get();
 
			return $query->result_array();
	}
	function get_feature_icon_whr_in($cid){	
		
			$this->db->select('f.*,c.title AS icon,c.image');
			$this->db->from('course_features as f');
			$this->db->join('icons as c', 'c.title = f.icon','left');
			$this->db->where('f.course_id', $cid);
			$query = $this->db->get(); 
			return $query->result_array();
	}	
	function get_order_by_users(){	
		
			$this->db->select('o.*,u.user_name,u.email');
			$this->db->from('orders as o');
			$this->db->join('users as u', 'o.user_id = u.id','left');
			$query = $this->db->get(); 
			return $query->result_array();
	}
	function get_tbl_whr_arr_orderby($tbl,$arr,$orderby){
				$this->db->order_by($orderby,'asc');	
			$query = $this->db->get_where($tbl, $arr);
			return $query->result_array();
		}
	
		
	
   
}
?>