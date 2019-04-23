<?php
require_once("ProductsRestHandler.php");
$method = $_SERVER['REQUEST_METHOD'];
$view = "";
if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
	switch($page_key){

		case "list":
			// to handle REST Url /mobile/list/
			$productsRestHandler = new ProductsRestHandler();
			$result = $productsRestHandler->getAllProducts();
			
			break;
	
		case "create":
			// to handle REST Url /mobile/create/
			$productsRestHandler = new ProductsRestHandler();
			$productsRestHandler->add();
		break;
		
		case "delete":
			// to handle REST Url /mobile/delete/<row_id>
			$productsRestHandler = new ProductsRestHandler();
			$result = $productsRestHandler->deleteProductsById();
		break;
		
		case "update":
			// to handle REST Url /mobile/update/<row_id>
			$productsRestHandler = new ProductsRestHandler();
			$productsRestHandler->editProductsById();
		break;
}
?>
