<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

### Include alert variables. Alert vars can be edited via vars_alert.php. 
include_once 'alert_vars.php';

#########################
#   USEFUL VARIABLES    #
#########################

### Contact details. Used on the about page mainly.
	$contact_email = "contact@jadefury.com";
	$link_github = "https://github.com/applessmillion/";

### News and stuff. Displays in the $widget_updates.
	$text_recentnews_title = "Recent Updates & Notices";
	$text_recentnews_first_date = "February 21, 2018";
	$text_recentnews_first_text = "Polishing up the basic search. Advanced search coming soon!";
	$text_recentnews_second_date = "February 13, 2018";
	$text_recentnews_second_text = "Variables are being updated. If you find an odd paragraph, I'm working on it!";

### Variables for the elemets on each webpage
	$webpage_contenttable_width = 710; 								 	//table width
	$webpage_contentborder_width = ($webpage_contenttable_width-18); 	//border width
	$webpage_border_color = "#00137F"; 									//line break color
	$webpage_border_length = "65%";	   									//line break width
	$webpage_device_iframe_height = 370;								//iframe height. Used on search for iteminfo.php
	$webpage_maincontent_css = "max-width:1300px";						//100% size for alert, 80% of main content max size.
	$webpage_table_text_labelcolor = "blue";
	$webpage_head_image_css = 'width="18%" style="min-width:156px;max-width:256px;"';

### Copyright notice for SHU-Explorer.
	$copyright_notice = "Copyright 2019. JADEFURY/Benjamin Robert. All Rights Reserved.";
	

#########################
# ERROR PAGE VARIABLES  #
#########################
### Variables displayed on 500 pages. 
	$error500_page_title = "Internal Server Error (500)";
	$error500_page_headtext = "500 Error - Internal Server Error";
	$error500_page_description = "The page you're looking for couldn't be found. Try <a href='../'>returning home</a>. If you think this is an error, feel free to contact us at $contact_email";

### Variables displayed on 404 pages. 
	$error404_page_title = "Page Not Found";
	$error404_page_headtext = "404 Error - Page Not Found";
	$error404_page_description = "Looks like our server is having some trouble. Try refreshing, and if the problem persists, feel free to contact us at $contact_email";

### Need to revisit these... at least rename them.	
$error_record_page = 'Error: Could not fetch item info. Refresh and try again';
$error_record_notfound = 'This item could not be found. Perhaps you clicked on a bad link?';

$error_record_nullid_desc = 'We were unable to find a record matching your results. Try searching again.';
$error_record_nullid_title = "Record Not Found!";


#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

##Other text stuff
	$text_goback = "Go Back</br>";
	
### Text used in the quick search
	$text_search_form_assetsearch_title = "Search by Asset Number";
	$text_search_form_assetsearch_label = "Asset Tag Number:";
	$text_search_head_title = "Quick Search";
	$text_search_body_title = "Quickly Search by Asset Tag Number";
	$text_search_body_desc = "
		Search for a computer or device using the tag number. The asset tag should be composed of 5 numbers, usually starting with 13, 14, or 15.
		If your search is too broad, it will be limited to 30 results. Asset tags can be found on all Siena Heights computers, and some other
		devices found in classrooms and offices. Look for a silver sticker with the words SIENA HEIGHTS UNIVERSITY to find it's number.
		";
		
	$text_search_displayasset_title = "Displaying information for Asset No. ";
	$text_search_displayname_title = "Showing information for ";
	$text_search_noresults_title = "Nothing Found!";
	$text_search_noresults_desc = "Try going back and refining your search.";
	$text_search_results_head1 = "Asset No.";
	$text_search_results_head2 = "Device Name";
	$text_search_results_head3 = "Device Type";

### QuickSearch Title
$quick = "Quick Search";

### QuickSearch Main Description


### Advanced Search Main Description
$advsearch_desc = "
Advanced Search description.
";

### Index title - title of the paragraph
$index_title = "SHU-Explorer - Asset Searching Tool";

