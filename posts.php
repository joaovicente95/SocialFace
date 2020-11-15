<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["username"])) {
    header('Location: regLogin.php');
} else {
    $id = $_SESSION["id"];
    ?>
    <html>
        <head> 
            <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <script src="bootstrap/jquery.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <script src="angular/angular.min.js"></script>
            <link rel="stylesheet" href="CSS/globlalCSS.css">
            <link rel="stylesheet" href="CSS/postCSS.css">
            <script src="AnPosts.js"></script>
        </head>
        <body>
            <div id="nav-bar">
                <script>
                    $.get("navbar.php", function (data) {
                        $("#nav-bar").replaceWith(data);
                    });
                </script>
            </div>
            <div id="conteudo">
                <div id="postApp" ng-app="postApp" ng-controller="postController" ng-init="iniciaTimer()">

                    <!-- Painel para adicionar um novo post -->

                    <div class="escreverPost">
                        <div class="panel">
                            <div class="panel-heading headerES">                                
                                <span><i class="glyphicon glyphicon-pencil"></i> Criar Publicação</span>
                            </div>
                            <div class="panel-body">
                                <textarea maxlength="250" ng-model="mensagemPost" placeholder="Em que estás a pensar, <?php echo $_SESSION["username"] ?>?" class="form-control textpost" name="mensagemPost"></textarea>
                            </div>
                            <div class="panel-footer clearfix footerES">
                                <button ng-click="addPost()" class="btn btn-primary pull-right" type="button">Publicar</button>
                            </div>
                        </div>
                    </div>

                    <!-- Lista Posts de amigos -->

                    <div id="listPost" ng-repeat="p in posts| reverse " >
                        <div class="panel">
                            <div  class="panel-heading headerES">
                                <label>
                                    {{p.nomeAutor}}
                                </label>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <label class="textPOST">
                                        {{p.texto}}
                                    </label>
                                </div>
                                <div class="pull-right">
                                    <label class="dataPOST">
                                        {{p.data}}
                                    </label>
                                </div>                                
                            </div>
                            <div class="panel-footer footerES">
                                <div class="PalLike clearfix">
                                    <img ng-src="{{p.SRCLike}}" src="IMG/LIKE.png" ng-click="addLike(p.postID)" ng-init="iniciaLike(p)" style="height:3%;width: auto">
                                    <label>{{p.numeroLikes}}</label>
                                </div>
                                <div class="ComentarioPost">
                                    <div ng-repeat="p2 in p.Comentarios">
                                        <span><i class="glyphicon glyphicon-user"></i> {{p2.Autor}}</span>
                                        - {{p2.Texto}}
                                    </div>
                                </div>
                                <div class ="input-group">
                                    <input ng-model="p.comment" placeholder="Escreva um comentário..." class="form-control" type="text" name="comentario"/>
                                    <span class="input-group-btn">
                                        <button ng-click="addComentario(p)" class="btn" type="button">Comentar</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        <?php }
        ?>
    </body>
</html>
