<?php
// Initialize the session
session_start();
// Check if logged in as admin, if not redirect to login page
echo '<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Centerville Mystery Night Out built with Bootstrap, confetti.js, and JQuery by IT Intern George Bolmida in 2021">
    <meta name="author" content="George Bolmida">';
	
if ($_SESSION["admin"] == "CHANGEME") {

echo '<!-- Page Tab Title -->
	  <title>Centerville Mystery ADMIN</title>
	  <!-- Favicon -->
	  <link rel="icon" href="./asset/cityLogo.png" type="image/x-icon" alt="City of Centerville Logo"/>
    <!-- Bootstrap core CSS -->
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	  <!-- Primary Custom CSS Stylesheet -->
    <link href="main.css" rel="stylesheet">';
    //Connection to Database
    include 'connection.php';
  echo '</head>  
  <body class="d-flex flex-column h-100">
    <header>
		  <!-- Navbar Begin -->
		  <nav class="navbar navbar-expand-md navbar-dark fixed-top">
			  <!-- Navbar Title -->
			  <a class="navbar-brand" href="admin.php">Centerville Mystery Night Out</a>
        <!-- Hamburger Menu (Only visible on mobile) -->
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <!-- Everything in this DIV will be collapsed by default on mobile -->
		    <div class="collapse navbar-collapse" id="navbarCollapse">
				  <ul class="navbar-nav mr-auto">    
					  <li class="nav-item">
						  <!-- Links to reset page, triggers log out -->
              <a class="nav-link" href="reset.php">Log Out</a>
					  </li>
				  </ul>
			  </div>
		  </nav>
	  </header>
	  <!-- Begin page content -->
	  <main role="main" class="flex-shrink-0 loadAnimate">
		  <div class="container">'; 
          // Pull Location data from DB
          $sql = "SELECT id, title, image, clueimage, text, clue, code FROM location_data ORDER BY id";
          $data = mysqli_query($conn,$sql);
          $i = -1;
          while($row = mysqli_fetch_array($data)) {
            $i++;
            $locData[$i]['id']=$row['id'];
            $locData[$i]['title']=$row['title'];
            $locData[$i]['image']=$row['image'];
            $locData[$i]['clueimage']=$row['clueimage'];
			$locData[$i]['text']=$row['text']; 
			$locData[$i]['clue']=$row['clue'];
			$locData[$i]['code']=$row['code'];
          }
          $data -> free_result();
          // Pull HomePage data from DB
          $sql = "SELECT id, title, image, text FROM homepage_data ORDER BY id";
          $data = mysqli_query($conn,$sql);
          $i = -1;
          while($row = mysqli_fetch_array($data)) {
            $i++;
            $homeData[$i]['id']=$row['id'];
            $homeData[$i]['title']=$row['title'];
            $homeData[$i]['image']=$row['image'];
				    $homeData[$i]['text']=$row['text'];       
          }
            $data -> free_result();
          // Pull Mystery Page data from DB
          $sql = "SELECT id, title, text FROM mysterypage_data ORDER BY id";
          $data = mysqli_query($conn,$sql);
          $i = -1;
          while($row = mysqli_fetch_array($data)) {
            $i++;
            $mysteryData[$i]['id']=$row['id'];
            $mysteryData[$i]['title']=$row['title'];
				    $mysteryData[$i]['text']=$row['text'];       
          }
          $data -> free_result();
          // Pull Congratulations data from DB
          $sql = "SELECT id, title, image, text FROM congrats_data ORDER BY id";
          $data = mysqli_query($conn,$sql);
          $i = -1;
          while($row = mysqli_fetch_array($data)) {
            $i++;
            $congratsData[$i]['id']=$row['id'];
            $congratsData[$i]['title']=$row['title'];
            $congratsData[$i]['image']=$row['image'];
				    $congratsData[$i]['text']=$row['text'];      
          }
          $data -> free_result();
        //Large Page Title
		  echo '<h1 class="display-5 pageSpacing" style="text-align:center;">Administration Console</h1>';  
          // Main Page edit Card
          echo '<div class="card pageSpacing" style="height:auto;">';
          echo '<img src="' . $homeData[0]['image'] . '" class="card-img-top" alt="MysteryPage Image">';
          echo '<div class="card-body">';              
          echo '<ul class="list-group list-group-flush">';
          echo '<li class="list-group-item">';
          echo '<h5 class="card-title">Main Page Content:</strong></h5>';
          echo '</li>';            
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Title: ' . $homeData[0]['title'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Text: ' . $homeData[0]['text'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHome">Edit Main Page Content</button>';
          echo '</li>';              
          echo '</ul>';
          echo '</div>';
          echo '</div>';
          // Main page PopUp Content
          echo '<div class="modal fade" id="editHome" tabindex="-1">';
          echo '<div class="modal-dialog modal-dialog-scrollable">';
          echo '<div class="modal-content">';
          echo '<div class="modal-header">';
          echo '<h5 class="modal-title" id="exampleModalLabel">Modifying data of: Main Page Data</h5>';
          echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
          echo '<span aria-hidden="true">&times;</span>';
          echo '</button>';
          echo '</div>';
          echo '<div class="modal-body">';
          // PopUp Main Content
          echo '<ul class="list-group">';
          echo '<li class="list-group-item">';     
          // New data form
          echo '<form method="POST">';
					echo '<div class="form-group">';
          // Main page title
          echo '<p>Current Title:</p>';
          echo '<h1 class="display-5">' . $homeData[0]['title'] . '</h1>';
          // Input for new title
          echo '<label>Put new page title here.</label>';
          echo '<input type="text" class="form-control" name="newHomeTitle" placeholder="New Title" value="' . $homeData[0]['title'] . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="249" required>';      
          echo '</li>';
          echo '<li class="list-group-item">';      
          // Main page image
          echo '<p>Current Image:</p>';
          echo '<img src="' . $homeData[0]['image'] . '" class="img-fluid img-thumbnail" alt="Current Main Image">';
          // Input for new image file
          echo '<label>Put new image filename here.</label>';
          // Format Image path for DB
          $imageFormat = substr($homeData[0]['image'], 25);
          echo '<input type="text" class="form-control" name="newHomeImage" placeholder="New Image Filename" pattern="[A-Za-z0-9\s,.?!&;#]+" value="' . $imageFormat . '" maxlength="199" required>';
          echo '<label><strong style="color:red;">WARNING:</strong> Make sure you leave the filepath out of this input, only enter the filename with extension. File names should really only contain alphanumerics and one period for the file extension. Place new images within the asset folder, or images wont load properly.</label>';  
          echo '</li>';
          echo '<li class="list-group-item">';                     
          // Main page text
          echo '<p>Current Text:</p>';
          echo '<p>' . $homeData[0]['text'] . '</p>';
          // Input for new text
          echo '<label><b>Put new page text here, use HTML entities for any non alphanumeric or non punctuation characters. See this page for reference <a href="https://dev.w3.org/html5/html-author/charref" target="_blank">HTML Entities</a></b></label>';
          echo '<textarea class="form-control" placeholder="New Text" rows="24" name="newHomeText" pattern="[A-Za-z0-9\s,.?!]+" maxlength="4000" required>' . $homeData[0]['text'] . '</textarea>';            
          echo '</li>';
          echo '</ul>';
          //End PopUp Content
          echo '</div>';
          echo '<div class="modal-footer">';
          echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'; 
          echo '<input class="btn btn-primary" type="submit" value="Save Changes">';
          // Post new Main page data to DB
					if (isset($_POST['newHomeTitle']) && isset($_POST['newHomeImage']) && isset($_POST['newHomeText'])) {
            $newTitle = $_POST['newHomeTitle'];
            $newImage = "./asset/" . $_POST['newHomeImage'];
            $newText = $_POST['newHomeText'];
            $sql = 'UPDATE homepage_data SET title = "' . $newTitle . '", image = "' . $newImage . '", text = "' . $newText . '" WHERE id = 1';
            if (mysqli_query($conn, $sql)) {
              echo '<script>alert("Page Update Successful");</script>';
              echo '<script type="text/javascript">window.location = "admin.php";</script>';
            } else {
              echo '<script>alert("Sorry, Page Submission Failed");</script>';
            }
          }
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          // End Main Page editing
          echo '<div class="pageSpacing">&nbsp;</div>';
          // Mystery Page Data
          echo '<div class="card pageSpacing" style="height:auto;">';
          echo '<div class="card-body">';              
          echo '<ul class="list-group list-group-flush">';
          echo '<li class="list-group-item">';
          echo '<h5 class="card-title">Mystery Page Content:</strong></h5>';
          echo '</li>';            
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Title: ' . $mysteryData[0]['title'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Text: ' . $mysteryData[0]['text'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMystery">Edit Mystery Page Content</button>';
          echo '</li>';              
          echo '</ul>';
          echo '</div>';
          echo '</div>';
          // Mystery page edit PopUp Content
          echo '<div class="modal fade" id="editMystery" tabindex="-1">';
          echo '<div class="modal-dialog modal-dialog-scrollable">';
          echo '<div class="modal-content">';
          echo '<div class="modal-header">';
          echo '<h5 class="modal-title" id="exampleModalLabel">Modifying data of: Mystery Page Data</h5>';
          echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
          echo '<span aria-hidden="true">&times;</span>';
          echo '</button>';
          echo '</div>';
          echo '<div class="modal-body">';
          // PopUp Content
          echo '<ul class="list-group">';
          echo '<li class="list-group-item">';     
          // Form for new Mystery Data
          echo '<form method="POST">';
          echo '<div class="form-group">';
          // Mystery Page title
          echo '<p>Current Title:</p>';
          echo '<h1 class="display-5">' . $mysteryData[0]['title'] . '</h1>';
          // Input for new title
          echo '<label>Put new page title here.</label>';
          echo '<input type="text" class="form-control" name="newMysteryTitle" placeholder="New Title" value="' . $mysteryData[0]['title'] . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="249" required>';      
          echo '</li>';
          echo '<li class="list-group-item">';                           
          // Mystery page Text
          echo '<p>Current Text:</p>';
          echo '<p>' . $mysteryData[0]['text'] . '</p>';
          // Input for new text
          echo '<label><b>Put new page text here, use HTML entities for any non alphanumeric or non punctuation characters. See this page for reference <a href="https://dev.w3.org/html5/html-author/charref" target="_blank">HTML Entities</a></b></label>';
          echo '<textarea class="form-control" placeholder="New Text" rows="24" name="newMysteryText" pattern="[A-Za-z0-9\s,.?!]+" maxlength="4000" required>' . $mysteryData[0]['text'] . '</textarea>';            
          echo '</li>';
          echo '</ul>';
          // End PopUp Content
          echo '</div>';
          echo '<div class="modal-footer">';
          echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
          echo '<input class="btn btn-primary" type="submit" value="Save Changes">';
          // Post new Mystery page data to DB      
          if (isset($_POST['newMysteryTitle']) && isset($_POST['newMysteryText'])) {                   
            $newTitle = $_POST['newMysteryTitle'];
            $newText = $_POST['newMysteryText'];
            $sql = 'UPDATE mysterypage_data SET title = "' . $newTitle . '", text = "' . $newText . '" WHERE id = 1';
            if (mysqli_query($conn, $sql)) {
              echo '<script>alert("Page Update Successful");</script>';
              echo '<script type="text/javascript">window.location = "admin.php";</script>';
            } else {
              echo '<script>alert("Sorry, Page Submission Failed");</script>';
            }
          }
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          // End Mystery page edit
          echo '<div class="pageSpacing">&nbsp;</div>';
          // Congrats Page Data
          echo '<div class="card pageSpacing" style="height:auto;">';
          echo '<img src="' . $congratsData[0]['image'] . '" class="card-img-top" alt="...">';
          echo '<div class="card-body">';              
          echo '<ul class="list-group list-group-flush">';
          echo '<li class="list-group-item">';
          echo '<h5 class="card-title">Congratulations Page Content:</strong></h5>';
          echo '</li>';            
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Title: ' . $congratsData[0]['title'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<p class="card-text">Location Text: ' . $congratsData[0]['text'] . '</p>';
          echo '</li>';
          echo '<li class="list-group-item">';
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCongrats">Edit Congratulations Page Content</button>';
          echo '</li>';              
          echo '</ul>';
          echo '</div>';
          echo '</div>';
          // Congrats page edit PopUp
          echo '<div class="modal fade" id="editCongrats" tabindex="-1">';
          echo '<div class="modal-dialog modal-dialog-scrollable">';
          echo '<div class="modal-content">';
          echo '<div class="modal-header">';
          echo '<h5 class="modal-title" id="exampleModalLabel">Modifying data of: Congratulations Page</h5>';
          echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
          echo '<span aria-hidden="true">&times;</span>';
          echo '</button>';
          echo '</div>';
          echo '<div class="modal-body">';
          // PopUp Content
          echo '<ul class="list-group">';
          echo '<li class="list-group-item">';     
          echo '<form method="POST">';
          echo '<div class="form-group">';
          // Congrats Page title
          echo '<p>Current Title:</p>';
          echo '<h1 class="display-5">' . $congratsData[0]['title'] . '</h1>';
          // Input for new title
          echo '<label>Put new page title here.</label>';
          echo '<input type="text" class="form-control" name="newCongratsTitle" placeholder="New Title" value="' . $congratsData[0]['title'] . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="249" required>';      
          echo '</li>';
          echo '<li class="list-group-item">'; 
          // Congrats page image
          echo '<p>Current Image:</p>';
          echo '<img src="' . $congratsData[0]['image'] . '" class="img-fluid img-thumbnail" alt="Current Congrats Image">';
          // Input for new image file
          echo '<label>Put new image filename here.</label>';
          // Re-format image filepath for DB
          $imageFormat = substr($congratsData[0]['image'], 25);
          echo '<input type="text" class="form-control" name="newCongratsImage" placeholder="New Image Filename" value="' . $imageFormat . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="199" required>';
          echo '<label><strong style="color:red;">WARNING:</strong> Make sure you leave the filepath out of this input, only enter the filename with extension. File names should really only contain alphanumerics and one period for the file extension. Place new images within the asset folder, or images wont load properly.</label>';  
          echo '</li>';
          echo '<li class="list-group-item">';                     
          // Congrats page text
          echo '<p>Current Text:</p>';
          echo '<p>' . $congratsData[0]['text'] . '</p>';
          // Input for new text
          echo '<label><b>Put new page text here, use HTML entities for any non alphanumeric or non punctuation characters. See this page for reference <a href="https://dev.w3.org/html5/html-author/charref" target="_blank">HTML Entities</a></b></label>';
          echo '<textarea class="form-control" placeholder="New Text" name="newCongratsText" pattern="[A-Za-z0-9\s,.?!]+" rows="24" maxlength="4000" required>' . $congratsData[0]['text'] . '</textarea>';            
          echo '</li>';
          echo '</ul>';
          //End PopUp Content
          echo '</div>';
          echo '<div class="modal-footer">';
          echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
          echo '<input class="btn btn-primary" type="submit" value="Save Changes">';
          // Post new Congrats page data to DB    
          if (isset($_POST['newCongratsTitle']) && isset($_POST['newCongratsImage']) && isset($_POST['newCongratsText'])) {
            $newTitle = $_POST['newCongratsTitle'];
            $newImage = "./asset/" . $_POST['newCongratsImage'];
            $newText = $_POST['newCongratsText'];
            $sql = 'UPDATE congrats_data SET title = "' . $newTitle . '", image = "' . $newImage . '", text = "' . $newText . '" WHERE id = 1';
            if (mysqli_query($conn, $sql)) {
              echo '<script>alert("Page Update Successful");</script>';
              echo '<script type="text/javascript">window.location = "admin.php";</script>';
            } else {
              echo '<script>alert("Sorry, Page Submission Failed");</script>';
            }    
          }
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          // End Congrats page edit
          echo '<div class="pageSpacing">&nbsp;</div>';
          // Create edit cards for all locations with array
          echo '<div class="row row-cols-1 row-cols-md-2">';
          for ($x = 0; $x <= 5; $x++) {
            echo '<div class="col mb-4">';
            echo '<div class="card" style="height:auto;">';
            echo '<img src="' . $locData[$x]['image'] . '" class="card-img-top" alt="Location Image">';
            echo '<img src="' . $locData[$x]['clueimage'] . '" class="card-img-top" alt="Location Image Clue">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Location Title: ' . $locData[$x]['title'] . '</h5>';
            echo '<p class="card-text">Location Text: ' . $locData[$x]['text'] . '</p>';
            echo '<p class="card-text">Location Clue: ' . $locData[$x]['clue'] . '</p>';
            echo '<p class="card-text">Location Code: ' . $locData[$x]['code'] . '</p>';
            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit" . $locData[$x]['id'] . "'>Edit this Page's Content</button>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
          } 
          echo '</div>';
          // Create PopUps for all locations with array
          for ($x = 0; $x <= 5; $x++) {     
            echo '<div class="modal fade" id="edit' . $locData[$x]['id'] . '" tabindex="-1">';
            echo '<div class="modal-dialog modal-dialog-scrollable">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Modifying data of: ' . $locData[$x]['title'] . '</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            // PopUp Content
            echo '<ul class="list-group">';
            echo '<li class="list-group-item">';
            echo '<form method="POST">';
				    echo '<div class="form-group">';
            // Location Title
            echo '<p>Current Title:</p>';
            echo '<h1 class="display-5">' . $locData[$x]['title'] . '</h1>';
            // Input for new title
            echo '<label>Put new page title here.</label>';
            echo '<input type="text" class="form-control" name="newTitle' . $locData[$x]['id'] . '" placeholder="New Title" value="' . $locData[$x]['title'] . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="249" required>';
            echo '</li>';
            echo '<li class="list-group-item">';
            // Location Image
            echo '<p>Current Image:</p>';
            echo '<img src="' . $locData[$x]['image'] . '" class="img-fluid img-thumbnail" alt="Current Location Image">';
            // Input for new image file
            echo '<label>Put new image filename here.</label>';
            // Re-format image path for DB
            $imageFormat = substr($locData[$x]['image'], 25);
            echo '<input type="text" class="form-control" name="newImage' . $locData[$x]['id'] . '" placeholder="New Image Filename" value="' . $imageFormat . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="199" required>';
            echo '<label><strong style="color:red;">WARNING:</strong> Make sure you leave the filepath out of this input, only enter the filename with extension. File names should really only contain alphanumerics and one period for the file extension. Place new images within the asset folder, or images wont load properly.</label>';
            echo '</li>';
            echo '<li class="list-group-item">';




            // Location Image Clue
            echo '<p>Current Clue Image:</p>';
            echo '<img src="' . $locData[$x]['clueimage'] . '" class="img-fluid img-thumbnail" alt="New Location Image Clue">';
            // Input for new image clue file
            echo '<label>Put new image filename here.</label>';
            // Re-format image path for DB
            $imageFormatClue = substr($locData[$x]['clueimage'], 25);
            echo '<input type="text" class="form-control" name="newClueImage' . $locData[$x]['id'] . '" placeholder="New Clue Image Filename" value="' . $imageFormatClue . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="199" required>';
            echo '<label><strong style="color:red;">WARNING:</strong> Make sure you leave the filepath out of this input, only enter the filename with extension. File names should really only contain alphanumerics and one period for the file extension. Place new images within the asset folder, or images wont load properly.</label>';
            echo '</li>';
            echo '<li class="list-group-item">';



            // Location Text
            echo '<p>Current Text:</p>';
            echo '<p>' . $locData[$x]['text'] . '</p>';
            // Input for new text
            echo '<label><b>Put new page text here, use HTML entities for any non alphanumeric or non punctuation characters. See this page for reference <a href="https://dev.w3.org/html5/html-author/charref" target="_blank">HTML Entities</a></b></label>';
            echo '<textarea class="form-control" name="newText' . $locData[$x]['id'] . '" placeholder="New Text" rows="24" pattern="[A-Za-z0-9\s,.?!]+" maxlength="4000" required>' . $locData[$x]['text'] . '</textarea>';
            echo '</li>';
            echo '<li class="list-group-item">';
            // Location Clue
            echo '<p>Current Clue:</p>';
            echo '<p>' . $locData[$x]['clue'] . '</p>';
            // Input for new clue
            echo '<label>Put new page clue here.</label>';
            echo '<input type="text" class="form-control" name="newClue' . $locData[$x]['id'] . '" placeholder="New Clue" value="' . $locData[$x]['clue'] . '" pattern="[A-Za-z0-9\s,.?!&;#]+" maxlength="349" required>';
            echo '</li>';
            echo '<li class="list-group-item">';
            // Location Code
            echo '<p>Current Code:</p>';
            echo '<p>' . $locData[$x]['code'] . '</p>';
            // Input for new code
            echo '<label>Put new page code here.</label>';
            echo '<input type="text" class="form-control" name="newCode' . $locData[$x]['id'] . '" placeholder="New Code" value="' . $locData[$x]['code'] . '" pattern="[A-Za-z0-9]+" maxlength="29" required>';
            echo '<label><strong style="color:red;">WARNING:</strong> Custom code should only consist of upper and lower case alphanumeric characters.</label>';      
            echo '</li>';
            echo '</ul>';
            //End PopUp Content
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            echo '<input class="btn btn-primary" type="submit" value="Save Changes">';
            // Post new Location data to DB
            if (isset($_POST['newTitle' . $locData[$x]['id']]) && isset($_POST['newImage' . $locData[$x]['id']]) && isset($_POST['newText' . $locData[$x]['id']]) && isset($_POST['newClue' . $locData[$x]['id']]) && isset($_POST['newCode' . $locData[$x]['id']])) {       
              $newTitle = $_POST['newTitle' . $locData[$x]['id']];
              $newImage = "./asset/" . $_POST['newImage' . $locData[$x]['id']];
              
              $newImageClue = "./asset/" . $_POST['newClueImage' . $locData[$x]['id']];
              
              $newText = $_POST['newText' . $locData[$x]['id']];
              $newClue = $_POST['newClue' . $locData[$x]['id']];
              $newCode = $_POST['newCode' . $locData[$x]['id']];
              $sql = 'UPDATE location_data SET title = "' . $newTitle . '", image = "' . $newImage . '", text = "' . $newText . '", clue = "' . $newClue . '", code = "' . $newCode . '", clueimage = "' . $newImageClue . '" WHERE id = ' . $locData[$x]['id'] . '';
              if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Page Update Successful");</script>';
                echo '<script type="text/javascript">window.location = "admin.php";</script>';
              } else {
                echo '<script>alert("Sorry, Page Submission Failed");</script>';
              }
            }
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
          // End Location Edit 
          mysqli_close($conn);
      echo '<!-- End page contents -->
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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>';
    } else {
		echo '<script type="text/javascript">window.location = "login.php";</script>';
		echo '<h1>Error: You must enable JavaScript for this website to function.</h1>';
	}
?>
</html>