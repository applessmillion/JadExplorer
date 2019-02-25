### Powershell script to visit a website based on system variables.
# Updates and adds info for an existing asset.

### Gather method info.
$computer_name = Get-ChildItem Env:Computername;
$computer_servicetag = wmic bios get serialnumber;

### Check if servicecode is defined. If not, we gotta update via tag number.
if(!$computer_servicetag){ $method = "tag" }
else{ $method = "service" }

### Let's define our update variables below.
$curuser = Get-ChildItem Env:Username # Requires a .Value to pull value.

### URL to visit. As long as the above variables do not contain an &, we should be fine.
$visit_url = "http://www.junklands.com/web/updatetool.php?method="+$method

### Run the command to load the URL.
Invoke-WebRequest -Uri $visit_url;