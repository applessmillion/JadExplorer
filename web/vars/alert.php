<?php
#########################
#    ALERT VARIABLES    #
#########################
$alert_title 					= "";			//Title of alert. Displays at 24pt.
$alert_text 					= "";			//Description of alert. Displays at 16pt. 
$webpage_alert_border_color 	= "#7F0000";	//Alert border color. Prefer a darker color than the background.
$webpage_alert_bg_color 		= "#FF5E5E";	//Alert bg color. Should be ligher color for the text.
	
### HTML for the alert widget. This will display on EVERY page when enabled.
	$widget_webpage_alert = '
		<div class="card p-5" style="background-color:'.$webpage_alert_bg_color.';border:2px solid '.$webpage_alert_border_color.'">
			<b class="mt-1 text-center" style="font-size:24px;">'. $alert_title .'</b>
			<b class="mx-2 my-1 text-left" "style="font-size:16px;">'.$alert_text.'</b>
		</div>
		';
## Other variables are located in the vars.php file. ?>