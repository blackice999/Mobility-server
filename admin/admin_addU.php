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
            <a href="admin_addP.php" class='btn'> Add Products </a>
            <a href="admin_addU.php" class='btn btn-info'> Add Users(TEST) </a>
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
            <?php echo'<form  method="POST" action="'.$Url.'createUser">'; ?>
                <div class="form-group">
                    <label for="DP">Display Name</label>
                    <input type="text" class="form-control" id="DP" placeholder="Display Name" name="displayName">    
                </div>

                <div class="form-group">
                    <label for="em">Email</label>
                    <input type="email" class="form-control" id="em" placeholder="Email" name = "email">
                </div>

                <div class="form-group">
                    <label for="PN">Phone Number</label>
                    <input type="number" class="form-control" id="PH" placeholder="Phone Number" name = "phone_number">
                </div>

                <div class="form-group">
                    <label for="loc">Location</label>
                    <input type="text" class="form-control" id="loc" placeholder="Location" name = "location">
                </div>

                 <div class="form-group">
                    <label for="tok">Token</label>
                    <input type="text" class="form-control" id="tok" placeholder="Token" name = "userId">
                </div>

                <div class="form-group">
                    <label for="notif">Display Notification</label>
                        <select id="notif" class="form-control" name="displayNotifications">
                            <option selected>True</option>
                            <option>False</option>
                        </select>
                </div>

                 <div class="form-group">
                    <label for="notiS">Notification Sound</label>
                        <select id="notiS" class="form-control" name="notification_sound">
                            <option selected>android sound resource id</option>
                            
                        </select>
                </div>

                 <div class="form-group">
                    <label for="led">Led Light</label>
                        <select id="led" class="form-control" name="ledLight">
                            <option>True</option>
                            <option selected>False</option>
                        </select>
                </div>

                <button type="submit" class="btn btn-primary" name="addUser">Submit</button>
            </form>
        </div></div>

  
        <!-- end content -->

            
</div> <!-- end container -->

<?php
    } else {
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