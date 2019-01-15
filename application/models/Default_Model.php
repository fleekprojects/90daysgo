<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Default_Model extends CI_Model {

		function __construct() {
			parent::__construct();
			$set= $this->db->get('settings')->row();
			define('site_title',$set->site_title);
			define('site_admin_title',$set->site_admin_title);
			define('site_email',$set->site_email);
			define('site_contact',$set->site_contact);
			define('site_address',$set->site_address);
			define('site_url',$set->site_url);
			define('site_logo',$set->site_logo);
			define('site_timezone',$set->site_timezone);
			date_default_timezone_set($set->site_timezone);
			define('smtp_host',$set->smtp_host);
			define('smtp_email',$set->smtp_email);
			define('smtp_password',$set->smtp_password);
			define('smtp_port',$set->smtp_port);
			define('facebook',$set->facebook);
			define('twitter',$set->twitter);
			define('date_now',date('Y-m-d'));
			define('time_now',date('H:i:s'));
			define('datetime_now',date('Y-m-d H:i:s'));
		}
		
		function checkLogin(){
			if(!$this->session->userdata('admin_id') || !$this->session->userdata('admin_user_name')){
				redirect(base_url().'admin/');
			}
		}
		function checkUserLogin(){
			if(!$this->session->userdata('user_id') || !$this->session->userdata('user_name')){
				redirect(base_url().'login');
			}
			
		}
		
		function get_tbl($tbl){
			$query = $this->db->get($tbl);
			return $query->result_array();
		}
		
		function get_tbl_whr($tbl,$id){	
			$query = $this->db->get_where($tbl, array('id' => $id));
			return $query->result_array();
		}
		
		function get_tbl_whr_arr($tbl,$arr){	
			$query = $this->db->get_where($tbl, $arr);
			return $query->result_array();
		}
		
		function get_tbl_whr_in($tbl,$key,$arr){	
			$this->db->where_in($key, $arr);
			$query = $this->db->get($tbl);
			return $query->result_array();
		}
		
		function insertdata($tbl,$data){
			$query = $this->db->insert($tbl,$data);
			return $query;
		}
		
		function update_data($tbl,$id,$data,$key){	
			$this->db->where($key, $id);
			$query = $this->db->update($tbl,$data);
		
			return $query;
		}
		
		function toggle_status($tbl,$id){		
			$query =$this->db->query('UPDATE '.$tbl.' SET status = IF(status=1, 0, 1) WHERE id='.$id);
			return $query;
		}
		
		function delete_rec($id,$whr_key, $table) {
			$this->db->where($whr_key, $id);
			if ($this->db->delete($table)) {
				return true;
			} 
			else {
				return false;
			}
		}
		function delete_multi_rec($arr,$whr_key, $table) {
			$this->db->where_in($whr_key, $arr);
			if ($this->db->delete($table)) {
				return true;
			} 
			else {
				return false;
			}
		}
		
		function get_data($qry){
			$query = $this->db->query($qry);
			if(($query->num_rows()) > 0){
				return $query->result_array();
			}
			else{
				return 0;
			}
		}
		
		function get_tbl_whr_row($tbl,$id){	
			$this->db->where('id', $id);
			$query = $this->db->get($tbl);
			return $query->row();
		}
		
		function get_table_where($sdata, $table, $id){
			$this->db->select($sdata);
			$this->db->where('id',$id);
			$query  = $this->db->get($table);
			$result = $query->result_array();
			return $result;
		}
		
		function send_mail($maildata){
			$config = array(
				'protocol' => 'mail',
				'smtp_host' => smtp_host,
				'smtp_port' => smtp_port,
				'smtp_user' => smtp_email,
				'smtp_pass' => smtp_password,
				'wordwrap' => TRUE
			);
			$this->load->library('email', $config);
			$this->email->from($maildata['from_email'],$maildata['from_name']);
			$this->email->to($maildata['to_email'],$maildata['to_name']);
			$this->email->subject($maildata['subject']);
			$this->email->message($maildata['message']);
			$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
			$this->email->set_header('Content-type', 'text/html');
			
			if($this->email->send()) {
				return 1;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}
		
		
		function IFExist($table,$Column,$value) {
			$query = $this->db->get_where($table, array($Column => $value))->num_rows();

			return $query == 0 ? true : false;
			
		}
		
		function IFExistEdit($table,$Column,$value,$id) {
			$query = $this->db->get_where($table, array($Column => $value , 'id !=' => $id ))->num_rows();
			return $query == 0 ? true : false;
		}
		
		function chk_num($tbl,$chkdata){	
			$this->db->where($chkdata);
			$this->db->from($tbl);
			return $this->db->get()->num_rows();
		}
		
	}

?>