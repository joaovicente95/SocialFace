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
            <link rel="stylesheet" href="CSS/mensagensCSS.css"> 
            <link rel="stylesheet" href="CSS/globlalCSS.css"> 

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
                <div id="chatApp" ng-app="chatApp" ng-controller="chatController" ng-init="iniciaTimer(); amigosLer()">
                    <script>
                        var app = angular.module('chatApp', []);
                        app.controller('chatController', function ($scope) {
                        $scope.id = "<?php Print($id); ?>";
                        $scope.mensagens = [];
                        $scope.amigos = [];
                        $scope.selected = 0;
                        $scope.status = "";
                        $scope.mensagem = "";
                        $scope.amigoDeConversa = 0;
                        $scope.iniciaTimer = function () {
                        setInterval("angular.element($('#chatApp')).scope().servicoLeitura()", 1000);
                        };
                        //Buscar amigos
                        $scope.amigosLer = function () {
                        $.getJSON(
                                "lerAmigosRest.php",
                        {
                        "iduser": $scope.id
                        },
                                function (jsonData)
                                {
                                $scope.amigos = jsonData;
                                $scope.$apply();
                                }
                        );
                        };
                        //Ler mensgens
                        $scope.servicoLeitura = function () {
                        $.getJSON(
                                "servicoLeitura.php",
                        {
                        "amigoDeConversaId": $scope.amigoDeConversa
                        },
                                function (jsonData)
                                {
                                $scope.mensagens = jsonData;
                                $scope.$apply();
                                });
                        };
                        // Adicionar mensagens
                        $scope.addMensagem = function ()
                        {
                        $.post(
                                "addMensagemRest.php",
                        {
                        "destinatario": $scope.amigoDeConversa,
                                "mensagem": $scope.mensagem
                        },
                                function (dados)
                                {
                                if (dados.indexOf("OK") >= 0)
                                {
                                $scope.mensagem = "";
                                } else
                                {
                                $scope.status = "FALHOU";
                                }
                                $scope.$apply();
                                }
                        );
                        };
                        //ng-click -> definir o id do amigo da conversa
                        $scope.selectAmigo = function (IDamigo) {
                        $scope.amigoDeConversa = IDamigo;
                        };
                        // Verificar qual o amigo de conversa
                        $scope.isActive = function (item) {
                        return $scope.amigoDeConversa === item;
                        };
                        //Ver tecla enter para submeter a mensagem
                        $scope.myFunct = function (keyEvent) {
                        if (keyEvent.which === 13)
                                $scope.addMensagem();
                        };
                        });
                    </script>

                    <!-- Amigos -->
                    <div class="AmigosCSS col-md-2">

                        <div class="panel">
                            <div class="panel-heading">Amigos</div>
                            <div class="panel-body" style="padding:0; overflow-y: scroll; max-height:85%;">
                                <div class="list-group">
                                    <div class="list-group-item" ng-repeat="a in amigos"  ng-click="selectAmigo(a.idamigo);"  ng-class="{active: isActive(a.idamigo)}">
                                        {{a.amigo}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Mensagens -->
                    <div class="MensagensCSS col-md-10">

                        <div class="panel">
                            <div class="panel-heading">Mensagens</div>
                            <div id="AutoScroll" class="panel-body" style="overflow-y: scroll;">
                                <div class='row' ng-repeat="m in mensagens">
                                    <label id="TextoMensagens" ng-class="{'pull-left': m.idAutor == <?php echo $id ?>,'pull-right' : m.idAutor != <?php echo $id ?>}">
                                        <label class='label' ng-class="{'label-success': m.idAutor == <?php echo $id ?>,'label-info' : m.idAutor != <?php echo $id ?>}">
                                            {{m.nomeAutor}}
                                        </label>- 
                                        {{m.data}}
                                        -
                                        {{m.texto}} 
                                    </label>
                                </div> 
                            </div>

                            <div class="panel-footer">
                                <div class ="input-group">
                                    <input id="TextBoxMensagem" ng-model="mensagem" placeholder="Escreva uma mensagem..." class="form-control" type="text" name="mensagem" ng-keypress="myFunct($event)"/>
                                    <span class="input-group-btn">
                                        <button ng-click="addMensagem()" class="btn btn-success" type="button">Enviar</button>
                                    </span>
                                </div>
                                <div ng-show="status.length > 0" class="alert alert-info">
                                    {{status}}
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
