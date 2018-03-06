<!--
modified version of list user
selects from based on user name
need to make a session variable to use to pull from DB
trying to do everything on this pg again....
we'll see how this goes.....
-->

<?php
    unset($_SESSION['redirect']);
    session_start();

    if($_SESSION['userStatus'] == 1 || $_SESSION['userStatus'] == 2 ){
        //LOG USER HAS ACCESSED THEIR PROFILE 
    }   
    elseif($_SESSION['userStatus'] == 3){
        $_SESSION['error'] = "Please wait until your account is active";
        header("Location: error.php");
        exit();
    }
    elseif($_SESSION['userStatus'] == 500){
        //ban ip 
    }
    else{
        $_SESSION['error'] = "Please login to view this page";
        $_SESSION['redirect'] = "userProfile.php";
        header("Location: login.php");
        exit();
    }

if(!empty($_POST)){
    session_start();
    $errors = array(); // array to hold errors
    $fPath = pathinfo($_FILES['pic']['name']);
    $ext = $fPath['extension']; 

    $_SESSION['pass'] = $_POST['pass'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['pic'] = $_POST['pic'];

    
        //Validation things 

    //Picture Validation 
   if (isset($_POST['picbtn'])) {

       if(empty($_FILES['pic'])){
        $errors['pic001'] = "Picture is required";
    }

    if ($_FILES['pic']['size'] > 3500000) {
        $errors['pic002'] = "File Limit Is 3.5 MB";
    } 

    if(!($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif')){
        $errors['pic003'] = "Please Upload An Image";
    }
    
if(count($errors) == 0 ){


$path = "/var/www/html/SSD2/userImages/";
$uNamePic = "$_SESSION[uname]." .$ext; 
$target = $path .$uNamePic;
$raw = $_FILES['pic']['tmp_name'];
$raw -> stripImage();

if(move_uploaded_file( $raw['pic']['tmp_name'], $target)){
        header("Refresh: 5; Location: userProfile.php");
        echo "<h2>Profile Pic has been uploaded</h2>";
        unset($_FILES['pic']);
         exit();

    }else{
        echo "<h2>file upload didnt work</h2>";
    }

}
}

//email validation
elseif (!empty($_POST['emailbtn'])) {

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

if(count($errors) == 0 ){
    $_SESSION['email'] = $_POST['email'];
        header("Location: editProfile.php");
        exit();
    }
}

//Password validation 
elseif (isset($_POST['passbtn'])) {

        if(empty($_POST['pass'])){//empty
            $errors['pass001'] = "Password is required";
        }
        if(!preg_match("/^[a-zA-Z\d\\!@#$%^&*()-_<>]{8,12}$/", $_POST["pass"])){//password requirements 
            $errors['pass002'] = "Min 8, Max 12, numbers, letters, special chars";//not fully done
        }
        if(!($_POST['pass'] == $_POST['passCheck'])){//makes sure password was entered correctly
            $errors['pass003'] = "Password do not match";
        }

        if(count($errors) == 0 ){
        $_SESSION['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        header("Location: editProfile.php");
        exit();
    }

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
          <a class="btn btn-default" href="/" role="button">Home &raquo;</a>
          <a class="btn btn-default" href="/SSD2" role="button">SSD2 &raquo;</a>
          <a class="btn btn-default" href="newuser.php" role="button">New User &raquo;</a>
        </div>
        <div id='navbar' class='navbar-collapse collapse'> 
            <form class='navbar-form navbar-right' role='form' method="post" action="/SSD2/login.php" id="uform" >
           <div class='form-group'>
        <?php
        if(!empty($_SESSION['uname'])){
          if($_SESSION['userStatus']==1){
          echo" <a class='btn btn-default' href='userProfile.php' role='button'>User Profile &raquo;</a>
          <a class='btn btn-default' href='blogPortal.php' role='button'>Blogs &raquo;</a>
          <a class='btn btn-default' href='admin.php' role='button'>admin &raquo;</a>
            <a class='btn btn-default' href='logout.php' role='button'>Logout &raquo;</a>
          

          ";} 

          else{
          echo" <a class='btn btn-default' href='userProfile.php' role='button'>User Profile &raquo;</a>
          <a class='btn btn-default' href='blogPortal.php' role='button'>Blogs &raquo;</a>
            <a class='btn btn-default' href='logout.php' role='button'>Logout &raquo;</a>
          

          ";} 
          
        }else{
          $_SESSION['redirect'] = "index.php";
          echo "
          
              <input type='text' placeholder='Username' class='form-control' id ='uname' name='uname'>
             
              <input type='password' placeholder='Password' class='form-control' id='pass' name ='pass'>
                          
            <button type='submit' class='btn btn-success'>Sign in</button>
          
        ";

        }



        ?>
        </div>
        </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>


        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>User Profile</h2>
                    <h3>Your Information Is Listed Below</h3>

                    <!--
                        Profile pic goes here

                    -->

                    <?php

                        //database connection
$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723") 
or die ("connection refused");

$stmtVal = array("$_SESSION[uname]");

$pre = pg_prepare($conn, "SELECT", 'SELECT uname, email FROM users WHERE uname = $1');
$rtn = pg_execute($conn, "SELECT", $stmtVal) or die("Database Error. Contact Your Administer");
$data = pg_fetch_assoc($rtn);

//displays username and email
echo "<h4>Username: " . $data['uname'] . "</h4>";
echo "<h4>Email: " . $data['email'] . "</h4>" ;

pg_close($conn);   

?>

<h3>Profile Options</h3>
<p href="/SSD2/blogPortal.php">Blog Portal</p>
<div>
    <!-- user pic form-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="picform" enctype="multipart/form-data">
        <p>
            <label for="pic"> Upload Profile Picture: </label>
            <input type="file" name="pic" id="pic" value="<?php if(isset($_POST['pic'])); echo $_POST['pic']?>"/>
        </p>
        <input class="btn btn-default" name="picbtn" type="submit" value="Submit &raquo;"/>
        <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
        <span class="errors"> * <?php
                               if(isset($errors['pic001'])) echo $errors['pic001'];#empty
                               if(isset($errors['pic002'])) echo $errors['pic002'];
                               if(isset($errors['pic003'])) echo $errors['pic003'];
                               ?>
                           </span>
                       </form>

                       <p>
                        <!-- email Form -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="emailform">
                            <h4>Change Email</h4>
                            <label for="email"> Email: </label>
                            <input type="text" placeholder="Email" name="email" id="email" value="<?php if(isset($_POST['email'])); echo $_POST['email']?>"/><br>

                            <label for="email_1"> Re-Enter: </label>
                            <input type="text" placeholder="Email" name="emailCheck" id="emailCheck" />
                            <span class="errors"> * <?php
                            if(isset($errors['email001'])) echo $errors['email001'];
                            if(isset($errors['email002'])) echo $errors['email002'];
                            if(isset($errors['email003'])) echo $errors['email003'];

                            ?></span>
                        </p>
                        <input class="btn btn-default" name="emailbtn" type="submit" value="Submit &raquo;"/>
                        <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
                    </form>

                    <p>
                        <h4>Change Password</h4>
                        <!-- Password Form --> 
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="passform">

                            <label for="pass">Password: </label>
                            <input type="password" placeholder="Password" name="pass" id="pass" value="<?php if(isset($_POST['pass'])); echo $_POST['pass']; ?>"/><br>

                            <label for="passCheck">Re-enter Password: </label>
                            <input type="password" placeholder="Password" name="passCheck" id="passCheck" />

                            <!-- Password Validation -->
                            <span class="errors"> * <?php
            if(isset($errors['pass001'])) echo $errors['pass001'];#empty

            if(isset($errors['pass002'])) echo $errors['pass002'];#should echo password requirements  

               if(isset($errors['pass003'])) echo $errors['pass003'];#makes sure that passwords match

               ?></span>
           </p>
           <input class="btn btn-default" name="passbtn" type="submit" value="Submit &raquo;"/>
           <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
       </form>


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
