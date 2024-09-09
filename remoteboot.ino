//
// Created by hank9999 on 24-9-8.
//

#include "main.h"

#define BLINKER_PRINT Serial
#define BLINKER_WIFI
// #define BLINKER_WITH_SSL

#include <Arduino.h>
#include <Blinker.h>

char auth[] = "Auth-Token";  //replace "Auth-Token" to Your Blinker TOKEN
char ssid[] = "Your-SSID";  //replace "Your-SSID" to Your-SSID
char pswd[] = "Your-Password"  //replace "Your-Password" to Your-Password

BlinkerButton BootButton(const_cast<char*>("btn-xx1"));  //replace "btn-xx1" to your blinker boot button id
BlinkerButton ForceShutdownButton(const_cast<char*>("btn-xx2"));  //replace "btn-xx2" to your blinker force-shutdown button id
BlinkerText StatusText(const_cast<char*>("tex-xx3"));  //replace "tex-xx3" to your blinker status text id
int D2_Status = 0x00;
int counter = 0;

void BootButtonCallback(const String & state) {
  BLINKER_LOG("BootButton event, state: ", state);
  digitalWrite(LED_BUILTIN, LOW);
  digitalWrite(D3, LOW);
  Serial.println("D3 LOW");
  delay(1000);
  digitalWrite(D3, HIGH);
  Serial.println("D3 HIGH");
  digitalWrite(LED_BUILTIN, HIGH);
}

void ForceShutdownButtonCallback(const String & state) {
  BLINKER_LOG("ForceShutdownButton event, state: ", state);
  digitalWrite(LED_BUILTIN, LOW);
  digitalWrite(D3, LOW);
  Serial.println("D3 LOW");
  delay(15000);
  digitalWrite(D3, HIGH);
  Serial.println("D3 HIGH");
  digitalWrite(LED_BUILTIN, HIGH);
}

void UpdateStatus() {
  if (digitalRead(D2) == HIGH) {
    StatusText.print("On");
    Serial.println("status: on");
  } else {
    StatusText.print("Off");
    Serial.println("status: off");
  }
}

void D2_Callback() {
  if (digitalRead(D2) != D2_Status) {
    UpdateStatus();
    D2_Status = digitalRead(D2);
    digitalWrite(LED_BUILTIN, LOW);
  }
}

void setup() {
  Serial.begin(115200);
  Serial.println("\nUART is ready!");

  pinMode(D3, OUTPUT);
  digitalWrite(D3, HIGH);
  Serial.println("D3 Pin is ready!");

  pinMode(D2, INPUT);
  Serial.println("D2 Pin is ready!");
  D2_Status = digitalRead(D2);

  pinMode(LED_BUILTIN, OUTPUT);
  digitalWrite(LED_BUILTIN, HIGH);
  Serial.println("LED_BUILTIN Pin is ready!");

#if defined(BLINKER_PRINT)
  BLINKER_DEBUG.stream(BLINKER_PRINT);
#endif

  Blinker.begin(auth, ssid, pswd);
  BootButton.attach(BootButtonCallback);
  ForceShutdownButton.attach(ForceShutdownButtonCallback);
  UpdateStatus();
}

void loop() {
  Blinker.run();
  digitalWrite(LED_BUILTIN, HIGH);
  D2_Callback();
  counter += 1;
  if (counter >= 100) {
    counter = 0;
    UpdateStatus();
  }
}
