<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/globlalCSS.css">
        <link rel="stylesheet" href="CSS/loginCSS.css">
    </head>
    <body id="login">
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        ?>
        <div id="nav-bar">
            <script>
                $.get("navbar.php", function (data) {
                    $("#nav-bar").replaceWith(data);
                });
            </script>
        </div>

        <div id="conteudo">

            <div class="login-block">
                <div class="form">
                    <!-- Form de login -->
                    <form class="form-horizontal" action="login.php" method="POST">
                        <h1>Login</h1>
                        <?php
                        if (isset($_SESSION["LogStatus"])) {
                            if ($_SESSION["LogStatus"] == 0) {
                                header('Location: posts.php');
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Username ou password incorretos!</strong>
                                </div>
                                <?php
                                unset($_SESSION["ERROR"]);
                            }
                        } elseif (isset($_SESSION["RegStatus"])) {
                            if ($_SESSION["RegStatus"] == 1) {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Erro ao concluir o registo</strong>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Registado com sucesso</strong>
                                </div>
                                <?php
                            }
                            unset($_SESSION["RegStatus"]);
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input id="username" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input id="password" type="password" name="password" class="glyphicon glyphicon-lock"
                                       placeholder="Password">
                            </div>
                        </div>
                        <button type="submit"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
                        <p class="message">Não estás registado? <a href="#">Criar uma conta</a></p>
                    </form>

                    <!-- Form de regito de utilizador -->
                    <form class="register-form form-horizontal" action="registarUser.php" method="POST">
                        <h1>Registar</h1>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Username:</label>
                            <div class="col-sm-12">
                                <input name="username" class="form-control" placeholder="Coloque o username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Email:</label>
                            <div class="col-sm-12"> 
                                <input name="email" class="form-control" placeholder="Coloque a email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Password:</label>
                            <div class="col-sm-12">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Coloque a password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Nome:</label>
                            <div class="col-sm-12">
                                <input name="nome" class="form-control" placeholder="Coloque o nome">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Telefone:</label>
                            <div class="col-sm-12">
                                <input name="telefone" class="form-control" placeholder="Coloque o telefone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Morada:</label>
                            <div class="col-sm-12">
                                <input name="morada" class="form-control" placeholder="Coloque a morada">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Idade:</label>
                            <div class="col-sm-12">
                                <input name="idade" class="form-control" placeholder="Coloque a idade">
                            </div>
                        </div>

                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-log-in"></span>
                            Registar
                        </button>
                        <p class="message">Já registado? <a href="#">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
        <?php
        //  }
        ?>
        <script>
            /* Abrir e fechar form de registar utilizador */
            $('.message a').click(function () {
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            });
            /* Fechar alert depois de 3 segundos */
            $(".alert").fadeTo(2000, 500).slideUp(500);
        </script>
    </body>
</html>