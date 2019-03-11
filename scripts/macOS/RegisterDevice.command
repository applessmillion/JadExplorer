### Template for the Terminal script.
# Note: Apple does not use a "service tag". They instead use the serial number.

### Not sure which to use - the name we'll see in AD, or the name given to the computer.
$computer_name = scutil --get LocalHostName;
$computer_name = defaults read /Library/Preferences/SystemConfiguration/com.apple.smb.server NetBIOSName;

$computer_model = sysctl hw.model;
$computer_manufacturer = "Apple Inc.";

### One is used for WiFi, the other is Ethernet. Find the one that is working.
$computer_IP = ipconfig getifaddr en0;
if($computer_IP == ""){ ipconfig getifaddr en1; }

$visit_url = "";