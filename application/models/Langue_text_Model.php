<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Langue_text_Model extends CI_MODEL
{

	// ------------------------------------------------------------------------------- TABLE LANGUE_TEXT --------------------------------------------------------------------

	function find_all_langue_text()
	{
		$query = $this->db->query(' select * from langue_text where activee = 1 ');
		$langues_text = $query->result_array();
		return $langues_text;
	}

	function find_all_langues()
	{
		$query = $this->db->query(' select * from langue_text ');
		$langues_text = $query->result_array();
		return $langues_text;
	}


	function find_all_langue_text_id_langue_text( $id_langue_text )
	{
		$sql = ' select * from langue_text  where id_langue_text = %d ';
		$sql = sprintf( $sql , $id_langue_text );
		$query = $this->db->query( $sql );
		$langue_text = $query->row_array();
		return $langue_text;
	}

	function insert_langue($langue_text)
	{
		$sql = " insert into langue_text( langue_text ) values( '%s' ) ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $langue_text) );
		$this->db->query( $sql );
	}

	function update_langue($id_langue_text , $langue_text)
	{
		$sql = " update langue_text set langue_text = '%s' where id_langue_text = %d ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $langue_text) , $id_langue_text );
		$this->db->query( $sql );
	}

	function update_activation_langue($id_langue_text , $activee)
	{
		$sql = ' update langue_text set activee = %d where id_langue_text = %d ';
		$sql = sprintf( $sql , $activee , $id_langue_text );
		$this->db->query( $sql );
	}


	// ------------------------------------------------------------------------------- VIEW LANGUES ----------------------------------------------------------------------------

	function find_all_langue_text_with_pagination( $langue_text , $page )
	{
		$start = ( $page - 1 ) * 5; 
		$sql = " select * from langues where langue_text like '%%%s%%' limit  %d , 5 ";
		$sql = sprintf( $sql , str_replace( "'" , "''" , $langue_text) , $start );
		$query = $this->db->query( $sql );
		$langues_text = $query->result_array();
		return $langues_text;
	}
}
?>