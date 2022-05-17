<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class User_Model extends CI_MODEL
	{	
	// ------------------------------------------------------------ TABLE USER ---------------------------------------------------------------------------------
		function find_all_users()
		{
			$query = $this->db->query(' select * from user order by id_user desc ');
			$users = $query->result_array();
			return $users;
		}

		function insert_user($nom_user , $mail_user , $mdp_user)
		{
			$sql = " insert into user(nom_user , mail_user , mdp_user , date_inscri ) values('%s' , '%s' , sha1('%s') , current_date) ";
			$sql = sprintf($sql , str_replace( "'" , "''" , $nom_user) , str_replace( "'" , "''" , $mail_user) , str_replace( "'" , "''" , $mdp_user) );
			$this->db->query($sql);
		}


		function find_user_by_mail($mail_user)
		{
			$sql = " select * from user where mail_user = '%s' ";
			$sql = sprintf($sql , str_replace( "'" , "''" , $mail_user) );
			$query = $this->db->query($sql);
			$user = $query->row_array();
			return $user;
		} 

		function find_user_by_mail_mdp($mail_user , $mdp_user)
		{
			$sql = " select * from user where mail_user = '%s' and mdp_user = sha1('%s') ";
			$sql = sprintf($sql , str_replace( "'" , "''" , $mail_user) , str_replace( "'" , "''" , $mdp_user) );
			$query = $this->db->query($sql);
			$user = $query->row_array();
			return $user;
		}

		function update_user($nom_user , $mail_user , $id_user)
		{
			$sql = " update user set nom_user = '%s' , mail_user = '%s' where id_user = %d ";
			$sql = sprintf($sql , str_replace( "'" , "''" , $nom_user) , str_replace( "'" , "''" , $mail_user) , $id_user);
			$this->db->query($sql);
		}

		function update_date_reset_password($id_user)
		{
			$sql = ' update user set date_reset_password = current_timestamp where id_user = %d ';
			$sql = sprintf($sql , $id_user);
			$this->db->query($sql);
		}

		function update_reduction_user($reduction_fidelite , $id_user)
		{
			$sql = ' update user set reduction_fidelite = "%s" where id_user = %d ';
			$sql = sprintf($sql , $reduction_fidelite , $id_user);
			$this->db->query($sql);
		}

		function update_accessibility_user( $id_user , $banni )
		{
			$sql = ' update user set banni = %d where id_user = %d ';
			$sql = sprintf( $sql , $banni , $id_user );
			$this->db->query($sql);
		}

		function update_fidelity_user( $id_user , $fidele )
		{
			$sql = ' update user set fidele = %d where id_user = %d ';
			$sql = sprintf( $sql , $fidele , $id_user );
			$this->db->query($sql);
		}

		function update_mdp_user( $id_user , $mdp_user )
		{
			$sql = " update user set mdp_user = sha1('%s') where id_user = %d ";
			$sql = sprintf( $sql , str_replace( "'" , "''" , $mdp_user) , $id_user );
			$this->db->query($sql);
		}

// ----------------------------------------------------------------- VIEW CLIENT ------------------------------------------------------------------------------------


		function find_all_users_with_pagination( $nom_user , $page )
		{
			$start = ( $page - 1 ) * 5; 
			$sql = " select * from client where id_user_type = 2 and nom_user like '%%%s%%' order by id_user desc limit %d , 5";
			$sql = sprintf( $sql , str_replace( "'" , "''" , $nom_user) , $start );
			$query = $this->db->query( $sql );
			$users = $query->result_array();
			return $users;
		}


		function find_all_clients()
		{
			$query = $this->db->query( ' select * from client where id_user_type = 2 ' );
			$users = $query->result_array();
			return $users;
		}	


		// -------------- par fidelite ------------------//

		function find_all_clients_by_fidele( $is_fidele )
		{
			$sql = ' select * from client where id_user_type = 2 and is_fidele = %d ';
			$sql = sprintf( $sql , $is_fidele );
			$query = $this->db->query( $sql );
			$users = $query->result_array();
			return $users;
		}

		function find_all_clients_by_fidele_with_pagination( $is_fidele , $nom_user , $page )
		{
			$start = ( $page - 1 ) * 5; 
			$sql = " select * from client where id_user_type = 2 and is_fidele = %d and nom_user like '%%%s%%' order by id_user desc limit %d , 5 ";
			$sql = sprintf( $sql , $is_fidele , str_replace( "'" , "''" , $nom_user) , $start );
			$query = $this->db->query( $sql );
			$users = $query->result_array();
			return $users;
		}	
		// --------------------------------//


		function find_user_by_id($id_user)
		{
			$sql = ' select * from client where id_user = %d ';
			$sql = sprintf($sql , $id_user);
			$query = $this->db->query($sql);
			$user = $query->row_array();
			return $user;
		} 	
// --------------------------------------------------------------------------- VIEW NB_CLIENT ----------------------------------------------------------------------------------------
		
		function find_nb_users()
		{
			$query = $this->db->query(' select * from nb_client where id_user_type = 2 order by nb_user desc');
			$users = $query->result_array();
			return $users;
		}

// --------------------------------------------------------------------------- par fidelite -----------------------------------------------------------------------------------------//
		
		function get_fidelite_user( $is_fidele ) 
		{			
			$sql = ' select fidele from client where id_user_type = 2 and is_fidele = %d ';
			$sql = sprintf( $sql , $is_fidele );
			$query = $this->db->query( $sql );
			$fidelite = $query->row_array();
			return $fidelite;
		}
	}
?>