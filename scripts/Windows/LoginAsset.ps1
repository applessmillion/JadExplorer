### Powershell script to visit a website based on system variables.
# Updates and adds info for an existing asset.

### Set some basic settings, such as the URL we're visiting and powershell-specific settings.
$ProgressPreference = 'SilentlyContinue';
$visit_url = "http://jadexplorer.junklands.com/e/updateasset.php";

### Gather information.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$domain = Get-CimInstance -ClassName Win32_ComputerSystem -Property Domain | Select-Object -ExpandProperty Domain;
$computer_model = Get-CimInstance -ClassName Win32_ComputerSystem -Property Model | Select-Object -ExpandProperty Model;
$computer_manufacturer = Get-CimInstance -ClassName Win32_ComputerSystem -Property Manufacturer | Select-Object -ExpandProperty Manufacturer;
$computer_ethernet = Get-NetAdapter -Name Ethernet | Select-Object -ExpandProperty MacAddress;
$curuser = $env:USERNAME;
$computer_ip = Get-NetIPAddress -PrefixOrigin Dhcp | Select-Object -ExpandProperty IPAddress;

### Check if servicecode is defined. If not, we gotta update via tag number.
if(!$computer_servicetag){ $method = "tag" }
if($computer_servicetag){ $method = "service" }

### Allows for some basic security. PHP can check to make sure this var is the same on it's side.
$verify = 1;

### Compile all the above info.
$submit_variables = 
    @{
	 method=$method;
	 cname=$computer_name;
     cmodel=$computer_model;
     cmanu=$computer_manufacturer;
	 ctag=$computer_servicetag;
	 ethernet=$computer_ethernet;
	 curuser=$curuser;
	 cip=$computer_ip;
	 domain=$domain;
	 v=1;
	}
					
### Visit page and submit the POST variables.
Invoke-WebRequest -Uri $visit_url -Method POST -Body $submit_variables

### Close out of this script.
exit


