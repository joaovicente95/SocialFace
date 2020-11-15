<?php

if (!isset($_SESSION)) {
    session_start();
}

unset($_SESSION['username']);
unset($_SESSION['id']);
session_destroy();

//include 'index.php';
header('Location: http://localhost:8000/index.php');
