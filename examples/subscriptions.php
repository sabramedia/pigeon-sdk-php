<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "/Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

$pigeon = new Pigeon();

// SUBSCRIPTION SUMMARY EXAMPLE - 2018-08-02


$response = $pigeon->Subscription->summary(
	["date_range"=>["2018-03-01","2018-03-15"]] // OPTIONAL DATE RANGE - array("Y-m-d","Y-m-d"), defaults to last month from query date
);

echo "\n\n\n #===== RESPONSE ====#\n\n";
print_r($response);