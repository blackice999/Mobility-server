<?php

require_once("RestTemplate/SimpleRest.php");
require_once("Model/Product_Images.php");
		
class Product_ImagesRestHandler extends SimpleRest {

	function getAllProduct_Images() {	

		$product_Images = new Product_Images();
		$rawData = $product_Images->getAllProduct_Images();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
			} else {
				$statusCode = 200; 
			}
				
			$result["product_Images"] = $rawData;
				$response = $this->encodeJson($result);
					echo $response;
							
	}

	function getProduct_Images() {	

		$product_Images = new Product_Images();
		$rawData = $product_Images->getProduct_Image();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
			} else {
				$statusCode = 200; 
			}
				
			$result["product_Image"] = $rawData;
				$response = $this->encodeJson($result);
					echo $response;
							
	}
	
	function add() {	

		$product_Images = new Product_Images();
		$rawData = $product_Images->addProduct_Images();

			if(empty($rawData)) { //message
				$statusCode = 404;
				$rawData = array('message'=>1, 'errorMessage'=>'Operation Failed!'); // 1 in cazul lui true, 
																											//exista erori - da	
			} else {
				$statusCode = 200;
			}
		
		$result = $rawData;
				
				$response = $this->encodeJson($result);
				echo $response;

	}

	function editProduct_ImagesById() {	
			
			$product_Images = new Product_Images();
			$rawData = $product_Images->editProduct_Images();

				if(empty($rawData)) { //message
					$statusCode = 404;
					$rawData = array('message'=>1, 'errorMessage'=>'Operation Failed!'); // 1 in cazul lui true, 
																											//exista erori - da	
				} else {
					$statusCode = 200;
				}

			$result = $rawData;
					
				$response = $this->encodeJson($result);
				echo $response;

	}

	function deleteProduct_ImagesById() {	

		$product_Images = new Product_Images();
		$rawData = $product_Images->deleteProduct_Images();
		
			if(empty($rawData)) { //message
				$statusCode = 404;
				$rawData = array('message'=>1, 'errorMessage'=>'Operation Failed!'); // 1 in cazul lui true, 
																											//exista erori - da	
			} else {
				$statusCode = 200;
			}
		
		$result = $rawData;
				
				$response = $this->encodeJson($result);
				echo $response;

	}
	
	
	public function encodeJson($responseData) { //transform to json format
		$jsonResponse = json_encode($responseData, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
		return $jsonResponse;		
	}

}

?>