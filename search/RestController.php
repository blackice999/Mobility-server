<?php
require_once("ProductsRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
switch($view){

	case "all":
		$productsRestHandler = new ProductsRestHandler();
		$productsRestHandler->searchProducts();
		break;

	case "" :
		break;
}
?>
