<?php
#########################
#    RECENT NEWS VARS   #
#########################
$text_recentnews_title 			= "News";
$text_recentnews_first_date 	= "March 30, 2019";
$text_recentnews_first_text 	= "Now pushing out to macOS! terminal scripts will now be included 
								in the standard shipment of JadeXplorer. This allows for all the tracking
								you are used to for a Windows machine, but now extended to our macOS friends.";
$text_recentnews_second_date 	= "March 29, 2019";
$text_recentnews_second_text 	= "This is a standard news block. <b>HTML elemets</b> can be inserted into this since
								PHP just echos this anyways, but I wouldn't get <i>too</i> crazy with the formatting.";
### Recent News Widget
# Webpages call $widget_updates. If it is enabled, the above shows. If not, nothing shows.
# You can easily customize the HTML from here.
	if($DISPLAY_NEWS != TRUE){ $widget_updates = ""; }
	else{
		$widget_updates 		= "
			<h3>$text_recentnews_title</h3>
			<p class='mx-5 text-left'>
				<strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</br>
				<strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text
			</p>
		";
	}
## Other variables are located in the vars.php file. ?>