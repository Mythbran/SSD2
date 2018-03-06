
<?php
  session_start();
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
          echo" <a class='btn btn-default' href='userProfile.php' role='button'>User Profile &raquo;</a>
            <a class='btn btn-default' href='logout.php' role='button'>Logout &raquo;</a>
            <a class='btn btn-default' href='blogPortal.php' role='button'>Blogs &raquo;</a>

          ";

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
        <h1>Team Igni Blogs</h1>
        <p>This is a live demo for Assignment 2 of Secure Software Development</p>
        <P>
           Created by Matthew D'Angelo and Tjon Trudge

        </p>
        <p>
          <?php
            
            echo "Logged in user is ". $_SESSION['uname'];
            
          ?>

        </p>
      </div>
    </div>

    <div class="container" align="left">
      <!-- Example row of columns -->     


        <div class="col-md-4">
          <h2>New User</h2>
          <p>Create a new user below(Going to move to user/pass up there ^)</p>
          <p><a class="btn btn-default" href="newuser.php" role="button">New User &raquo;</a></p>
        </div>            

      </div>
    </div>

<div class="container" align="center">
    <h2>Recent Blogs</h2>
    <h3>Come Join The Community!!!</h3>
<?php

            //selects blogs from the database
try{
            $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723")or die ("Connection Refused");

$pre = pg_prepare($conn, "SELECT", "SELECT owner, title, data FROM blogs");

$rtn = pg_execute($conn, "SELECT");

while($data = pg_fetch_assoc($rtn)){
  echo" <span>
        <p>
        <h2>$data[title]</h2><br>
        <h3>By: $data[owner]</h3><br>
        <h4>$data[data]</h4><br>
        </p>
        </span>
  ";
}

pg_close($conn);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
            ?>

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
