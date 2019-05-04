<?php
require_once("CategoriesRestHandler.php");
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
			$categoriesRestHandler = new CategoriesRestHandler();
			$result = $categoriesRestHandler->getAllCategories();
			
			break;
	
		case "create":
			// to handle REST Url /mobile/create/
			$categoriesRestHandler = new CategoriesRestHandler();
		
			$categoriesRestHandler->add();
		break;
		
		case "delete":
			// to handle REST Url /mobile/delete/<row_id>
			$categoriesRestHandler = new CategoriesRestHandler();
			$result = $categoriesRestHandler->deleteCategoriesById();
		break;
	
		case "update":
			// to handle REST Url /mobile/update/<row_id>
			$categoriesRestHandler = new CategoriesRestHandler();
			$categoriesRestHandler->editCategoriesById();
		break;
}
?>
