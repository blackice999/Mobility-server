<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Categories {
	private $mobiles = array();
	public function getAllcategories(){
		if(isset($_GET['name'])){
			$name = $_GET['name'];
			$query = 'SELECT * FROM categories_products WHERE name LIKE "%' .$name. '%"';
		} else {
			$query = 'SELECT * FROM categories_products';
		}
		$dbcontroller = new DBController();
		$this->mobiles = $dbcontroller->executeSelectQuery($query);
		return $this->mobiles;
	}

	public function addCategories($categories){
		var_dump($categories);

		if($categories['name'] != null){
			$name = $categories['name'];
				
			$query = "insert into categories_products (name) values ('" . $name ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);

			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function deleteCategories(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM categories_products WHERE id = '.$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function editProducts(){
		if(isset($_POST['name']) && isset($_GET['id'])){
			$name = $_POST['name'];
		
			$query = "UPDATE categories_products SET name = '".$name."' WHERE id = ".$_GET['id'];
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