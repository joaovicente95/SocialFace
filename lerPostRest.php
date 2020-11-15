<?php

header("Content-type: application/json");

include './mysql/mysqlConnect.php';

session_start();
$id = $_SESSION["id"];
$ultimoElemento = $_GET["ultimoElemento"];

$result = $GLOBALS["db.connection"]->query(
        "select " .
        "p.id as postID, " .
        "p.texto as texto, " .
        "p.data as data, " .
        "autor.nome as nomeAutor, " .
        "count(l.idAutor) as numeroLikes " .
        "from likes l " .
        "right join post p on p.id = l.idPost " .
        "join utilizador autor on autor.id = p.idAutor " .
        "where(p.idAutor " .
        "in " .
        "((select idAmigo2 from amigos where idAmigo1 = $id)) " .
        "or " .
        "p.idAutor = $id )" .
        "and " .
        "(p.id > $ultimoElemento) " .
        "group by p.id " .
        "order by p.id"
);

if ($result == false) {
    echo $GLOBALS["db.connection"]->error;
}

$todos = array();
while ($row = $result->fetch_assoc()) {
    $ultimo = $row['postID'];
    // Comentarios do post
    $sql2 = "select c.Texto as Texto, p.nome as Autor from comentarios c " .
            "join utilizador p on p.id = c.idUtilizador " .
            "WHERE " .
            "(c.idPost = $ultimo)";
    $result2 = $GLOBALS["db.connection"]->query($sql2);
    $comentarios = array();
    while ($row2 = $result2->fetch_assoc()) {        
        $comentarios[] = $row2;
    }
    $row['Comentarios'] = array_values($comentarios);
    unset($comentarios);

    $todos[] = $row;
}

echo json_encode($todos);

include './mysql/mysqlClose.php';
