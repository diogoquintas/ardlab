import RPi.GPIO as GPIO
from time import sleep

Pin = 4

GPIO.setmode(GPIO.BCM)
GPIO.setup(Pin, GPIO.OUT)

if GPIO.input(Pin) == 1:
    GPIO.output(Pin, GPIO.LOW)
    print("GPIO 4 is now : LOW (0)")
else:
    GPIO.output(Pin, GPIO.HIGH)
    print("GPIO 4 is now : HIGH (1)")


