<!--
Just using new user from assignment 1 for this.
adding password field
also need to add it to the DB
redirects to user Success
-->
<?php   
if($_POST){
    
    session_start();

    if($_SESSION['userStatus'] != 1){ 
    $_SESSION['error'] = "Please login to view this page";
    header("Location: errors.php");
    exit();
    }

    if($_POST['userStatus'] == 1 || $_POST['userStatus'] == 2 || $_POST['userStatus'] == 3){
        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdupdate password=Qwtc8*08")or die ("Connection Refused");

        $stmtVal =  array("$_POST[userStatus]","$_POST[uname] ");

        $result = pg_prepare($conn, "UPDATE", "UPDATE users SET userstatus = $1 WHERE uname = $2");


        $rtn = pg_execute($conn, "UPDATE", $stmtVal);


    }else{
        $errors = "Enter a correct user status value";
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

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Approve New Users</h1>
            </div>
        </div>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-8">
                    <!-- User Form --> 
                    <p>User Status Meaning </p>
                    <p>1 = Admin</p>
                    <p>2 = Active User</p>
                    <p>3 = Inactive User</p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uform">
                    <?php
                    //database connection
                     
                    $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723")or die ("Connection Refused");

                    $rtn = pg_query($conn, "SELECT * FROM users");

                    while ($row = pg_fetch_assoc($rtn)) {
                        print "Username:      " . $row['uname'] . "<br> ";
                        print "Email:        " . $row['email'] . "<br> ";
                        print "Status : <input type='text' name='userStatus'id='userStatus' value='". $row['userstatus'] . "' /> <br>";
                        print "<input type='hidden' name ='uname' value='".$row['uname'] . "' />";
                        print "<br>";
                    }//while loop
                    ?>

                    <br>
                </div>
        
        <input class="btn btn-default" type="submit" value="Submit &raquo;"/>
        <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
        <a class="btn btn-default" href="/SSD1" role="button">Back &raquo;</a>
    </form>

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
