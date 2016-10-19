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
		if( !is_array($filters) )
			$filters = array("search"=>$filters);

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

	public function sessionLogin( $customer_id )
	{
		$unique_session = md5(Pigeon_Configuration::get("pigeon_domain"));
		if( array_key_exists($unique_session."_id", $_COOKIE) && array_key_exists($unique_session."_hash", $_COOKIE) ){
			return $this->post("/customer/session_login", array("customer_id"=>$customer_id,"session_id"=>$_COOKIE[$unique_session."_id"],"session_hash"=>$_COOKIE[$unique_session."_hash"]));
		}else{
			return FALSE;
		}
	}

	public function sessionLogout( $customer_id )
	{
		$unique_session = md5(Pigeon_Configuration::get("pigeon_domain"));
		if( array_key_exists($unique_session."_id", $_COOKIE) && array_key_exists($unique_session."_hash", $_COOKIE) ){
			return $this->post("/customer/session_logout", array("customer_id"=>$customer_id,"session_id"=>$_COOKIE[$unique_session."_id"],"session_hash"=>$_COOKIE[$unique_session."_hash"]));
		}else{
			return FALSE;
		}
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

	public function getSSOLink( $customer_id, $url )
	{
		return "https://" . Pigeon_Configuration::get("pigeon_domain")."?psso=".$customer_id."&rd=".urlencode($url);
	}
}
