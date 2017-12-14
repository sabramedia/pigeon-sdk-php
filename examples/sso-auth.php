<?php

ini_set( "display_errors", TRUE );
require_once( __DIR__. "../../Pigeon.php");

Pigeon_Configuration::pigeonDomain("");
Pigeon_Configuration::clientId("");
Pigeon_Configuration::apiKey("");

$pigeon = new Pigeon();

//$response = $pigeon->Customer->login("youremail@something.com","some-pw");
//print_r($customer);
//if( $response->success ){
//	header("Location: ".$pigeon->Customer->getSSOLink($response->customer->id,"http://staging.sabramedia.com/c/sdk/examples/sso-sp.php"));
//}