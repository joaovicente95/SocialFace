<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
}


include './mysql/mysqlConnect.php';

$sql = "SELECT * FROM utilizador where username = '" . $username . "' and password = '" . $password . "'";

$result = $GLOBALS["db.connection"]->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION["username"] = $row["username"];
    $_SESSION["id"] = $row["id"];
    $_SESSION["nome"] = $row["nome"];
    $_SESSION["LogStatus"] = 0;
} else {
    $_SESSION["LogStatus"] = 1;
}

include './mysql/mysqlClose.php';

include("reglogin.php");
