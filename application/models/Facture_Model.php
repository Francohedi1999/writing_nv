<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facture_Model extends CI_MODEL
{
	// ---------------------------------------------------------------------- TABLE FACTURE ----------------------------------------------------------------------------------
	function insert_facture( $id_user , $id_commande )
	{
		$sql = ' insert into facture( id_user , id_commande , date_facturation ) values( %d , %d , current_date ) ';
		$sql = sprintf($sql , $id_user , $id_commande );
		$this->db->query( $sql );
	}

	


	function find_all_factures_by_id_user( $id_user )
	{
		$sql = ' select * from facture where id_user = %d ';
		$sql = sprintf( $sql , $id_user );
		$query = $this->db->query( $sql );
		$factures = $query->result_array();
		return $factures;
	}


	function find_all_factures_by_id_commande( $id_commande )
	{
		$sql = ' select * from facture where id_commande = %d ';
		$sql = sprintf( $sql , $id_commande );
		$query = $this->db->query( $sql );
		$facture = $query->row_array();
		return $facture;
	}

	function delete_facture_by_id_commande( $id_commande )
	{
		$sql = ' delete from facture where id_commande = %d ';
		$sql = sprintf( $sql , $id_commande );
		$this->db->query( $sql );
	}

	function update_etat_facture( $id_facture )
	{
		$sql = ' update facture set payee = 1 where id_facture = %d ';
		$sql = sprintf( $sql , $id_facture );
		$this->db->query( $sql );
	}


	// ---------------------------------------------------------------------- VIEW DETAILS_FACTURE ------------------------------------------------------------------------
	function find_all_factures()
	{
		$query = $this->db->query(' select * from details_facture ');
		$factures = $query->result_array();
		return $factures;
	}

	function find_all_factures_by_id_user_with_pagination( $id_user , $page , $filtre , $ordre )
	{
		$start = ( $page - 1 ) * 5; 
		if( $filtre == "" )
		{
			$filtre = "id_facture ".$ordre;
			$sql = ' select * from details_facture where id_user = %d order by %s limit %d , 5 ';
		}
		elseif( $filtre != "" )
		{
			$filtre = $filtre." ".$ordre;
			$sql = ' select * from details_facture where id_user = %d order by %s limit %d , 5 ';
		}		
		$sql = sprintf($sql , $id_user , $filtre , $start);
		$query = $this->db->query( $sql );
		$factures = $query->result_array();
		return $factures;
	}


	function find_all_factures_with_pagination( $page , $filtre , $ordre)
	{
		$start = ( $page - 1 ) * 5; 
		if( $filtre == "" )
		{
			$filtre = "id_facture ".$ordre;
			$sql = ' select * from details_facture order by %s limit %d , 5 ';
		}
		elseif( $filtre != "" )
		{
			$filtre = $filtre." ".$ordre;
			$sql = ' select * from details_facture order by %s limit %d , 5 ';
		}		
		$sql = sprintf($sql , $filtre , $start);
		$query = $this->db->query( $sql );
		$factures = $query->result_array();
		return $factures;
	}


	function find_facture_by_id_facture($id_facture)
	{
		$sql = ' select * from details_facture where id_facture = %d ';
		$sql = sprintf($sql , $id_facture);
		$query = $this->db->query( $sql );
		$factures = $query->row_array();
		return $factures;
	}

	function find_facture_by_id_commande($id_commande)
	{
		$sql = ' select * from details_facture where id_commande = %d ';
		$sql = sprintf($sql , $id_commande);
		$query = $this->db->query( $sql );
		$factures = $query->row_array();
		return $factures;
	}
}
?>
