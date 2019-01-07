<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ship extends CI_Model {
    function __construct() {
        parent::__construct();
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
}
?>