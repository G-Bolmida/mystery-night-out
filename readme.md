# Mystery Night Out #

## Installation ##
In order to install this web app it need to be placed on a server with PHP and a MySQL database. Move the full MysteryNightOut folder contents to the root of the web server.
Once moved you will want to import the cpd_mystery database into your MySQL database using the cpd_mystery.sql file. Once the database has been installed you will want to modify 
the connection.php file and fill in the details of your MySQL server. Finally you will want to edit your PHP's configuration by modifying the php.ini file. The "session.gc_maxlifetime"
control needs to be modified or player progress will be wiped on 24 minutes of inactivity, set this value to what you see fit. After the php config file is edited, your server will 
need to restart. When installing make sure you do not host the SQL file or this documentation file or you may allow users to see the page password as well as the admin password.
At this point the web app should be fully functional. You'll now want to put the current years content into the app. 

## Adding Content ##
In order to add new text, images, and location codes you will use the admin.php page in your browser by navigating to YourDomainName/admin.php. By default the login for this page is 
blank, this can be changed by modifying the PHP of the admin.php and login.php pages. Using the admin page you can edit the text of the homepage, top of the 
mystery page, and each of the locations. As far as location editing you can modify the puzzle image, completed image, clue text, completion text, and location code. When editing 
page texts you will need to use HTML entities in place of symbols and grammar marks, a good reference for HTML entities is here [charref documentation](https://dev.w3.org/html5/html-author/charref). 
In order to add new images you will need to directly upload the files to the server and place them into the asset folder. For best results you should upload high resolution landscape 
images, preferably with low file sizes for optimal loading times. **WARNING: When adding photos do not remove cityLogo.png, locked.png, or question.png as these are used regardless of content added via the admin page.** Once the images are in the asset folder you will need to 
use the admin page to set the new image file names to the images you would like to change. Lastly, if there is any other images or text in the page such as in the footer than you 
want to edit you will have to directly edit the PHP files, use caution if you would like to do that.