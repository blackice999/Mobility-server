<?php

require_once("RestTemplate/SimpleRest.php");
require_once("Model/Users.php");
		
class UsersRestHandler extends SimpleRest {

	function getAllUsers() {	

		$users = new Users();
		$rawData = $users->getAllUsers();

			if(empty($rawData)) { // message
				$statusCode = 404;
				$rawData = array('message'=>1, 'errorMessage'=>'Database Is Empty!'); // 1 in cazul lui true, 
																											//exista erori - da	
			} else {
				$statusCode = 200; 
			}
				
			$result["Users"] = $rawData;

				$response = $this->encodeJson($result);
				echo $response;
				
	}
	
	function add() {	

		$users = new Users();
		$rawData = $users->addUsers();

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

	function editUsersById() {	
			
		$users = new Users();
			$rawData = $users->editUsers();

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

	function deleteUsersById() {	

		$users = new Users();
		$rawData = $users->deleteUsers();
		
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