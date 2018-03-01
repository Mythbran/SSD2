<!--
takes data from user profile and alters it in the DB
uses series of IF statements
-->

<?php
session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (!isset($_SESSION)) {
	echo "<h1>sessions isnt being passed</h1>";
	exit();
}
$_SESSION['uname'] = 'tjon';

 					//debugging stuff



$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdinsert password=insert")or die ("Connection Refused");

        			if (!$conn) {//makes sure connection was successful
        				echo pg_last_error($conn);

        			} elseif(!empty($_SESSION)){//makes sure pgs cant be maniplulated

        				if(isset($_SESSION['pic'])){//edits user pic

        					$stmtVal = array("$_SESSION[pic]");

           				 	//prepared statement & query string            
        					$result = pg_prepare($conn, "INSERT", 'INSERT INTO pics pic VALUES $1');

        					$rtn = pg_execute($conn, "INSERT", $stmtVal);

            				//makes sure that the insert executed properly
        					if (!$rtn) {
        						echo pg_last_error($conn);
        					} else {
        						echo "<h2> The Following Information Was Added To The Database</h2>";
        						echo "<br>";

        						echo "<h3>Profile pic is below </h3>";

        						echo "<br><br>";

                                //echo "<img src="$_SESSION[pic]">";

        					}

        				} 

        					elseif (isset($_SESSION['email'])) {//edits email
        						$stmtVal = array("$_SESSION[email]", "$_SESSION[uname]");

           				 	//prepared statement & query string            
        						$result = pg_prepare($conn, "UPDATE", 'UPDATE users SET email = $1 WHERE uname = $2');

        						$rtn = pg_execute($conn, "UPDATE", $stmtVal);

            				//makes sure that the insert executed properly
        						if (!$rtn) {
        							echo pg_last_error($conn);
        						} else {
        							
        							echo "<h2> The Following Information Was Updated In The Database</h2>";
        							echo "<br>";

        							echo "<h3>Email: " . $_SESSION['email'] . "</h3>";

        							echo "<br><br>";

        						}
        					}

        					elseif (isset($_SESSION['pass'])) {//edits password
        						$stmtVal = array("$_SESSION[pass]", "$_SESSION[uname]");

           				 	//prepared statement & query string            
        						$result = pg_prepare($conn, "UPDATE", 'UPDATE users SET pass = $1 WHERE uname = $2');

        						$rtn = pg_execute($conn, "UPDATE", $stmtVal);

            				//makes sure that the insert executed properly
        						if (!$rtn) {
        							echo pg_last_error($conn);
        						} else {
        							
        							echo "<h2> The Following Information Was Updated In The Database</h2>";
        							echo "<br>";

        							echo "<h3>Email: " . $_SESSION['pass'] . "</h3>";
        						} 


            }else{//incase something goes wrong
            	echo "<h3> Something Went Wrong...</h3>";
            	echo "<p><a class='btn btn-default' href='/login.php' role'button'>Login &raquo; </a></p>";
            }

            //releases session data #SECUREAF
            unset($_SESSION['pic']);
            unset($_SESSION['email']);
            unset($_SESSION['pass']);
        }
        else{
        	echo "<p><h2>Error: Please login before accessing this page.</h2></p>"; 
        	echo "<p><a class='btn btn-default' href='/login.php' role'button'>Login &raquo; </a></p>"; //should redirect to login page     
        }

        pg_close($conn);
        ?>
