<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();

// DO CUSTOMER FIND EXAMPLES - 2016-07-21

/**
 * Authenticate the customer
 *
 * SCHEMA
 * find( arr || str $customer_id )
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
 * SEARCH SCHEMA
 * search( str || arr )
 *
 * string = customer name | email | company | zip | phone
 *
 * array =
 * "search" == search as stated above
 * "limit" == limit results
 * "page" == paginate limits (zero based, 0 is first page)
 *
 */

// FIND A CUSTOMER
// Token search will return auth status and access metadata
$response = $pigeon->Customer->find(array("token"=>"22b46acc403af624e69c75f7886a0bdf"));


// Get the user data by customer id
$response = $pigeon->Customer->find($customer_id);


// SEARCH CUSTOMERS
// Search  by customer name | email | company | zip | phone
$response = $pigeon->Customer->search("search term here");

// Same search, but limited to the first result on page 1
$response = $pigeon->Customer->search(array("search"=>"search term here","limit"=>1,"page"=>0));

echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);