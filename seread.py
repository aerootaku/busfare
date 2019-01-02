#!/usr/bin/env python

import serial
ardata = serial.Serial('/dev/ttyACM0',9600)

while True:
   if(ardata.inWaiting()>0):
      myData = ardata.readline()
      print (myData)
      ardata.close()
      break
          