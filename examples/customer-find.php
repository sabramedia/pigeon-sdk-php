<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();

// DO CUSTOMER FIND EXAMPLES - 2017-08-28

/**
 * Authenticate the customer
 *
 * SCHEMA
 * find( str $customer_id )
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
 * "search" == search string as stated above
 * "limit" == limit results
 * "page" == paginate limits (zero based, 0 is first page)
 *
 */

// FIND A CUSTOMER

// Get a customer based on their logged in status. This only works in the context of the primary domain (e.g., company.com, sub1.company.com, sub2.company.com)
$response = $pigeon->Customer->getLoggedIn();

// Get the user data by customer id. This method can be used in the context of the primary domain or via a third-party domain (e.g., company2.com to company.com)
$response = $pigeon->Customer->find($customer_id);


// SEARCH CUSTOMERS
// Search  by customer name | email | company | zip | phone
$response = $pigeon->Customer->search("search term here");

// Same search, but limited to the first result on page 1
$response = $pigeon->Customer->search(array("search"=>"search term here","limit"=>1,"page"=>0));

echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);