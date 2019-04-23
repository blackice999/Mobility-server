<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Users {
	private $mobiles = array();
	public function getAllUsers(){
		if(isset($_GET['disiplayName'])){
			$disiplayName = $_GET['disilayName'];
			$query = 'SELECT * FROM users WHERE disiplayName LIKE "%' .$disiplayName. '%"';
		} else {
			$query = 'SELECT * FROM users';
		}
		$dbcontroller = new DBController();
		$this->mobiles = $dbcontroller->executeSelectQuery($query);
		return $this->mobiles;
	}

	public function addUsers(){
		if(isset($_POST['disiplayName'])){
			$disiplayName = $_POST['disiplayName'];
				$email = '';
				$phone_number = '';
				$location = '';
				$token = '';
				
			if(isset($_POST['email'])){
				$model = $_POST['email'];
			}
			if(isset($_POST['phone_number'])){
				$color = $_POST['phone_number'];
			}	
			if(isset($_POST['location'])){
				$color = $_POST['location'];
			}	
			if(isset($_POST['token'])){
				$color = $_POST['token'];
		
			}		
			$query = "insert into products (didiplayName,email, phone_number,location, token) values ('" . $disiplayName ."','". $email ."','" . $phone_number ."', '". $location ."', '". $token ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function deleteUsers(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM users WHERE id = '.$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function editUsers(){
		if(isset($_POST['disiplayName']) && isset($_GET['id'])){
			$disiplayName = $_POST['disiplayName'];
			$email = $_POST['email'];
			$phone_number = $_POST['phone_number'];
			$location = $_POST['location'];
			$token = $_POST['token'];
			$query = "UPDATE users SET disiplayName = '".$disiplayName."',email ='". $email ."',phone_number = '". $phone_number ."', location = '". $location ."' , token = '". $token ."' WHERE id = ".$_GET['id'];
		}
		$dbcontroller = new DBController();
		$result= $dbcontroller->executeQuery($query);
		if($result != 0){
			$result = array('success'=>1);
			return $result;
		}
	}
	
}
?>