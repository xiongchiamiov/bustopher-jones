#!/usr/local/bin/python

import glob
import random

files = glob.glob("./*.jpg")

data = open(files[random.randint(0,len(files)-1)], 'rb').read()
print "Content-Type: image/png\nContent-Length: %d\n" % len(data)
print data
