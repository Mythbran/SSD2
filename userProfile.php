<!--
modified version of list user
selects from based on user name
need to make a session variable to use to pull from DB
need to research adding a user profile pic
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
                    <h2>User Profile</h2>
                    <h3>Your Information Is Listed Below</h3>

                    <!--
                        Profile pic goes here
                    -->

                    <table>                   
                        <?php
                //debugging stuff???
                        ini_set('display_errors', 'On');
                        error_reporting(E_ALL);
                    //database connection
                        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=select") or die ("connection refused");

                        $stmtVal = 'tjon';
/*
                    $data = pg_prepare($conn, "SELECT", 'SELECT (uname, pass, email, sname, snum, city, province, pcode, pnum, bio) FROM users WHERE uname = $1');//test variable

                     $rtn = pg_execute($conn, "SELECT", $stmtVal) or die(echo pg_last_error($conn));

                     $data = pg_fetch_assoc($rtn);
                   */

                     $rtn = pg_query($conn, 'SELECT (uname, email, sname, snum, city, province, pcode, pnum, bio) FROM users WHERE uname = tjon');//test variable
                    
                       while ($data = pg_fetch_assoc($rtn)) {
                        echo"<tr>";
                        echo "<td><h4> Username       </h4></td>";
                        echo "<td><h4> Email          </h4></td>";
                        echo "<td><h4> Address        </h4></td>";
                        echo "<td><h4> City           </h4></td>";
                        echo "<td><h4> Postal Code    </h4></td>";
                        echo "<td><h4> Phone Number   </h4></td>";
                        echo "<td><h4> Bio            </h4></td>";
                        echo "</tr>";                     

                        echo"<tr>";
                        echo "<td><h5>" . $data['uname'] .    "</h5></td>";
                        echo "<td><h5>" . $data['email'] .    "</h5></td>";
                        echo "<td><h5>" . $data['snum']  . " " . $rtn['sname'] . "</h5></td>";//". . "     
                        echo "<td><h5>" . $data['city'] . ", " . $data['province'] . "</h5></td>";
                        echo "<td><h5>" . $data['pcode'] .    "</h5></td>";
                        echo "<td><h5>" . $data['pnum'] .     "</h5></td>";
                        echo "<td><h5>" . $data['bio']   .    "</h5></td>";
                        echo"</tr>"; 
                    }
                    

                pg_close($conn);                               
                ?>
            </table>

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