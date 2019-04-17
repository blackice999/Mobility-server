<?php

class DBController { 
	
	private $conn = "";
	private $host = "127.0.0.1";
	private $user = "root";
	private $password = "";
	private $database = "mobility";

		function __construct() {  //constructor
			$conn = $this->connectDB();
				if(!empty($conn)) {  //if not exist conn replace with the current one
					$this->conn = $conn;			
				}
		}

		function connectDB() {  //connect to DB
			$conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
			return $conn;
		}

		function executeQuery($query) { //Returns the number of Affected Rows

			$conn = $this->connectDB();    
			$result = mysqli_query($conn, $query);
				if (!$result) {
					//check for duplicate entry
					if($conn->errno == 1062) {
						return false;
					} else {
						trigger_error (mysqli_error($conn),E_USER_NOTICE);
						
					}
				}		
			$affectedRows = mysqli_affected_rows($conn);
				return $affectedRows;
		}

		function executeSelectQuery($query) {  //Returns the data from table
			$result = mysqli_query($this->conn,$query);
				while($row=mysqli_fetch_assoc($result)) {
					$resultSet[] = $row;
				}
			if(!empty($resultSet))
				return $resultSet;
		}

		function prodStringArray($query){ //under contruction
			
			$pathToServer = "images/";
			$i = 0;
			
		 	$result = mysqli_query($this->conn,$query);//for product
				while($row=mysqli_fetch_assoc($result)){

					//$resultSet[] = $row;
					$product[$i] = $row;
			
				//product images with specific product id
					$query2 = "SELECT image_location FROM product_images WHERE product_images.product_id='".$row['id']."' ";
						$result2 = mysqli_query($this->conn,$query2);

					$nullOrNot = mysqli_num_rows($result2);//test if it exist
							if($nullOrNot  > 0){ 
								while($row=mysqli_fetch_assoc($result2)) {
									$imagesUrl[] = $pathToServer.$row['image_location'];
								} 
							
							} else {
								$imagesUrl = null;
							}

					$product[$i]['imageUrl'] = $imagesUrl; //merge
		
					$i++;
				} //end while

				return $product;
		}
}

?>
