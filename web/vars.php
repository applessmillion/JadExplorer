<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */

#########################
#   USEFUL VARIABLES    #
#########################

$alert_text = "Notice: This is the alert widget. Whenever you specify something in alert_text, you'll see this message appear. P.S. This website is still a major WIP.";

$contact_email = "contact@jadefury.com";
$link_github = "https://github.com/applessmillion/";

$webpage_border_color = "#00137F";
$webpage_border_length = "65%";

$text_recentnews_first_date = "February 13, 2018";
$text_recentnews_first_text = "Variables are being updated. If you find an odd paragraph, I'm working on it!";
$text_recentnews_second_date = "February 12, 2018";
$text_recentnews_second_text = "Website has been uploaded. <strong>Work in progress!</strong>";
$text_goback = "Go Back";

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

### QuickSearch Main Description
$quicksearch_desc = "
Search for an asset using it's Asset Tag. The asset tag should be composed of 6 numbers, usually starting with 13, 14, or 15.
If your search is broad, up to 50 results will show.
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
$about_title = "
What is SHU-Explorer?
";

#About - Main Descritpion
$about_desc = "
Do the about for SHU Explorer.
</br></br>
Need to contact us about anything? Send an email to <b>$contact_email</b></br>
SHU-Explorer's source code is also available. <a class='head' href='$link_github'>Find me on GitHub</a>.</br>
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
<h4>$quicksearch_title</h4>
$quicksearch_desc
";



#########################
#    WEBPAGE WIDGETS    #
#########################

### Recent News Widget
$widget_updates = "
<h3>Recent Updates</h3>
<p><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></p>
<p><strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
</br></br>
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
$widget_webpage_border_large = "<hr style='border-color:$webpage_border_color; width:80%;'></br>";

### For alerts at the top of the page
$widget_webpage_alert = '
<table align="center" width="760" height="48" style="background-color:#540000;"><tr>
<th align="left" style="background-color:#F26060;"><strong>'.$alert_text.'</strong></th>
</tr></table></br></br>';

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
$var_logging_cooldown = 29000;
?>