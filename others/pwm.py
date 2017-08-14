import RPi.GPIO as GPIO
from time import sleep
import sys

pwmPin = 12
dc = float(sys.argv[1])
freq = float(sys.argv[2])
time = float(sys.argv[3])

if (dc < 0) or (dc > 100):
    print('Ups! The duty-Cycle must be between 0 and 100 %')
    sys.exit()
elif (freq < 0) or (freq > 100000):
    print('Ups! The frequency must be between 0 and 100k Hertz')
    sys.exit()
elif (time < 0) or (time > 1800):
    print('Ups! The duration must be between 0 and 1800 seconds')
    sys.exit()


GPIO.setmode(GPIO.BCM)
GPIO.setup(pwmPin, GPIO.OUT)
pwm = GPIO.PWM(pwmPin, freq)

pwm.start(dc)
sleep(time)
pwm.stop()
GPIO.cleanup()

print('Duty-Cycle = '+str(dc)+' %')
print('Frequency = '+str(freq)+' Hz')
print('Duration = '+str(time)+' s')
print('PWM on GPIO12 Finished ...')
    
