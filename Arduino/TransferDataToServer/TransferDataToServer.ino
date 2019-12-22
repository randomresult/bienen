// Include for HTTP-Transfer
#include < ESP8266HTTPClient.h >
// Include for Temp/Humidity
#include < DHTesp.h >
// Include for Wlan
#include < ESP8266WiFi.h >
// Include for Weight
#include < HX711.h >

// Define Pins 
const int
LOADCELL_DOUT_PIN = 7;
const int
LOADCELL_SCK_PIN = 8;

// Define Variables
String postData;
String postVariableTemp = "temp=";
String postVariableHumidity = "humidity=";
String connector = "&";
String unit = "unit=99";

// Define Server 
char server[] = "measuring.h-wie-honig.de";

// Intiate TEMP 
DHTesp dht;

// Intiate Scale
HX711 scale;

void setup()
{
    // put your setup code here, to run once:
    Serial.begin(115200);
    Serial.println();


    Serial.println("ESP Gestartet");
    
    WiFi.begin("Kurpfalzring712ghz", "harrysfunklan");
    Serial.print("Verbindung wird aufgebaut");

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println();
    Serial.print("Verbunden mit IP-Adresse:");
    Serial.println(WiFi.localIP());
    scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
    if (scale.is_ready()) {
        long
        reading = scale.read();
        Serial.print("HX711 reading: ");
        Serial.println(reading);
    } else {
        Serial.println("HX711 not found.");
    }


    dht.setup(D4, DHTesp::DHT11);
    float
    humidity = dht.getHumidity();
    float
    temperature = dht.getTemperature();
    postData = unit + connector + postVariableTemp + temperature + connector + postVariableHumidity + humidity;


    if (WiFi.status() == WL_CONNECTED) {   //Check WiFi connection status

        HTTPClient http;    //Declare object of class HTTPClient

        http.begin("http://measuring.h-wie-honig.de/API/putTemp.php");      //Specify request destination
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //Specify content-type header

        int httpCode = http.POST(postData);   //Send the request
        String payload = http.getString();                  //Get the response payload

        Serial.println(httpCode);   //Print HTTP return code
        Serial.println(payload);    //Print request response payload

        http.end();  //Close connection
    }


    Serial.println(postData);
    Serial.println("postet data");

    Serial.print("Entering Deep Sleep");
    ESP.deepSleep(60 * 60 * 1000000);
}

void loop()
{
    // put your main code here, to run repeatedly:

}
