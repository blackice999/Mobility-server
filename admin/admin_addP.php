<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mycss.css" />
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>


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
    if(isset($_SESSION['logat'])){
?>
        
<div class="container">

    <div class="card">
        <div class="card-header"><a class="btn btn-link float-left disabled" href=""> Admin</a>

        <!-- button -->
            
            <a href="admin.php" class='btn'> Show Products </a>
            <a href="admin_addP.php" class='btn btn-info'> Add Products </a>
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
<br><br>

        <!-- content -->
        <div class="container"><div class="container-fluid">
        <?php echo'<form  method="POST" action="'.$Url.'createProduct" enctype="multipart/form-data">'; ?>
                <div class="form-group">
                    <label for="prodN">Product Name</label>
                    <input type="text" class="form-control" id="prodN" placeholder="Product Name" name="name">    
                </div>

                <div class="form-group">
                    <label for="price">Product Price </label>
                    <input type="number" class="form-control" id="price" placeholder="Product Price" name = "price">
                </div>

                 <div class="form-group">
                    <label for="price">Product Discount</label>
                    <input type="number" class="form-control" id="discount" placeholder="Product Discount" name = "discount">
                </div>

                 <div class="form-group">
                    <label for="desc">Product Description</label>
                    <textarea type="number" class="form-control" id="desc" rows="8" placeholder="Product Description" name = "descriere"></textarea>
                </div>

                <br><div class="form-group row">
                    <label for="fileToUpload" class="ml-3">Choose Product Image: </label>
                    <div class="col-md-6">
                        <input type="file" name="file_img[]" id="fileToUpload" multiple/ >
                    </div>
                </div>


                <br><button type="submit" class="btn btn-primary" name="addProduct">Submit</button>
            </form>
            </div></div>

  
        <!-- end content -->

            
</div> <!-- end container -->

<?php
    } else {//dc nu sunt logat
?>
<div class="container">

<div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top:15%;margin-left:15%;margin-right:15%;">
                    <div class="card">
                        <div class="card-header"> Welcome Admin </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="admin.php">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control" name="name" required autofocus>

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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->