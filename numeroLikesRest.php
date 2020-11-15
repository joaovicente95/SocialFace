<?php

include './mysql/mysqlConnect.php';

$IDPost = $_GET["IDPost"];

// Query para verificar se o utilizadar ja realisou like no post
$sql_novo = "select * from likes where " .
        "(idPost = '$IDPost')";

$result = $GLOBALS["db.connection"]->query($sql_novo);

if ($result == false) {
    echo $GLOBALS["db.connection"]->error;
}

echo mysqli_num_rows($GLOBALS["db.connection"]->query($sql_novo));

include './mysql/mysqlClose.php';
