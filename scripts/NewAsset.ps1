### Powershell script to visit a website based on system variables.
# For use during the Windows imaging process.
# Can also be run on already imaged machines to add the device to SHU-Explorer db.

### Gather computer information. Gathers the most basic information.
# Formatting is not a concern, as our php page will neaten up everything before entered to the db.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_model = Get-CimInstance -ClassName Win32_ComputerSystem -Property Model | Select-Object -ExpandProperty Model;
$computer_manufacturer = Get-CimInstance -ClassName Win32_ComputerSystem -Property Manufacturer | Select-Object -ExpandProperty Manufacturer;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$computer_winserial = Get-CIMInstance -ClassName Win32_OperatingSystem -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;

### URL to visit. As long as the above variables do not contain an &, we should be fine.
$visit_url = "http://www.junklands.com/web/creationtool.php?cname="+$computer_name+"&cmodel="+$computer_model+"&cserial="+$computer_winserial+"&cmanu="+$computer_manufacturer+"&cservice="+$computer_servicetag+"&cat=1";

if($domain = "sienahts.edu"){ Invoke-WebRequest -Uri $visit_url; }

exit

