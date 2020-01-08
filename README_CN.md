# 远程启动  

使用ESP8266/ESP32远程启动计算机  
这个项目有无公网ip均可  
但是你需要搭建一个网站  
## 环境要求
- **PHP >= 7.0**
- **HTTP ONLY**

## 快速开始
1.下载 [最新发行版](https://github.com/hank9999/Remoteboot/releases), 解压并把 `remote.php` 放在网站根目录  
2.访问 http://example.com/remote.php 并且保存好ID
3.下载 [WakeOnLan-ESP8266](https://github.com/koenieee/WakeOnLan-ESP8266/archive/master.zip), 添加到Arduino IDE  
4.配置你的ID,WIFI,MAC,网站地址在 `remoteboot.ino` 中,并且下载到ESP8266/ESP32中  
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
6.完成  