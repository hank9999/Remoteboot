# 远程启动
使用ESP8266/ESP32远程启动计算机  
这个项目有无公网ip均可  
但是你需要搭建一个网站  
## 环境要求
- **PHP >= 7.0**
- **MySQL >= 5.5**

## 快速开始
1.下载 [最新发行版](https://github.com/hank9999/Remoteboot/releases), 解压并把 `remote.php` 放在网站根目录  
2.配置在 `remote.php` 文件中的数据库信息  
```
$servername = "";
$username = "";
$password = "";
$dbname = "";
```
3.访问 `http://你的域名/remote.php?install=yes`  
4.下载 [WakeOnLan-ESP8266](https://github.com/koenieee/WakeOnLan-ESP8266/archive/master.zip), 添加到Arduino IDE  
5.配置你的WIFI,MAC,网站地址在 `remoteboot.ino` 中,并且下载到ESP8266/ESP32中  
```
#define STASSID "Your-SSID"  //replace "Your-SSID" by Your-SSID
#define STAPSK  "Your-Password"  //replace "Your-Password" by Your-Password
```
```
String check_api = "http://example.com/remote.php?boot=check";  //replace "example.com" by your address
String received_api = "http://example.com/remote.php?boot=received";  //replace "example.com" by your address
```
```
byte mac[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00 };   //replace "0x00, 0x00, 0x00, 0x00, 0x00, 0x00"
```
6.完成  