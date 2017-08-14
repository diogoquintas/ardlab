import time
import RPi.GPIO as GPIO
import sys

GPIO.setmode(GPIO.BOARD)
GPIO.setup(12, GPIO.OUT)

p = GPIO.PWM(12, 500000)
p.start(float(sys.argv[1]))
try:
    while 1:
       print("bitches")
except KeyboardInterrupt:
    pass
p.stop()
GPIO.cleanup()
