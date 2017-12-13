<?php

ini_set( "display_errors", TRUE );
require_once( __DIR__. "../../Pigeon.php");

Pigeon_Configuration::pigeonDomain("profil-test.acadienouvelle.com");
Pigeon_Configuration::clientId("acadienouvelle");
Pigeon_Configuration::apiKey("fj3ls285zkq93smx");

$pigeon = new Pigeon();

//$response = $pigeon->Customer->login("admin@sabramedia.com","Sm112358!");
//print_r($customer);
//if( $response->success ){
//	header("Location: ".$pigeon->Customer->getSSOLink($response->customer->id,"http://staging.sabramedia.com/c/sdk/examples/sso-sp.php"));
//}