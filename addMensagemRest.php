<?php

include './mysql/mysqlConnect.php';

$mensagem = $_POST["mensagem"];

session_start();
$destinatario = $_POST["destinatario"];
$id = $_SESSION["id"];

// Query para inserir uma nova mensagem
$sql_novo = "insert into mensagem (data,texto,idAutor,idTarget) "
        . " VALUES(NOW(),'$mensagem',$id,$destinatario)";

$result = $GLOBALS["db.connection"]->query($sql_novo);

include './mysql/mysqlClose.php';

if ($result == TRUE) {
    echo "OK";
} else {
    echo "FALSE";
}