<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */
$JADEXPLORER_VERSION = "1.1.190403";
#########################
#     HARD SETTINGS     #
#########################
$ASSET_TAG_LENGTH_MAX 				= 5; //Still hardcoded. Will migrate soon.
$ASSET_TAG_LENGTH_MIN 				= 5;
$DISPLAY_NEWS 						= FALSE; //Displays custom content from vars/news.php if set to TRUE.
$CUSTOM_LINK_1_ENABLE	 			= TRUE;
$CUSTOM_LINK_2_ENABLE 				= FALSE;
$ENABLE_SPICEWORKS_INTEGRATION 		= TRUE; //Show spiceworks button on iteminfo
$link_spiceworks_query 				= "https://spiceworks.sienaheights.edu/search?query=";
$link_dell_servicetag_support 		= "https://www.dell.com/support/home/us/en/04/product-support/servicetag/";
$link_acer_servicetag_support 		= "https://www.acer.com/ac/en/US/content/support/";

### Include other files containing variables. These files are used to better categorize variables.
include_once 'contact.php';
include_once 'formatting.php';
include_once 'error.php';
include_once 'alert.php';
include_once 'news.php';
include_once 'headervars.php';
include_once 'footer.php';

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################
	$text_website_name 				= "SHUXplorer"; //Set this for site-wide custom branding.
### Page browser titles
	$text_unspecified_title 		= " | $text_website_name";
	$text_iteminfo_page_title 		= "Asset Info$text_unspecified_title";
	$text_search_page_title 		= "Search$text_unspecified_title";
	$text_about_page_title 			= "About$text_unspecified_title";
	$text_index_page_title 			= "Home$text_unspecified_title";
	$text_stats_page_title 			= "Statistics$text_unspecified_title";
	$text_results_page_title 		= "Search Results$text_unspecified_title";
	$text_edit_page_title 			= "Edit Asset$text_unspecified_title";
	
### Statistic page text variables. There are a lot..
	$text_stat_head_title 			= "Statistics";
	$text_stat_body_desc 			= "Various statistics can be viewed from this page about the assets and devices 
									found by $text_website_name. These statistics include overall information along
									with recent additions to entries. You can also view recent device edits and
									user logins.";
	$text_stat_body_desc2			= ""; //Displays below the first bit of stats. Above user/recent tables.
	$text_stat_table_head_device 	= "Device Name";
	$text_stat_table_head_user 		= "Username";
	$text_stat_table_head_edit 		= "Edit Description";
	$text_stat_desc_mostviewed 		= "Most viewed asset!";
	$text_stat_desc_newasset 		= "Newest asset added!";
	$text_stat_desc_newtag 			= "Highest Asset Tag!";
	$text_stat_desc_recentulogin 	= "Most recent user to log in!";
	$text_stat_desc_recentdlogin	= "Most recent device logged into!";
	$text_stat_desc_uniqued		 	= "Unique device types!";
	$text_stat_desc_uniquea 		= "Unique assets added!";
	$text_stat_desc_pageviews 		= "Total asset page views!";
	$text_stat_desc_assetno 		= "Asset #";

### I made it into a button now. So it's not text, but it's everywhere, so...
	$text_goback 					= '<button type="button" class="btn btn-lg btn-dark">Go Back</button>';	
	$button_next_page 				= '<button type="button" class="btn btn-primary">Next Page</button>';	
	$button_previous_page			= '<button type="button" class="btn btn-secondary">Previous Page</button>';	
	$button_device_list 			= '<button type="button" class="btn btn-primary">Devices</button>';	
	$button_os_list 				= '<button type="button" class="btn btn-primary">OS Versions</button>';	
	$button_login_list 				= '<button type="button" class="btn btn-primary">User Logins</button>';	
	$button_login_d 				= '<button type="button" class="btn btn-outline-dark">24 Hours</button>';	
	$button_login_w 				= '<button type="button" class="btn btn-outline-dark">1 Week</button>';	
	$button_login_m 				= '<button type="button" class="btn btn-outline-dark">1 Month</button>';	
	$button_login_y 				= '<button type="button" class="btn btn-outline-dark">1 Year</button>';	

	
### Text used in the asset search.
$text_search_form_assetsearch_title 	= "Search by Asset Number";
$text_search_form_assetsearch_label 	= "Asset Tag Number:";
$text_search_form_namesearch_title 		= "Search by Name";
$text_search_form_namesearch_label 		= "Computer Name:";
$text_search_form_unamesearch_title 	= "Search by Username";
$text_search_form_unamesearch_label 	= "Username:";
$text_search_head_title 				= "Search for Computer Assets";
$text_search_body_title 				= "Search for Devices";
$text_search_body_desc 					= "
		Search for computer-related assets using the methods below. Partial search terms will display records closely matching what you've entered.
		If your search term is too broad, the results will be limited. From the results, you can click on a record for more
		detailed information, such as the asset service tag, last IP, edit and login history, and more.
		";	
$text_search_activity_head_log 			= "Time";
$text_search_activity_head_desc 		= "Description";

