<?php
require_once("UsersRestHandler.php");
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
			$usersRestHandler = new UsersRestHandler();
			$result = $usersRestHandler->getAllUsers();
			
			break;
	
		case "create":
			// to handle REST Url /mobile/create/
			$usersRestHandler = new UsersRestHandler();
			$usersRestHandler->add();
		break;
		
		case "delete":
			// to handle REST Url /mobile/delete/<row_id>
			$usersRestHandler = new UsersRestHandler();
			$result = $UsersRestHandler->deleteUsersById();
		break;
		
		case "update":
			// to handle REST Url /mobile/update/<row_id>
			$usersRestHandler = new UsersRestHandler();
			$usersRestHandler->editUsersById();
		break;
}
?>
