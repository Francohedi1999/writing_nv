<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Etat_commande_Model extends CI_MODEL
{
	// ---------------------------------------------------- TABLE ETAT_COMMANDE ---------------------------------------------------------------------------------------------
	
	function find_all_etat_commande()
	{
		$query = $this->db->query(' select * from etat_commande ');
		$etats_commande = $query->result_array();
		return $etats_commande;
	}

	function find_etat_commande_by_id_etat_commande( $id_etat_commande )
	{
		$sql = ' select * from etat_commande where id_etat_commande = %d ';
		$sql = sprintf( $sql , $id_etat_commande );
		$query = $this->db->query( $sql );
		$etat_commande = $query->row_array();
		return $etat_commande;
	}
}
?>