<?php

class Pigeon_Subscription extends Pigeon
{

	public function find( $plan_id )
	{
		return parent::get("/subscription", array("id"=>$plan_id));
	}

	public function search( $filters )
	{
		if( !is_array($filters) )
			$filters = array("search"=>$filters);

		return parent::get("/plan/search", $filters);
	}
	public function summary( $filters=array() )
	{
		if( !is_array($filters) )
			$filters = array();

		return parent::get("/subscription/summary", $filters);
	}
}