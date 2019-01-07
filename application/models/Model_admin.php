<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model {
    function __construct() {
        parent::__construct();
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
                $this->session->set_userdata('_admin',true);
                $this->session->set_userdata('admin_user_name',$user_name);
                $this->session->set_userdata('admin_id',$rows->id);
                $this->session->set_userdata('admin_email',$rows->email);
				return $rows->id;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
		
	function fpass($email,$string){
		$email_check=$this->db->get_where('users', array('email' => $email))->num_rows();
		if($email_check==1){
			$data=array('reset_token'=>$string);
			$this->Dmodel->update_data('users',$email,$data,'email');
			$maildata= array(
				'from'=>Site_Title.','.Site_Email,
				'to'=>$email,
				'subject'=>'Reset your Account Password.',
				'message'=>'We have received a request to reset your account password associated with this email address. If you have not placed this request, you can safely ignore this email and we assure you that your account is completely secure. 
				If you do need to change your Password, you can use this link: '
			);
			$this->Dmodel->send_mail($maildata);
		}
	}
	
	// function verifiybytoken($token){
		// $token_exist=$this->db->get_where('users', array('reset_token' => $token))->num_rows();
		// if($token_exist){
		// }
		// else{
			// return false;
		// }
	// }
	
	function get_order_to_details($odetailid){
		$this->db->select('order_details.*, orders.order_code', 'orders.id as orderid')
		->from('order_details')
		->join('orders', 'order_details.order_id = orders.id')
		->where('order_details.id',$odetailid);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	function get_recent(){
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('orders',10);
		return $query->result_array();
	}
	
	function get_counters(){
	  $counters['received']=$this->db->get_where('orders', array('status' => 'received'))->num_rows();
	  $counters['paid']=$this->db->get_where('orders', array('status' => 'paid'))->num_rows();
	  $counters['recycled']=$this->db->get_where('orders', array('status' => 'recycled'))->num_rows();
	  $counters['returned']=$this->db->get_where('orders', array('status' => 'returned'))->num_rows();
	  return $counters;
	}	
	
	function get_passed_trades(){
		$array = array('o.status' => 'received','od.action' => '1');
		$res2=array();
		$this->db->join('order_details od', 'o.id=od.order_id');
		$this->db->group_by("o.id"); 
		$res= $this->db->get_where('orders o', $array)->result_array();
		
		foreach($res as $row){
			$array = array('action !=' => '1', 'order_id'=>$row['id']);
			$num_res= $this->db->get_where('order_details', $array)->num_rows();
			if($num_res == 0){
				array_push($res2,$row);
			}
		}
		// print_r($res2); die;
		return $res2;
	}
}
?>