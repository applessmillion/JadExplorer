### Powershell script to visit a website based on system variables.
# Designed to run on system startup. Checks non-user variables.

### Gather method info.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$domain = Get-CimInstance -ClassName Win32_ComputerSystem -Property Domain | Select-Object -ExpandProperty Domain;

### Let's define our update variables below.
$computer_ip = Get-NetIPAddress -PrefixOrigin Dhcp | Select-Object -ExpandProperty IPAddress;

### URL to visit. As long as the above variables do not contain an &, we should be fine.
$visit_url = "http://www.junklands.com/web/updatetool.php?method=checkup&cname="+$computer_name+"&ctag="+$computer_servicetag+"&cip="+$computer_ip;

if($domain = "sienahts.edu"){ Invoke-WebRequest -Uri $visit_url; }

exit
