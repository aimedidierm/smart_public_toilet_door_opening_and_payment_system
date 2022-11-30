#include <ArduinoJson.h>
#include <SPI.h>
#include <MFRC522.h>
#include <LiquidCrystal.h>


const int rs = A6, en = A7, d4 = A11, d5 = A10, d6 = A9, d7 = A8;
LiquidCrystal lcd(rs, en, d4, d5, d6, d7);

#define SS_PIN 53
#define RST_PIN 5
#define buzzer A0
#define led A1
int motor1=4;
int motor2=6;
int motor1u=2;
int motor2u=3;
const int buto = A4;
const int butou = A5;
const int rbuto = A2;
const int rbuto2 = A3;
byte readCard[4];
int k=0;
String tagID = "";
MFRC522 mfrc522(SS_PIN, RST_PIN);

boolean getID();
int buttonState = 0;
int rbuttonState = 0;
int rbuttonState2 = 0;
int buttonStateu = 0;
void setup() {
lcd.begin(16, 2);

 Serial.begin(115200);
pinMode(buzzer, OUTPUT); 
pinMode(led, OUTPUT);
pinMode(motor1,OUTPUT);
pinMode(motor2,OUTPUT);
pinMode(motor1u,OUTPUT);
pinMode(motor2u,OUTPUT);
pinMode(buto, INPUT);
pinMode(butou, INPUT);
pinMode(rbuto, INPUT);
pinMode(rbuto2, INPUT);


  SPI.begin();
  mfrc522.PCD_Init();
  lcd.setCursor(2, 0);
  lcd.print("Smart public");
  lcd.setCursor(5, 1);
  lcd.print("toilette");
  delay(3000);
}

void loop() {
 lcd.clear();
 lcd.setCursor(0, 0);
 lcd.print("Place Your Card");    

  if (getID()){
    if (tagID == "41FCFE45"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Welcome");
    tone(buzzer, 1000, 1000);
    delay(2000);
    opendoor();
      } else if (tagID == "B38204B"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Welcome");
    tone(buzzer, 1000, 1000);
    delay(2000);
    opendooru();
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
  void opendooru(){
  digitalWrite(motor1u,HIGH);
  digitalWrite(motor2u,LOW);
  delay(5000);
  digitalWrite(motor2u,HIGH);
  digitalWrite(motor1u,LOW);
  digitalWrite(led,HIGH);
  delay(2000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Somebody in");
  opendoor2u();
  }
void opendoor2(){
  int i = 1;
  while(i>0){
 buttonState = digitalRead(buto);
 rbuttonState = digitalRead(rbuto);
 if (rbuttonState == HIGH) {
  Serial.println("?report");
  delay(1000);
 }
 }
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
void opendoor2u(){
  int i = 1;
  while(i>0){
 buttonStateu = digitalRead(butou);
 rbuttonState2 = digitalRead(rbuto2);
 if (rbuttonState2 == HIGH) {
  Serial.println("?report2");
  delay(1000);
 }
  if (buttonStateu == HIGH) {
  digitalWrite(motor1u,HIGH);
  digitalWrite(motor2u,LOW);
  delay(5000);
  digitalWrite(motor2u,HIGH);
  digitalWrite(motor1u,LOW);
  digitalWrite(led,LOW);
  resetFunc();
  }
  delay(200);
  }
}
