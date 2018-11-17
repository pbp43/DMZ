#!/usr/bin/php
<?php

	ini_set("allow_url_fopen", 1);

	$url = "https://api.nutritionix.com/v1_1/search/banana?			results=0%3A20&cal_min=0&cal_max=50000&fields=item_name%2Cbrand_name%2Citem_id%2Cbrand_id&appId=e2776803&appKey=bb63a372b37ecad9e72e41699ba3f239";
	//echo $url;
	
	//echo $json;
	$data = file_get_contents($url);
	//$data = ""
	//$data = $more;
	header('Content-Type: application/json;charset=utf-8');
	
	//echo json_decode($data);
	echo ($data);
	//$arr=$data;
	//header("Content-type: text/javascript");
	//echo json_encode($arr);
?>
