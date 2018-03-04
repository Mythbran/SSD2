<?php
session_start();
if (!empty($_SESSION)) {
  $editID = $_SESSION['editid'];
  $owner = 'tjon';

  if(!empty($_POST['submitbtn'])){
   $_SESSION['btitle'] = $_POST['btitle'];
   $_SESSION['bdata'] = $_POST['bdata'];
   $_SESSION['bid'] = $editID;

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
                  $_SESSION['uname'] = $owner;
                  
                  $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdinsert password=Jxem877&")or die ("Connection Refused");

                  $stmtVal = array("$btitle", "$bdata", "$editID");
                  $result = pg_prepare($conn, "UPDATE", "UPDATE blogs SET title = $1, data = $2 WHERE bid = $3");
                  $rtn = pg_execute($conn, "UPDATE", $stmtVal);

                  if (!$rtn) {
                    echo pg_last_error($conn);
                  }else{

                    header("Refresh: 10; URL=/SSD2/blogPortal.php");
                    echo "<h2>Your Blog Post has been updated.</h2>";
                    unset($_SESSION['btitle']);
                    unset($_SESSION['bdata']);
                    unset($_SESSION['editID']);
                    exit();

                  }
                  pg_close($conn);

                  exit();
                }
              }
            }
            else{
              header("Refresh: 5; URL=/SSD2/login.php");
              echo "<h1>Please Log In</h1>";
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
              textarea {
               resize: none;
               width: 800px;
               height: 300px;
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
              <h1>Edit a Blog Post</h1>

              <p>
                <?php
                ini_set('display_errors', 'On');
                error_reporting(E_ALL);
          //makes sure user owns said blog
                $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723")or die ("Connection Refused");
                $stmtVal = array("$editID");
                $pre = pg_prepare($conn, "SELECT", "SELECT owner, title, data FROM blogs WHERE bid = $1");
                $rtn = pg_execute($conn, "SELECT", $stmtVal) or die(pg_last_error($conn));
                $result = pg_fetch_assoc($rtn);

                if ($owner == $result['owner']) {
                  $editTitle = $result['title'];
                  $editData = $result['data'];


                }else{
                  header("Refresh: 5; URL=/SSD2/blogPortal.php");
                  echo "You Don't Own Thing Blog!";
                  exit();
                }

                pg_close($conn);
                ?>

                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="editblogform">
                  <!--Edit Blog Name Input -->
                  <p>
                    <label for="btitle"> Blog Title </label>
                    <input type="text" name="btitle" id="btitle" value="<?php echo $editTitle;?>"/>
                    <span>
                      <?php
                        if(isset($errors['btitle001'])) echo $errors['btitle001'];#empty
                        if(isset($errors['btitle002'])) echo $errors['btitle002'];#formatting
                        ?>
                      </span>
                    </p>

                    <!--Edit Blog Data Input -->
                    <p>
                      <label for="bdata"> Blog Content </label>
                      <textarea name="bdata" rows="8" cols="20"> <?php echo $editData;?> </textarea>
                      <span><?php
                        if(isset($errors['bdata001'])) echo $errors['bdata001'];#empty
                        ?></span>
                        
                        <input class="btn btn-default" name="submitbtn" type="submit" value="Submit &raquo;"/>
                        <input class="btn btn-default" type="reset" value="Reset &raquo;"/>
                      </p>
                    </form>
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
