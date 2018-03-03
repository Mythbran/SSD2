<?php
session_start();
$_SESSION['uname'];//TEST
if (!empty($_SESSION)) {//need to re do this. itll never be empty with whatever id form we use
	$blogID = $_SESSION['blogid'];
	$owner = $_SESSION['uname'];
	$stmtVal = array("$blogID");

	//makes sure user owns said blog
	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723")or die ("Connection Refused");
	$pre = pg_prepare($conn, "SELECT", "SELECT owner FROM blogs WHERE bid = $1");
	$rtn = pg_execute($conn, "SELECT", $stmtVal) or die(pg_last_error($conn));
	$ownerCheck = pg_fetch_result($rtn);

	if ($owner == $ownerCheck) {//deletes from database
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
}else{
	header("Refresh: 5; URL=/SSD2/blogPortal.php");
		echo "<h2>You Don't Own This Blog</h2>";
		unset($_SESSION['blogid']);
		exit();
}
}

?>