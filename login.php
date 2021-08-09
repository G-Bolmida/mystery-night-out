<?php
// Initialize the session
session_start();
?>
<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Centerville Mystery Night Out built with Bootstrap, confetti.js, and JQuery by IT Intern George Bolmida in 2021">
        <meta name="author" content="George Bolmida">
        <!-- Page Tab Title -->
	    <title>Centerville Mystery Night Out</title>
	    <!-- Favicon -->
	    <link rel="icon" href="./asset/cityLogo.png" type="image/x-icon" alt="City of Centerville Logo"/>
        <!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	    <!-- Primary Custom CSS Stylesheet -->
        <link href="main.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column h-100">
        <header>
		    <!-- Navbar Begin -->
		    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
		        <!-- Navbar Title -->
		        <a class="navbar-brand" href="admin.php">Centerville Mystery Night Out</a>
		    </nav>
	    </header>
	    <!-- Begin page content -->
	    <main role="main" class="flex-shrink-0 loadAnimate">
		    <div class="container">
                <!-- Log-In Card Information -->
                <div class="card" style="margin-top: 30%; margin-bottom: 30%;">
                    <h5 class="card-header">Log In</h5>
                    <div class="card-body">    
                        <?php
                            // Check if already logged in, if logged in pass to admin page
                            if($_SESSION["admin"] == "CHANGEME") {
                                echo '<script type="text/javascript">window.location = "admin.php";</script>';
                            } else {
                                echo '<form method="post" class="form-inline">';
                                echo '<div class="form-group">';
                                echo '<label for="inputPassword">Password:</label>';
                                echo '<input type="password" name="pass" placeholder="************" class="form-control mx-sm-3">';
                                echo '<input class="btn btn-md btn-primary pageSpacing" type="submit" name="checkPass" value="Submit">';
                                echo '</div>';
                                echo '</form>';
                                if($_POST['pass']) {
                                    // If submitted password is correct pass to admin
                                    if($_POST['pass'] == "CHANGEME") {
                                        $_SESSION['admin'] = 'CHANGEME';
                                        echo '<script type="text/javascript">window.location = "admin.php";</script>';
                                    } else {
                                        // On wrong password trigger alert
                                        echo '<div class="alert alert-danger alert-dismissible fade show pageSpacing" role="alert">';
                                        echo 'Sorry, incorrect password.';
                                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                        echo '<span aria-hidden="true">&times;</span>';
                                        echo '</button>';
                                        echo '</div>';
                                    } 
                                }
                            }    
                        ?>
                    </div>
                </div>
                <!-- End page contents -->
		    </div>
	    </main>
	    <!-- Page footer -->
	    <footer class="footer mt-auto py-3">
		    <div class="container" style="text-align:center;">
                <!-- City Logo -->
                <img src="./asset/cityLogo.png" class="img-fluid" style="height:35px;" alt="City of Centerville Logo">
                <!-- City of Centerville links back to city website -->
                <a class="text-muted" href="https://www.centervilleohio.gov/" target="_blank">City of Centerville</a> - Created by George Bolmida - 2021
		    </div>
	    </footer>
    </body>
    <!-- JQuery Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Bootstrap JS Script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</html>