<?php
require_once("SimpleRest.php");
require_once("Products.php");
		
class ProductsRestHandler extends SimpleRest {

	function getAllProducts() {	

		$products = new Products();
		$rawData = $products->getAllProducts();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);		
		} else {
			$statusCode = 200;
		}


		
			// $requestContentType = $_SERVER['HTTP_ACCEPT'];
			// $this ->setHttpHeaders($requestContentType, $statusCode);
		
			$result["output"] = $rawData;
			// if(strpos($requestContentType,'application/json') !== false){
				$response = $this->encodeJson($result);
				echo $response;
			// }
				
	}
	
	function add() {	
		$products = new Products();
		$rawData = $products->addProducts();
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);		
		} else {
			$statusCode = 200;
		}
		
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$result = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}

	function deleteProductsById() {	
		$products = new Products();
		$rawData = $products->deleteProducts();
		
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);		
		} else {
			$statusCode = 200;
		}
		
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$result = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function editProductsById() {	
		$products = new products();
		$rawData = $products->editProducts();
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);		
		} else {
			$statusCode = 200;
		}
		
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$result = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
}
?>