<?php
session_start();
if (!empty($_SESSION)) {//need to re do this. itll never be empty with whatever id form we use
	$owner = $_SESSION['uname'];
	$title = $_SESSION['btitle'];
	$data = $_SESSION['bdata'];

	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdinsert password=Jxem877&")or die ("Connection Refused");

	$stmtVal = array("$owner", "$title", "$data");
	$result = pg_prepare($conn, "INSERT", 'INSERT INTO blogs (owner, title, data) VALUES ($1, $2, $3)');
	$rtn = pg_execute($conn, "INSERT", $stmtVal);

	if (!$rtn) {
		echo pg_last_error($conn);
	}else{

		header("Refresh: 10; URL=/SSD2/blogPortal.php");
		echo "<h2>Your Blog Post Can now be seen from the front page.</h2>";
		unset($_SESSION['btitle']);
		unset($_SESSION['bdata']);
		exit();

	}
	pg_close($conn);
}else{
	echo "no sessions";
}

?>