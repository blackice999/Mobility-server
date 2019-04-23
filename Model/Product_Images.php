<?php

require_once("Controller/dbcontroller.php");

	/* 	A domain Class to demonstrate RESTful web services	*/

Class Product_Images { // Model_Product

	private $mobiles = array();

		public function getAllProduct_Images(){ // GetALL
			echo "Under Contruction..";
		}

		public function getProduct_Image(){ // Get One Product
			echo "Under Contruction..";			
		}

		public function addProduct_Images(){ //POST 
			echo "Under Contruction..";
		}

		public function editProduct_Images(){ // PUT
			echo "Under Contruction";
		}// end editProduct

		public function deleteProduct_Images(){ // DELETE

			if(isset($_POST['product_id']) && isset($_POST['imgName'])){
				$prod_id = trim($_POST['product_id']);
					$dbController = new DBController();

					foreach($_POST['imgName'] as $IMG){

						$query = 'DELETE FROM product_images WHERE product_id = '.$prod_id.' AND image_location = "'.$IMG.'" ';	
						$result = $dbController->executeQuery($query);

						//now delete from the folder as well
							$data = $IMG;
							$dir = "images";
							$path = $_SERVER['DOCUMENT_ROOT'].'/MobilityA/images/'.$data;
							$dirHandle = opendir($dir);

								while ($file = readdir($dirHandle)) {
									if($file==$data) {
										unlink($path);
									}
								} //end while

							closedir($dirHandle);
						//end delete folder
					}

					if($result != 0){ 
						$result = array('message'=>0, 'errorMessage'=>null); // 0 in cazul lui false, exista erori - nu
						return $result;
					}		
			} // end isset
			
		} //end deleteProduct_Images
	
}
?>