import requests, MySQLdb, datetime, json # Added datetime

url = "http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast10day/q/12487.json"

response = requests.get(url, verify=False)

if response.status_code != 200:
	print('Status:', response.status_code, 'Problem with the request. Exiting.')
	exit()

data= response.json()
dataStr = str(data)
decodedjson = json.JSONDecoder().decode(data) # Experimental, should this be data, response, or url?
#decodedjson = json.JSONDecoder.decode(data) 



# fahrenheit = decodedjson["forecast"]["simpleforecast"]["forecastday"]["/"daysOut"/"]["high"]["fahrenheit"]; This line should be in a loop 0 - 9
db = MySQLdb.connect(host="127.0.0.1",
user="n02762252",
passwd="12321",
db="oldForecast"
)
cursor = db.cursor()

for daysOut in range(0, 10):
	fahrenheit = decodedjson["forecast"]["simpleforecast"]["forecastday"]["\"" + daysOut + "\""]["high"]["fahrenheit"]
	rawdate = datetime.datetime.now() + datetime.timedelta(days=daysOut) # Again not sure about this
	date = rawdate.strftime('%Y-%m-%d')
	number_of_rows_x_days_Out = cursor.execute("INSERT INTO " + daysOut + "dayOutHighTemps (date, temperature, comments) VALUES (%s, %s, '')", (date, fahrenheit,)) #Not sure if fahrenheit should have a comma after it here, I don't think it should

number_of_rows_Old_Weather_Data = cursor.execute("insert into OldWeather (OldWeatherData) VALUES(%s)",(dataStr,)) # SQL Query
db.commit()
db.close()