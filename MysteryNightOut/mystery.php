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
	    <link rel="icon" href="./asset/cityLogo.png" type="image/x-icon"/>
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
					    <!-- Nav links to different pages (add .active to current page) -->
					    <li class="nav-item">
						    <!-- Link to Home -->
                            <a class="nav-link" href="index.php">Home</a>
					    </li>
					    <li class="nav-item active">
						    <!-- Link to Mystery -->
                            <a class="nav-link" href="mystery.php">Mystery<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
						    <!-- Option to clear mystery progress, triggers popup -->
                            <a class="nav-link" data-toggle="modal" data-target="#static1">Reset Mystery Progress</a>
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
                    // Detects whether first station variable has been set, if it hasn't it will set it with a random value from 1-5
                    if (!isset($_SESSION['firstStation']) || $_SESSION['firstStation'] == '') {
                        $_SESSION["firstStation"] = rand(0, 4);
                    }
                    if (!isset($_SESSION['progress']) || $_SESSION['progress'] == '') {
                        $_SESSION["progress"] = 0;
                    }
                    if (!isset($_SESSION['currentLoc']) || $_SESSION['currentLoc'] == '') {
                        $_SESSION["currentLoc"] = 0;
                    }
                ?>
                <?php 
                    // Pull Mystery data from DB
                    $sql = "SELECT id, title, text FROM mysterypage_data ORDER BY id";
                    $data = mysqli_query($conn,$sql);
                    $i = -1;
                    while($row = mysqli_fetch_array($data)) {
                        $i++;
                        $mysData[$i]['id']=$row['id'];
                        $mysData[$i]['title']=$row['title'];
				        $mysData[$i]['text']=$row['text'];    
                    }
                    $data -> free_result();
                    //Large Page Title
			        echo '<h1 class="display-5 pageSpacing" style="text-align:center;">' . $mysData[0]['title'] . '</h1>';
                    //Mystery Instructions
                    echo '<p class="lead">' . $mysData[0]['text'] . '</p>';
                ?>
			    <div class="alert alert-success alert-dismissible fade show pageSpacing" role="alert">
                    <?php
                        // Set progress bar to percentage complete based on progress session variable
                        $percentComplete = $_SESSION["progress"] * 16.666666666;
                        $locationsLeft = 6 - $_SESSION["progress"];
                        if ($locationsLeft == 1) {
                            echo '<strong>You have unlocked ' . $_SESSION["progress"] . '/6 locations, ' . $locationsLeft . ' location to go! Keep it up!</strong>';
                        } elseif ($locationsLeft == 0){
                            echo '<strong>You have unlocked all of the locations!!! Great Job!</strong>';
                        } else {
                            echo '<strong>You have unlocked ' . $_SESSION["progress"] . '/6 locations, ' . $locationsLeft . ' locations to go! Keep it up!</strong>';
                        }
				        echo '<div class="progress pageSpacing">';
  					    echo '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="' . $percentComplete . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $percentComplete . '%"></div>';
                        echo '</div>';
                    ?>
			    </div>
                <!-- Location Grid -->
                <div class="container pageSpacing">
                    <?php
                        // Pull Location data from DB
                        $sql = "SELECT title, image, text, next FROM location_data ORDER BY id";
                        $data = mysqli_query($conn,$sql);
                        $i = -1;
                        while($row = mysqli_fetch_array($data)) {
                            $i++;
                            $locData[$i]['title']=$row['title'];
                            $locData[$i]['image']=$row['image'];
                            $locData[$i]['text']=$row['text'];
                            $locData[$i]['next']=$row['next'];
                        }
                        $data -> free_result();
                        $conn -> close();
                        // Store progress and start sessions
                        $progress = $_SESSION["progress"];
                        $firstStation = $_SESSION["firstStation"];
                        // 1
                        if ($progress == 0) {
                            // ACTIVE - Waiting for code
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing" style="margin-left: auto;margin-right: auto;">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image One">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = $firstStation;
                        }
                        if ($progress >= 1) {
                            // UNLOCKED - Unlocked location
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing" style="margin-left: auto;margin-right: auto;">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[$firstStation]['image'] . '" class="card-img-top" alt="Location Image One">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $locData[$firstStation]['title'] . '</h5>';
                            echo '<p class="card-text">"' . $locData[$firstStation]['text'] . '"</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        // 2 
                        $locTwo = $locData[$firstStation]['next'];
                        if ($progress == 1) {
                            // ACTIVE - Waiting for code
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image Two">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = $locTwo;
                        } elseif ($progress > 1) {
                            // UNLOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[$locTwo]['image'] . '" class="card-img-top" alt="Location Image Two">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $locData[$locTwo]['title'] . '</h5>';
                            echo '<p class="card-text">"' . $locData[$locTwo]['text'] . '"</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // LOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/locked.png" class="card-img-top" alt="Location Image Two">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Locked Location</h5>';
                            echo '<p class="card-text">This location will become available once previous locations are unlocked.</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Locked</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        //3
                        $locThree = $locData[$locTwo]['next'];
                        if ($progress == 2) {
                            // ACTIVE - Waiting for code
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image Three">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = $locThree;
                        } elseif ($progress > 2) {
                            // UNLOCKED
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[$locThree]['image'] . '" class="card-img-top" alt="Location Image Three">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $locData[$locThree]['title'] . '</h5>';
                            echo '<p class="card-text">"' . $locData[$locThree]['text'] . '"</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // LOCKED
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/locked.png" class="card-img-top" alt="Location Image Three">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Locked Location</h5>';
                            echo '<p class="card-text">This location will become available once previous locations are unlocked.</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Locked</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        //4
                        $locFour = $locData[$locThree]['next'];
                        if ($progress == 3) {
                            // ACTIVE
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image Four">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = $locFour;
                        }
                        elseif ($progress > 3) {
                            // UNLOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[$locFour]['image'] . '" class="card-img-top" alt="Location Image Four">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $locData[$locFour]['title'] . '</h5>';
                            echo '<p class="card-text">"' . $locData[$locFour]['text'] . '"</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // LOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/locked.png" class="card-img-top" alt="Location Image Four">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Locked Location</h5>';
                            echo '<p class="card-text">This location will become available once previous locations are unlocked.</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Locked</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        //5
                        $locFive = $locData[$locFour]['next'];
                        if ($progress == 4) {
                            // ACTIVE
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image Five">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = $locFive;
                        }
                        elseif ($progress > 4) {
                            // UNLOCKED
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[$locFive]['image'] . '" class="card-img-top" alt="Location Image Five">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $locData[$locFive]['title'] . '</h5>';
                            echo '<p class="card-text">' . $locData[$locFive]['text'] . '</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // LOCKED
                            echo '<div class="col-sm-6 pageSpacing">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/locked.png" class="card-img-top" alt="Location Image Five">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Locked Location</h5>';
                            echo '<p class="card-text">This location will become available once previous locations are unlocked.</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Locked</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        //6
                        if ($progress == 5) {
                            // ACTIVE
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing" style="margin-left: auto;margin-right: auto;">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/active.png" class="card-img-top" alt="Location Image Six">';
                            echo '<div class="card-body">';
                            echo'<h5 class="card-title">Active Location</h5>';
                            echo '<p class="card-text">View the clue for this location and take a guess!</p>';
                            echo '<a class="btn btn-primary" href="location.php" role="button">View Clue</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $_SESSION["currentLoc"] = 5;
                        }
                        elseif ($progress > 5) {
                            // UNLOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing" style="margin-left: auto;margin-right: auto;">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="' . $locData[5]['image'] . '" class="card-img-top" alt="Location Image Six">';
                            echo '<div class="card-body">';
                            echo'<h5 class="card-title">' . $locData[5]['title'] . '</h5>';
                            echo '<p class="card-text">' . $locData[5]['text'] . '</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Completed</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // LOCKED
                            echo '<div class="row">';
                            echo '<div class="col-sm-6 pageSpacing" style="margin-left: auto;margin-right: auto;">';
                            echo '<div class="card" style="width: auto; height: 100%;">';
                            echo '<img src="./asset/locked.png" class="card-img-top" alt="Location Image Six">';
                            echo '<div class="card-body">';
                            echo'<h5 class="card-title">Locked Location</h5>';
                            echo '<p class="card-text">This location will become available once previous locations are unlocked.</p>';
                            echo '<a class="btn btn-primary disabled" href="location.php" role="button">Locked</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    <!-- Popup to confirm clearing of progress -->
			        <div class="modal fade" id="static1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  				        <div class="modal-dialog modal-dialog-centered">
    				        <div class="modal-content">
      					        <div class="modal-header">
        					        <h5 class="modal-title" id="staticBackdropLabel"><strong>Warning! Warning! Warning!</strong></h5>
        					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          						        <span aria-hidden="true">&times;</span>
        					        </button>
      					        </div>
      					        <div class="modal-body">If you proceed in this action you will <strong style="color:red;">LOSE ALL PROGRESS</strong> within the event!!! Only proceed if you know what you're doing!</div>
      					        <div class="modal-footer">
        					        <button type="button" class="btn btn-success" data-dismiss="modal">CANCEL</button>
        					        <button type="button" class="btn btn-danger" data-toggle="modal" data-dismiss="modal" data-target="#static2">PROCEED</button>
      					        </div>
    				        </div>
  				        </div>
                    </div>
                    <!-- Second confirmation popup -->
                    <div class="modal fade" id="static2" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  				        <div class="modal-dialog modal-dialog-centered">
    				        <div class="modal-content">
      					        <div class="modal-header">
        					        <h5 class="modal-title" id="staticBackdropLabel"><strong>Warning! Warning! Warning!</strong></h5>
        					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          						        <span aria-hidden="true">&times;</span>
        					        </button>
      					        </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <label for="confirmClearInput">Confirm action by entering the word "confirm":</label>
								            <input type="text" class="form-control center-block pageSpacing" style="width: 100%" id="confirmInput" maxlength="8" pattern="[A-Za-z0-9]+" placeholder="confirm" required>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
        					        <button type="button" class="btn btn-success" data-dismiss="modal">CANCEL</button>
                                    <button type="button" class="btn btn-danger btn-med" onclick="confirmClear()">SUBMIT</button>
                                    <!-- Javascript to redirect to reset page on submit -->
                                    <script type="text/javascript">
                                        function confirmClear() {
                                            if (document.getElementById('confirmInput').value == "confirm") {
                                                window.location = "reset.php";
                                            } else {
                                                window.alert('Error, you did not enter "confirm" correctly');
                                            }
                                        }
                                    </script>
      					        </div>
    				        </div>
  				        </div>
			        </div>
                    <div class="pageSpacing">&nbsp;</div>
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
		            <img src="./asset/question.png" class="img-fluid" tabindex="-2" style="width:65px; height:65px; position:fixed; bottom:10px; right:10px; opacity:0.5; outline: none;" data-toggle="modal" data-target="#scavengerHelp" alt="Help Bubble">
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