
// Fill-in information from your Blynk Template here
#define BLYNK_TEMPLATE_ID "TMPLPXuLYBgS"
#define BLYNK_DEVICE_NAME "tanamapa"
//#define BLYNK_AUTH_TOKEN "YVqLANUGQDSPlgtXUW2rEH5LO333qcmP"

#define BLYNK_FIRMWARE_VERSION        "0.1.0"

#define BLYNK_PRINT Serial
//#define BLYNK_DEBUG

#define APP_DEBUG

// https://blynk.cloud/external/api/isHardwareConnected?token=YVqLANUGQDSPlgtXUW2rEH5LO333qcmP
#define USE_NODE_MCU_BOARD
#include "BlynkEdgent.h"
#include "DHT.h"

BlynkTimer timer;

#define PH_SENSOR A0
#define DHT_SENSOR D1

#define DHTTYPE DHT22

DHT dht(DHT_SENSOR, DHTTYPE);

int phSensorValue = 0;
float phOutputValue = 0.0;

void ph()
{
  phSensorValue = analogRead(PH_SENSOR);

  //Mathematical conversion from ADC to pH
  //rumus didapat berdasarkan datasheet
  phOutputValue = (-0.0279 * phSensorValue) + 7.7761;
  Serial.print("sensor ADC= ");
  Serial.print(phSensorValue);
  Serial.print("PH :");
  Serial.println(phOutputValue);
  Blynk.virtualWrite(V0, phSensorValue);
  Blynk.virtualWrite(V1, phOutputValue);
}

void humidity() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  Serial.print("Humidity :");
  Serial.print(h);
  Serial.println("oC");
  Blynk.virtualWrite(V2, h);
}

void setup()
{
  Serial.begin(115200);
  delay(100);

  dht.begin();

  BlynkEdgent.begin();
  timer.setInterval(1000L, ph);
  timer.setInterval(1000L, humidity);
}

void loop() {
  BlynkEdgent.run();
  timer.run();
}
