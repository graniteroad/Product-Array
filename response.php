<?php
if (is_ajax()) {
	if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
		$action = $_POST["action"];
		switch($action) { //Switch case for value of action
			case "test": test_function(); break;
			case "prod": test_prod(); break;
		}
	}
}

//Function to check if the request is an AJAX request
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
	$return = $_POST;
	
	//Do what you need to do with the info. The following are some examples.
	//if ($return["favorite_beverage"] == ""){
	//	$return["favorite_beverage"] = "Coke";
	//}
	//$return["favorite_restaurant"] = "McDonald's";
	
	$return["json"] = json_encode($return);
	echo json_encode($return);
}
 
function test_prod(){
	$return = $_POST;
	$arrsize = $return["array_size"];
	// build array
	$arr = array();
	$n = 0;
	for ($i=1;$i<=$arrsize;$i++) {
		$arr[$n] = $i;
		$n++;
	}
	
	$prod = prodArr($arr);
	
	$return["count"] = $arrsize;
	$return["original_array"] = json_encode($arr);
	$return["product_array"] = json_encode($prod);
	$return["json"] = json_encode($return);
  	echo json_encode($return);
}

/*
//This is the meat of it use PHP's unset function to remove the array object @ index $x 
//then use array_product to get the product of the rest of the array as new value @ $x.
*/
function prodArr($array) {
	$prod = array();
	$arrlength = count($array);
	
	for($x=0;$x<$arrlength;$x++) {
		$temp = $array;
		unset($temp[$x]);
		$prod[$x] = array_product($temp);
		//DEBUGGING
		//echo "array val = " . $prod[$x] . "\n";
	}
	return $prod;
}
?>