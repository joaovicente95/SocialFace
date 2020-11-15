<?php

include './mysql/mysqlConnect.php';

$IDPost = $_GET["IDPost"];

session_start();
$id = $_SESSION["id"];

// Query para verificar se o utilizadar ja realisou like no post

$sql_novo = "select * from likes where " .
        "(idPost = '$IDPost' " .
        "and " .
        "idAutor = '$id')";

$result = $GLOBALS["db.connection"]->query($sql_novo);

// Caso ja tenha feito like no post, esse like é retirado
if (mysqli_num_rows($result) > 0) {
    $sql_novo = "delete from likes where " .
            "(idPost=$IDPost " .
            "and " .
            "idAutor = $id)";
} else {
    $sql_novo = "insert into likes (idPost, idAutor) "
            . " VALUES($IDPost,$id)";
}

$GLOBALS["db.connection"]->query($sql_novo);

include './mysql/mysqlClose.php';
