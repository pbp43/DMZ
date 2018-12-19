

We used Nutritionix as our API as it was the best match for our project.
The URL to get the information we need for every item is https://api.nutritionix.com/v1_1/search/'.$item.'?results=0:20&fields=item_name,brand_name,item_id,nf_calories,nf_sodium,nf_sugars,nf_protein,nf_total_carbohydrate&appId=aac181c3&appKey=18d1adac27be37b70e42974393087394

The information returned from the API can vary but for our project we used the following nutrition Information as required in the project:

item_name, brand_name, item_id,nf_calories, nf_sodium, nf_sugars, nf_protein and nf_total_carbohydrate.

To get started, we used the testApiSag.php to test the api first and it was successful. Once the testing was completed we moved on to the coding of the actual project which is in the dmzFunctions.php file

The two lines of code were used so the RabbitMQ server know the that API server is listening and waiting for the requests sent to the api server.

$server = new rabbitMQServer('testRabbitMQ.ini', 'apiServer');
$server->process_requests('requestProcessor');

The RequestProcessor function was used because we had 3 different cases which go the three functions mentioned below as they were different requests from the FrondEnd and Database.

function fetchItem($item)
function calorietrack($item,$username)
function attributesearch($item,$username)
The reason for having three different functions is because each function was returning information to either the FrontEnd or both FrontEnd and Database.

We used curl to produce and parse the API request into a big Array and then further decode the array and display it in the FrontEnd.



