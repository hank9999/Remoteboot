# 远程启动  

使用ESP8266/ESP32远程启动计算机 带有状态信息显示 使用[Blinker](https://diandeng.tech/)平台  
使用Blinker App不需要搭建其他东西  
[Web旧版v2.0](https://github.com/hank9999/Remoteboot/tree/v2)  

## 快速开始
配置你的WIFI,TOKEN,组件ID,并且下载到ESP8266/ESP32中  
默认 `D3` 为 主板 POWER_ON 按键引脚, `D2` 为任意开机带电 关机断电引脚  
上报数据、执行按键操作均会闪烁LED, 使用 `LED_BUILTIN` 定义LED  
所有使用引脚均可全局替换  
```
char auth[] = "Auth-Token";  //replace "Auth-Token" to Your Blinker TOKEN
char ssid[] = "Your-SSID";  //replace "Your-SSID" to Your-SSID
char pswd[] = "Your-Password"  //replace "Your-Password" to Your-Password
```
```
BlinkerButton BootButton(const_cast<char*>("btn-xx1"));  //replace "btn-xx1" to your blinker boot button id
BlinkerButton ForceShutdownButton(const_cast<char*>("btn-xx2"));  //replace "btn-xx2" to your blinker force-shutdown button id
BlinkerText StatusText(const_cast<char*>("tex-xx3"));  //replace "tex-xx3" to your blinker status text id
```

## 组件参考图片
![Remoteboot_2](https://raw.githubusercontent.com/hank9999/Remoteboot/master/images/Remoteboot_2.jpg)

## 成品效果
## 组件参考图片
![Remoteboot_1](https://raw.githubusercontent.com/hank9999/Remoteboot/master/images/Remoteboot_1.jpg)