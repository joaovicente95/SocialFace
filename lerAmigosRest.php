<?php

//necessário para dizer ao receptor que o conteudo é json
header("Content-type: application/json");

include './mysql/mysqlConnect.php';

$id = $_GET["iduser"];
session_start();

$result = $GLOBALS["db.connection"]->query(
        "select " .
        "u.nome as amigo, " .
        "u.id as idamigo " .
        "from utilizador u " .
        "join amigos a on a.idAmigo1 = u.id " .
        "where  " .
        "(a.idAmigo2 = $id)"
);

if ($result == false) {
    echo $GLOBALS["db.connection"]->error;
}

$todos = array();
while ($row = $result->fetch_assoc()) {
    $todos[] = $row; //atribui o array do user à ultima prosicao do array geral
}
echo json_encode($todos);

include './mysql/mysqlClose.php';
