<?php

include './mysql/mysqlConnect.php';

$mensagem = $_POST["comentario"];
$IDPost = $_POST["IDPost"];

session_start();
$id = $_SESSION["id"];

// Query para inserir um novo comentario num post
$sql_novo = "insert into comentarios (idPost,idUtilizador,Texto) "
        . " VALUES('$IDPost','$id','$mensagem')";

$result = $GLOBALS["db.connection"]->query($sql_novo);

include './mysql/mysqlClose.php';

if ($result == TRUE) {
    echo "OK";
} else {
    echo "FALSE";
}
