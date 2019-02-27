<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

### Include alert variables. Alert vars can be edited via vars_alert.php. 
include_once 'vars_alert.php';
include_once 'vars_news.php';

#########################
#   USEFUL VARIABLES    #
#########################

### Contact details. Used on the about page mainly.
	$contact_email = "contact@jadefury.com";
	$link_github = "https://github.com/applessmillion/";

### Variables for the elemets on each webpage
	$webpage_contenttable_width = 710; 								 	//table width
	$webpage_contentborder_width = ($webpage_contenttable_width-18); 	//border width
	$webpage_border_color = "#00137F"; 									//line break color
	$webpage_border_length = "65%";	   									//line break width
	$webpage_device_iframe_height = 400;								//iframe height. Used on search for iteminfo.php
	$webpage_maincontent_css = "max-width:1300px;";						//100% size for alert, 80% of main content max size.
	$webpage_table_text_labelcolor = "blue";
	$webpage_head_image_css = 'width="18%" style="min-width:156px;max-width:256px;"';
	$table_tagcol_text_size = 20;

### Copyright notice for SHU-Explorer.
	$copyright_notice = "Copyright 2019. JADEFURY LLC/Benjamin Robert. All Rights Reserved.";
	
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

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

### Page browser titles
	$text_unspecified_title = " | SHU-Explorer";
	$text_iteminfo_page_title = "Asset Info | SHU-Explorer";
	$text_results_page_title = "Search Results | SHU-Explorer";

### I made it into a button now. So it's not text, but it's everywhere, so...
	$text_goback = '<button type="button" class="btn btn-lg btn-dark">Go Back</button>';	
### Text used in the asset search.
	$text_search_form_assetsearch_title = "Search by Asset Number";
	$text_search_form_assetsearch_label = "Asset Tag Number:";
	$text_search_form_namesearch_title = "Search by Computer Name";
	$text_search_form_namesearch_label = "Computer Name:";
	$text_search_head_title = "Asset Search";
	$text_search_body_title = "Search for Devices";
	$text_search_body_desc = "
		Search for an asset using the methods below. Partial search terms will display records closely matching what you've entered.
		If your search term is too broad, up to 30 records will be shown. From the results page, you can click on a record for more
		detailed information, such as the asset service tag, last IP, last user logged in, and more.
		";	
### Text displayed on the asset search page
	$text_search_displayasset_title = "Displaying information for Asset No. ";
	$text_search_displayname_title = "Showing information for ";
	$text_search_noresults_title = "Nothing Found!";
	$text_search_noresults_desc = "We were unable to find a single record matching your search. Try refining your search term, or try a different search method.";
	$text_search_results_head1 = "Asset No.";
	$text_search_results_head2 = "Device Name";
	$text_search_results_head3 = "Device Type";
	$text_search_results_null_title = "Showing 30 Results";
	$text_search_results_null_desc = "It appears you did not enter any data when searching. Go back and enter something into the search box, or browse the random devices below.";
### Text displayed on the asset's info page
	$text_search_display_body_title = "Device Activity";
	$text_search_display_body_desc = "
		Below you can view the most-recent activity to the asset.
		Activity includes a change in IP, a user logging on, or the device name being changed.
		";
	$text_search_display_nohistory = "
		This asset has no history :(
		";
### Text used in the infopage.php
	$text_iteminfo_devicetype_server = "This Device is a SHU server";
	$text_iteminfo_assetinfo_title = "ASSET INFORMATION";
	$text_iteminfo_deviceinfo_title = "DEVICE INFORMATION";
	$text_infobox_lastedit = "Last Edited: ";
	$text_infobox_created = "Asset Added: ";
	$text_iteminfo_btn_newtab = "Open in New Tab";
	$text_iteminfo_btn_spiceworks = "Spiceworks Search";
	$text_iteminfo_btn_edit = "Edit Info";
### Text used in stats.php page
	$text_stat_head_title = "Some Statistical Stats";
	$text_stat_body_desc = "See stats webpage to edit. Since it uses PHP snippets, I've gone ahead and just put the text in that file directly.";
### Index texts
	$text_index_body_title = "SHU-Explorer - Asset Searching Tool";
	$text_index_body_desc = "
		SHU-Explorer contains records on various IT-related assets located at Siena Heights University. 
		By using the various search tools, you can find information relating to any of these assets, such as
		location, name, device owner, along with other details.
		";
### About page texts
	$text_about_body_title = "What is SHU-Explorer?";
	$text_about_body_desc = "
		SHU-Explorer contains records on various IT-related assets at Siena Heights University. 
		You can find information relating to any of these assets, such as name, recent IP, service tag, and more.</br>
		This project exists as a Senior Seminar project. More info on this can be seen on the GitHub page.</br>
		Class taught by Professor Hong Chen at Siena Heights University. Project created and developed by Benjamin Robert.</br>
		Any work derived or based from this project is to be attributed correctly per the MIT License. Visit the LICENSE file on GitHub for more information.</br>
		</br></br>
		Need to contact us about anything? Send an email to <b>$contact_email</b></br>
		SHU-Explorer's source code is also available. <a class='head' href='$link_github'>Find me on GitHub</a>.</br>
		";

#########################
#    WEBPAGE WIDGETS    #
#########################
### Recent News widget moved to it's own php page.
### Site-Wide Alert widget moved to it's own php page.

### About Widget
	$widget_aboutinfo = 
		"A Senior Seminar project for Siena Heights University.</br>
		$copyright_notice</br>
		By using our service, you acknowledge that we use cookies to customize your experience.
		";

### Webpage border - lg
	$widget_webpage_border_large = "<hr style='border-color:$webpage_border_color; width:85%;'>";

### Webpage border - med-lg
	$widget_webpage_border = "<hr style='border-color:$webpage_border_color; width:70%;'>";

### Webpage border - med
	$widget_webpage_border_medium = "<hr style='border-color:$webpage_border_color; width:55%;'>";

### Content boxes that are used on almost every page. Sets up the layout for the main content.
	$webpage_topcontentbox = 
		'<div class="card" style="margin: 0 auto;max-width:80%">
			<table align="center" width="$webpage_contenttable_width" style="background-color:white" class="table table-borderless">
				<tbody>';
				
	$webpage_bottomcontentbox = 
		'		</tbody>
			</table>
		</div>
		</br>';

#########################
#    TECH VARIABLES     #
#########################

### Imports the few lines required for Bootstrap. 
$tech_css_js_styleimports = '
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

### Starts the page. Includes the var above and the body tag to include a few needed variables.
$randbg = rand(1,4);
$page_bg = "img/bg$randbg.jpg";

$tech_html_head_start_body = $tech_css_js_styleimports . '<body style="background:url('.$page_bg.') no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';

?>