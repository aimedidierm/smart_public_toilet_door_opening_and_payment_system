#include <ArduinoJson.h>
#include <LiquidCrystal_I2C.h>
#include <SPI.h>
#include <MFRC522.h>
int lcdColumns = 16;
int lcdRows = 2;

LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);

#define SS_PIN 10
#define RST_PIN 9
#define buzzer 3
#define led 2
int motor1=6;
int motor2=7;
const int buto = 8;  
byte readCard[4];
int k=0;
String tagID = "";
MFRC522 mfrc522(SS_PIN, RST_PIN);

boolean getID();
int buttonState = 0;
void setup() {
pinMode(buzzer, OUTPUT); 
pinMode(led, OUTPUT);
pinMode(motor1,OUTPUT);
pinMode(motor2,OUTPUT);
pinMode(buto, INPUT);

  SPI.begin();
  mfrc522.PCD_Init();
  lcd.init();
  lcd.backlight();
  lcd.setCursor(2, 0);
  lcd.print("Smart public");
  lcd.setCursor(5, 1);
  lcd.print("toilette");
  delay(3000);
  Serial.begin(9600);
}

void loop() {
 Serial.begin(115200);
 lcd.clear();
 lcd.setCursor(0, 0);
 lcd.print("Place Your Card");    

  if (getID()){
    if (tagID == "B177EA1B"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Welcome admin");
    tone(buzzer, 1000, 1000);
    delay(2000);
    opendoor();
      } else if (tagID == "A38FACAB"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Welcome cleaner");
    tone(buzzer, 1000, 1000);
    delay(2000);
    opendoor();
      } else{
        Serial.println((String)"?card="+tagID);
        while(k==0){
          if (Serial.available() > 0) {
            //kwakira data zivuye kuri node mcu na server
          DynamicJsonBuffer jsonBuffer;
          JsonObject& root = jsonBuffer.parseObject(Serial.readStringUntil('\n'));
          if (root["cstatus"]) {
          int cstatus = root["cstatus"];
          int balance = root["balance"];
          if(cstatus==0){
            lowbalance();
            } else{
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print("Balance:");
              lcd.print(balance);
              opendoor();
              }
          }
          }
              }
        }
    
    }
}
void(* resetFunc) (void) = 0;
boolean getID(){
  if(!mfrc522.PICC_IsNewCardPresent()){
    return false;
    }
  if(!mfrc522.PICC_ReadCardSerial()){
    return false;
    }
    tagID = "";
    for (uint8_t i = 0; i < 4; i++){
      tagID.concat(String(mfrc522.uid.uidByte[i], HEX));
      }
      tagID.toUpperCase();
      mfrc522.PICC_HaltA();
      return true;
  }
void lowbalance(){
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Insufficient funds");
  tone(buzzer, 1000, 500);
  delay(1300);
  resetFunc();
  }
void opendoor(){
  digitalWrite(motor1,HIGH);
  digitalWrite(motor2,LOW);
  delay(5000);
  digitalWrite(motor2,HIGH);
  digitalWrite(motor1,LOW);
  digitalWrite(led,HIGH);
  delay(2000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Somebody in");
  opendoor2();
  }
void opendoor2(){
  int i = 1;
  while(i>0){
 buttonState = digitalRead(buto);
  if (buttonState == HIGH) {
  digitalWrite(motor1,HIGH);
  digitalWrite(motor2,LOW);
  delay(5000);
  digitalWrite(motor2,HIGH);
  digitalWrite(motor1,LOW);
  digitalWrite(led,LOW);
  resetFunc();
  }
  delay(200);
  }
}
