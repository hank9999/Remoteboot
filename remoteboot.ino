#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <WakeOnLan.h>

#define STASSID "Your-SSID"  //replace "Your-SSID" by Your-SSID
#define STAPSK  "Your-Password"  //replace "Your-Password" by Your-Password

const char* ssid = STASSID;
const char* password = STAPSK;
String api_address = "example.com";  //replace "example.com" by your address
String api_id = "Your_ID";  //replace "Your_ID" by your ID

String check_api = "http://" + api_address + "/remote.php?id=" + api_id + "&command=check";  // only http
String received_api = "http://" + api_address + "/remote.php?id=" + api_id + "&command=boot_ok"; // only http
IPAddress computer_ip(255, 255, 255, 255);
byte mac[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00 };   //replace "0x00, 0x00, 0x00, 0x00, 0x00, 0x00"

ESP8266WiFiMulti WiFiMulti;
WiFiUDP UDP;

void setup() {
  Serial.begin(115200);

  Serial.println();
  Serial.println();

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP(ssid, password);
  Serial.println("WIFI Connecting");
  while (WiFiMulti.run() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println("");
  Serial.println("WIFI Connected");
}

void loop() {

  if ((WiFiMulti.run() == WL_CONNECTED)) {
    WiFiClient client;
    HTTPClient http; 
    if (http.begin(client, check_api)) {  // HTTP
      int httpCode = http.GET();
      if (httpCode > 0) {
        String payload = http.getString();
        Serial.print(httpCode);
        Serial.print(", check:  ");
        Serial.println(payload);
        if(payload == "{\"code\":10000,\"message\":\"Check Success\",\"status\":\"1\"}") {
          WakeOnLan::sendWOL(computer_ip, UDP, mac, sizeof mac);
          http.begin(client, received_api);
          int httpCode2 = http.GET();
          String payload2 = http.getString();
          Serial.print(httpCode2);
          Serial.print(", ");
          Serial.println(payload2);
          Serial.println("");
          http.end();
        }
      } else {
        Serial.printf("HTTP Failed, error: %s\n", http.errorToString(httpCode).c_str());
      }
      http.end();
    } else {
      Serial.printf("Unable to connect\n");
    }
  }
  delay(1000);
  
}