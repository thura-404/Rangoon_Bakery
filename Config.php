<?php

//start session on web page

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('692375772019-03et2riu18ctveqij782071bqc361mfi.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/Rangoon_Bakery/New_Design/User_Login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>