<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/globlalCSS.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img class="navbar-brand" src="IMG/Logo.png">
                    <div class="navbar-brand"><a href="posts.php" style="all: unset">Social Club</a></div>
                </div>
                <?php
                if (!isset($_SESSION)) {
                    session_start();
                }
                if (isset($_SESSION["username"])) {
                    ?>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="posts.php">Home</a></li>
                            <li><a href="mensagens.php">Mensagens</a></li>
                        </ul>
                        <div class="Username">
                            <?php
                            $username = $_SESSION["username"];
                            echo "Ola $username";
                            ?>
                            <a class="btn btn-danger pull-right clearfix" href="logout.php" style="margin-left:10px"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </body>
</html>
