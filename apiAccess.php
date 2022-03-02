<?php

function createClient() {
	// Connect to Google Account
	$client = new Google_Client();
	$client->setApplicationName("CalendarAndEvents");

	// Go to https://console.cloud.google.com/apis/credentials?project=YOUR-PROJECT-NAME-HERE to create client id, client secret, and to register your redirect uri.
	$client->setClientId('124375902481-8jb0p9kiq8hvdige2i9hd8nn2qrn91t6.apps.googleusercontent.com');
	$client->setClientSecret('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');
	$client->setRedirectUri('http://192.168.31.201/oauth2callback');
	$client->setDeveloperKey('AIzaSyBRyMVy3cEaleZEbVJDHOKLr50FSo_ODBgz');
	$client->addScope("https://www.googleapis.com/auth/calendar");
	
	return $client;
}

?>
