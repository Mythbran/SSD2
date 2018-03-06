
<?php
    if(empty($_SESSION)){
      echo "No user logged in"; 
    }

    elseif(!empty($_SESSION)){
      
      $_SESSION = array();
      session_destroy();
    else{

    }

  header("Location: index.php");

?>
