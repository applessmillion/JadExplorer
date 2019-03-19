<?php
#########################
#    RECENT NEWS VARS   #
#########################
### Allows for the news widget to be disabled.
# Way more convenient than gutting the refrences to it in each individual page.

### News and stuff. Displays in the $widget_updates.
	$text_recentnews_title = "Recent Updates & Notices";
	$text_recentnews_first_date = "March 11, 2018";
	$text_recentnews_first_text = "Added support for Daylight Savings Time. Times will now appear correctly.";
	$text_recentnews_second_date = "March 8, 2018";
	$text_recentnews_second_text = "Testing has begun on login scripts. You may notice some devices updating as they are logged into.";
	
	
### Recent News Widget
# Gives the ability to toggle the display of the news widget.
	if($DISPLAY_NEWS != TRUE){
		$widget_updates = "";
	}
	else{
		$widget_updates = "
			<h3>$text_recentnews_title</h3>
			<p class='mx-5 text-left'><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></br>
			<strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
			</br>
		";
	}

## Other variables are located in the vars.php file.
?>