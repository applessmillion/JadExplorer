<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

#########################
#   USEFUL VARIABLES    #
#########################

$alert_text = "";

$contact_email = "contact@jadefury.com";
$link_github = "https://github.com/applessmillion/";

$webpage_border_color = "#00137F";
$webpage_border_length = "65%";

#Time until an item can get an update to it's current price. Deprecated
$var_logging_cooldown = 29000;

$text_recentnews_first_date = "February 13, 2018";
$text_recentnews_first_text = "Variables are being updated. If you find an odd paragraph, I'm working on it!";
$text_recentnews_second_date = "February 12, 2018";
$text_recentnews_second_text = "Website has been uploaded. <strong>Work in progress!</strong>";

#########################
# ERROR PAGE VARIABLES  #
#########################
$error404_page_title = "SHU-Explorer - Internal Server Error (500)";
$error404_page_headtext = "Error - Internal Server Error";
$error404_page_description = "<center>The page you're looking for couldn't be found. Try <a href='../'>returning home</a>. If you think this is an error, feel free to contact us at ".$contact_email.".</center>";
$error500_page_title = "SHU-Explorer - Page Not Found ";
$error500_page_headtext = "Error - Page Not Found";
$error500_page_description = "<center>Looks like our server is having some trouble. Try refreshing, and if the problem persists, feel free to contact us at ".$contact_email.".</center>";

#########################
#    GENERAL ERRORS     #
#########################
$error_noContentFound_title = "No items were found!";
$error_noContentFound_desc = "We couldn't find anything matching your search. Please go back and try again.";


#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

### Item Main Description
$quicksearch_desc = "
Search for an asset using it's Asset Tag. The asset tag should be composed of 6 numbers, usually starting with 13, 14, or 15.
If your search is broad, up to 50 results will show.
";

#Index - Main Description (kinda a combo of above)
$index_desc = 
"
<h3>SHU-Explorer - What is it?</h3>
<p>The <strong>Item Search</strong> allows you to search.</p>
</br>
$quicksearch_title
$quicksearch_desc
</br>
";

#Copyright notice for MaraPets. Required. Change only when needed/requested.
$copyright_notice = "Copyright 2019. All Rights Reserved.";

#About - Paragraph title
$about_title = "
What is SHU-Explorer?
";

#About - Main Descritpion
$about_desc = "
$widget_webpage_border
</br>
<h3></h3>
<hr style='border-color:$webpage_border_color; width:$webpage_border_length;'>
Do the about for SHU Explorer.</br>
Need to contact us about anything? Send an email to <b>$contact_email</b></br>
SHU-Explorer's source code is also available. <a class='head' href='$link_github'>Find me on GitHub</a>.</br>
";


#########################
#  COMPLETE WEB TEXTS   #
#########################

#Users - user page description
$page_users = "
<h3>$var_users_title</h3>
<h3>$var_users_desc</h3>

";

$page_index = "
$index_title
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
$copyright_notice</br>
A Senior Seminar project for Siena Heights University. Created by Benjamin Robert.</br>
By using our service, you acknowledge that we use cookies to customize your experience.
";

### Webpage border
$widget_webpage_border = "<hr style='border-color:$webpage_border_color; width:$webpage_border_length;'></br>";

#########################
#    STAT VARIABLES     #
#########################
# Deprecated as of 2/13/19. Needs redone.
$statuser = file_get_contents("stats.php?total-users");
$statlog =  file_get_contents("stats.php?total-logs&format");

### DEPRECATED VARIABLES
$var_item_updatetxt = "<strong>var_item_updatetxt - use widget_updates</strong>";
$mainpage_notice = "mainpage_notice. Use alert_text";
$about_madeby = "about_madeby. Use widget_aboutinfo.";
$about_use = "about_use. Use widget_aboutinfo.";
$price_desc = "price_desc";
$item_desc = "item_desc";
$var_users_title = "var_users_title";
$var_users_desc = "var_users_desc";
?>