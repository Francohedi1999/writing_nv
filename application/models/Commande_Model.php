<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande_Model extends CI_MODEL
{
// -----------------------------------------------------------------------TABLE COMMANDE-------------------------------------------------------------------
		function insert_commande( 	$id_tarif,
									$id_user,
									$fidele,
									$reduction_fidelite,
									$nom_user,
									$mail_user,
									$nom_entreprise,
									$num_eng_fiscal,
									$id_langue_text,
									$cible,
									$ton,
									$titre,
									$intertitres,
									$nb_mots_paragraphe,
									$mot_cle_1,
									$mot_cle_2,
									$mise_en_forme,
									$meta_titre,
									$meta_desc,
									$balise,
									$remarques,
									$code_promo,
									$reduction_promo,
									$id_type_paiement,
									$prix_prestation )
		{
			if( $fidele == 1 )
			{
				$remise_total = $reduction_promo + $reduction_fidelite;
				$reduction_total = $prix_prestation * ( $remise_total / 100 );
				$prix_prestation_final = $prix_prestation - $reduction_total;
			}
			elseif( $fidele == 0 )
			{
				$reduction_fidelite = 0;
				$remise_total = $reduction_promo + $reduction_fidelite;
				$reduction_total = $prix_prestation * ( $remise_total / 100 );
				$prix_prestation_final = $prix_prestation - $reduction_total;
			}

			$sql = " insert into commande(id_tarif,
									id_user,
									fidele,
									reduction_fidelite,
									nom_user,
									mail_user,
									nom_entreprise,
									num_eng_fiscal,
									id_langue_text,
									cible,
									ton,
									titre,
									intertitres,
									nb_mots_paragraphe,
									mot_cle_1,
									mot_cle_2,
									mise_en_forme,
									meta_titre,
									meta_desc,
									balise,
									remarques,
									code_promo,
									reduction_promo,
									id_type_paiement,
									prix_prestation,
									date_commande ) values(	%d,
																%d,
																%d,
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																%d,
																'%s',
																'%s',
																'%s',
																'%s',
																%d,
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																'%s',
																current_date )";
			$sql = sprintf( $sql,
							$id_tarif,
							$id_user,
							$fidele,
							$reduction_fidelite,
							str_replace( "'" , "''" , $nom_user ),
							str_replace( "'" , "''" , $mail_user ),
							str_replace( "'" , "''" , $nom_entreprise ),
							str_replace( "'" , "''" , $num_eng_fiscal ),
							$id_langue_text,
							str_replace( "'" , "''" , $cible ),
							str_replace( "'" , "''" , $ton ),
							str_replace( "'" , "''" , $titre ),
							str_replace( "'" , "''" , $intertitres ),
							$nb_mots_paragraphe,
							str_replace( "'" , "''" , $mot_cle_1 ),
							str_replace( "'" , "''" , $mot_cle_2 ),
							str_replace( "'" , "''" , $mise_en_forme ),
							str_replace( "'" , "''" , $meta_titre ),
							str_replace( "'" , "''" , $meta_desc ),
							str_replace( "'" , "''" , $balise ),
							str_replace( "'" , "''" , $remarques ),
							$code_promo,
							$reduction_promo,
							$id_type_paiement,
							$prix_prestation_final );
			$this->db->query($sql);
		}
	}

	function cancel_commande( $id_commande )
	{
		$sql = ' update commande set id_etat_commande = 6 , prix_prestation = 0 , modifiable = 0 where id_commande = %d ';
		$sql = sprintf($sql , $id_commande);
		$this->db->query($sql);
	}

	function update_prix_prestation( $id_commande )
	{
		$sql = ' update commande set prix_prestation = 0 where id_commande = %d ';
		$sql = sprintf($sql , $id_commande);
		$this->db->query($sql);
	}

	function update_etat_commande_by_id_commande( $id_commande , $id_etat_commande )
	{
		if( $id_etat_commande == 2 )
		{
			$sql = ' update commande set id_etat_commande = %d where id_commande = %d ';
		}
		elseif( $id_etat_commande == 3 )
		{
			$sql = ' update commande set date_commencement = current_date , id_etat_commande = %d where id_commande = %d ';
		}
		elseif( $id_etat_commande == 4 )
		{
			$sql = ' update commande set date_livraison = current_date , id_etat_commande = %d where id_commande = %d ';
		}
		elseif( $id_etat_commande == 5 )
		{
			$sql = ' update commande set id_etat_commande = %d where id_commande = %d ';
		}
		$sql = sprintf( $sql , $id_etat_commande , $id_commande );
		$this->db->query( $sql );
	}

	function update_commande_by_id_commande($id_tarif,
												$id_langue_text,
												$nb_mot,
												$mot_cle,
												$titre_commande,
												$remarque,
												$nom_user,
												$nom_entreprise,
												$adresse,
												$nom_pays,
												$ville,
												$region,
												$code_postal,
												$num_TVA,
												$code_promo,
												$reduction_promo,
												$reduction_fidelite,
												$prix_prestation,
												$id_type_paiement,
												$id_user,
												$id_commande,
												$fidele)
	{
		if( $fidele == 1 )
		{
			$remise_total = $reduction_promo + $reduction_fidelite;
			$reduction_total = $prix_prestation * ( $remise_total / 100 );
			$prix_prestation_final = $prix_prestation - $reduction_total;
		}
		elseif( $fidele == 0 )
		{
			$reduction_fidelite = 0;
			$remise_total = $reduction_promo + $reduction_fidelite;
			$reduction_total = $prix_prestation * ( $remise_total / 100 );
			$prix_prestation_final = $prix_prestation - $reduction_total;		
		}
		$sql = " update commande set
					id_tarif = %d ,
					id_langue_text = %d ,
					nb_mot = %d ,
					mot_cle = '%s' ,
					titre_commande = '%s',
					remarque = '%s' ,
					nom_user = '%s' ,
					nom_entreprise = '%s' ,
					adresse = '%s' ,
					nom_pays = '%s' ,
					ville = '%s' ,
					region = '%s' ,
					code_postal = '%s' ,
					num_TVA = '%s' ,
					modifiable = false ,
					code_promo = '%s' ,
					reduction_promo = '%s' ,
					reduction_fidelite = '%s',
					prix_prestation = '%s',
					id_type_paiement = %d,
					id_user = %d ,
					fidele = %d 
					where id_commande = %d ";
		$sql = sprintf($sql ,$id_tarif,
								$id_langue_text,
								$nb_mot,
								str_replace( "'" , "''" , $mot_cle),
								str_replace( "'" , "''" , $titre_commande),
								str_replace( "'" , "''" , $remarque),
								str_replace( "'" , "''" , $nom_user),
								str_replace( "'" , "''" , $nom_entreprise),
								str_replace( "'" , "''" , $adresse),
								str_replace( "'" , "''" , $nom_pays),
								str_replace( "'" , "''" , $ville),
								str_replace( "'" , "''" , $region),
								str_replace( "'" , "''" , $code_postal),
								str_replace( "'" , "''" , $num_TVA),
								str_replace( "'" , "''" , $code_promo),
								$reduction_promo,
								$reduction_fidelite,
								$prix_prestation_final,
								$id_type_paiement,
								$id_user,
								$fidele,
								$id_commande);
		$this->db->query($sql);
	}

	function find_all_commandes_by_id_user($id_user)
	{
		$sql = ' select * from commande where id_user = %d and modifiable = 0 order by id_commande desc ';
		$sql = sprintf($sql , $id_user);
		$query = $this->db->query($sql);
		$all_commande_by_id_user = $query->result_array();
		return $all_commande_by_id_user;
	}



	function find_all_commandes( )
	{
		$query = $this->db->query('select * from commande where modifiable = 0');
		$commandes = $query->result_array();
		return $commandes;
	}



	

	// -------------------------------------------------------------------VIEW COMMANDES----------------------------------------------------------------------------


	// ---------------- COMMANDE PAR USER --------------------- //
	
	function find_last_command_by_id_user($id_user)
	{
		$sql = ' select * from commandes where id_user = %d order by id_commande desc limit 1 ';
		$sql = sprintf($sql , $id_user);
		$query = $this->db->query($sql);
		$last_command = $query->row_array();
		return $last_command;
	}

	
	function find_commande_by_id_commande($id_commande)
	{
		$sql = ' select * from commandes where id_commande = %d ';
		$sql = sprintf($sql , $id_commande);
		$query = $this->db->query( $sql );
		$commandes = $query->row_array();
		return $commandes;
	}


	// ---------------- COMMANDE PAR ETAT --------------------- //


	function find_all_commandes_by_id_etat( $id_etat_commande )
	{	
		$sql = ' select * from commandes where id_etat_commande = %d and modifiable = 0 ';	
		$sql = sprintf( $sql , $id_etat_commande );
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}


	function find_all_commandes_by_id_etat_with_pagination( $id_etat_commande , $titre_commande , $page , $filtre )
	{	
		$start = ( $page - 1 ) * 5; 

		if( $filtre == "" )
		{
			$filtre = 'id_commande desc';
			$sql = " select * from commandes where id_etat_commande = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		elseif( $filtre != "" )
		{
			$sql = " select * from commandes where id_etat_commande = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		$sql = sprintf( $sql , $id_etat_commande , str_replace( "'" , "''" , $titre_commande) , $filtre , $start );
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}



	// ---------------- COMMANDE PAR TARIF --------------------- //


	function find_all_commandes_by_id_tarif( $id_tarif )
	{	
		$sql = ' select * from commandes where id_tarif = %d and modifiable = 0 ';	
		$sql = sprintf( $sql , $id_tarif );
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}


	function find_all_commandes_by_id_tarif_with_pagination( $id_tarif , $titre_commande , $page , $filtre , $ordre)
	{	
		$start = ( $page - 1 ) * 5; 

		if( $filtre == "" )
		{
			$filtre = 'id_commande desc';
			$sql = " select * from commandes where id_tarif = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		elseif( $filtre != "" )
		{
			$filtre = $filtre.' '.$ordre;
			$sql = " select * from commandes where id_tarif = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		$sql = sprintf( $sql , $id_tarif , str_replace( "'" , "''" , $titre_commande) , $filtre , $start );
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}


	// ---------------- COMMANDE PAR ETAT ET USER --------------------- //



	function get_commande_by_id_user_id_etat_commande_with_pagination( $id_user , $id_etat_commande , $titre_commande , $filtre , $page)
	{
		$start = ( $page - 1 ) * 5; 
		if( $filtre == "" )
		{
			$filtre = 'id_commande desc';
			$sql = " select * from commandes where id_user = %d and id_etat_commande = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		elseif( $filtre != "" )
		{
			$sql = " select * from commandes where id_user = %d and id_etat_commande = %d and modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
		}
		$sql = sprintf( $sql , $id_user , $id_etat_commande , str_replace( "'" , "''" , $titre_commande) , $filtre , $start );
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}

	function get_commande_by_id_user_id_etat_commande( $id_user , $id_etat_commande )
	{
		$sql = ' select * from commandes where id_user = %d and modifiable = 0 and id_etat_commande = %d order by id_commande desc ';
		$sql = sprintf( $sql , $id_user , $id_etat_commande);
		$query = $this->db->query( $sql );
		$commandes_clients = $query->result_array();
		return $commandes_clients;
	}


	// ---------------- COMMANDES --------------------- //


	function find_all_commandes_with_pagination( $titre_commande , $date_commande_1 , $date_commande_2 , $page , $filtre , $ordre ) 
	{
		$start = ( $page - 1 ) * 5; 

		if( $filtre == "" )
		{
			$filtre = 'id_commande desc ';
			if( $date_commande_1 == "" && $date_commande_2  == "" )
			{
				$sql = " select * from commandes where modifiable = 0 and titre_commande like '%%%s%%' order by %s limit %d , 5 ";	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $filtre , $start );
			}
			elseif( $date_commande_1 != "" && $date_commande_2  == "" )
			{
				$sql = ' select * from commandes 
						where  
						titre_commande like "%%%s%%" 
						and date_commande>="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $date_commande_1 , $filtre , $start );
			}
			else
			{
				$sql = ' select * from commandes 
						where 
						titre_commande like "%%%s%%" 
						and date_commande>="%s" and date_commande<="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $date_commande_1 , $date_commande_2 , $filtre , $start );
			}
		}
		else
		{
			$filtre = $filtre." ".$ordre ;
			if( $date_commande_1 == "" && $date_commande_2 == "" )
			{
				$sql = ' select * from commandes 
						where
						titre_commande like "%%%s%%" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $filtre , $start );
			}
			elseif( $date_commande_1 != "" && $date_commande_2  == "" )
			{
				$sql = ' select * from commandes 
						where 
						titre_commande like "%%%s%%" 
						and date_commande>="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $date_commande_1 , $filtre , $start );
			}
			else
			{
				$sql = ' select * from commandes 
						where 
						titre_commande like "%%%s%%" 
						and date_commande>="%s" and date_commande<="%s" order by %s limit %d , 5 ';	
				$sql = sprintf( $sql , str_replace( "'" , "''" , $titre_commande) , $date_commande_1 , $date_commande_2 , $filtre , $start );
			}
		}
		$query = $this->db->query($sql);
		$commandes = $query->result_array();
		return $commandes;
	}


	


	


	// ------------------------------------------------------------------------VIEW NB_COMMANDE_USER--------------------------------------------------------------------

	// modifiable = 0
	function get_nb_commande_id_user( $id_user )
	{
		$sql = ' select * from nb_commande_user where id_user = %d ';
		$sql = sprintf( $sql , $id_user );
		$query = $this->db->query( $sql );
		$nb_commande_client = $query->result_array();
		return $nb_commande_client;
	}


	// ------------------------------------------------------------------------VIEW NB_COMMANDE_ETAT--------------------------------------------------------------------

	// modifiable = 0
	function get_nb_commande_id_etat_commande()
	{
		$query = $this->db->query( ' select * from nb_commande_etat order by nb_commande desc ' );
		$commandes = $query->result_array();
		return $commandes;
	}


	// ------------------------------------------------------------------------VIEW NB_COMMANDE_TARIF--------------------------------------------------------------------

	// modifiable = 0
	function get_nb_commande_id_tarif()
	{
		$query = $this->db->query( ' select * from nb_commande_tarif order by prix_prestation desc ' );
		$commandes = $query->result_array();
		return $commandes;
	}

	// modifiable = 0
	function get_sum_prix()
	{
		$query = $this->db->query( ' select sum(prix_prestation) as prix_prestation_total from nb_commande_tarif ' );
		$commandes = $query->row_array();
		return $commandes;
	}
?>