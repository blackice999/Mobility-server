<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Products {
	private $mobiles = array();
	public function getAllproducts(){
		if(isset($_GET['name'])){
			$name = $_GET['name'];
			$query = 'SELECT * FROM products WHERE name LIKE "%' .$name. '%"';
		} else {
			$query = 'SELECT * FROM products';
		}
		$dbcontroller = new DBController();
		$this->mobiles = $dbcontroller->executeSelectQuery($query);
		return $this->mobiles;
	}

	public function addProducts(){
		if(isset($_POST['name'])){
			$name = $_POST['name'];
				$price = '';
				$discount = '';
				$descriere = '';
			if(isset($_POST['price'])){
				$model = $_POST['price'];
			}
			if(isset($_POST['discount'])){
				$color = $_POST['discount'];
			}	
			if(isset($_POST['descriere'])){
				$color = $_POST['descriere'];
			}			
			$query = "insert into products (name,price, discount, descriere) values ('" . $name ."','". $price ."','" . $discount ."','". $descriere ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function deleteProducts(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM products WHERE id = '.$id;
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
			$price = $_POST['price'];
			$discount = $_POST['discount'];
			$descriere = $_POST['descriere'];
			$query = "UPDATE products SET name = '".$name."',price ='". $price ."',discount = '". $discount ."', descriere = '". $descriere ."' WHERE id = ".$_GET['id'];
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