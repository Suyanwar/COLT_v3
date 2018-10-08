<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {
	
	private $table_name = "admin";
	private $primary_key = "admin_id";
	private $field_search = array('full_name', 'username', 'name');
	private $limit_rows = 10;
	
	private $table_join = "role";
	private $field_join = "role_id";
	
	public function __construct()
	{
        parent::__construct();
    }
	
	public function get_limit()
	{
		return $this->limit_rows;
    }
	
	public function get_no($page)
	{
		return (($this->limit_rows * $page) - $this->limit_rows) + 1;
    }
	
	public function restrict_item($where, $id=NULL)
	{
		if($id){
			$where = array_merge($where, array(
				$this->primary_key.'<>' => $id
			));
		}
		$this->db->where($where);
		$query = $this->db->get($this->table_name);
		return $query->result_id->num_rows;
	}
	
	public function source($id)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->join($this->table_join, "{$this->table_name}.{$this->field_join} = {$this->table_join}.{$this->field_join}");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	public function get_source($page, $search=NULL, $where=NULL)
	{
		if($search){
			$where = $this->search_role($search);
			$this->db->where("($where)");
		}
		if($where){
			$this->db->where($where);
		}
        $this->db->order_by($this->primary_key, 'DESC')->limit($this->limit_rows, pagination_offset($page, $this->limit_rows));
		$this->db->join($this->table_join, "{$this->table_name}.{$this->field_join} = {$this->table_join}.{$this->field_join}");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	public function paging_source($search=NULL, $where=NULL)
	{
		if($search){
			$where = $this->search_role($search);
			$this->db->where("($where)");
		}
		if($where){
			$this->db->where($where);
		}
		$this->db->join($this->table_join, "{$this->table_name}.{$this->field_join} = {$this->table_join}.{$this->field_join}");
		$query = $this->db->get($this->table_name);
		return $query->result_id->num_rows;
	}
	
	public function search_role($key)
	{
		$i = 0;
		$where = NULL;
		$keyword = str_replace(array(' ', "'"), array('%', "''"), $key);
		foreach($this->field_search as $field){
			if($i){
				$where .= " OR ";
			}
			$where .= "`$field` LIKE '%$keyword%'";
			$i=1;
		}
		return $where;
	}
	
	public function create_source($data)
	{
		$this->db->insert($this->table_name, $data);
		return true;
	}
	
	public function update_source($data, $id)
	{
		$this->db->update($this->table_name, $data, array($this->primary_key => $id));
		return true;
	}
	
	public function delete_source($id)
	{
		$this->db->delete($this->table_name, array($this->primary_key => $id));
		return false;
	}
}