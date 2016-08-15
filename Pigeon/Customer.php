<?php

class Pigeon_Customer extends Pigeon
{

	public function create( $input, $force_auth = FALSE )
	{
		if( !array_key_exists("email", $input) ){
			throw new Exception("An email is required for account creation");
		}

		return $this->post("/customer", array("data"=>$input,"force_auth"=>$force_auth));
	}

	public function find( $customer_id )
	{
		return parent::get("/customer", array("id"=>$customer_id));
	}

	public function search( $filters )
	{
		return parent::get("/customer/search", $filters);
	}

	/**
	 * @param $email
	 * @param $password
	 * @return mixed
	 *
	 * Add for semantics
	 */
	public function auth( $email, $password )
	{
		return $this->login($email, $password);
	}

	public function login( $email, $password )
	{
		return $this->post("/customer/login", array("email"=>$email,"password"=>$password));
	}

	/**
	 * @param $id_or_token
	 * @param string $type
	 * @return mixed
	 *
	 * default is sending token, but the user id can be used, but will remove all
	 * user sessions created via api, which in most cases will only be one.
	 */
	public function logout( $id_or_token, $type = "token" )
	{
		return $this->post("/customer/logout", array("token"=>$id_or_token,"type"=>$type));
	}
}
