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
            table, tr, td{
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
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
<table>
	<?php
		session_start();
		$temp = $_SESSION['uname'];
        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd1 user=ssdinsert password=Jxem877&")or die ("Connection Refused");

        //makes sure connection was successful
        if (!$conn) {	
            echo pg_last_error($conn);
			
        } elseif(!empty($_SESSION)){

            $stmtVal = array("$_SESSION[uname]", "$_SESSION[email]", "$_SESSION[sname]", "$_SESSION[snum]", "$_SESSION[city]", "$_SESSION[province]", "$_SESSION[pcode]", "$_SESSION[pnum]", "$_SESSION[bio]");
            //prepared statement & query string
            
            
            $result = pg_prepare($conn, "INSERT", 'INSERT INTO users (uname, email, sname, snum, city, province, pcode, pnum, bio) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)');



            $rtn = pg_execute($conn, "INSERT", $stmtVal);

            //makes sure that the insert executed properly
            if (!$rtn) {
                echo pg_last_error($conn);
            } else {
		echo "<h2> The Following Information Was Added To The Database</h2>";
		echo "<br>";
		echo"<tr>";
		echo "<th><h4> username </h4></th>";
		echo "<th><h4> email </h4></th>";
		echo "<th><h4> house number </h4></th>";
		echo "<th><h4> Street Name </h4></th>";
		echo "<th><h4> City </h4></th>";
		echo "<th><h4> Province </h4></th>";
		echo "<th><h4> Postal Code </h4></th>";
		echo "<th><h4> Phone Number </h4></th>";
		echo "<th><h4> Bio </h4></th>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td><h5> $_SESSION[uname]</h5></td>";
		echo "<td><h5> $_SESSION[email]</h5></td>";
		echo "<td><h5> $_SESSION[snum]</h5></td>";
		echo "<td><h5> $_SESSION[sname]</h5></td>";
		echo "<td><h5> $_SESSION[city]</h5></td>";
		echo "<td><h5> $_SESSION[province]</h5></td>";
		echo "<td><h5> $_SESSION[pcode]</h5></td>";
		echo "<td><h5> $_SESSION[pnum]</h5></td>";
		echo "<td><h5> $_SESSION[bio]</h5></td>";
		echo "</tr>";
		
		
		
            }//end of else

			unset($_SESSION['uname']);
			unset($_SESSION['email']);
			unset($_SESSION['snum']);
			unset($_SESSION['sname']);
			unset($_SESSION['city']);
			unset($_SESSION['province']);
			unset($_SESSION['pnum']);
			unset($_SESSION['bio']);
			unset($_SESSION['pcode']);
            pg_close($conn);
        }
        else{
        	echo "<p><h2>Error: Please enter information before accessing this page.</h2></p>"; 
        	echo "<p><a class='btn btn-default' href='/SSD1/newuser.php' role'button'> New User &raquo; </a></p>";   	
        }
        ?>
        </table>

      <p><a class="btn btn-default" href="/SSD1" role="button">Home &raquo;</a></p>
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
