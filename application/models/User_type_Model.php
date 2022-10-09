<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_type_Model extends CI_MODEL
{
	function find_all_user_type()
	{
		$sql = ' select * from user_type where id_user_type = 2 or id_user_type = 3 ';
		$query = $this->db->query($sql);
		$user_type = $query->result_array();
		return $user_type;
	}
}
?>