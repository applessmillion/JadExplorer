<?php
#########################
#    ALERT VARIABLES    #
#########################
### Alert text variables. 
# Just define a value for alert_text and the alert will display.
	$text_alert_title = "NOTICE";
	$text_alert_desc = "";

## Alert box customization. Colors yay!
	$webpage_alert_border_color = "#7F0000";	//Alert border color. Prefer a darker color than the bg
	$webpage_alert_bg_color = "#FF5E5E";		//Alert bg color. Should be ligher color, cuz text is black.
	
### For alerts at the top of the page
	$widget_webpage_alert = '
		<div class="card" style="background-color:'.$webpage_alert_bg_color.';border:2px solid '.$webpage_alert_border_color.'">
			<b class="mt-1 text-center" style="font-size:24px;">'.$text_alert_title.'</b>
			<b class="my-1 text-left" "style="font-size:16px;">'.$text_alert_desc.'</b>
		</div>
		</br></br>';
		
## Other variables are located in the vars.php file.
?>