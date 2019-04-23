<?php

require_once("Controller/dbcontroller.php");

	/* 	A domain Class to demonstrate RESTful web services	*/

Class Products { // Model_Product

	private $mobiles = array();

		public function getAllProducts(){ // GetALL

			if(isset($_GET['searchTerm'])){
				$searchTerm = trim($_GET['searchTerm']);
				$query = 'SELECT *	FROM products WHERE products.name LIKE "%'.$searchTerm.'%"';
			} else {
				$query = 'SELECT * FROM products';
			}

			$dbController = new DBController();
			//$this->mobiles = $dbController->executeSelectQuery($query);

				$this->mobiles = $dbController->prodStringArray($query);
			
					return $this->mobiles;
		}

		public function getProduct(){ // Get One Product

			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$query = 'SELECT * FROM products WHERE id='.$id;
			}
			
			$dbController = new DBController();
			//$this->mobiles = $dbController->executeSelectQuery($query);

				$this->mobiles = $dbController->prodStringArray($query);
			
					return $this->mobiles;
			
		}

		public function addProducts(){ //POST 
			
			$target_dir = "images/";

			if(isset($_POST['name']) && isset($_POST['price'])){	
				$name = trim($_POST['name']);
					$price = $discount = $descriere = '';
					
					if(isset($_POST['price'])){
						$price = trim($_POST['price']);
					}
					if(isset($_POST['discount'])){
						$discount = trim($_POST['discount']);
					}	
					
					if(isset($_POST['descriere'])){ 
						$descriere = trim($_POST['descriere']);
					}	
		
					
				$query = "INSERT INTO products (name, price, discount, descriere) values ('".$name."','".$price."', 
				'".$discount."', '".$descriere."')";

				$query_FindId = "SELECT id from products WHERE products.name='".$name."' ";

				$dbController = new DBController();
					$result = $dbController->executeQuery($query);
					$result_FindId = $dbController->executeSelectQuery($query_FindId);

					$prod_id = $result_FindId[0]['id'];

				//insert img
				for($i=0; $i<count($_FILES["file_img"]["name"]); $i++){ 
					$filetmp = $_FILES["file_img"]["tmp_name"][$i];
					$filename = $_FILES["file_img"]["name"][$i];
					$target_file=$target_dir.$filename;
		
						if(strpos($filename,'.') !== false ) { 
							move_uploaded_file($filetmp, $target_file);
							$queryImg = "INSERT INTO product_images(product_id,image_location) values('$prod_id','$filename') ";
							$resultImg = $dbController->executeQuery($queryImg);

						} //end if

				}//end for

					if($result != 0){ 
						$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
						return $result;
					}

			} elseif(isset($_POST['ImageAddId'])){ // pt add images
					$id = $_POST['ImageAddId'];
					$dbController = new DBController();

							for($i=0; $i<count($_FILES["file_img"]["name"]); $i++){ 
								$filetmp = $_FILES["file_img"]["tmp_name"][$i];
								$filename = $_FILES["file_img"]["name"][$i];
								$target_file=$target_dir.$filename;
					
									if(strpos($filename,'.') !== false ) { 
										move_uploaded_file($filetmp, $target_file);
										$queryImg = "INSERT INTO product_images(product_id,image_location) values('$id','$filename') ";
										$resultImg = $dbController->executeQuery($queryImg);
									} //end if
							}
					//altel da eroare in cazul in care $resultImg e null
					if(strpos($filename,'.') !== false && $resultImg != 0){ 
						$resultImg = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
						return $resultImg;
					}
			} //end add images

		}// end addProducts

		public function editProducts(){ // PUT

			if(isset($_POST['name']) && isset($_GET['id'])){
				$name = trim($_POST['name']);
				$price = trim($_POST['price']);
				$discount = trim($_POST['discount']);	
				$descriere = trim($_POST['descriere']);

					if(isset($_POST['categorie_id'])){
						$categorie_id = $_POST['categorie_id'];
						$add_query = 'categorie_id ='.$categorie_id.',';
					} else $add_query = '';
					
				$query = "UPDATE products SET $add_query name = '".$name."', price = '".$price."', discount = '".$discount."', descriere = '".$descriere."'  WHERE id = ".$_GET['id'];
			}

			$dbController = new DBController();
				$result= $dbController->executeQuery($query);
					
				if($result != 0){ 
					$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
					return $result;
				}

		}// end editProduct

		public function deleteProducts(){ // DELETE

			if(isset($_GET['id'])){

				$id = trim($_GET['id']);
					$query = 'DELETE FROM products WHERE id = '.$id;

				$dbController = new DBController();
					$result = $dbController->executeQuery($query);

						if($result != 0){ 
							$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
							return $result;
						}
			} // end isset
			
		} //end deleteProducts
	
		
	
}
?>