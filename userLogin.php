<!--
same pg validation
redirects to user profile if true
-->
<?php
session_start();
if($_POST){
$_SESSION['email'] = $_POST['email'];
$_SESSION['pass'] = $_POST['pass'];
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
        				<a href="newuser.php">
        					<span style="display: block;">
        						Create An Account
        					</span>
        				</a>
        				<button type="submit" class="btn btn-success">Sign in</button>
        			</form>
        		</div><!--/.navbar-collapse -->
        	</div>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
        	<div class="container">
        		<h1></h1>
        	</div>
        </div>

        <div class="container">
        	<!-- Example row of columns -->
        	<div class="row">
        		<div class="col-md-4">
        			<form method="post" action="login.php" id="loginform">
        				<!-- email Form -->
        				<label for="email"> Email: </label>
        				<input type="text" placeholder="Email" name="email" id="email"value="<?php if(isset($_POST['email'])); echo $_POST['email'];?>"/>
        				<br>
        				<!-- pass Form -->
        				<label for="pass">Password: </label>
        				<input type="password" placeholder="Password" name="pass" id="pass" value="<?php if(isset($_POST['pass'])); echo $_POST['pass']; ?>"/><br>
        				<a href="passForget.php">
        					<span style="display: block;">
        						Forgot Your Password?
        					</span>
        				</a>
        				<input class="btn btn-default" type="submit" value="Submit &raquo;"/>
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