#Index - Main Description (kinda a combo of above)
$index_desc = "
SHU-Explorer contains records on various IT-related assets located at Siena Heights University. 
By using the various search tools, you can find information relating to any of these assets, such as
location, name, device owner, along with other details.
";

#About - Paragraph title
$about_title = "What is SHU-Explorer?";

#About - Main Descritpion
$about_desc = "
SHU-Explorer contains records on various IT-related assets at Siena Heights University. 
By using the various search tools, you can find information relating to any of these assets, such as
location, name, device owner, along with other details.</br>
SHU-Explorer is a project developed per requirement of graduating with a Computer Information Systems major at Siena Heights University.
Project <i>overseen</i> by Professor Hong Chen at Siena Heights University. Project created, developed, and content overseen by Benjamin Robert.</br>
Any and all work derived, copied, or based from this project to be used in any other work is to be attributed correctly per the BSD 3-Clause License. Visit the LICENSE file on GitHub (link below) for more information.</br>
Project is based on Maralook (See GitHub). Major edits were introduced to accomodate for the different data structure and theme of the website.
</br></br>
Need to contact us about anything? Send an email to <b>$contact_email</b></br>
SHU-Explorer's source code is also available. <a class='head' href='$link_github'>Find me on GitHub</a>.</br>
";

#Advsearch - Paragraph title
$advsearch_title = "Advanced Search";

#AdvancedSearch - Main Descritpion
$advsearch_desc = "
Search for a device using a selection of options. </br>Select which search you would like to use by filling out the needed info.
If your search is too broad, it will be limited to 30 results.
";

### Stat.php text variables
	$stat_title = "Some Statistical Stats";
	$stat_desc = "See stats webpage to edit. Since it uses PHP snippets, I've gone ahead and just put the text in that file directly.";

#########################
#  COMPLETE WEB TEXTS   #
#########################

#Users - user page description
$page_stats = "page_stats. Use stat_title and stat_desc pls.";

$page_index = "dep page_index";

$page_quicksearch = "
<h3>$quicksearch_title</h3>
$quicksearch_desc
</br>
";

$page_advsearch = "
<h3>$advsearch_title</h3>
$advsearch_desc
</br>
";

#########################
#    WEBPAGE WIDGETS    #
#########################

### Recent News Widget
	$widget_updates = "
		<h3>$text_recentnews_title</h3>
		<p><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></br>
		<strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
		</br>
	";

### About Widget
	$widget_aboutinfo = 
		"A Senior Seminar project for Siena Heights University.</br>
		$copyright_notice</br>
		By using our service, you acknowledge that we use cookies to customize your experience.
		";

### Webpage border - lg
	$widget_webpage_border_large = "<hr style='border-color:$webpage_border_color; width:85%;'>";

### Webpage border - med-lg
	$widget_webpage_border = "<hr style='border-color:$webpage_border_color; width:70%;'></br>";

### Webpage border - med
	$widget_webpage_border_medium = "<hr style='border-color:$webpage_border_color; width:55%;'>";

### For alerts at the top of the page
	$widget_webpage_alert = '
		<div class="card" style="background-color:$webpage_alert_bg_color;border:4px solid $webpage_alert_border_color.">
			<b class="mt-1" style="text-center;font-size:24px;">$alert_title</b>
			<b class="my-1" "style="font-size:16px;">$alert_text</b>
		</div>
		</br></br>';

### Content boxes that are used on almost every page. Sets up the layout for the main content.
	$webpage_topcontentbox = 
		'<div class="card" style="margin: 0 auto;max-width:80%">
			<table align="center" width="$webpage_contenttable_width" style="background-color:white" class="table table-bordered">
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
$tech_html_head_start_body = 
		$tech_css_js_styleimports . '<body style="background:url(img/bg.png) no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';


#########################
# DEPRECATED VARIABLES  #
#########################
### Pending deletion
	$error_record_timeout = 'DEPRECTED error_record_timeout';
	$error_record_updated = 'DEPRECTED error_record_updated';
	$quicksearch_desc = 'renamed'
?>