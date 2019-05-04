<?php
require_once("SimpleRest.php");
require_once("Categories.php");
		
class CategoriesRestHandler extends SimpleRest {

	function getAllCategories() {	

		$categories = new categories();
		$rawData = $categories->getAllCategories();

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
		$categories = new Categories();
		$json = file_get_contents('php://input');
		$values = json_decode($json, true);
		$rawData = $categories->addCategories($values);
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

	function deleteCategoriesById() {	
		$catgories = new Categories();
		$rawData = $categories->deleteCategories();
		
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
	
	function editCategoriesById() {	
		$categories = new categories();
		$rawData = $categories->editCategories();
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