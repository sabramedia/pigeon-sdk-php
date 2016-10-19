<?php

class Pigeon_Plan extends Pigeon
{

	public function find( $plan_id )
	{
		return parent::get("/plan", array("id"=>$plan_id));
	}

	public function search( $filters )
	{
		if( !is_array($filters) )
			$filters = array("search"=>$filters);

		return parent::get("/plan/search", $filters);
	}

	public function getAll()
	{
		return $this->search("");
	}
}
