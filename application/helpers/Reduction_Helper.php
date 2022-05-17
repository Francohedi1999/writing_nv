<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function get_prix_reduction( $prix , $p_reduction )
	{
		$reduction = $prix * ( $p_reduction / 100 );

		return $prix - $reduction;
	}
?>