int motor1=6;
int motor2=7;
void setup() {
  pinMode(motor1,OUTPUT);
  pinMode(motor2,OUTPUT);
}

void loop() {
  opendoor();
  delay(10000);
}

void opendoor(){
  digitalWrite(motor1,HIGH);
  digitalWrite(motor2,LOW);
  delay(5000);
  digitalWrite(motor2,HIGH);
  digitalWrite(motor1,LOW);
  delay(2000);
  }
