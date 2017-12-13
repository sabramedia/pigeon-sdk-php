<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();

// PLAN SEARCH AND FIND EXAMPLES - 2016-10-16

/**
 * Authenticate the customer
 *
 * SCHEMA
 * find(  )
 *
 * $filters
 * 	"id" == user id
 * 	"token" == session token created on customer auth
 * 	--- more to come ---
 *
 *
 * RESPONSE
 * The customer array along with access and auth status if the session token is passed
 *
 */

// Token search will return auth status and access metadata
$response = $pigeon->Customer->find(array("token"=>"22b46acc403af624e69c75f7886a0bdf"));


// Get the user data by customer id, but won't tell if they are authenticated or what kind of access they have
$response = $pigeon->Customer->find($customer_id);

// NOTE the session token will be used when determining if a customer can access on-demand content or subscription-level access

echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);