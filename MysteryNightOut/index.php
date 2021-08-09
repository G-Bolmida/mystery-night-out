<?php
	// Initialize the session
	session_start();
?>
<!doctype html>
<html lang="en" class="h-100">
	<head>
    	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Centerville Mystery Night Out built with Bootstrap and JQuery by IT Intern George Bolmida in 2021">
        <meta name="author" content="George Bolmida">
        <!-- Page Tab Title -->
	    <title>Centerville Mystery Night Out</title>
	    <!-- Favicon -->
	    <link rel="icon" href="./asset/cityLogo.png" type="image/x-icon" alt="City of Centerville Logo"/>
		<!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<!-- Primary Custom CSS Stylesheet -->
        <link href="main.css" rel="stylesheet">
		<!-- Connection to Database -->
        <?php include 'connection.php';?>
    </head>
    <body class="d-flex flex-column h-100">
    	<header>
			<!-- Navbar Begin -->
			<nav class="navbar navbar-expand-md navbar-dark fixed-top">
			    <!-- Navbar Title -->
			    <a class="navbar-brand" href="index.php">Centerville Mystery Night Out</a>
			    <!-- Hamburger Menu (Only visible on mobile) -->
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			    </button>
			    <!-- Everything in this DIV will be collapsed by default on mobile -->
		        <div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
						    <!-- Link to Home -->
							<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
					    </li>
					    <li class="nav-item">
						    <!-- Link to Mystery -->
							<a class="nav-link" href="mystery.php">Join the Fun</a>
                        </li> 
					    <li class="nav-item">
						    <!-- Link to City of Centerville Website -->
							<a class="nav-link" href="https://www.centervilleohio.gov/" target="_blank">City of Centerville</a>
					    </li>
				    </ul>
			    </div>
		    </nav>
	    </header>
	    <!-- Begin page content -->
	    <main role="main" class="flex-shrink-0 loadAnimate">
			<div class="container">	
				<?php
                	// Pull Home Page data from DB
                    $sql = "SELECT id, title, image, text FROM homepage_data";
                    $data = mysqli_query($conn,$sql);
					while($row = $data->fetch_assoc()) {
						//Large Page Title
						echo '<h1 class="display-5 pageSpacing" style="text-align:center;">' . $row["title"] . '</h1>';
						//Page Image
						echo '<img src="' . $row["image"] . '" class="img-fluid img-thumbnail rounded border border-info pageSpacing" style="width:100%;" alt="Homepage Image">';
						//Page Text
						echo '<p class="lead">' . $row["text"] . '</p>';
					}
                    $data -> free_result();
                    $conn -> close();
				?>
				<!-- Container for Begin Button -->
                <div class="card text-center pageSpacing" style="width: auto; background-color: #c9e9f6;">
  				    <div class="card-body pageSpacing">
                        <h4>Join the fun!</h4>
                        <!-- Links to Location list page -->
                        <a class="btn btn-primary pageSpacing" href="mystery.php" role="button">&nbsp;Begin!&nbsp;</a> 
  				    </div>
			    </div>
				<div class="pageSpacing">&nbsp;</div>
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