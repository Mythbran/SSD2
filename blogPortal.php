<!--
modified version of userProfile
redirects to separate pages
-->

<?php
if(!empty($_POST)){
    session_start();
   $errors = array(); // array to hold errors

        //Validation things 

   if (isset($_POST['picbtn'])) {

           //pic validation
     if(empty($_POST['pic'])){
    $errors['pic001'] = "Picture is required";
     }
     /*
     $file = $_POST['pic'];
    $img = new Imagick(realpath($file));
    $img->stripImage();*/
    $_SESSION['pic'] = file($_POST['pic']);

 }

 elseif (!empty($_POST['emailbtn'])) {

      //email validation
    if(empty($_POST['email'])){
        $errors['email001'] = "Email is required";
    }
        //Email Formatting Validation
    if(!preg_match("/^([A-Za-z0-9\.\-]{1,64})[@]([A-Za-z0-9\-]{1,188}\.)([A-Za-z\.]{1,9})$/", $_POST["email"])){
        $errors['email002'] = "Valid email is required";
    }

    if(!($_POST['email'] == $_POST['emailCheck'])){//makes sure email was entered correctly
            $errors['email003'] = "Emails Do Not Match";
        }

     $_SESSION['email'] = $_POST['email'];
}

elseif (isset($_POST['passbtn'])) {

        //Password validation goes here
        if(empty($_POST['pass'])){//empty
            $errors['pass001'] = "Password is required";
        }
        if(!preg_match("/^[a-zA-Z\d\\!@#$%^&*()-_<>]{8,12}$/", $_POST["pass"])){//password requirements 
            $errors['pass002'] = "Min 8, Max 12, numbers, letters, special chars";//not fully done
        }
        if(!($_POST['pass'] == $_POST['passCheck'])){//makes sure password was entered correctly
            $errors['pass003'] = "Password do not match";
        }

        $_SESSION['pass'] = $_POST['pass'];

    }

    if(count($errors) == 0 ){
        header("Location: editProfile.php");
        exit();
    }
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta https-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
    body {
        padding-top: 50px;
        padding-bottom: 20px;
    }
    table, td, tr{
        border: 1px solid black;
        width:500px;
    }
    th, td {
       padding: 15px;
       text-align: left;
   }
</style>
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/main.css">

<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Home</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" role="form">
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>Blog Options</h2>
                   
                       <p>
           <a  href="/SSD2/createBlog.php">Create a Blog</a><br>
           <a  href="/SSD2/editBlog.php">Edit a Blog</a><br>
           <a  href="/SSD2/deleteBlog.php">Delete a Blog</a><br>
</p>
 </div>
   </div>

   <hr>

   <footer>
    <p>&copy; D'AngeloTrudge 2018</p>
</footer>
</div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>
</body>
</html>