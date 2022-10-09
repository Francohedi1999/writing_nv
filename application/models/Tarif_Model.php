<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tarif_Model extends CI_MODEL
{
// ------------------------------------------------------------- TABLE TARIF ------------------------------------------------------------------------------------------------
	

	function insert_tarif($type_redacteur , $type_text , $prix_par_mot)
	{
		$sql = " insert into tarif(type_redacteur , type_text , prix_par_mot) values('%s' , '%s' , '%s') ";
		$sql = sprintf($sql , str_replace( "'" , "''" , $type_redacteur) , str_replace( "'" , "''" , $type_text) , $prix_par_mot);
		$this->db->query($sql);
	}


	function update_tarif($type_redacteur , $type_text , $prix_par_mot ,  $id_tarif)
	{
		$sql = " update tarif set type_redacteur = '%s' , type_text = '%s' , prix_par_mot = '%s' where id_tarif = %d ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $type_redacteur) , str_replace( "'" , "''" , $type_text) , $prix_par_mot , $id_tarif );
		$this->db->query($sql);
	}

	function update_activation_tarif($active , $id_tarif)
	{
		$sql = ' update tarif set active = %d where id_tarif = %d ';
		$sql = sprintf( $sql , $active , $id_tarif );
		$this->db->query($sql);
	}
	
// ------------------------------------------------------------- VIEW TARIFS ------------------------------------------------------------------------------------------------
	
	function find_tarif_by_id_tarif($id_tarif)
	{
		$sql = ' select * from tarifs where id_tarif = %d ';
		$sql = sprintf($sql , $id_tarif);
		$query = $this->db->query($sql);
		$tarif = $query->row_array();
		return $tarif;
	}

	function find_all_tarif_active()
	{
		$query = $this->db->query(' select * from tarifs where is_active = 1');
		$tarifs = $query->result_array();
		return $tarifs;
	}

	function find_all_tarif_active_with_pagination( $page )
	{
		$start = ( $page - 1 ) * 3; 
		$sql = ' select * from tarifs where is_active = 1 limit %d , 3' ;
		$sql = sprintf($sql , $start);
		$query = $this->db->query($sql);
		$tarifs = $query->result_array();
		return $tarifs;
	}

	function find_all_tarif()
	{
		$query = $this->db->query(' select * from tarifs ');
		$tarifs = $query->result_array();
		return $tarifs;
	}

	function find_all_tarif_pagination( $page , $type_text)
	{
		$start = ( $page - 1 ) * 5 ;
		$sql = " select * from tarifs where type_text like '%%%s%%' order by id_tarif desc limit %d , 5 ";
		$sql = sprintf($sql , str_replace( "'" , "''" , $type_text) , $start);
		$query = $this->db->query($sql);
		$tarifs = $query->result_array();
		return $tarifs;
	}
}
?>