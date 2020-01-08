# Remoteboot  

Remote boot your computer with ESP8266/ESP32  
[中文版本](https://github.com/hank9999/Remoteboot/blob/master/README_CN.md)  
The project can be adapted to public network ip and intranet ip.  
But you need to build a website to achieve.  
## Requirements
- **PHP >= 7.0**
- **HTTP ONLY**

## Quick Start
1.Download our [latest release](https://github.com/hank9999/Remoteboot/releases), extract and put `remote.php` in the website directory.  
2.Navigate to `http://example.com/remote.php` in your browser and save your id.   
3.Download [WakeOnLan-ESP8266](https://github.com/koenieee/WakeOnLan-ESP8266/archive/master.zip), and add to Arduino IDE.  
4.Configure your ID,Wifi,Mac and WebSite informations in `remoteboot.ino`, and Download to ESP8266/ESP32.  
```
#define STASSID "Your-SSID"  //replace "Your-SSID" by Your-SSID
#define STAPSK  "Your-Password"  //replace "Your-Password" by Your-Password
```
```
String api_address = "example.com";  //replace "example.com" by your address
String api_id = "Your_ID";  //replace "Your_ID" by your ID
```
```
byte mac[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00 };   //replace "0x00, 0x00, 0x00, 0x00, 0x00, 0x00"
```
6.Finish