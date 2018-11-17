
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
//require_once('testrabbitMQClient.php');
$connection = dbConnection();
error_reporting(E_ALL);
ini_set('display_errors', 'off');
ini_set('log_errors', 'On');
ini_set('error_log', dirname(__FILE__).'log.txt');


function fetchItem($item){
    	$connection = dbConnection();
	$query = "SELECT * FROM FoodInfo WHERE Item = '$item'";
	$result = mysqli_query($connection,$query);
	echo json_encode($result);
	//print_r($result->fetch_all());
	
	return $result->fetch_all();
}

function requestProcessor($request){

      echo "received request".PHP_EOL;
      var_dump($request);

      if(!isset($request['type']))
      {
        return "ERROR: unsupported message type";
      }

        switch($request['type']){             

	    case "search":
                return fetchItem($request['item']);
                break;
	}
            

       	echo var_dump($response_msg);
        return $response_msg;
    
}

    $server = new rabbitMQServer("testRabbitMQ.ini","apiServer");

    $server->process_requests('requestProcessor');
    exit();



?>
