# Remoteboot
Remote boot your computer with ESP8266/ESP32  
[中文版本](https://github.com/hank9999/Remoteboot/blob/master/README_CN.md)  
The project can be adapted to public network ip and intranet ip.  
But you need to build a website to achieve.  
## Requirements
- **PHP >= 7.0**
- **MySQL >= 5.5**

## Quick Start
1.Download our [latest release](https://github.com/hank9999/Remoteboot/releases), extract and put `remote.php` in the website directory.  
2.Configure your database information in `remote.php`.  
3.Navigate to `http://example.com/remote.php?install=yes` in your browser.  
4.Download [WakeOnLan-ESP8266](https://github.com/koenieee/WakeOnLan-ESP8266/archive/master.zip), and add to Arduino IDE.  
5.Configure your Wifi,Mac and WebSite informations in `remoteboot.ino`, and Download to ESP8266/ESP32.    
6.Finish