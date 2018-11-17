<?php
  
  	require_once('path.inc');
    	require_once('get_host_info.inc');
    	require_once('rabbitMQLib.inc');
	//require_once('testApiSag.php');


//	//  This function will log errors
//    function logAndSendErrors(){
//        
//        $file = fopen("../logging/log.txt","r");
//        $errorArray = [];
//        while(! feof($file)){
//            array_push($errorArray, fgets($file));
//        }
//        for($i = 0; $i < count($errorArray); $i++){
//            echo $errorArray[$i];
//            echo "<br>";
//        }
//
//        fclose($file);
//
//
//        $request = array();
//        $request['type'] = "frontend";  
//        $request['error_string'] = $errorArray;
//        $returnedValue = createClientForRmq($request);
//
//        $fp = fopen("../logging/logHistory.txt", "a");
//        for($i = 0; $i < count($errorArray); $i++){
//            fwrite($fp, $errorArray[$i]);
//        }
//
//        file_put_contents("../logging/log.txt", "");
//
//
//    }

  
 	function fetchItem($item){
   

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.nutritionix.com/v1_1/search/'.$item.'?results=0:20&fields=item_name,brand_name,item_id,nf_calories,nf_sodium&appId=aac181c3&appKey=18d1adac27be37b70e42974393087394",
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => "",
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => "GET",
  		CURLOPT_HTTPHEADER => array(
    		"Postman-Token: eb158d0e-a543-4895-8d47-e4e0f967be96",
    		"cache-control: no-cache"
  		),
));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
  			echo "cURL Error #:" . $err;
		} else {
  			echo $response;
			

		$result = json_decode($response, true);
		//print_r($result);
		$hits = $result['hits'];
		$item_info = $hits['0'];
		print_r($item_info);
		return $item_info;
	}
    
  }

    function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);
       
        if(!isset($request['type'])){
            return "ERROR: Message type is not supported";
        }
        switch($request['type']){             

	    case "search":
                return fetchItem($request['item']);
                break;
            
        }
       	echo var_dump($response_msg);
        return $response_msg;
    
    }

    //creating a new server
    $server = new rabbitMQServer('testRabbitMQ.ini', 'apiServer');
   
    //processes the request sent by client
    $server->process_requests('requestProcessor');

	exit();
    

?>
