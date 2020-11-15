<?php
include './mysql/mysqlConnect.php';

$mensagem = $_POST["mensagem"];

session_start();
$id = $_SESSION["id"];

// query para inserir uma nova mensagem
$sql_novo = "insert into post (idAutor,texto,data) "
        . " VALUES($id,'$mensagem',NOW())";

$result = $GLOBALS["db.connection"]->query($sql_novo);

include './mysql/mysqlClose.php';

if ($result == TRUE) {
    echo "OK";
} else {
    echo "FALSE";
}