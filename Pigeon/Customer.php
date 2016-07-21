<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nick
 * Date: 7/20/16
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */
class Pigeon_Customer extends Pigeon
{

	public function create( $input )
	{
		if( !array_key_exists("email", $input) ){
			throw new Exception("An email is required for account creation");
		}

		return $this->post("/customer", $input);
	}

	public function find( $filters )
	{
		parent::get("/customer", $filters);
	}

	public function login( $email, $password )
	{
		return $this->post("/customer/login", array("email"=>$email,"password"=>$password));
	}

	public function logout( $id, $token )
	{
		return $this->post("/customer/logout", array("session_id"=>$id,"session_token"=>$token));
	}

	public function auth( $id, $token )
	{
		return $this->post("/customer/auth", array("id"=>$id,"token"=>$token));
	}
}
