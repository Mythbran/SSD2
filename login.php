<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (!isset($_SESSION['email']) && !isset($_SESSION['pass'])) {//not sure why session isnt being passed
  //$email = $_SESSION['email'];
 // $pass = $_SESSION['pass'];
$email = 'nojt@nojt.com';
$pass = 'tjontjonsdscdc';

  $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=select")or die ("Connection Refused");

                        if(!empty($_SESSION)){//not the proper way just trying to get it to work
                        	$stmtVal = array("$email","$pass");
                        	$pre = pg_prepare($conn, "SELECT", 'SELECT (uid, uname) FROM users WHERE email = $1 AND pass = $2');
                        	$rtn = pg_execute($conn, "SELECT", $stmtVal);

                        	if (!$rtn) {//records not found, redirects back
                                header("Location: userLogin.php");
                                exit();                      		
                            }else{
                               
                                echo "ypu shudnt be here";
                                $_SESSION['SESSION_ID'] = $rtn['uid'];//uses uid as the session id
                                unset($_POST['email']);
                                unset($_POST['pass']);
                                unset($email);
                                unset($pass);
                                header("Location: userProfile.php");
                                exit();
                            }
                        }
                  
                    else{
                       // echo "SOMETHING WENT WRONG FAM";
                    header("Location: userLogin.php");
                    }
}
?>
