<?php

if (isset($_POST['nome']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['telefone']) && isset($_POST['morada']) && isset($_POST['idade'])) {
    $nome = $_POST["nome"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $telefone = $_POST["telefone"];
    $morada = $_POST["morada"];
    $idade = $_POST["idade"];
} else {
    $_SESSION["RegStatus"] = 1;
    include("index.php");
}

include './mysql/mysqlConnect.php';

$sql = "insert into utilizador (username,nome, email,morada, telefone,password,idade) values ('$username','$nome','$email','$morada','$telefone','$password','$idade');";
if ($GLOBALS["db.connection"]->query($sql) === TRUE) {
    $_SESSION["RegStatus"] = 0;
} else {
    $_SESSION["RegStatus"] = 1;
}
include './mysql/mysqlClose.php';


include("reglogin.php");
