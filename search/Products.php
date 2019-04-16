<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Products {
	private $products = array();
	public function searchProducts(){
		if(isset($_GET['name'])){
			$name = $_GET['name'];
			$query = "SELECT * FROM products WHERE name LIKE '%" .$name. "%'";
		} else {
			$query = "SELECT * FROM products";
		}
		$dbcontroller = new DBController();
		$this->products = $dbcontroller->executeSelectQuery($query);
		return $this->products;
	}	
}
?>