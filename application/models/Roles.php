<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Model {
	
	private $table_name = "role";
	private $field_sort = "name";
	
	public function __construct()
	{
        parent::__construct();
    }
	
	public function all_source($where=NULL)
	{
		if($where){
			$this->db->where($where);
		}
        $this->db->order_by($this->field_sort, 'ASC');
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
}