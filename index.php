<!DOCTYPE html>
<html>
    <head>
        <title>Spell Check</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <header class="w3-center w3-black w3-container">
            <h1>Spell Check</h1>
        </header>
    <body>
        <form action = "SpellCheck.php" method="post">
            <br>
            Word: <input type="text" name = "input"  value = "input"><br><br>
            <input type="submit" value = "Spell Check">
        </form>
    </body>
    <footer class= "w3-center w3-monospace w3-dark-grey w3-container">
        <?php
        $date = date_create();

        echo "Today's date is ".date_format($date, "M j, Y");
        ?>
    </footer>
</html>