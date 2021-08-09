<?php session_start();?>
<html>
    <?php
        // Destroys any location progress and admin login
        session_unset();
        session_destroy();
    ?>
    <!-- Redirect back home -->
    <script>window.location = "index.php";</script>
</html>