<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Model {
	
	private $table_name = "account";
	private $primary_key = "account_id";
	private $field_sort = "socmed";
	private $field_search = array('username', 'name');
	private $limit_rows = 10;
	
	private $table_join = "account_competitor";
	private $field_join = "main_account";
	
	private $table_join1 = "account_role";
	private $field_join1 = "role_id";
	
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
	
	public function restrict_role($role, $id)
	{
		$this->db->where(array(
			$this->field_join1 => $role,
			$this->primary_key => $id
		));
		$query = $this->db->get($this->table_join1);
		return $query->result_id->num_rows;
	}
	
	public function all_competitor($id, $where=NULL)
	{
		if($where){
			$this->db->where($where);
		}
		$this->db->select("{$this->table_name}.*, IFNULL({$this->table_join}.{$this->field_join}, 0) AS competitor")->order_by("{$this->table_name}.name", 'ASC');
		$this->db->join($this->table_join, "{$this->table_name}.{$this->primary_key} = {$this->table_join}.{$this->primary_key} AND {$this->table_join}.{$this->field_join} = $id", 'left');
		$query = $this->db->get($this->table_name);
		return $query->result();
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
	
	public function role_source($where=NULL)
	{
		if($where){
			$this->db->where($where);
		}
        $this->db->select("{$this->table_name}.*")->join($this->table_name, "{$this->table_join1}.{$this->primary_key} = {$this->table_name}.{$this->primary_key}")->where($this->field_join1, $this->auth->session('role'))->order_by("{$this->table_name}.name", 'ASC');
		$query = $this->db->get($this->table_join1);
		return $query->result();
	}
	
	public function source($id, $where=NULL)
	{
		if($where){
			$this->db->where($where);
		}
		$this->db->where($this->primary_key, $id);
		$query = $this->db->get($this->table_name);
		return $query->row();
	}
	
	public function get_source($page, $search=NULL)
	{
		if($search){
			$where = $this->search_role($search);
			$this->db->where("($where)");
		}
        $this->db->order_by($this->primary_key, 'DESC')->limit($this->limit_rows, pagination_offset($page, $this->limit_rows));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	public function paging_source($search=NULL)
	{
		if($search){
			$where = $this->search_role($search);
			$this->db->where("($where)");
		}
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
	
	public function create_competitor($data)
	{
		$this->db->insert($this->table_join, $data);
		return true;
	}
	
	public function delete_competitor($id)
	{
		$this->db->delete($this->table_join, array($this->field_join => $id));
		return false;
	}
}