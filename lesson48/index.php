<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accepting Applications</title>
    </head>
    <body>
        <form action="/request.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="phone">Number:</label>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="from-site">FromSite:</label>
            <input type="text" id="from-site" name="from-site" required><br><br>

            <input type="submit" value="Send">
        </form>
    </body>
</html>