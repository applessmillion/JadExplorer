<?php
/* This page is used as the holder of mySQL connection info.
It is simply here now to show the variables and such.
*/
$ip   = "107.180.51.34"; //MySQL Server IP
$db   = "shuexplorer"; //Database

### Standard account. Should have READ & basic access only.
# This account will fetch info from our db.
$user = "shu_navigator"; //MySQL user
$pw   = "jadedfury"; //MySQL password

### Privileged account. Should have WRITE access and a bit more.
# This account is used in the creationtool.php. 
# Eventually it will also need to edit records.
$user = ""; //MySQL PRIVILEGED user
$pw   = ""; //MySQL PRIVILEGED password




?>