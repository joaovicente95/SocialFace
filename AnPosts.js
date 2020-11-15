// Funções dos Posts

var app = angular.module('postApp', []);
app.controller('postController', function ($scope) {
    $scope.id = "<?php Print($id); ?>";
    $scope.posts = [];
    $scope.status = "";
    $scope.mensagemPost = "";
    $scope.ultimoElemento = 0;
    // Timer para ler os posts
    $scope.iniciaTimer = function () {
        setInterval("angular.element($('#postApp')).scope().LerPost()", 2000);
    };

    // Função definir um timer para actualizar o numero de likes
    $scope.iniciaLike = function (p) {
        setInterval(function () {
            $scope.contarLike(p);
        }, 2000);
    };

    // Adicionar comentario
    $scope.addComentario = function (p) {
        $.post(
                "addComentarioRest.php",
                {
                    "comentario": p.comment,
                    "IDPost": p.postID
                },
                function (dados)
                {
                    p.comment = "";
                    $scope.$apply();
                }
        );
    };
    // Adicionar mensagens
    $scope.addPost = function () {
        $.post(
                "addPostRest.php",
                {
                    "mensagem": $scope.mensagemPost
                },
                function (dados)
                {
                    if (dados.indexOf("OK") >= 0)
                    {
                        $scope.mensagemPost = "";
                    } else
                    {
                        $scope.status = "FALHOU";
                    }
                    $scope.$apply();
                }
        );
    };
    //Ler mensagens
    $scope.LerPost = function () {
        $.getJSON(
                "lerPostRest.php",
                {
                    "ultimoElemento": $scope.ultimoElemento
                },
                function (jsonData)
                {
                    $scope.posts = $scope.posts.concat(jsonData);
                    if ($scope.ultimoElemento < $scope.posts[$scope.posts.length - 1].postID) {
                        $scope.ultimoElemento = $scope.posts[$scope.posts.length - 1].postID;
                        $scope.$apply();
                    }
                });
    };

    // Função para adicionar likes 
    $scope.addLike = function (Like) {
        $.get(
                "addLikeRest.php",
                {
                    "IDPost": Like
                }
        );
    };
    // Função para contar likes
    $scope.contarLike = function (p) {
        $.get(
                "numeroLikesRest.php",
                {
                    "IDPost": p.postID
                },
                function (dados)
                {
                    p.numeroLikes = dados;
                    $scope.VerLike(p);
                    $scope.$apply();
                }
        );
    };
    // Verificar se o utilizador que está na sessão fez like no post
    $scope.VerLike = function (p) {
        $.get(
                "verificarLikeRest.php",
                {
                    "IDPost": p.postID
                },
                function (dados)
                {
                    if (dados.indexOf("OK") >= 0)
                    {
                        p.SRCLike = "IMG/ILIKE.png";
                    } else
                    {
                        p.SRCLike = "IMG/LIKE.png";
                    }
                    $scope.$apply();
                }
        );
    };
});

// Filtro para reverter o array de posts
app.filter('reverse', function () {
    return function (array) {
        return array.slice().reverse();
    }
    ;
});

