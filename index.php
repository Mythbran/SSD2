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

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Main Blog Page</h1>
        <p>This is a live demo for Assignment 2 of Secure Software Development</p>
        <P>
           Created by Matthew D'Angelo and Tjon Trudge

        </p>
        <p>
          <?php
            echo "Logged in user is ". $_SESSION['uname'];
            echo "And his email is ". $_SESSION['email'];
          ?>

        </p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Login</h2>
          <p><a class="btn btn-default" href="login.php" role="button">Login &raquo;</a></p>

        </div>

        <div class="row">
        <div class="col-md-4">
          <h2>Blogs</h2>
          <p><a class="btn btn-default" href="blogPortal.php" role="button">Blogs &raquo;</a></p>

        </div>

        <div class="col-md-4">
          <h2>New User</h2>
          <p>Create a new user below(Going to move to user/pass up there ^)</p>
          <p><a class="btn btn-default" href="newuser.php" role="button">New User &raquo;</a></p>
        </div>

        <div class="col-md-4">
          <h2>USERPROFILE</h2>
          <p><a class="btn btn-default" href="userProfile.php" role="button">User Profile &raquo;</a></p>
        </div>

        <div class="col-md-4">
          <h2>Apps</h2>
          <p>Below is a list of our program downloads</p>
          <p><a class="btn btn-default" href="gitpush.sh" role="button">Download gitpush &raquo;</a></p>
       </div>


            

      </div>
    </div>

<div class="container" align="center">
<?php

            //selects blogs from the database

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
