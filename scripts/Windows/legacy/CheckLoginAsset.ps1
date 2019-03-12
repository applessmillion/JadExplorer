### Powershell script to visit a website based on system variables.
# Updates and adds info for an existing asset.

### Gather method info.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$domain = Get-CimInstance -ClassName Win32_ComputerSystem -Property Domain | Select-Object -ExpandProperty Domain;

### Check if servicecode is defined. If not, we gotta update via tag number.
if(!$computer_servicetag){ $method = "tag" }
if($computer_servicetag){ $method = "service" }

### Let's define our update variables below.
$curuser = $env:USERNAME
$computer_ip = Get-NetIPAddress -PrefixOrigin Dhcp | Select-Object -ExpandProperty IPAddress;

### URL to visit. As long as the above variables do not contain an &, we should be fine.
$visit_url = "http://www.junklands.com/web/updatetool.php?method="+$method+"&cname="+$computer_name+"&ctag="+$computer_servicetag+"&cip="+$computer_ip+"&curuser="+$curuser;

if($domain = "sienahts.edu"){ Invoke-WebRequest -Uri $visit_url; }

exit
