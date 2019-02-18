<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

#########################
#   USEFUL VARIABLES    #
#########################

$alert_text = "";

$contact_email = "contact@jadefury.com";
$link_github = "https://github.com/applessmillion/";

###Variables for the elemets on each webpage
$webpage_contenttable_width = 710; //table width
$webpage_contentborder_width = ($webpage_contenttable_width-18); //border width
$webpage_border_color = "#00137F"; //line break color
$webpage_border_length = "65%";	   //line break width
$webpage_device_iframe_height = 370;
$webpage_table_text_labelcolor = "blue";

##Widget-like HTML that contains the corners and border for the content box
$webpage_topcontentbox = '<img src="img/corner.png" width="9"><img src="img/border.png" width="'.$webpage_contentborder_width.'" height="9" border="0"><img src="img/corner2.png" width="9"><table align="center" width="'.$webpage_contenttable_width.'" style="background-color:white">';
$webpage_bottomcontentbox = '</table><img src="img/corner3.png" width="9" ><img src="img/border.png" width="'.$webpage_contentborder_width.'" height="9" border="0"><img src="img/corner4.png" width="9"></br></br></br></br>';

### News and stuff
$text_recentnews_first_date = "February 16, 2018";
$text_recentnews_first_text = "Advanced search is a WIP.";
$text_recentnews_second_date = "February 13, 2018";
$text_recentnews_second_text = "Variables are being updated. If you find an odd paragraph, I'm working on it!";

##Other text stuff
$text_goback = "Go Back</br>";

$text_search_displayinfo_title = "Showing info for Asset #";

$text_search_noresults_title = "Nothing Found!";
$text_search_noresults_desc = "Try going back and refining your search.";

#########################
# ERROR PAGE VARIABLES  #
#########################
$error404_page_title = "SHU-Explorer - Internal Server Error (500)";
$error404_page_headtext = "Error - Internal Server Error";
$error404_page_description = "<center>The page you're looking for couldn't be found. Try <a href='../'>returning home</a>. If you think this is an error, feel free to contact us at ".$contact_email.".</center>";
$error500_page_title = "SHU-Explorer - Page Not Found";
$error500_page_headtext = "Error - Page Not Found";
$error500_page_description = "<center>Looks like our server is having some trouble. Try refreshing, and if the problem persists, feel free to contact us at ".$contact_email.".</center>";

$error_record_page = 'Error: Could not fetch item info. Refresh and try again';
$error_record_notfound = 'This item could not be found. Perhaps you clicked on a bad link?';
$error_record_nullid = '<h2 style="color:red;">Item Not Found!</h2></br>We were unable to find a record matching your results. Try searching again.';
$error_record_timeout = '<h2 style="color:red;">Page Timed Out!</h2></br>Something prevented us from getting a live look at this item. Please try again later.';
$error_record_updated = '<h2 style="color:red;">Just Updated!</h2></br>The asset has just been updated! You can view the changes by refreshing the page.';

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

###Stats Title
$stats_title = "";

$stats_desc = "";

### QuickSearch Title
$quicksearch_title = "Quick Search";

### QuickSearch Main Description
$quicksearch_desc = "
Search for a device using it's Asset Tag number. </br>The asset tag should be composed of 5 numbers, usually starting with 13, 14, or 15.
If your search is too broad, it will be limited to 50 results.
";

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
Do the about for SHU Explorer.
</br></br>
Need to contact us about anything? Send an email to <b>$contact_email</b></br>
SHU-Explorer's source code is also available. <a class='head' href='$link_github'>Find me on GitHub</a>.</br>
";

#Advsearch - Paragraph title
$advsearch_title = "Advanced Search";

#AdvancedSearch - Main Descritpion
$advsearch_desc = "
Search for a device using a selection of options. </br>Select which search you would like to use by filling out the needed info.
If your search is too broad, it will be limited to 50 results.
";


#Copyright notice for MaraPets. Required. Change only when needed/requested.
$copyright_notice = "Copyright 2019. JADEFURY/Benjamin Robert. All Rights Reserved.";

#########################
#  COMPLETE WEB TEXTS   #
#########################

#Users - user page description
$page_stats = "
<h3>$stats_title</h3>
$stats_desc
";

$page_index = "
<h3>$index_title</h3>
$index_desc
</br></br>
<h3>$quicksearch_title</h3>
$quicksearch_desc
";

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
<h3>Recent Updates</h3>
<p><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></p>
<p><strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
</br>
";

### About Widget
$widget_aboutinfo = "
A Senior Seminar project for Siena Heights University.</br>
$copyright_notice</br>
By using our service, you acknowledge that we use cookies to customize your experience.
";

### Webpage border
$widget_webpage_border = "<hr style='border-color:$webpage_border_color; width:$webpage_border_length;'></br>";

### Webpage border - longer
$widget_webpage_border_large = "<hr style='border-color:$webpage_border_color; width:80%;'>";

### Webpage border - medium adaptive
$widget_webpage_border_medium = "<hr style='border-color:$webpage_border_color; width:55%;'>";

### For alerts at the top of the page
$widget_webpage_alert = '
<table align="center" width="860" height="48" style="background-color:#540000;"><tr>
<th align="left" style="background-color:#F26060;"><strong>'.$alert_text.'</strong></th>
</tr></table></br></br>';

#########################
#    TECH VARIABLES     #
#########################
$tech_css_js_styleimports = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';


###### DEPRECATED VARIABLES
# Pending deletion
$var_users_title = "var_users_title";
$var_users_desc = "var_users_desc";
$var_logging_cooldown = 29000;
?>