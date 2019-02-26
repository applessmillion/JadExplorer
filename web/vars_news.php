<?php
#########################
#    RECENT NEWS VARS   #
#########################
### Recent news variables.

### News and stuff. Displays in the $widget_updates.
	$text_recentnews_title = "Recent Updates & Notices";
	$text_recentnews_first_date = "February 21, 2018";
	$text_recentnews_first_text = "Polishing up the basic search. Advanced search coming soon!";
	$text_recentnews_second_date = "February 13, 2018";
	$text_recentnews_second_text = "Variables are being updated. If you find an odd paragraph, I'm working on it!";
	
	
### Recent News Widget
	$widget_updates = "
		<h3>$text_recentnews_title</h3>
		<p class='mx-5 text-left'><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></br>
		<strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
		</br>
	";

## Other variables are located in the vars.php file.
?>