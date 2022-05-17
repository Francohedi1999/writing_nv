<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Info_user_Model extends CI_MODEL
{
	// ---------------------------------------------------------------------------- TABLE INFO_USER -----------------------------------------------------------------

	function insert_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user)
	{
		$sql = " insert into info_user(nom_entreprise , adresse , id_pays , ville , region , num_TVA , code_postal , id_user) values('%s' , '%s' , %d , '%s' , '%s' , '%s' , '%s' , %d) ";
		$sql = sprintf($sql , $nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
		$this->db->query($sql);
	}

	function update_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user)
	{
		$sql = " update info_user set nom_entreprise = '%s' , adresse = '%s' , id_pays = %d , ville = '%s' , region = '%s' , num_TVA = '%s' , code_postal = '%s' where id_user = %d ";
		$sql = sprintf($sql , $nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
		$this->db->query($sql);
	}


	// ---------------------------------------------------------------------------- VIEW INFORMATIONS_USER -----------------------------------------------------------------

	function find_info_user_by_id_user($id_user)
	{
		$sql = ' select * from informations_user where id_user = %d ';
		$sql = sprintf($sql , $id_user);
		$query = $this->db->query($sql);
		$info_user = $query->row_array();
		return $info_user;
	}
}
?>