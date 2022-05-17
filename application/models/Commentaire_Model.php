<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Commentaire_Model extends CI_MODEL
{
	// ----------------------------------------------------TABLE COMMENTAIRE---------------------------------------------------------------------------------------------
	function insert_commentaire( $id_user , $id_commande , $commentaire , $fichier )
	{
		$sql = " insert into commentaire( id_user , id_commande , commentaire , fichier ) values( %d , %d , '%s' , '%s' ) ";
		$sql = sprintf( $sql , $id_user , $id_commande , str_replace( "'" , "''" , $commentaire ) , str_replace( "'" , "''" , $fichier ) );
		$this->db->query( $sql );
	}

	function delete_commentaire_by_id_commande( $id_commentaire )
	{
		$sql = ' delete from commentaire where id_commentaire = %d ';
		$sql = sprintf($sql , $id_commentaire);
		$this->db->query($sql);
	}

	function update_commentaire($commentaire , $id_commentaire )
	{
		$sql = " update commentaire set commentaire = '%s' where id_commentaire = %d ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $commentaire ) , $id_commentaire );
		$this->db->query( $sql );
	}

	// ----------------------------------------------------VIEW DETAILS_COMMENTAIRE---------------------------------------------------------------------------------------------
	function find_commentaire_by_id_commentaire( $id_commentaire )
	{
		$sql = ' select * from details_commentaire where id_commentaire = %d ';
		$sql = sprintf($sql , $id_commentaire);
		$query = $this->db->query($sql);
		$commentaire = $query->row_array();
		return $commentaire;
	}	

	function find_commentaire_by_id_commande( $id_commande )
	{
		$sql = ' select * from details_commentaire where id_commande = %d ';
		$sql = sprintf($sql , $id_commande);
		$query = $this->db->query($sql);
		$commentaires = $query->result_array();
		return $commentaires;
	}

	
}
?>