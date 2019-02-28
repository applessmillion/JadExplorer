<?php
#########################
#    RECENT NEWS VARS   #
#########################
$DISPLAY_NEWS = true;

### News and stuff. Displays in the $widget_updates.
	$text_recentnews_title = "Recent Updates & Notices";
	$text_recentnews_first_date = "February 28, 2018";
	$text_recentnews_first_text = "Device Service Tags for Dell devices will now link to Dell's website with info on the product.";
	$text_recentnews_second_date = "February 26, 2018";
	$text_recentnews_second_text = "Working on optimizing page backgrounds and load times.";
	
	
### Recent News Widget
# Let's give myself an option to toggle visibility.
	if($DISPLAY_NEWS == false){
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