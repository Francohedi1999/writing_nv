<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Pays_Model extends CI_MODEL
	{

	// ------------------------------------------------------------------------------- TABLE PAYS ----------------------------------------------------------------------------

		function find_all_pays()
		{
			$query = $this->db->query('select * from pays');
			$pays = $query->result_array();;
			return $pays;
		}
	}
?>