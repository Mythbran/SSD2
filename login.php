<?php
  session_start();
  if(!empty($_SESSION['uname'])){
    header("Location: /SSD2/index.php");
  }


	if($_POST){
    if($_POST['pass']){
    $passHashed = password_hash($password, PASSWORD_BCRYPT);
    $password = $_POST['pass'];
  }
		$errors = array(); 

		//username validation 
		if(empty($_POST['uname'])){
			$errors['uname001'] = "Username is required";
		}
	# validation = ereg("[A-Za-z]{1,25}")
		if(!preg_match("/^[a-zA-Z]{1,25}$/", $_POST["uname"])){
			$errors['uname002'] = "Only letters are allowed. Max 25 characters";
		}
	//Password validation goes here
		if(empty($_POST['pass'])){//empty
			$errors['pass001'] = "Password is required";
		}

    //CHECKING CREDENTIALS 
    $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723") or die ("Connection Refused");
        //makes sure connection was successful
    if (!$conn) {   
      $errors['conn'] = "$conn";

    } elseif($conn){

      $result = pg_query($conn, "SELECT * FROM users where uname = '$_POST[uname]' ");
		//THIS POSSIBLY OPENS US UP TO A SQL INJECTION ATTACK 
		//REWRITE USING PREPARED STATEMENTS WHEN WE SOME TIME 

      //$userPass = array($_POST['uname']);

      //$result = pg_prepare($conn, "SELECT", "SELECT * FROM users where uname = 'mythbran' ");            

      //$rtn = pg_execute($conn, "SELECT");

      //$userPass = var_dump($value1);
      //$userPass2 = var_dump($value2);

      //$userPass = pg_fetch_result($rtn, 0, 1);
      //$userPass2 = pg_fetch_result($result, 0, 1);

      while($rows = pg_fetch_assoc($result)){
        $userPass = $rows['pass'];
      }
      pg_close($conn);

      if(empty($userPass)){
        $errors['nouser'] = "Account was not found";

      }elseif(password_verify($password, $userPass)){
        //LOG    	
      }else{
        $errors['invalidcred'] = "Invalid credentials.";
      }



    }else {
      $errors['defaulError'] = "An unknown error has occured";
    }//end of else
    
 
    unset($_SESSION['pass']);      
		//IF DOESN'T MATCH IN DATABSE 

		if(count($errors) == 0){
      $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723") or die ("Connection Refused");
			
      $result = pg_query($conn, "SELECT * FROM users where uname = '$_POST[uname]' ");

      while($rows = pg_fetch_assoc($result)){
        $_SESSION['userStatus'] =  $rows['userstatus'];

      }

    

      $_SESSION['uname'] = $_POST['uname'];

      header("Location: ". $_SESSION['redirect']);
      pg_close($conn);
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
        <h1>Login</h1>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-5">
        	<!-- User Form --> 
        		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uform">

              <span class="errors"> <?php
                if(isset($errors['conn'])) echo $errors['conn'];#Conection error
                if(isset($errors['nouser'])) echo $errors['nouser'];#nouserfound
                if(isset($errors['invalidcred'])) echo $errors['invalidcred'];#invalid credentials
                if(isset($errors['defaultError'])) echo $errors['defaultError'];#unidentified error
                if(isset($_SESSION['error'])) echo $_SESSION['error'];//errors from oher pages
                unset($_SESSION['error']);
              ?></span>
        			<!-- Username Form --> 
        			<p>
        				<label for="uname">Username: </label>
        				<input type="text" name="uname" id="uname"/>
       					<!-- Username Validation -->
       					<span class="errors"> * <?php
							if(isset($errors['uname001'])) echo $errors['uname001'];#empty

							if(isset($errors['uname002'])) echo $errors['uname002'];#A-Za-z 1-25 length      
						?></span>
					</p>      	
					<!-- Username Form --> 
        			<p>
        				<label for="pass">password: </label>
        				<input type="password" name="pass" id="pass"/>
        				<!--PASSWORD VALIDATION -->
							<span class="errors"> * <?php
								if(isset($errors['pass001'])){
            						echo $errors['pass001'];#empty
            					}
							?></span></br>
       					<a href="/passForget.php">Forgot Password</a>
       					
       					
					</p>      	
					
					<p>
					<input class="btn btn-default" type="submit" value="Submit &raquo;"/>
					<input class="btn btn-default" type="reset" value="Reset &raquo;"/>
					<a class="btn btn-default" href="/SSD2" role="button">Back &raquo;"</a>
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
