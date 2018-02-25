<!--
modified version of list user
selects from based on user name
need to make a session variable to use to pull from DB
throws data to editProfile.php
table still not working
-->

<?php
if($_POST){

    session_start();

    $_SESSION['pass'] = $_POST['pass'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['pic'] = $_POST['pic'];
    
        //Validation things 


        $errors = array(); // array to hold errors

//Password validation goes here
        if(empty($_POST['pass'])){//empty
            $errors['pass001'] = "Password is required";
        }

        if(!preg_match("/^[[a-zA-Z\d\\!@#$%^&*()-_<>]{8,12}$/", $_POST["pass"])){//password requirements 
            $errors['pass002'] = "Min 8, Max 12, numbers, letters, special chars";//not fully done
        }

        if(!($_POST["pass"] == $_POST["passCheck"])){//makes sure password was entered correctly
            $errors['pass003'] = "Password do not match";

        }

        //email validation
        if(empty($_POST['email'])){
            $errors['email001'] = "Email is requred";
        }

        //Email Formatting Validation
        if(!preg_match("/^([A-Za-z0-9\.\-]{1,64})[@]([A-Za-z0-9\-]{1,188}\.)([A-Za-z\.]{1,9})$/", $_POST["email"])){
            $errors['email002'] = "Valid email is required";
        }

        if(count($errors) == 0){
            header("Location: /editProfile.php");

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
                    <h2>User Profile</h2>
                    <h3>Your Information Is Listed Below</h3>

                    <!--
                        Profile pic goes here

                    -->

                    <table>     
                        <tr><!--table header-->
                           <th><h4> Username       </h4></th>
                           <th><h4> Email          </h4></th>
                           <th><h4> Address        </h4></th>
                           <th><h4> City           </h4></th>
                           <th><h4> Postal Code    </h4></th>
                           <th><h4> Phone Number   </h4></th>
                           <th><h4> Bio            </h4></th>
                       </tr>          

                       <tr>     
                        <?php

                        //debugging stuff - printing in text box for some reason
                        ini_set('display_errors', 'On');
                        error_reporting(E_ALL);

                        //database connection
                        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=select") 
                        or die ("connection refused");

                        //$stmtVal = 'tjon';

                    $pre = pg_prepare($conn, "SELECT", 'SELECT (uname, email, sname, snum, city, province, pcode, pnum, bio) FROM users');


               // $rtn = pg_execute($conn, "SELECT", stmtVal) or die(echo "<h1>WRONG</h1>");
                 //PROBLEM IS RIGHT HERE ^^^^^^^^^

                 //    $rtn = pg_query($conn, 'SELECT (uname, email, sname, snum, city, province, pcode, pnum, bio) FROM users LIMIT 1');//test variable*/
                    
                     // $data = pg_fetch_assoc($rtn);


                        /*
                        echo "<td><h5>" . $data['uname'] .    "</h5></td>";
                        echo "<td><h5>" . $data['email'] .    "</h5></td>";
                        echo "<td><h5>" . $data['snum']  . " " . $data['sname'] . "</h5></td>";   
                        echo "<td><h5>" . $data['city'] . ", " . $data['province'] . "</h5></td>";
                        echo "<td><h5>" . $data['pcode'] .    "</h5></td>";
                        echo "<td><h5>" . $data['pnum'] .     "</h5></td>";
                        echo "<td><h5>" . $data['bio']   .    "</h5></td>";

                        echo $data['uname'];
                        echo $data['email'];
                        echo $data['snum'];
                        echo $data['sname'];
                        echo $data['city'] . ", " . echo $data['province'];
                        echo $data['pcode'];
                        echo $data['pnum'];
                        echo $data['bio'];
                */


                        pg_close($conn);   

                        ?>
                    </tr>
                </table> 

                <h3>Profile Options</h3>
                <div>
                    <!-- user pic form-->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="picform">
                        <p>
                            <label for="pic"> Upload Profile Picture: </label>
                            <input type="file" name="pic" id="pic" value="<?php if(isset($_POST['pic'])); echo $_POST['pic']?>"/>
                        </p>
                        <input class="btn btn-default" type="submit" value="Submit &raquo;"/>
                        <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
                    </form>

                    <p>
                        <!-- email Form -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="eform">
                            <h4>Change Email</h4>
                            <label for="email"> Email: </label>
                            <input type="text" placeholder="Email" name="email" id="email" value="<?php if(isset($_POST['email'])); echo $_POST['email']?>"/>

                            <label for="email_1"> Re-Enter: </label>
                            <input type="text" placeholder="Email" name="email_1" id="email_1" value=""/>
                            <span class="errors"> * <?php
                            if(isset($errors['email001'])){
                                echo $errors['email001'];#empty
                            }

                            if(isset($errors['email002'])){
                                echo $errors['email002'];#invalid
                            }

                            ?></span>
                    </p>
                    <input class="btn btn-default" type="submit" value="Submit &raquo;"/>
                    <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
                         </form>

    <p>
        <h4>Change Password</h4>
        <!-- Password Form --> 
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="pswdform">
        
            <label for="pass">Password: </label>
            <input type="password" placeholder="Password" onfocus="this.value=''" name="pass" id="pass" value="<?php if(isset($_POST['pass'])); echo $_POST['pass']; ?>"/>

            <label for="passCheck">Re-enter Password: </label>
            <input type="password" placeholder="Password" onfocus="this.value=''" name="passCheck" id="passCheck" value="<?php if(isset($_POST['passCheck'])); echo $_POST['passCheck']; ?>
            "/>

            <!-- Password Validation -->
            <span class="errors"> * <?php
            if(isset($errors['pass001'])) echo $errors['pass001'];#empty

            if(isset($errors['pass002'])) echo $errors['pass002'];#should echo password requirements  

               if(isset($errors['pass003'])) echo $errors['pass003'];#makes sure that passwords match

               ?></span>
           </p>
           <input class="btn btn-default" type="submit" value="Submit &raquo;"/>
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