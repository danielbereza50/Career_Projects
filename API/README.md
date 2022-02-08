https://vimeo.com/

https://ziggeo.com/

https://console.plivo.com/accounts/login/

https://www.twilio.com/login

https://developer.aylien.com/login

https://developers.facebook.com/tools/debug/

/////////////////////////////////////////////

https://login.quickbase.com/db/main?a=signin

https://developer.quickbase.com/

https://www.youtube.com/watch?v=8OWD9COKDIU&t=1642s

appId: br5n39gmu

QB-Realm-Hostname: danielbereza.quickbase.com

User-Agent: mydemo

Authorization: QB-USER-TOKEN b6tday_p2sq_0_d3y8zjeb8buiv9euy5msbjjj2d3 

Parameters are take right from the url:

https://danielbereza.quickbase.com/db/br5n39gmu

example request for create a table:

https://developer.quickbase.com/operation/createTable

var headers = {
  	'QB-Realm-Hostname': 'danielbereza.quickbase.com',
	'User-Agent': 'mydemo',
	'Authorization': 'QB-USER-TOKEN b6tday_p2sq_0_d3y8zjeb8buiv9euy5msbjjj2d3',
    'Content-Type': 'application/json'
}
var body = {
  "name": "My table",
  "description": "my first table",
  "singleRecordName": "record",
  "pluralRecordName": "records"
}

const xmlHttp = new XMLHttpRequest();
xmlHttp.open('POST', 'https://api.quickbase.com/v1/tables?appId=br5n59r26', true);
for (const key in headers) {
  xmlHttp.setRequestHeader(key, headers[key]);
}
xmlHttp.onreadystatechange = function() {
  if (xmlHttp.readyState === XMLHttpRequest.DONE) {
    console.log(xmlHttp.responseText);
  }
};

xmlHttp.send(JSON.stringify(body));



 
/////////////////////////////////////////////

project file header:

example:

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

terminal command:  

composer require {folder}

Need a: 

1. Client Id

2. Client Secret (Private Key)

3. Application Token

4. Encryption Key

5. SDK to connect
