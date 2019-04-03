<?php
require_once '../config.php';

### If the username and password fields are set, we want to handle the request.
if(isset($_POST['u']) && isset($_POST['p'])){
	/*
	Handle the request.
	Connect to the database and verify the plaintext username and password.
	Once verified, give the SESSION and USERNAME cookie.
	Place a session into the DB web_users with the string we generate.
	On edit pages, we want to verify the session ID so we should connect to it via this page.
	*/
}
elseif(isset($_GET['v'])){
	/*
	Here we want to verify the request.
	We should connect to the database and verify the session id.
	If the session ID is wrong, we'll want to error them out and 
	display content letting them know they are not logged in, or 
	to log in again to get a new session.
	
	We might also want to verify on other pages, just to silently log them out
	if we find they have a mismatched sessionid.
	*/
?>
