<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pricing extends CI_Model {
    function __construct() {
        parent::__construct();
    }
		
	function get_pricing($cat_id){	
		$this->db->select('p.id, c.title AS condition_title, m.title AS model_title, pr.title AS provider_title, s.title AS storage_title, p.price, p.status, p.created_at,p.updated_at');
		$this->db->from('pricing p');
		$this->db->join('conditions c', 'p.condition_id=c.id');
		$this->db->join('models m', 'p.model_id=m.id');
		$this->db->join('providers pr', 'p.provider_id=pr.id');
		$this->db->join('storage s', 'p.storage_id=s.id');
		$this->db->where('p.category_id', $cat_id);
		return $this->db->get()->result_array();
	}
		
	function chk_num($cdata,$id){	
		$this->db->where($cdata);
		$this->db->from('pricing');
		return $this->db->get()->num_rows();
	}
		
	function edit_data($id){	
		$this->db->select('c.title AS condition, m.title AS model, pr.title AS provider, s.title AS storage, p.price');
		$this->db->from('pricing p');
		$this->db->where('p.id',$id);
		$this->db->join('conditions c', 'p.condition_id=c.id');
		$this->db->join('models m', 'p.model_id=m.id');
		$this->db->join('providers pr', 'p.provider_id=pr.id');
		$this->db->join('storage s', 'p.storage_id=s.id');
		return $this->db->get()->result_array();
	}
}
?>