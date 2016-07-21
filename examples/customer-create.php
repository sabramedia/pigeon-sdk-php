<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();


// CREATE NEW ACCOUNT EXAMPLE - 2016-07-21

/**
 * The create method allow for creating customer accounts on Pigeon.
 *
 * SCHEMA
 * create( array $data, bool $force_auth = FALSE )
 *
 * data
 * 	Takes an array creates the customer in Pigeon. Minimum of email is required
 *
 * force_auth
 * 	TRUE forces the authentication on creation. A session token is returned in response
 *
 *
 * RESPONSE
 *
 */

// NOTE: Hide/Unhide the following blocks to test.


// Minimum Example
$response = $pigeon->Customer->create(array(
	"email"=>"some_email_here"
));


// Note the force login parameter. The response will give you a session token that can be used for subsequent calls
$response = $pigeon->Customer->create(array(
	"email"=>"nick@sabramedia.com"
), TRUE);


// Attempt to create customer when email that already exists
$response = $pigeon->Customer->create(array(
	"email"=>"admin@sabramedia.com"
));


// Full example (currently)
$response = $pigeon->Customer->create(array(
	"email"=>"some_email_here",
	"display_name"=>"Name Here",
	"password"=>"sadfasdf",
	"password2"=>"sadfasdf" // For comparing
	// More can be added later
));


echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);