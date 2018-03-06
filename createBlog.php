<!--

-->

<?php

    session_start();

    unset($_SESSION['redirect']);
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


if(!empty($_POST['submitbtn'])){
  $_SESSION['btitle'] = $_POST['btitle'];
  $_SESSION['bdata'] = $_POST['bdata'];

  $errors = array();

    //Title validation 
  if(empty($_POST['btitle'])){
    $errors['btitle001'] = "Title is required";
  }

  if(!preg_match("/^[a-zA-Z0-9\s]{1,25}$/", $_POST["btitle"])){
    $errors['btitle002'] = "Only letters are allowed. Max 25 characters";
  }

      //bdata validation
  if(empty($_POST['bdata'])){
    $errors['bdata001'] = "Blog Content is required";
  }

  $temp = $_POST['bdata'];
        $temp = stripslashes($temp);//going to strip html regardless
        $temp = htmlspecialchars($temp);
        $temp = trim($temp);

    if(!preg_match("[a-zA-Z][\s]", $temp, $matches)){//anything other than letters and spaces
                   $temp = str_replace($matches, "", $temp);//replaces with null
                 }

                if(preg_match("(?i)select|delete|insert", $temp, $matches)){//removes SQL operations
                   $temp = str_replace($matches, "", $temp);//replaces with null
                 }
                $_POST['bdata'] = $temp;//posts back to bdata
                
                if(count($errors) == 0){
                  header("Location: blogPost.php");

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
          

          ";} else{
           echo" <a class='btn btn-default' href='logout.php' role='button'>Logout &raquo;</a>";
          } 


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


          <!-- Main jumbotron for a primary marketing message or call to action -->
          <div class="jumbotron">
            <div class="container">
              <h1>Blog Creation</h1>

              <p>
                <?php
                echo "Logged in user is ". $_SESSION['uname'];
                ?>

              </p>
            </div>
          </div>

          <div class="container">
            <!-- Example row of columns -->
            <div class="row">
              <div class="col-md-4">

                <p>
                 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="mkblogform">
                  <!--Blog Name Input -->
                  <p>
                    <label for="btitle"> Blog Title </label>
                    <input type="text" placeholder="Blog Title" name="btitle" id="btitle" value="<?php if(isset($_POST['btitle'])); echo $_POST['btitle']?>"/>
                    <span>
                      <?php
                        if(isset($errors['btitle001'])) echo $errors['btitle001'];#empty
                        if(isset($errors['btitle002'])) echo $errors['btitle002'];#formatting
                      ?>
                    </span>
                  </p>

                  <!--Blog Data Input -->
                  <p>
                    <label for="bdata"> Blog Content </label>
                    <textarea name="bdata" placeholder="Words Go Here" rows="8" cols="20"></textarea>
                    <span><?php
                        if(isset($errors['bdata001'])) echo $errors['bdata001'];#empty
                      ?></span>
                  </p>

                  <input class="btn btn-default" name="submitbtn" type="submit" value="Submit &raquo;"/>
                  <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
                 
   </form>
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
