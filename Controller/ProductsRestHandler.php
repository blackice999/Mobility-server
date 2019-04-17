<?php

require_once("RestTemplate/SimpleRest.php");
require_once("Model/Products.php");
		
class ProductsRestHandler extends SimpleRest {

	function getAllProducts() {	

		$products = new Products();
		$rawData = $products->getAllProducts();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
			} else {
				$statusCode = 200; 
			}
				
			$result["products"] = $rawData;
				$response = $this->encodeJson($result);
					echo $response;
							
	}

	function getProduct() {	

		$products = new Products();
		$rawData = $products->getProduct();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
			} else {
				$statusCode = 200; 
			}
				
			$result["product"] = $rawData;
				$response = $this->encodeJson($result);
					echo $response;
							
	}
	
	function add() {	

		$products = new Products();
		$rawData = $products->addProducts();

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

	function editProductsById() {	
			
			$products = new Products();
			$rawData = $products->editProducts();

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

	function deleteProductsById() {	

		$products = new Products();
		$rawData = $products->deleteProducts();
		
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