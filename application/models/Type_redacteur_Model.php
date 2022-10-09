<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Type_redacteur_Model extends CI_MODEL
{

	// ------------------------------------------------------------ TABLE TYPE_REDACTEUR ---------------------------------------------------------------------------------

	function find_all_type_redacteur()
	{
		$query = $this->db->query(' select * from type_redacteur');
		$type_redacteurs = $query->result_array();
		return $type_redacteurs;
	}

}
?>