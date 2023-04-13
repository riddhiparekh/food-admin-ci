<?php

class CommonModel extends CI_Model {
	function checkData($key, $value,$table)
	{
		$this->db->where($key,$value);
		return $this->db->get($table)->result_array();
	}
	function InsertData($data,$table)
	{
		return $this->db->insert($table,$data);
	}
	function updateData($cond,$data,$table)
	{
		$this->db->where($cond);
		return $this->db->update($table, $data);
	}
	function deleteData($cond,$table)
	{
		$this->db->where($cond);
		return $this->db->delete($table);
	}
	function getData($data,$table)
	{
		$this->db->where($data);
		return $this->db->get($table)->result_array();
	}
	function getSingleData($data,$table,$select = '*')
	{
		$this->db->select($select);
		$this->db->where($data);
		return $this->db->get($table)->row_array();
	}
	function batchInsert($table,$data)
	{
		return $this->db->insert_batch($table,$data);
	}
	function getDataCount($cond,$table,$join = array())
	{
		if(count($join)){
			foreach($join as $j){
				if(@$j['type'] == ''){
					$this->db->join($j['table'],$j['on']);
				}
				else{
					$this->db->join($j['table'],$j['on'],$j['type']);
				}	
			}
			
		}
		$this->db->where($cond);
		return $this->db->from($table)->count_all_results();
	}
	function getWithJoinData($cond,$table,$join = array(),$rand = NULL,$limit = 0)
	{
		if(count($join)){
			foreach($join as $j){
				if(@$j['type'] == ''){
					$this->db->join($j['table'],$j['on']);
				}
				else{
					$this->db->join($j['table'],$j['on'],$j['type']);
				}	
			}
		}
		$this->db->where($cond);
		if($rand){
			$this->db->order_by('rand()');
		}
		if($limit){
			$this->db->limit($limit);
		}
		return $this->db->get($table)->result_array();
	}
	function getSortedData($data,$table,$sortby = 'created_at',$order = 'DESC')
	{
		$this->db->where($data);
		$this->db->order_by($sortby,$order);
		return $this->db->get($table)->result_array();
	}
	function getSelData($select,$cond,$table,$result_in = 'array')
	{
		$this->db->select($select);
		$this->db->where($cond);
		$query = $this->db->get($table);
		if ($result_in == 'array') {
			return $query->result_array();
		}
		return $query->result();
	}
	function getLimitedData($cond,$table,$limit,$offset)
	{
		$this->db->where($cond);
		$this->db->limit($limit,$offset);
		return $this->db->get($table)->result_array();
	}
	function getLastLimData($cond,$table,$limit,$offset)
	{
		$this->db->where($cond);
		$this->db->order_by('created_at','DESC');
		$this->db->limit($limit,$offset);
		return $this->db->get($table)->result_array();
	}
	function datatableQueryBuilder($data,$result_type = 'array',$join = array())
	{
		if (!isset($data['table'])) {
			return array();
		}
		if (!isset($data['select'])) {
			$data['select'] = '*';
		}
		if (!isset($data['limit'])) {
			$data['limit'] = 10;
		}
		if (!isset($data['offset'])) {
			$data['offset'] = 0;
		}
		if (!isset($data['order_by'])) {
			$data['order_by'] = 'created_at';
		}
		if (!isset($data['order_dir'])) {
			$data['order_dir'] = 'asc';
        }
        if($result_type != 'count') {
            $this->db->select($data['select']);
        }
		
		if (isset($data['condition']) && is_array($data['condition']) && count($data['condition'])) {
			$this->db->where($data['condition']);
		}
		if(count($join)){
			foreach($join as $j){
				if(@$j['type'] == ''){
					$this->db->join($j['table'],$j['on']);
				}
				else{
					$this->db->join($j['table'],$j['on'],$j['type']);
				}	
			}
		}
		if ($result_type != 'count') {
			$this->db->order_by($data['order_by'],$data['order_dir']);
			$this->db->limit($data['limit'],$data['offset']);
		}
        $query = $this->db->from($data['table']);
        if ($result_type == 'count') {
			return $query->count_all_results();
        }
        $query = $query->get();
		if ($result_type == 'array') {
			return $query->result_array();
		}
		return $query->result();
	}

}