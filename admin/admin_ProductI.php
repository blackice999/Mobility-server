<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   

<!-- //dropdowns wont work without -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>


<?php
    //server details
        $Server = "http://".$_SERVER['HTTP_HOST'];
            //http://localhost:8181
        $Folder = "/MobilityA/";
        $Path = $Server.$Folder; 
            //http://localhost:8181/MobilityA/
        $Url = $Path."index.php?page_key=";
            //http://localhost:8181/MobilityA/index.php?page_key=";


    session_start();

    $name = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
         if(isset($_POST["name"]) && isset($_POST["password"])) {

            $name = $_POST["name"];
            $password = $_POST["password"];

                if($name == "admin" && $password == "admin" ){
                    $_SESSION['logat'] = true;
                }
           
        }
    }          
?>
<?php 
    if(isset($_SESSION['logat']) && isset($_GET['id'])){
        $productId = $_GET['id'];
?>
        
<div class="container">

    <div class="card">
        <div class="card-header"><a class="btn btn-link float-left disabled" href=""> Admin</a>

        <!-- button -->
       
            <a href="admin.php" class='btn'> Show Products </a>
            <a href="admin_addP.php" class='btn'> Add Products </a>
            <a href="admin_addU.php" class='btn'> Add Users(TEST) </a>
            <a href="admin_Category.php" class='btn'> Add/Show Categories </a>

        <!-- end buttons -->

            <div class="float-right pt-1">
                <div class="row"> 
                    <div id="reg" class="btn-basic col">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div> <!-- end cardheader -->
    </div> <!-- end card  -->
    
    <br>

        <!-- content -->
        
         <?php
            header('Access-Control-Allow-Origin: *');
            
                $url = $Url."readProduct&id=".$productId;
                $response = file_get_contents($url); 
                
                
                $tab = json_decode($response);//varianta1
                //$tab = json_decode($response, true);//varianta2, array = true
            
                if(empty($tab)){   
                  echo '<img class="img-fluid mx-auto d-block" src="../images/robote.jpg" class="img-rounded" height="600" width="800" >';
                } else {
        ?>
        <div class="container-fluid"><div class="container">
            <br><fieldset class="form-control">
                <legend style="width:auto;padding:0 10px;
    border-bottom:none;"><i>Add Image To Existing Product</i></legend>
        <?php echo'<form  method="POST" action="'.$Url.'createProduct" enctype="multipart/form-data">'; ?>
                <div class="p-3"> <!-- padding -->
                <?php $i=0; //no need forloop ?>
                    
                <!-- Category -->
                     <?php 
                        $getCategorieByUrl = $Url."readCategorie&id=".$tab->product[$i]->categorie_id;
                            $getServerResponse = file_get_contents($getCategorieByUrl);   
                                $getCategorie = json_decode($getServerResponse);

                        if(empty($getCategorie))  $v = null;
                        else $v = $getCategorie->categorie[0]->name ;
                    
                    ?>
                        <div class="form-group row"> 
                            <label for="category" class="col-sm-2 col-form-label">Category: </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="category" value="<?php echo $v; ?>">
                                </div>
                        </div>
                <!-- end Category -->  

                    <div class="form-group row"> <!-- name -->
                        <label for="name" class="col-sm-2 col-form-label">Name: </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="name" value="<?php echo $tab->product[$i]->name; ?>">
                            </div>
                    </div>
                
                     <div class="form-group row"> <!-- price -->
                        <label for="price" class="col-sm-2 col-form-label">Price: </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="price" value="<?php echo $tab->product[$i]->price; ?>">
                            </div>
                    </div>

                    <div class="form-group row"> <!-- discount -->
                        <label for="discount" class="col-sm-2 col-form-label">Discount: </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="discount" value="<?php echo $tab->product[$i]->discount; ?>">
                            </div>
                    </div>

                    <div class="form-group row"> <!-- descriere -->
                        <label for="descriere" class="col-sm-2 col-form-label">Descriere: </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="descriere" value="<?php echo $tab->product[$i]->descriere; ?>">
                            </div>
                    </div>
                <!-- Images -->
               
                    <div class="form-group row">
                        <label for="images" class="col-sm-2 col-form-label">Images: </label>
                            <div class="col-sm-10">
                                <?php
                                    if(empty($tab->product[$i]->imageUrl)){
                                        echo '<input type="text" readonly class="form-control-plaintext" id="descriere" value="No Image!">';
                                    } else {  
                                        foreach ($tab->product[$i]->imageUrl as $value) {
                                            $Img= str_replace("images/", "", $value);        
                                            echo'<img src="../'.$value.'" alt="'.$Img.'" class="img" height="200px;" width="200px;">';                   
                                        }
                                    }  
                                ?> 
                            </div>
                    </div>

                    <!-- add new image -->
                        <br><div class="form-group row">
                            <label for="fileToUpload" class="ml-3">Choose Product Image: </label>
                                <div class="col-md-6">
                                    <input type="file" name="file_img[]" id="fileToUpload" multiple/ >
                                </div>
                        </div>
                    <!-- end add new img -->   
                    <input type="hidden" name="ImageAddId" value="<?php echo $productId ?>">
                    <br><button type="submit" class="btn btn-primary " name="addImages">Submit</button>  
                </div>   <!-- padding div -->           
            </form>
            
        </div></div> <!-- end containers -->
        </fieldset>
                <?php } ?> <!-- if not empty results -->
        <!-- end content -->
        
</div> <!-- end container -->

<?php
    } else { //dc nu sunt logat 
?>

<body><div class="container">

<div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top:15%;margin-left:15%;margin-right:15%;">
                    <div class="card">
                        <div class="card-header"> Welcome Admin </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="admin.php">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>
                        
                            <br><div class="form-group row ">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

<?php
     }
?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->