<?php
session_start();

unset($_SESSION['redirect']);
    if($_SESSION['userStatus'] == 1 || $_SESSION['userStatus'] == 2 ){
        //LOG USER HAS ACCESSED THEIR PROFILE 
    }   

    elseif($_SESSION['userStatus'] == 3){
        $_SESSION['error'] = "Please wait until your account is active";
        header("Location: error.php");
        exit();
    }

    elseif($_SESSION['userStatus'] == 500){
        //ban ip 
    }
    else{
        $_SESSION['error'] = "Please login to view this page";
        $_SESSION['redirect'] = "userProfile.php";
        header("Location: login.php");
        exit();
    }

if (!empty($_SESSION)) {//need to re do this. itll never be empty with whatever id form we use
	$blogID = $_SESSION['deleteid'];
	$owner = $_SESSION['uname'];
	$stmtVal = array("$blogID");
	//makes sure user owns said blog
	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723")or die ("Connection Refused");
	$pre = pg_prepare($conn, "SELECT", "SELECT owner, title FROM blogs WHERE bid = $1");
	$rtn = pg_execute($conn, "SELECT", $stmtVal) or die(pg_last_error($conn));
	$ownerCheck = pg_fetch_assoc($rtn);
	if ($owner == $ownerCheck['owner']) {//deletes from database
		if (isset($_POST['yesbtn'])) {
			
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssddelete password=delete")or die ("Connection Refused");
			$result = pg_prepare($conn, "DELETE", 'DELETE FROM blogs WHERE bid = $1');
			$rtn = pg_execute($conn, "DELETE", $stmtVal);
			if (!$rtn) {
				echo pg_last_error($conn);
			}else{
				header("Refresh: 5; URL=/SSD2/blogPortal.php");
				echo "<h2>Your Blog Post Has Been Deleted From The Front Page.</h2>";
				unset($_SESSION['blogid']);
				exit();
			}
			pg_close($conn);
		}
		elseif(isset($_POST['nobtn'])){
			header("Refresh: 5; URL=/SSD2/blogPortal.php");
			echo "<h2>ABORT!</h2>";
			unset($_SESSION['blogid']);
			exit();
		}
	}else{
		header("Refresh: 5; URL=/SSD2/blogPortal.php");
		echo "<h2>You Don't Own This Blog</h2>";
		unset($_SESSION['blogid']);
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
        			<h2>Corfirmation</h2>
        			

        			<p>
        				<h3>Are You Sure You Want To Delete This Blog?</h3>
        				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="confirmform">
        					<input class="btn btn-default" name="yesbtn" type="submit" value="Yes &raquo;"/>
        					<input class="btn btn-default" name="nobtn" type="submit" value="No &raquo;"/>
        				</form>
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
