<?php
### Demo version of main.php. Will override everything in main if enabled. 

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

### Page browser titles
	$text_unspecified_title = " | JadeXplorer Demo";
	
### Statistic page text variables. There are a lot..
	$text_stat_head_title = "Statistics";
	$text_stat_body_desc = "This demo includes statistics acquired from the database used for Siena Heights Univeristy. 
		There are currently 8 different statistics, each featuring unique insights about the website and 
		the data gathered.";
	$text_stat_body_recentlogins = "
		Below is a list of the 10 most-recent edits and logins made to assets. You can click on the asset tag or 
		name of the asset to go to the information page.
		";

### Text used in the asset search.
	$text_search_body_desc = "
		Search for computer-related assets using the methods below. Partial search terms will display records closely matching what you've entered.
		If your search term is too broad, up to 30 records will be shown. From the results page, you can click on a record for more
		detailed information, such as the asset service tag, last IP, last user logged in, and more. Information will only be shown for devices we've collected.
		";	
### Text displayed on the asset search page
	$text_search_displayasset_title = "Displaying information for Asset No. ";
	$text_search_displayname_title = "Showing information for ";
	$text_search_username_title = "Showing recent devices for ";
	$text_search_noresults_title = "Results Not Found.";
	$text_search_noresults_desc = "We were unable to find a record matching your search. Try refining your search, or try a different search method.";
	$text_search_results_content_desc = "Click on the asset tag number or asset name for more information.";
	$text_search_results_content_user_desc = "Below is a list of devices the user has logged into.";
	$text_search_results_null_title = "Showing Randomized Results";
	$text_search_results_null_desc = "It appears you did not enter any data when searching. Go back and enter something into the search box, or browse the random devices below.";

### Index texts
	$text_index_body_title = "JadeXplorer - Device Searching Tool";
	$text_index_body_desc = "
		This is a demo version of JadeExplorer. The demo version provides more information about pages
		and what they do. It also disables certain aspects of the website, such as page views and editing.
		JadeXplorer contains records on various IT-related assets located at Siena Heights University. 
		By using the various search tools, you can find information relating to any of these assets, such as
		location, name, device owner, along with other details.
		";
### About page texts
	$text_about_body_title = "What is JadeXplorer?";
	$text_about_body_desc = "
		JadeXplorer contains records on various IT-related assets at Siena Heights University. 
		You can find information relating to any of these assets, such as name, recent IP, service tag, and more.</br>
		This project exists as a Senior Seminar project. More info on this can be seen on the GitHub page.</br>
		Class taught by Professor Hong Chen at Siena Heights University. Project created and developed by Benjamin Robert.</br>
		Any work derived or based from this project is to be attributed correctly per the MIT License. Visit the LICENSE file on GitHub for more information.</br>
		</br></br>
		Need to contact us about anything? Send an email to <b>".$contact_email."</b></br>
		JadeXplorer's source code is also available. <a class='head' href='".$link_github."'>Find me on GitHub</a>.</br>
		";

### About Widget
	$widget_aboutinfo = 
		"A Senior Seminar project for Siena Heights University.</br>
		".$copyright_notice."</br>
		By using our service, you acknowledge that we use cookies to customize your experience.
		";

### ONLY set to true when your server clock does not change for DST and DST is observed.
$enable_daylight_savings_adjustments = TRUE; //Does magic voodoo to fix DST-related issues.

?>