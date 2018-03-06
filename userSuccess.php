<!--
a modified version of usedAdded
displays the info of a newly added user
redirects to index page
-->


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
          

          ";}
            else{
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

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <table style="width=100%">
                        <?php
                        session_start();
                        $temp = $_SESSION['uname'];
                        try{
                        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdinsert password=Jxem877&") or die ("Connection Refused");

        //makes sure connection was successful
                        if (!$conn) {   
                            echo pg_last_error($conn);

                        } elseif(!empty($_SESSION)){
                            $password = $_SESSION['pass'];
                            $passHashed = password_hash($password, PASSWORD_BCRYPT);
                            $stmtVal = array("$_SESSION[uname]", "$passHashed", "$_SESSION[email]", "FALSE", "FALSE" );

            //prepared statement & query string            
                            $result = pg_prepare($conn, "INSERT", 'INSERT INTO users (uname, pass, email, admin, active) VALUES ($1, $2, $3, $4, $5)');

                            $rtn = pg_execute($conn, "INSERT", $stmtVal);

            //makes sure that the insert executed properly
                            if (!$rtn) {
                                echo pg_last_error($conn);
                            } else {
                                echo "<h2> The Following Information Was Added To The Database</h2>";
                                echo "<br>";
                                echo"<tr>";
                                echo "<th><h4> Username </h4></th>";
                                echo "<th><h4> Email </h4></th>";
                                echo "<th><h4> Admin </h4></th>";
                                echo "<th><h4> Active </h4></th>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td><h5> $_SESSION[uname]</h5></td>";
                                echo "<td><h5> $_SESSION[email]</h5></td>";
                                echo "<th><h4> FALSE </h4></th>";
                                echo "<th><h4> FALSE </h4></th>";
                                echo "</tr>";



            }//end of else
            unset($_SESSION['pass']);
            unset($_SESSION['email']);
            $_SESSION['active'] = "FALSE";
            $_SESSION['admin'] =  "FALSE";

        }
        else{
            echo "<p><h2>Error: Please Create a before accessing this page.</h2></p>"; 
            echo "<p><a class='btn btn-default' href='/SSD2/newuser.php' role'button'> New User &raquo; </a></p>";      
        }

            pg_close($conn);
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        ?>
    </table>

    <p><a class="btn btn-default" href="/SSD2" role="button">Home &raquo;</a></p>
    <p><a class="btn btn-default" href="/SSD2/userProfile.php" role="button">User Profile &raquo;</a></p>
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
