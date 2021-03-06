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
    if(isset($_SESSION['logat'])){
?>
        
<div class="container">

    <div class="card">
        <div class="card-header"><a class="btn btn-link float-left disabled" href=""> Admin</a>

        <!-- button -->
       
            <a href="admin.php" class='btn'> Show Products </a>
            <a href="admin_addP.php" class='btn'> Add Products </a>
            <a href="admin_addU.php" class='btn'> Add Users(TEST) </a>
            <a href="admin_Category.php" class='btn btn-info'> Add/Show Categories </a>

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
            <!-- add Category -->
                <div class="container">
                    <form method="POST" action="<?php echo $Url."createCategories";?>">
                    
                        <div class="row">
                            <div class="col-3"></div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Category Name" name="name">
                                </div>
                                <div class="col">
                                     <button class="btn" type="submit">Add Category</button>
                                </div>
                            </div>
                            
                    </form>
                </div>
            <!-- end add Category -->
        

        <!-- content -->
        
         <?php
            header('Access-Control-Allow-Origin: *');

                $url = $Url."readAllCategories";
                $response = file_get_contents($url); 
                
                
                $tab = json_decode($response);//varianta1
                //$tab = json_decode($response, true);//varianta2, array = true
                
                if(empty($tab)){   
                  echo '<img class="img-fluid mx-auto d-block" src="../images/robote.jpg" class="img-rounded" height="600" width="800" >';
                } else {
        ?>
        <div class="container-fluid">
            <table class="table table-hover" style="margin-top:60px;">
                <thead>
                    <tr>
                        <th style="width: 50%" >Name</th>
                        <th style="width: 50%;" ><b style="float:right;padding-right:7%;">Action</b></th>
                    </tr>
                </thead>
                <tbody>

                <!-- while/foreach -->            
                    <?php 
                        for( $i=0; $i < Count( $tab->categories ); $i++ )  {  
                            //for( $i=0; $i < Count( $tab['categories'] ); $i++ )  {  //varianta2   
                    ?>
                    <tr><td>
                                <?php  
                                    if( isset($_GET['editOn']) &&( $_GET['editOn'] == $tab->categories[$i]->id ) ){
                                        
                                        echo'<form method="POST" action="'.$Url.'updateCategorie&id='
                                                .$tab->categories[$i]->id.'">';
                     
                                        echo'<input type="text" class="form-control mt-1" name="name" required autofocus value="'.$tab->categories[$i]->name.'">';
                                    } else {
                                        echo $tab->categories[$i]->name; //varianta1
                                        //echo $tab['categories'][$i]['name'];
                                    }
                                ?>
                           
                            </td><td>
                                <div class = "row p-2" style=""> 
                                    <div class="col"></div><!-- col-2 -->
                                        <?php
                                    //edit On
                                        if( isset($_GET['editOn']) &&( $_GET['editOn'] == $tab->categories[$i]->id ) ){ 

                                        echo"<div class='row ml-2 mr-1 mb-1' style=''>";

                                            echo'<button type="submit" name="Saved" class="btn btn-secondary btn-sm col" style=""><i class="fas fa-save" style="color:#ADFF2F;"></i> &nbsp;Save </button>
                                            </form>';

                                            echo'<form method="POST" action="admin_Category.php">
                                            <button type="submit" class="btn btn-secondary btn-sm col ml-1"> <i class="far fa-times-circle"></i>&nbsp;Close </button>
                                            </form>';

                                        echo "</div>";
                                //edit Off
                                        } else{ 
                                            
                                          echo"<div class='row ml-1 mr-1' >";

                                        ?>
                                  
                                        
                                        <div class="dropdown col">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                        <?php  echo'    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                                <a class="dropdown-item" href="?editOn='.$tab->categories[$i]->id.'">     <i style="color:blue;"class="fas fa-pencil-alt"></i>&nbsp;Edit </a>  

                                                <a class="dropdown-item" onclick="return confirm(\'Are you sure want to delete?\')" href="'.$Url.'deleteCategorie&id='.$tab->categories[$i]->id.'" >    
                                                    <i class="far fa-trash-alt" style="color:#F08080;"></i>   &nbsp;Delete </a> 
                                             
                                            </div>
                                        </div>';
                                            
                                        }
                                        ?>
                                    
                                </div>
                    </td></tr>
                    <?php 
                   
                    } //end loop
                    ?>
                 <!-- end while/foreach --> 
                </tbody>
            </table>
            
    </div>
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