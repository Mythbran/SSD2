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

          elseif($_SESSION['userStatus']==2){
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

          <div class="jumbotron">
            <div class="container">
              <h1>Forgetten Password</h1>
              <p>Reset</p>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uform">
                <label for="email"> Email: </label>
                <input type="text" placeholder="Email" name="email" id="email"value="<?php if(isset($_POST['email'])); echo $_POST['email']?>"/>
                <input class="btn btn-default" type="submit" value="Submit &raquo;"/>
              </form>
            </div>
          </div>

          <div class="container">
            <!-- Example row of columns -->
            <div class="row">
              <div class="col-md-4">

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
