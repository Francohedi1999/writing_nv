<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Promotion_Model extends CI_MODEL
	{

// ------------------------------------------------------------------ TABLE PROMOTION -------------------------------------------------------------------------


		function insert_promotion($code_promo , $desc_promo , $reduction)
		{
			$sql = " insert into promotion( code_promo , desc_promo , reduction , date_promotion) values( '%s' , '%s' , '%s' , current_date ) ";
			$sql = sprintf($sql , str_replace( "'" , "''" , $code_promo) , str_replace( "'" , "''" , $desc_promo) , $reduction );
			$this->db->query($sql);
		}

		function find_promo_by_code_promo($code_promo)
		{
			$sql = " select * from promotion where activee = 1 and code_promo = '%s' order by id_promotion desc";
			$sql = sprintf($sql , str_replace( "'" , "''" , $code_promo));
			$query = $this->db->query($sql);
			$promotion = $query->row_array();
			return $promotion;
		}

		function find_all_promo()
		{
			$query = $this->db->query( ' select * from promotion order by id_promotion desc ' );
			$promotions = $query->result_array();
			return $promotions;
		}

		function find_all_promo_activee()
		{
			$query = $this->db->query( ' select * from promotion where activee = 1 order by id_promotion desc ' );
			$promotions = $query->result_array();
			return $promotions;
		}

		function upadte_promotion($code_promo , $desc_promo , $reduction , $id_promotion)
		{
			$sql = " update promotion set code_promo = '%s' , desc_promo = '%s' , reduction = '%s' where id_promotion = %d " ;
			$sql = sprintf( $sql , str_replace( "'" , "''" , $code_promo) , str_replace( "'" , "''" , $desc_promo) , $reduction , $id_promotion );
			$this->db->query($sql);
		}

		function update_activation_promotion( $activee , $id_promotion )
		{
			$sql = ' update promotion set activee = %d where id_promotion = %d ';
			$sql = sprintf( $sql , $activee , $id_promotion );
			$this->db->query($sql);
		}

// ------------------------------------------------------------------ VIEW DETAILS_PROMOTIONS -------------------------------------------------------------------------

		function find_all_promo_with_pagination( $page , $code_promo )
		{
			$start = ( $page - 1 ) * 5 ;
			$sql = " select * from details_promotion where code_promo like '%%%s%%' order by id_promotion desc limit %d , 5 ";
			$sql = sprintf( $sql , str_replace( "'" , "''" , $code_promo) , $start );
			$query = $this->db->query( $sql );
			$promotions = $query->result_array();
			return $promotions;
		}

		function find_promo_by_id_promo( $id_promotion )
		{
			$sql = ' select * from details_promotion where id_promotion = %d ';
			$sql = sprintf($sql , $id_promotion);
			$query = $this->db->query($sql);
			$promotion = $query->row_array();
			return $promotion;
		}
	}
?>