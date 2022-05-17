<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Type_paiement_Model extends CI_MODEL
{

	// ------------------------------------------------------------ TABLE TYPE_PAIEMENT ---------------------------------------------------------------------------------

	function find_all_type_paiement_active()
	{
		$query = $this->db->query(' select * from type_paiement where active = 1 order by id_type_paiement desc');
		$type_paiements = $query->result_array();
		return $type_paiements;
	}

	function find_all_type_paiement()
	{
		$query = $this->db->query(' select * from type_paiement order by id_type_paiement desc');
		$type_paiements = $query->result_array();
		return $type_paiements;
	}

	function insert_type_paiement($type_paiement , $desc_type_paiement)
	{
		$sql = " insert into type_paiement(type_paiement , desc_type_paiement) values( '%s' , '%s' ) ";
		$sql = sprintf($sql , str_replace( "'" , "''" , $type_paiement) , str_replace( "'" , "''" , $desc_type_paiement));
		$this->db->query($sql);
	}

	function update_type_paiement($type_paiement , $desc_type_paiement , $id_type_paiement)
	{
		$sql = " update type_paiement set type_paiement = '%s' , desc_type_paiement = '%s' where id_type_paiement = %d ";
		$sql = sprintf($sql , str_replace( "'" , "''" , $type_paiement) , str_replace( "'" , "''" , $desc_type_paiement) , $id_type_paiement);
		$this->db->query($sql);	
	}

	function update_activation_type_paiement( $id_type_paiement , $active )
	{
		$sql = ' update type_paiement set active = %d where id_type_paiement = %d ';
		$sql = sprintf( $sql , $active , $id_type_paiement );
		$this->db->query($sql);
	}

	function detele_type_paiement($id_type_paiement)
	{
		$sql = ' delete from type_paiement where id_type_paiement = %d ';
		$sql = sprintf($sql , $id_type_paiement);
		$this->db->query($sql);
	}

	// ------------------------------------------------------------ VIEW DETAILS_TYPE_PAIEMENT ---------------------------------------------------------------------------------

	function find_all_type_paiement_with_pagination( $type_paiement ,  $page )
	{
		$start = ( $page - 1 ) * 5; 
		$sql = " select * from details_type_paiement where type_paiement like '%%%s%%' order by id_type_paiement desc limit %d , 5 ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $type_paiement) , $start );
		$query = $this->db->query($sql);
		$type_paiements = $query->result_array();
		return $type_paiements;
	}

	function find_type_paiement_by_id( $id_type_paiement )
	{
		$sql = ' select * from details_type_paiement where id_type_paiement = %d ';
		$sql = sprintf( $sql , $id_type_paiement );
		$query = $this->db->query($sql);
		$type_paiement = $query->row_array();
		return $type_paiement;
	}
}
?>