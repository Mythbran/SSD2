<!--

-->

<?php
session_start();
if(!empty($_POST)){
    if (isset($_POST['editbtn'])) {
        $_SESSION['editid'] = $_POST['editid'];
        header("Location: editBlog.php");
    }
    elseif (isset($_POST['deletebtn'])) {
        $_SESSION['deleteid'] = $_POST['deleteid'];
        header("Location: deleteBlog.php");

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
    table, td, tr{
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
                    <h2>Your Blogs</h2>
                    <p>
                        <table style="width: 100%">
                            <tr>
                                <th>Blog ID</th>
                                <th>Title</th>
                            </tr>
                            <?php
                            $conn = pg_connect("host=127.0.0.1 port=5432 dbname=ssd2 user=ssdselect password=Wier~723") 
                            or die ("connection refused");

                            $stmtVal = array("tjon");

                            $pre = pg_prepare($conn, "SELECT", 'SELECT bid, title FROM blogs WHERE owner = $1');
                            $rtn = pg_execute($conn, "SELECT", $stmtVal) or die("Database Error. Contact Your Administer");

                            while($data = pg_fetch_assoc($rtn)){
                                echo "<tr>";
                                echo "<td>$data[bid]</td>";
                                echo "<td>$data[title]</td>";
                                echo "</tr>";
                            }

                            pg_close($conn);
                            ?>

                        </table>


                    </p>
                    <h2>Blog Options</h2>

                    <p>
                       <a  href="/SSD2/createBlog.php">Create a Blog</a><br>
                   </p>

                   <p>
                       <h3>Edit a Blog</h3>
                       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="editblogform">
                        <label for="editid"> Enter a Blog ID: </label>
                        <input type="text" placeholder="Blog ID " name="editid" id="editid" value="<?php if(isset($_POST['editid'])); echo $_POST['editid']?>"/>
                        <input class="btn btn-default" name="editbtn" type="submit" value="Submit &raquo;"/>
                    </form>
                </p>

                <p>
                   <h3>Delete a Blog</h3>
                   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="deleteblogform">
                    <label for="deleteid"> Enter a Blog ID: </label>
                    <input type="text" placeholder="Blog ID " name="deleteid" id="deleteid" value="<?php if(isset($_POST['deleteid'])); echo $_POST['deleteid']?>"/>
                    <input class="btn btn-default" name="deletebtn" type="submit" value="Submit &raquo;"/>
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