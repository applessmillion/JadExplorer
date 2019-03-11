### Template for the Terminal script.
# Note: Apple does not use a "service tag". They instead use the serial number.

### Not sure which to use - the name we'll see in AD, or the name given to the computer.
$computer_name = scutil --get LocalHostName;
$computer_name = defaults read /Library/Preferences/SystemConfiguration/com.apple.smb.server NetBIOSName;
$computer_serial = ioreg -l | awk '/IOPlatformSerialNumber/ { print $4;}'; ### Get the Serial Number of the iDevice.
$computer_model = sysctl hw.model;
$computer_manufacturer = "Apple Inc.";
$computer_mac = ifconfig en1 | awk '/ether/{print $2}';

$visit_url = "http://www.junklands.com/web/creationtool.php";

### Send request to our site
curl -X GET 
	-F "cname=$computer_name" 
	-F "cmodel=$computer_model" 
	-F "ethernet=$computer_mac"
	$visit_url;