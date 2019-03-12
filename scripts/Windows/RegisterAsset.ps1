### Powershell script to visit a website based on system variables.
# For use during the Windows imaging process.
# Can also be run on already imaged machines to add the device to SHU-Explorer db.

### Set some basic settings, such as the URL we're visiting and powershell-specific settings.
$ProgressPreference = 'SilentlyContinue';
$visit_url = "http://www.junklands.com/web/e/createasset.php";

### Gather computer information. Gathers the most basic information.
$computer_name = Get-CimInstance -ClassName Win32_ComputerSystem -Property Name | Select-Object -ExpandProperty Name;
$computer_model = Get-CimInstance -ClassName Win32_ComputerSystem -Property Model | Select-Object -ExpandProperty Model;
$computer_manufacturer = Get-CimInstance -ClassName Win32_ComputerSystem -Property Manufacturer | Select-Object -ExpandProperty Manufacturer;
$computer_servicetag = Get-CIMInstance -ClassName win32_bios -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$computer_winserial = Get-CIMInstance -ClassName Win32_OperatingSystem -Property SerialNumber | Select-Object -ExpandProperty SerialNumber;
$computer_ethernet = Get-NetAdapter -Name Ethernet | Select-Object -ExpandProperty MacAddress;

### Allows for some basic security. PHP can check to make sure this var is the same on it's side.
$verify = 1;

### Compile all the above info.
$submit_variables = 
    @{cname=$computer_name;     
	 cmodel=$computer_model;
	 cserial=$computer_winserial;
     cmanu=$computer_manufacturer;
	 cservice=$computer_servicetag;
	 ethernet=$computer_ethernet;
     "cat"=1;
	 v=$verify;
	}
					
### Visit page and submit the POST variables.
Invoke-WebRequest -Uri $visit_url -Method POST -Body $submit_variables

### Close out of this script.
exit

