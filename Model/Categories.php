<?php

require_once("Controller/dbcontroller.php");

	/* 	A domain Class to demonstrate RESTful web services	*/

Class Categories { // Model_Product

	private $mobiles = array();

		public function getAllCategories(){ // GetALL

			if(isset($_GET['searchTerm'])){
				$searchTerm = trim($_GET['searchTerm']);
				$query = 'SELECT * FROM product_categories WHERE name LIKE "%'.$searchTerm.'%"';
			} else {
				$query = 'SELECT * FROM product_categories';
			}

			$dbController = new DBController();
				$this->mobiles = $dbController->executeSelectQuery($query);

					return $this->mobiles;
		}

		public function getCategorie(){ // GetOne Categorie

			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$query = 'SELECT * FROM product_categories WHERE id = '.$id;
			
			$dbController = new DBController();
				$result = $dbController->executeQuery($query);

				if($result != 0){
					$this->mobiles = $dbController->executeSelectQuery($query);

					return $this->mobiles;
				}
			}
		}

		public function addCategories(){ //POST 
			
			if(isset($_POST['name']) ){	
				$name = trim($_POST['name']);
										
				$query = "INSERT INTO product_categories(name) values ('".$name."')";

				$dbController = new DBController();
					$result = $dbController->executeQuery($query);
				
					if($result != 0){ 
						$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
						return $result;
					}

			} // end isset		

		}// end addCategories

		public function editCategories(){ // PUT

			if(isset($_POST['name']) && isset($_GET['id'])){
				$name = trim($_POST['name']);

				$query = "UPDATE product_categories SET name = '".$name."' WHERE id = ".$_GET['id'];

				$dbController = new DBController();
				$result= $dbController->executeQuery($query);

			}		
				if($result != 0){ 
					$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
					return $result;
				} 

		}// end editProduct

		public function deleteCategories(){ // DELETE

			if(isset($_GET['id'])){

				$id = trim($_GET['id']);
					$query = 'DELETE FROM product_categories WHERE id = '.$id;

				$dbController = new DBController();
					$result = $dbController->executeQuery($query);

						if($result != 0){ 
							$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
							return $result;
						}
			} // end isset
			
		} //end deleteCategories
	
		
	
}
?>