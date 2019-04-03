### Powershell script to visit a website based on system variables.
# For use during the Windows imaging process.
# Can also be run on already imaged machines to add the device to SHU-Explorer db.

### Set some basic settings, such as the URL we're visiting and powershell-specific settings.
$ProgressPreference = 'SilentlyContinue';
$visit_url = "http://jadexplorer.com/e/updateasset.php";

### Gather information.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$computer_ethernet = Get-NetAdapter -Name Ethernet | Select-Object -ExpandProperty MacAddress;
$computer_ip = Get-NetIPAddress -PrefixOrigin Dhcp | Select-Object -ExpandProperty IPAddress;

### Allows for some basic security. PHP can check to make sure this var is the same on it's side.
$verify = Get-Date;

if(!$computer_servicetag){ $method = "tag" }
if($computer_servicetag){ $method = "service" }

### Compile all the above info
$submit_variables = 
    @{method=$method;
	 checkup=1;
	 cname=$computer_name;
     cmodel=$computer_model;
	 cserial=$computer_winserial;
     cmanu=$computer_manufacturer;
	 ctag=$computer_servicetag;
	 ethernet=$computer_ethernet;
     "cat"=1;
	 v=($verify.DayOfYear*4);
	}
					
### Visit page and submit the POST variables.
Invoke-WebRequest -Uri $visit_url -Method POST -Body $submit_variables

### Close out of this script.
exit

