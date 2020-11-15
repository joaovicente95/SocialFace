<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        if (!isset($_SESSION["username"])) {
            header('Location: regLogin.php');
        }
        else{
            header('Location: posts.php');
        }
        ?>
    </body>
</html>
