<?php

require_once("RestTemplate/SimpleRest.php");
require_once("Model/Categories.php");
		
class CategoriesRestHandler extends SimpleRest {

	function getAllCategories() {	
		
		$categories = new Categories();
		$rawData = $categories->getAllCategories();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
				$error = "Something Went Wrong";
			} else {
				$statusCode = 200; 
				$error = null;
			}
				
			$result['categories'] = $rawData;
			$result['errorMessage'] = $error;
			
				$response = $this->encodeJson($result);
					echo $response;
							
	}

	function getCategorie() {	

		$categories = new Categories();
		$rawData = $categories->getCategorie();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('success' => 0);		
			} else {
				$statusCode = 200; 
			}
				
			$result["categorie"] = $rawData;
				$response = $this->encodeJson($result);
					echo $response;
							
	}
	
	function add() {	

		$categories = new Categories();
		$rawData = $categories->addCategories();

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

	function editCategoriesById() {	
			
		$categories = new Categories();
		$rawData = $categories->editCategories();

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

	function deleteCategoriesById() {	

		$categories = new Categories();
		$rawData = $categories->deleteCategories();
		
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