# Raspberry Pi Tips & Tricks - https://raspberrytips.nl

import Adafruit_DHT

humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT22, 4)

humidity = round(humidity, 2)
temperature = round(temperature, 2)

if humidity is not None and temperature is not None:

  print '{'
  print '"temperature_c":{0:0.1f}'.format(temperature)
  print ','
  print '"humidity":{0:0.1f}'.format(humidity)
  print '}'

else:

  print '{"error":"no data"}'

