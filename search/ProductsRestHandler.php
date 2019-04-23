<?php
require_once("SimpleRest.php");
require_once("Products.php");
		
class ProductsRestHandler extends SimpleRest {

	function searchProducts() {	

		$products = new Products();
		$rawData = $products->searchProducts();

		if(empty($rawData)) {
			$statusCode = 200;
		} else {
			$statusCode = 200;
		}
		
		$result["output"] = $rawData;
				

			$response = $this->encodeJson($result);
			echo $response;
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
}
?>