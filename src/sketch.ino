#include <LiquidCrystal.h>
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);
float tempC; 
int leitura; 
int tempPin = A4; 

void setup(){
	analogReference(INTERNAL);
	Serial.begin(9600); 
	lcd.begin(16, 2); 
}
void loop(){
	leitura = analogRead(tempPin); 
	tempC = leitura / 9.31; // (value * (Vref/1023)) * 100
	print(tempC);
	delay(1000);
}
/* just to make loop function easier to read and understand, this function prints 
the temperature in the lcd display and in the Serial port */
void print(float valor){ 
	Serial.print("temperatura: "); Serial.print(valor); 
	Serial.println(" ºC");
	lcd.clear();
	lcd.print("temp: "); lcd.print(tempC);
	lcd.print((char)223); lcd.print("C");
}