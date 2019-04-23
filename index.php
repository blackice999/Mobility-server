<?php

require_once("Controller/CategoriesRestHandler.php");
require_once("Controller/ProductsRestHandler.php");
require_once("Controller/Product_ImagesRestHandler.php");
require_once("Controller/UsersRestHandler.php");

$method = $_SERVER['REQUEST_METHOD'];

//$view = "";

	if(isset($_GET["page_key"])){
		$page_key = $_GET["page_key"];

	/* controls the RESTful services URL mapping */

			switch($page_key){

		//User
				case "readAllUsers":
					// to handle REST Url /mobile/read/
						$usersRestHandler = new UsersRestHandler();
						$result = $usersRestHandler->getAllUsers();
				break;

				case "createUser":
					// to handle REST Url /mobile/create/
						$usersRestHandler = new UsersRestHandler();
						$result = $usersRestHandler->add();
				break;

				case "updateUser":
					// to handle REST Url /mobile/update/<row_id>
						$usersRestHandler = new UsersRestHandler();
						$result = $usersRestHandler->editUsersById();
				break;

				case "deleteUser":
					// to handle REST Url /mobile/delete/<row_id>
						$usersRestHandler = new UsersRestHandler();
						$result = $usersRestHandler->deleteUsersById();
				break;
			
		//Product
				case "readAllProducts":
					// to handle REST Url /mobile/read/
						$productsRestHandler = new ProductsRestHandler();
						$result = $productsRestHandler->getAllProducts();
				break;

				case "readProduct":
					// to handle REST Url /mobile/read/
						$productsRestHandler = new ProductsRestHandler();
						$result = $productsRestHandler->getProduct();
				break;
			
				case "createProduct":
					// to handle REST Url /mobile/create/
						$productsRestHandler = new ProductsRestHandler();
						$result = $productsRestHandler->add();
				break;

				case "updateProduct":
					// to handle REST Url /mobile/update/<row_id>
						$productsRestHandler = new ProductsRestHandler();
						$result = $productsRestHandler->editProductsById();
				break;
				
				case "deleteProduct":
					// to handle REST Url /mobile/delete/<row_id>
						$productsRestHandler = new ProductsRestHandler();
						$result = $productsRestHandler->deleteProductsById();
				break;

		//Categorie
				case "readAllCategories":
					// to handle REST Url /mobile/read/
						$categoriesRestHandler = new CategoriesRestHandler();
						$result = $categoriesRestHandler->getAllCategories();
				break;

				case "readCategorie":
					// to handle REST Url /mobile/read/
						$categoriesRestHandler = new CategoriesRestHandler();
						$result = $categoriesRestHandler->getCategorie();
				break;
			
				case "createCategories":
					// to handle REST Url /mobile/create/
						$categoriesRestHandler = new CategoriesRestHandler();
						$result = $categoriesRestHandler->add();
				break;

				case "updateCategorie":
					// to handle REST Url /mobile/update/<row_id>
						$categoriesRestHandler = new CategoriesRestHandler();
						$result = $categoriesRestHandler->editCategoriesById();
				break;
				
				case "deleteCategorie":
					// to handle REST Url /mobile/delete/<row_id>
						$categoriesRestHandler = new CategoriesRestHandler();
						$result = $categoriesRestHandler->deleteCategoriesById();
				break;

		//Product_Images

				case "deleteProduct_Images":
				// to handle REST Url /mobile/delete/<row_id>
					$product_ImagesRestHandler = new Product_ImagesRestHandler();
					$result = $product_ImagesRestHandler->deleteProduct_ImagesById();
				break;
					
			} //end switch

	} else echo "<br>Wrong URl"; //end isset
?>
