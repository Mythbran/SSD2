<!--
Just using new user from assignment 1 for this.
adding password field
also need to add it to the DB
redirects to user Success
-->
<?php 	
if($_POST){
	
	session_start();
	$_SESSION['uname'] = $_POST['uname'];
	$_SESSION['pass'] = $_POST['pass'];
	$_SESSION['email'] = $_POST['email'];
		//Validation things 


		$errors = array(); // array to hold errors

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
        	session_start();
        	$_SESSION['uname'] = $_POST['uname'];
        	$_SESSION['pass'] = password_hash($_POST['pass'], PASSWORD_BYCRYPT);
        	$_SESSION['email'] = $_POST['email'];
         	header("Location: /userSuccess.php");

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
            	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        			<a class="navbar-brand" href="/SSD1">SSD1</a>
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
        		<h1>New User Creation</h1>
        	</div>
        </div>
        <div class="container">
        	<!-- Example row of columns -->
        	<div class="row">
        		<div class="col-md-8">
        			<!-- User Form --> 
        			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uform">
        				<!-- Username Form --> 
        				<p>
        					<label for="uname">Username: </label>
        					<input type="text" placeholder="Username" name="uname" id="uname" value="<?php if(isset($_POST['uname'])); echo $_POST['uname']; ?>"/>

        					<!-- Username Validation -->
        					<span class="errors"> * <?php
			if(isset($errors['uname001'])) echo $errors['uname001'];#empty

			if(isset($errors['uname002'])) echo $errors['uname002'];#A-Za-z 1-25 length      


			?></span>
		</p> 

		<!-- Password Form --> 
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uform">
			<p>
				<label for="pass">Password: </label>
				<input type="password" placeholder="Password" onfocus="this.value=''" name="pass" id="pass" value="<?php if(isset($_POST['pass'])); echo $_POST['pass']; ?>"/><br>
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

		<p> 
			<!-- email Form -->
			<label for="email"> Email: </label>
			<input type="text" placeholder="Email" name="email" id="email"value="<?php if(isset($_POST['email'])); echo $_POST['email']?>"/>
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
