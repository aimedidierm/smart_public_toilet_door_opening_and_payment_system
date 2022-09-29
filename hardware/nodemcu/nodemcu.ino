#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "Virus";
const char* password = "mbega123455";
String serverName = "http://192.168.43.76/smart_toilete_card/data.php";
void setup() {
  Serial.begin(115200); 

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
}

void loop() {
      WiFiClient client;
      HTTPClient http;

      String req = Serial.readStringUntil('\n');
      String serverPath = serverName + req;
      http.begin(client, serverPath.c_str());
      
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
      }
      http.end();
    }