### Text displayed on the asset search page
$text_search_displayasset_title 		= "Displaying information for Asset No. ";
$text_search_displayname_title 			= "Showing information for ";
$text_search_username_title 			= "Showing recent devices for ";
$text_search_noresults_title 			= "Results Not Found.";
$text_search_noresults_desc 			= "We were unable to find a record matching your search. Try refining your search, or try a different search method.";
$text_search_results_content_desc 		= "Below is a list of the results found from your search. Click on the asset tag number or asset name for more information.";
$text_search_results_content_user_desc 	= "Below is a list of devices the user has logged into.";
$text_search_results_head1 				= "Asset No.";
$text_search_results_head2 				= "Device Name";
$text_search_results_head3 				= "Device Type";
$text_search_results_head4 				= "Login Date";
$text_search_results_head5 				= "Operating System";
$text_search_results_null_title 		= "Showing Randomized Results";
$text_search_results_null_desc 			= "It appears you did not enter any data when searching. Go back and enter something into the search box, or browse the random info below.";
### Text displayed on the asset's info page
$text_search_display_body_title = "Device Activity";
$text_search_display_body_desc = "
		Below is a list of the most recent activity to this asset. Activity includes user edits, logins, restarts, and other 
		Activity includes a change in IP, a user logging on, or the device name being changed.
		";
$text_search_display_nohistory = "No history could be found on this asset.";
### Text used in the infopage.php
$text_iteminfo_devicetype_server = "This device is a server";
$text_iteminfo_assetinfo_title = "ASSET INFORMATION";
$text_iteminfo_deviceinfo_title = "DEVICE INFORMATION";
$text_infobox_lastedit = "Last Edited: ";
$text_infobox_buydate = "Purchase Date: ";
$text_infobox_created = "Asset Added: ";
$text_iteminfo_btn_newtab = "Open in New Tab";
$text_iteminfo_btn_spiceworks = "Spiceworks Search";
$text_iteminfo_btn_edit = "Edit Info";
	
### Index texts
$text_index_body_title = "SHUXplorer - Knowing Your Inventory";
$text_index_body_desc 			= "SHUXplorer contains records on various IT-related assets located at Siena Heights University. ";
$text_index_body_info_head1 	= "Searching Assets";
$text_index_body_info_desc1 	= "Using the search, you can find assets logged and updated by SHUXplorer.
								 Useful information, such as Service Tag, Device Model, and Internal IP, will be shown
								 along with a list of recent logins and edits to the device.";
$text_index_body_info_head2 	= "Device List";
$text_index_body_info_desc2 	= "The device list shows every device type logged by SHUXplorer. Every asset is counted 
									and is displayed upon clicking for more information. This is especially useful for finding
									active assets that are a certain device, or simply knowing what types of computers are out there.";
$text_index_body_info_head3 	= "Statistical Logging";
$text_index_body_info_desc3 	= "The statistics page shows various information regarding what has been logged, along with displaying 
									recent user logins and asset edits.";
$text_index_body_info_head4 	= "Creating & Editing Entries";
$text_index_body_info_desc4 	= "To create or edit an asset, you must be logged in (WIP)";
### Text used in lists.php
$text_lists_device_list_title = "Devices";
$text_lists_device_list_desc = "A list of devices that have been added. The list is ordered by the number of assets that are of that device type.";
$text_lists_os_list_title = "Computer Operating Systems";
$text_lists_os_list_desc = "Unique operating systems detected on computers that check in. Offers the OS version, build number, and the number of devices that are running that version of the OS.";
$text_lists_login_list_title = "Recent User Logins Within "; //Leave end blank for the interval.
$text_lists_login_list_desc = "A list of unique user logins per computer in a given timeframe. Shows the asset name, most-recent user, the date of the most recent login, 
								and the total login count for the given time period.";
$text_lists_table_head_assetname 	= "Asset Name";
$text_lists_table_head_recentuser 	= "Recent User";
$text_lists_table_head_lastlogin 	= "Last Login Date";
$text_lists_table_head_os 			= "Operating System";
$text_lists_table_head_osversion	= "OS Version";
$text_lists_table_head_devicetotal 	= "Total Devices";
$text_lists_table_head_userlogins 	= "User Logins";
$text_lists_table_head_devicemodel 	= "Model";
$text_lists_table_head_devicemanu 	= "Manufacturer";
$text_lists_table_head_deviceprice 	= "Price (USD)";

### About page texts
	$text_about_body_title = "What is SHUXplorer?";
	$text_about_body_desc = "
		SHUXplorer contains records on various IT-related assets at Siena Heights University. 
		You can find information relating to any of these assets, such as name, recent IP, service tag, and more.</br>
		</br></br>
		Need to contact us about anything? Send an email to <b>".$contact_email_admin."</b></br>
		.</br>
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
		'<div class="card" style="margin: 0 auto;max-width:90%">
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

### Set to true if your area observes DST and your server clock does not change for it.
$enable_daylight_savings_adjustments = FALSE; //Does magic voodoo to fix DST-related issues.

### Imports the few lines required for Bootstrap. 
$tech_css_js_styleimports = '
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

### Starts the page. Includes the var above and the body tag to include a few needed variables.
$randbg = rand(1,3);
$page_bg = "img/bg$randbg.jpg";
$account_bg = "../img/bg$randbg.jpg";
$tech_html_head_start_body = $tech_css_js_styleimports . '<body style="background:url('.$page_bg.') no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';
$tech_html_head_start_body_account = $tech_css_js_styleimports . '<body style="background:url('.$account_bg.') no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';

$utility_timezone_offset = 0; //In seconds. Calculate offset in seconds from Server timezone (2HOURS*60SECONDS*60MINUTES)
$utility_noshow_devices_before = "2000";	//Purchase dates will not be shown before this year.
?>