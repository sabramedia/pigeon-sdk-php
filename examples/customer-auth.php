<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();

// DO CUSTOMER AUTH EXAMPLES - 2016-07-21

/**
 * Authenticate the customer
 *
 * SCHEMA
 * login( str $email, str $password )
 *
 * For semantics the following method does the exact same thing
 *
 * auth( str $email, str $password )
 *
 * $email
 * 	Email is used as the account username
 *
 * $password
 * 	Minimum of 6 characters
 *
 *
 * RESPONSE
 * all responses return success == TRUE | FALSE for error handling
 *
 */

// AUTH/LOGIN PROCESS
$response = $pigeon->Customer->login("you@email.com","some_password");

// Record the token for subsequent calls that require status and access information.



/**
 * Logout a customer
 *
 * SCHEMA
 * logout( mixed $id_or_token, str $type = "token" )
 *
 * $id_or_token
 * 	user id or session token
 *
 * $type
 * 	Default is token. The user id can be used, but will remove all
 * 	user sessions created via api, which in most cases will only be one.
 *
 */

// Min example
$response = $pigeon->Customer->logout("23c66491e798a3370010a6758d6a1837");

// User id example
$response = $pigeon->Customer->logout(1,"id");

echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);