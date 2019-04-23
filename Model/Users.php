<?php

require_once("Controller/dbcontroller.php");

	/* 	A domain Class to demonstrate RESTful web services	*/

Class Users { // Model_User

	private $users = array();

		public function getAllUsers(){ // GetALL

			if(isset($_GET['searchTerm'])){
				$searchTerm = $_GET['searchTerm'];
				$query = 'SELECT users.id,users.userId,displayName,email,phone_number,location,displayNotifications,notification_sound,ledLight FROM users INNER JOIN settings ON users.userId=settings.userId WHERE users.userId LIKE "%'.$searchTerm.'%"';
			} else {
				$query = 'SELECT users.id,users.userId,displayName,email,phone_number,location,displayNotifications,notification_sound,ledLight FROM users INNER JOIN settings ON users.userId=settings.userId';
			}

			$dbcontroller = new DBController();
				$this->users= $dbcontroller->executeSelectQuery($query);
			
				return $this->users;
		}

		public function addUsers(){ //POST 
			
			if(isset($_POST['userId'])){	
				$userId = $_POST['userId'];
					$displayName = $email = $phone_number = $location = $displayNotifications = $notification_sound = $ledLight ='';
					
					if(isset($_POST['displayName'])){
						$displayName = $_POST['displayName'];
					}
					if(isset($_POST['email'])){
						$email = $_POST['email'];
					}	

					if(isset($_POST['phone_number'])){ 
						$phone_number = $_POST['phone_number'];
					}

					if(isset($_POST['location'])){ 
						$location = $_POST['location'];
					}
					
					if(isset($_POST['displayNotifications'])){ 
						$displayNotifications = $_POST['displayNotifications'];
					}

					if(isset($_POST['notification_sound'])){ 
						$notification_sound = $_POST['notification_sound'];
					}

					if(isset($_POST['ledLight'])){ 
						$ledLight = $_POST['ledLight'];
					}


				$query1 = "INSERT INTO users (displayName, email, phone_number, location, userId) values ('".$displayName."','".$email."', '".$phone_number."', '".$location."' ,'".$userId."')";

				$query2 = "INSERT INTO settings (userId, displayNotifications, notification_sound, ledLight) values ('".$userId."','".$displayNotifications."','".$notification_sound."','".$ledLight."')";

		
				$dbController = new DBController();
					$result1 = $dbController->executeQuery($query1);
					$result2 = $dbController->executeQuery($query2);

					if($result1 != 0 && $result2 != 0){ 
						$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
						return $result;
					}

			} // end isset		

		}// end addUser

		public function editUsers(){ // PUT

			if(isset($_GET['id'])){

				$displayName = $_POST['displayName'];
				$email = $_POST['email'];	
				$phone_number = $_POST['phone_number'];	
				$location = $_POST['location'];
					
				$query = "UPDATE users SET displayName = '".$displayName."', email = '".$email."', phone_number = '".$phone_number."', location = '".$location."' WHERE id = ".$_GET['id'];
			}

			$dbController = new DBController();
				$result= $dbController->executeQuery($query);
					
				if($result != 0){ 
					$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
					return $result;
				}

		}// end editUser

		public function deleteUsers(){ // DELETE

			if(isset($_GET['id'])){

				$id = $_GET['id'];
					$query = 'DELETE FROM users WHERE id = '.$id;

				$dbController = new DBController();
					$result = $dbController->executeQuery($query);

						if($result != 0){ 
							$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
							return $result;
						}
			} // end isset
			
		} //end deleteUser
	
		
	
}
?>