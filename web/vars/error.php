<?php
#########################
# ERROR PAGE VARIABLES  #
#########################
	$error_generic_title = "Oops";

### Variables displayed on 500 pages. 
	$error500_page_title = "Internal Server Error (500)";
	$error500_page_headtext = "500 Error - Internal Server Error";
	$error500_page_description = "The page you're looking for couldn't be found. Try <a href='../'>returning home</a>. If you think this is an error, feel free to contact us at $contact_email";
### Variables displayed on 404 pages. 
	$error404_page_title = "Page Not Found";
	$error404_page_headtext = "404 Error - Page Not Found";
	$error404_page_description = "Looks like our server is having some trouble. Try refreshing, and if the problem persists, feel free to contact us at $contact_email";
### Search page history errors.
	$error_display_history_none = "Hmm.. No history found!";
	$error_display_history_timeout = "Timed out! Try again later?";
	$error_display_history_misc = "Unknown Error";
### Search page result errors
	$error_record_nullid_desc = "
		It appears you've visited this page by accident. Click <b>Go Back</b> 
		to return to safety. If you're visiting a link that was copied or shared, 
		make sure it's all there!</br>
		If you believe you're seeing this page in error, contact us at $contact_email!</br>
		It is also possible the asset you're looking for has changed it's name. If that is
		the case, try searching for it's <b>Asset Tag Number</b>";
	$error_record_nullid_title = "Record Not Found!";
	$error_record_noid = "No record ID has been specified. Try again!";
	$error_record_unknown = "An unknown error has ocurred.";
### Error vars for results.php
	$error_results_badurl_title = "Error! Bad URL";
	$error_results_badurl_desc = "
		We had trouble searching with the information provided. Please go back and try again. If you believe this
		 is an error, feel free to contact us at $contact_email. If you continue to have issues, try using a different
		 search method.
		";
### Need to revisit these... at least rename them.	
	$error_record_page = 'Error: Could not fetch item info. Refresh and try again';
	$error_record_notfound = 'This item could not be found. Perhaps you clicked on a bad link?';
?>