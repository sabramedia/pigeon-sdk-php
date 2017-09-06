<?php
ini_set( "display_errors", TRUE );

// Change to the path of the init Pigeon.php file.
require_once( __DIR__. "../../Pigeon.php");

Pigeon_Configuration::clientId("CLIENT_ID");
Pigeon_Configuration::apiKey("API_KEY");
Pigeon_Configuration::pigeonDomain("PIGEON_DOMAIN");

// Single-Sign-on Service Provider

/**
 * The typical flow of server-side Single Sign-on (SSO) involves a Customer wanting access to a Service Provider (SP)
 * on host 1 and an Identification Provider (IdP) on different host 2 which stores the Customer's authentication credentials.
 *
 *	1) The SP requires user authentication before giving access. The SP checks if the customer is authenticated on the IdP.
 *		YES) The Pigeon IdP returns the customer data. At this point the SP can serve authenticated access to the customer
 * 		 NO) Redirects to a sign-in process either located on the IdP or SP where authentication can be done via Pigeon API.
 * 	2) The SP will maintain a check with the IdP as the customer accesses restricted content.
 * 	3) When the customer signs out of the SP, the IdP will be signed out too.
 *
 * All the steps are located in this page for testing convenience.
 *
 * The sso_auth_failed_redirect setting can be used to determine how you want handle the redirection
 * when a customer is not signed in. Here are the possible parameters
 *df
 * [FALSE] (default) to control failed auth response manually
 * [TRUE] to Pigeon IdP server where the person can login or choose a plan.
 * [string] URL to redirect to on failure
 */

 Pigeon_Configuration::set("sso_auth_failed_redirect", FALSE);

$pigeon = new Pigeon();
$customer_id = NULL;

// If the content requires sign-on auth, then check the Pigeon IDP (Identification Provider)

// If the customer is logged in, then the customer data is returned, if not then the sso_auth_failed_redirect setting is followed.
$customer = $pigeon->Customer->isSSOLoggedIn();

if( isset($_GET["logout"]) ){
	// SSOLogout( [, str $url] )
	// The url defaults to the page it is called on. Or you can set a different redirect.
	$pigeon->Customer->SSOLogout();
}

?>

<!DOCTYPE html>
<html class="no-js modal" lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Pigeon SSO Login</title>
</head>
<body>
<?php
	if( array_key_exists("login", $_POST)) {
		$response = $pigeon->Customer->login($_POST["email"], $_POST["password"]);
		if ( $response->success ) {
			// SSOLogin( mixed $customer_id [, str $url])
			// This method ensures the SP and IdP auth cookies are synced.
			// Pass the customer id along with the URL you want to come back to. Defaults to the page it is called on.
			$pigeon->Customer->SSOLogin($response->customer->id);
		} else {
			echo "<p>Login failed. Please try again.</p>";
		}
	}
?>

<?php if( ! $customer ){ ?>

	<form action="" method="post">
		<input type="email" name="email" value="" placeholder="Email" />
		<input type="password" name="password" value="" placeholder="Password" />
		<input type="submit" name="login" value="Login" />
	</form>

<?php }else{ ?>

	<p>Logged In.</p>
	<p><a href="?logout=1">Click here to logout</a></p>
	<?php
	// You can use the customer response data to determine what level of access you want to give
	print_r($customer);
	?>

<?php } ?>

</body>
</html>
