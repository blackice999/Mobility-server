<?php
require_once("SimpleRestUsers.php");
require_once("Users.php");
		
class UsersRestHandler extends SimpleRestUsers {

	function getAllUsers() {	

		$users = new Users();
		$rawData = $users->getAllUsers();

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
		$users = new Users();
		$rawData = $products->addUsers();
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

	function deleteUsersById() {	
		$users = new users();
		$rawData = $users->deleteUsers();
		
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
	
	function editUsersById() {	
		$users = new users();
		$rawData = $users->editUsers();
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