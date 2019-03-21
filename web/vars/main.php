<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

#########################
#     HARD SETTINGS     #
#########################
$WEBSITE_DEMO_MODE = FALSE; //Overrides some main.php settings.
$WEBSITE_RESTRICTED_MODE = FALSE; //Removes header and certain functions.
$DISPLAY_NEWS = FALSE;
$ASSET_ID_LENGTH = 5;

### Include other files containing variables. These files are used to better categorize variables.
include_once 'contact.php';
include_once 'formatting.php';
include_once 'alert.php';
include_once 'news.php';
include_once 'error.php';

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

### Page browser titles
	$text_unspecified_title = " | JadeXplorer";
	$text_iteminfo_page_title = "Asset Info$text_unspecified_title";
	$text_search_page_title = "Search$text_unspecified_title";
	$text_about_page_title = "About$text_unspecified_title";
	$text_index_page_title = "Home$text_unspecified_title";
	$text_stats_page_title = "Statistics$text_unspecified_title";
	$text_results_page_title = "Search Results$text_unspecified_title";
	$text_edit_page_title = "Edit Asset$text_unspecified_title";
	
### Statistic page text variables. There are a lot..
	$text_stat_head_title = "Statistics";
	$text_stat_body_desc = "Below is a list of statistics from assets that have been tracked. Device names and asset tags can be clicked on
							for the info page on the asset.";
	$text_stat_body_recentlogins = "
		Below is a list of the 10 most-recent edits and logins made to assets. You can click on the asset tag or 
		name of the asset to go to the information page.
		";
	$text_stat_table_head_device = "Device Name";
	$text_stat_table_head_user = "Username";
	$text_stat_table_head_edit = "Edit Description";
	$text_stat_desc_mostviewed = "Most viewed asset!";
	$text_stat_desc_newasset = "Newest asset added!";
	$text_stat_desc_newtag = "Highest Asset Tag!";
	$text_stat_desc_recentulogin = "Most recent user to log in!";
	$text_stat_desc_recentdlogin = "Most recent device logged into!";
	$text_stat_desc_uniqued = "Unique device types!";
	$text_stat_desc_uniquea = "Unique assets added!";
	$text_stat_desc_pageviews = "Total asset pages views!";
	$text_stat_desc_assetno = "Asset #";

### I made it into a button now. So it's not text, but it's everywhere, so...
	$text_goback = '<button type="button" class="btn btn-lg btn-dark">Go Back</button>';	
### Text used in the asset search.
	$text_search_form_assetsearch_title = "Search by Asset Number";
	$text_search_form_assetsearch_label = "Asset Tag Number:";
	$text_search_form_namesearch_title = "Search by Computer Name";
	$text_search_form_namesearch_label = "Computer Name:";
	$text_search_form_unamesearch_title = "Search by Username";
	$text_search_form_unamesearch_label = "Username:";
	$text_search_head_title = "Search for Computer Assets";
	$text_search_body_title = "Search for Devices";
	$text_search_body_desc = "
		Search for computer-related assets using the methods below. Partial search terms will display records closely matching what you've entered.
		If your search term is too broad, up to 30 records will be shown. From the results page, you can click on a record for more
		detailed information, such as the asset service tag, last IP, last user logged in, and more.
		";	
### Text displayed on the asset search page
	$text_search_displayasset_title = "Displaying information for Asset No. ";
	$text_search_displayname_title = "Showing information for ";
	$text_search_username_title = "Showing recent devices for ";
	$text_search_noresults_title = "Results Not Found.";
	$text_search_noresults_desc = "We were unable to find a record matching your search. Try refining your search, or try a different search method.";
	$text_search_results_content_desc = "Click on the asset tag number or asset name for more information.";
	$text_search_results_content_user_desc = "Below is a list of devices the user has logged into.";
	$text_search_results_head1 = "Asset No.";
	$text_search_results_head2 = "Device Name";
	$text_search_results_head3 = "Device Type";
	$text_search_results_head4 = "Date";
	$text_search_results_null_title = "Showing Randomized Results";
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
	$text_infobox_buydate = "Purchase Date: ";
	$text_infobox_created = "Asset Added: ";
	$text_iteminfo_btn_newtab = "Open in New Tab";
	$text_iteminfo_btn_spiceworks = "Spiceworks Search";
	$text_iteminfo_btn_edit = "Edit Info";
### Index texts
	$text_index_body_title = "JadeXplorer - Device Searching Tool";
	$text_index_body_desc = "
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

#########################
#    WEBPAGE WIDGETS    #
#########################
### Recent News widget moved to it's own php page.
### Site-Wide Alert widget moved to it's own php page.

### About Widget
	$widget_aboutinfo = 
		"A Senior Seminar project for Siena Heights University.</br>
		".$copyright_notice."</br>
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

### ONLY set to true when your server clock does not change for DST and DST is observed.
$enable_daylight_savings_adjustments = TRUE; //Does magic voodoo to fix DST-related issues.


### Imports the few lines required for Bootstrap. 
$tech_css_js_styleimports = '
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

### Starts the page. Includes the var above and the body tag to include a few needed variables.
$randbg = rand(1,3);
$page_bg = "img/bg$randbg.jpg";
$tech_html_head_start_body = $tech_css_js_styleimports . '<body style="background:url('.$page_bg.') no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';

$utility_timezone_offset = 7200; //In seconds. GoDaddy hosts us in Mountain time. Calculate offset in seconds from that timezone (2HOURS*60SECONDS*60MINUTES)
$utility_timezone_offset_origindate = "January 1, 1970";	//Don't change unless you know what you're doing. Default is "December 31, 1969".

if($WEBSITE_DEMO_MODE){ include_once 'demo.php'; }
?>