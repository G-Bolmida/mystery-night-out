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
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<!-- Everything in this DIV will be collapsed by default on mobile -->
		    	<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
						<!-- Nav links to different pages -->
						<li class="nav-item">
							<!-- Link to Home Page -->
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="nav-item active">
							<!-- Link to Mystery Page -->
							<a class="nav-link" href="mystery.php">Mystery<span class="sr-only">(current)</span></a>
                    	</li>
						<li class="nav-item">
							<!-- Links to City of Centerville Website -->
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
              		// Pull Location data from DB
              		$sql = "SELECT title, clueimage, clue, code FROM location_data ORDER BY id";
              		$data = mysqli_query($conn,$sql);
              		$i = -1;
              		while($row = mysqli_fetch_array($data)) {
                  		$i++;
                  		$locData[$i]['title']=$row['title'];
                  		$locData[$i]['clueimage']=$row['clueimage'];
				  		$locData[$i]['clue']=$row['clue'];
				  		$locData[$i]['code']=$row['code'];
              		}
              		$data -> free_result();
              		$conn -> close();
					// Location Title
					$stationTitle = $_SESSION["progress"] + 1;
			    	echo '<h1 class="display-5 pageSpacing" style="text-align:center;">Station ' . $stationTitle . '</h1>';
                	// Location Image Clue
			    	echo '<img src="' . $locData[$_SESSION["currentLoc"]]['clueimage'] . '" class="img-fluid img-thumbnail rounded border border-info pageSpacing" style="width:100%;" alt="Centerville Location Image">';
                	// Location Clue
			    	echo '<p class="lead">' . $locData[$_SESSION["currentLoc"]]['clue'] . '</p>';
				?>
			  	<!-- Begin Password Box -->
                <div class="card pageSpacing">
                	<h5 class="card-header">Unlock Next Location</h5>
                    <div class="card-body">
                    	<div class="container">
                        	<div class="row">
                            	<div class="col-sm-2"></div>
                            	<div class="col-sm-8">
						    		<form method="POST" id="codeSubmit">
										<div class="form-group">
								        	<!-- Input location password -->
											<input type="text" class="form-control center-block pageSpacing" style="width: 100%" name="inputCode" pattern="[A-Za-z0-9]+" maxlength="29" placeholder="Location Code" required>
											<a class="btn btn-primary" href="mystery.php" role="button">Back</a>
                                        	<input class="btn btn-primary pageSpacing" type="submit" value="Submit">
											<?php
												$locCode = $locData[$_SESSION["currentLoc"]]['code'];
												$progress = $_SESSION["progress"];			
												// Determine whether location code is correct 
												if (isset($_POST['inputCode']) && $_POST['inputCode'] == $locCode) {
													if($progress == 5) {
														// SUCCESS set progress up one and go back to congratulations.php			
														$_SESSION["progress"] = $progress + 1;
														echo '<script type="text/javascript">window.location = "congratulations.php";</script>';
													} else {
														// SUCCESS set progress up one and go back to mystery.php
														$_SESSION["progress"] = $progress + 1;
														echo '<script type="text/javascript">window.location = "mystery.php";</script>';
													}
												} elseif (isset($_POST['inputCode']) && $_POST['inputCode'] != $locCode) {
													// On password fail show alert box
													echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
													echo 'Sorry, incorrect code.';
  													echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    												echo '<span aria-hidden="true">&times;</span>';
													echo '</button>';
													echo '</div>';
												}
			  								?>
										</div>
									</form>
                            	</div>
                        		<div class="col-sm-2"></div>
                            </div>
                        </div>
  				    </div>
				</div>
				<div class="pageSpacing">&nbsp;</div>  
            </div>
			<!-- Popup to show scavenger help -->
			<div class="modal fade" id="scavengerHelp" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  				<div class="modal-dialog modal-dialog-centered">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h5 class="modal-title" id="staticBackdropLabel"><strong>Help</strong></h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          						<span aria-hidden="true">&times;</span>
        					</button>
						</div>
						<!-- Scavenger help text -->
						<div class="modal-body">To begin the scavenger hunt, tap on the next available location. When in the location you will be presented with a puzzle, the answers of the puzzles are locations you can drive to. If you solved the puzzle correctly and drove to the right location, there will be signs posted where you must count the sheep.  REMEMBER THESE NUMBERS! If you need any additional help, feel free to call our helpline at <a href="tel:9374284791">(937)428-4791</a>, <a href="tel:9374284792">(937)428-4792</a>, <a href="tel:9374284793">(937)428-4793</a>, <a href="tel:9374284794">(937)428-4794</a></div>
						<div class="modal-footer">
        					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
    				</div>
  				</div>
            </div>	
			<img src="./asset/question.png" class="img-fluid" tabindex="-2" style="width:65px; height:65px; position:fixed; bottom:10px; right:10px; opacity:0.5; outline: none;" data-toggle="modal" data-target="#scavengerHelp" alt="Homepage Image">
			<!-- End page contents -->
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