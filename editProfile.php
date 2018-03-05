<!--
takes data from user profile and alters it in the DB
uses series of IF statements
redirects back to userProfile after 10 seconds
-->

<?php
session_start();

//debugging stuff
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (empty($_SESSION)) {
	echo "<h1>sessions isnt being passed</h1>";
	exit();
}

$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdupdate password=Qwtc8*08")or die ("Connection Refused");

if(!empty($_SESSION)){//makes sure pgs cant be maniplulated
$_SESSION['uname'] = 'tjon';

if (isset($_SESSION['email'])) {//edits email
	$stmtVal =  array("$_SESSION[email]", "$_SESSION[uname]");
	//$stmtVal = array("$_SESSION[uname]", "passpass", "$_SESSION[email]", "FALSE", "FALSE");

//prepared statement & query string            
	$result = pg_prepare($conn, "UPDATE", "UPDATE users SET email = $1 WHERE uname = $2");
	//$result = pg_query_params($conn, "UPDATE users SET email = $1 WHERE uname = $2", $stmtVal);

	$rtn = pg_execute($conn, "UPDATE", $stmtVal);

//makes sure that the update executed properly
	if (!$result) {
		echo pg_last_error($conn);
	} else {
		header("Refresh: 10; URL=/SSD2/userProfile.php");
		echo "<h2> The Following Information Was Updated In The Database</h2>";
		echo "<br>";
		echo "<h3>Email: " . $_SESSION['email'] . "</h3>";
		unset($_SESSION['email']);
	}
}

elseif (isset($_SESSION['pass'])) {//edits password

	$stmtVal = array("$_SESSION[pass]", "$_SESSION[uname]");

//prepared statement & query string            
	$result = pg_prepare($conn, "UPDATE", "UPDATE users SET pass = $1 WHERE uname = $2");

	$rtn = pg_execute($conn, "UPDATE", $stmtVal);

//makes sure that the update executed properly
	if (!$rtn) {
		echo pg_last_error($conn);
	} else {
		header("Refresh: 10; URL=/SSD2/userProfile.php");
		echo "<h2> Your Password Was Updated In The Database</h2>";
		unset($_SESSION['pass']);
	} 

}else{//incase something goes wrong
	echo "<h3> Something Went Wrong...</h3>";
	echo "<p><a class='btn btn-default' href='/login.php' role'button'>Login &raquo; </a></p>";
}

}
else{
	echo "<p><h2>Error: Please login before accessing this page.</h2></p>"; 
echo "<p><a class='btn btn-default' href='/SSD2/login.php' role'button'>Login &raquo; </a></p>"; //should redirect to login page     
}

pg_close($conn);
?>
