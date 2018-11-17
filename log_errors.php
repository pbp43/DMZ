<?php

//    include(".dmzFunctions.php");
//
//    logAndSendErrors();


    //  Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    //ini_set('error_log', dirname(__FILE__). 'logging/log.txt');

    //  Requireing required files
    require_once('rabbitmqphp_example/path.inc');
    require_once('rabbitmqphp_example/get_host_info.inc');
    require_once('rabbitmqphp_example/rabbitMQLib.inc');
    //require_once('../php/rabbitMQClient.php');

    $file = fopen("log.txt","r");
    $errorArray = [];
    while(! feof($file)){
        array_push($errorArray, fgets($file));
    }

    fclose($file);

    $request = array();
    $request['type'] = "dmz";  
    $request['error_string'] = $errorArray;
    $returnedValue = createClientForRmq($request);

    $fp = fopen("logHistory.txt", "a");
    for($i = 0; $i < count($errorArray); $i++){
        fwrite($fp, $errorArray[$i]);
    }

    file_put_contents("log.txt", "");

    function createClientForRmq($request){
            $client = new rabbitMQClient("rabbitmqphp_example/rabbitMQ_rmq.ini", "testServer");

            if(isset($argv[1])){
                $msg = $argv[1];
            }
            else{
                $msg = "client";
            }


            $response = $client->send_request($request);

            return $response;
        }

?>
