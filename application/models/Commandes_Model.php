<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commandes_Model extends CI_MODEL
{


	function find_all_commandes_by_id_user_with_pagination( $id_user , $titre , $date_commande_1 , $date_commande_2 , $page , $filtre , $ordre )
	{	
		$start = ( $page - 1 ) * 5; 

		if( $filtre == "" )
		{
			$filtre = 'id_commande desc';
			if( $date_commande_1 == "" && $date_commande_2  == "" )
			{
				$sql = " select * from commandes 
						where 
						(id_user = %d and modifiable = 0) and 
						titre like '%%%s%%' order by %s limit %d , 5 ";	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $filtre , $start );
			}
			elseif( $date_commande_1 != "" && $date_commande_2  == "" )
			{
				$sql = ' select * from commandes 
						where 
						(id_user = %d and modifiable = 0) and  
						titre like "%%%s%%" 
						and date_commande>="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $date_commande_1 , $filtre , $start );
			}
			else
			{
				$sql = ' select * from commandes 
						where 
						( id_user = %d and modifiable = 0 ) and 
						titre like "%%%s%%" 
						and date_commande>="%s" and date_commande<="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $date_commande_1 , $date_commande_2 , $filtre , $start );
			}
		}
		else
		{
			$filtre = $filtre." ".$ordre ;
			if( $date_commande_1 == "" && $date_commande_2 == "" )
			{
				$sql = ' select * from commandes 
						where 
						(id_user = %d and modifiable = 0) and 
						titre like "%%%s%%" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $filtre , $start );
			}
			elseif( $date_commande_1 != "" && $date_commande_2  == "" )
			{
				$sql = ' select * from commandes 
						where 
						(id_user = %d and modifiable = 0) and 
						titre like "%%%s%%" 
						and date_commande>="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $date_commande_1 , $filtre , $start );
			}
			else
			{
				$sql = ' select * from commandes 
						where 
						(id_user = %d and modifiable = 0) and 
						titre like "%%%s%%" 
						and date_commande>="%s" and date_commande<="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , $id_user , str_replace( "'" , "''" , $titre) , $date_commande_1 , $date_commande_2 , $filtre , $start );
			}
		}
		// echo $sql;
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}

	
	function update_commande_to_uneditable($id_commande)
	{
		$sql = 'update commande set modifiable = false where id_commande = %d';
		$sql = sprintf($sql , $id_commande);
		$this->db->query($sql);
	}


}