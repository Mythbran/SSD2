<?php
#adds users to the db
#general connection(not sure if works)
$db = resource pg_connect ("host=localhost port=5432 dbname=ssd user=user password=user");

#insert query
$insertQuery = ("INSERT INTO userTable VALUES '$_POST[name]', '$_POST[email]', '$_POST[address]', '$_POST[pNumber]', '$_POST[bio]' ");

#executes
$result = pg_query($insertQuery); 

if(!result){
echo "INSERT FAILED!!!";
}
else
echo "INSERT SUCCESSFUL!!!";
?>



<?php
#lists the users in the db
#general connection
$db = resource pg_connect ("host=localhost port=5432 dbname=ssd user=user password=user");

#insert query
$insertQuery = ("INSERT INTO userTable VALUES '$_POST[name]', '$_POST[email]', '$_POST[address]', '$_POST[pNumber]', '$_POST[bio]' ");

#executes
$result = pg_query($db, "SELECT * FROM userTable"); 
$row = pg_fetch_assoc($result);

#lists the results in a table

?>

<?php
#have to use PDO 
try{
$dbuser = 'postgres';
$dbpass = 'abc123';
$host = 'localhost';
$dbname = 'postgres';
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
}catch(PDOException $e){
echo "ERROR : " . $e->getMessage() . "<br>";
die();
}
$query = "SELECT * FROM userTable";
foreach ($conn->query($query) as $row){#lists within a table
print $row['name'] . " ";
print $row['email'] . " ";
print $row['address'] . " ";
print $row['pNumber'] . "-->";
print $row['bio'] . "<br>";

}


?>
