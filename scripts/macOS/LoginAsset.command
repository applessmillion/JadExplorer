### Template for the Terminal script.
# Note: Apple does not use a "service tag". They instead use the serial number.

### Not sure which to use - the name we'll see in AD, or the name given to the computer.
$computer_name = scutil --get LocalHostName;
$computer_name = defaults read /Library/Preferences/SystemConfiguration/com.apple.smb.server NetBIOSName;

$computer_serial = ioreg -l | awk '/IOPlatformSerialNumber/ { print $4;}'; ### Get the Serial Number of the iDevice.
$computer_user = id -un; ### Get the username of the person logging in.

### One is used for WiFi, the other is Ethernet. Find the one that is working.
$computer_IP = ipconfig getifaddr en0;
if($computer_IP == ""){ ipconfig getifaddr en1; }

$visit_url = "http://your.url/e/updatetool.php";

curl -X GET 
    -F "cname=$computer_name";
    -F "cserial=$computer_serial";
    -F "cip=$computer_IP";
    -F "curuser=$computer_user";

$visit_url;