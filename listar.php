<?php
    include_once "databaseconnect.php";
    
    $sql_lista = "SELECT Username, Tempo, Batalhas, Pontos FROM users ORDER BY Pontos DESC LIMIT 10";
    $stmt_lista = $conn->prepare($sql_lista);
    $stmt_lista->execute();

    $ranking = array();

    while($dados = $stmt_lista->fetch(PDO::FETCH_OBJ)) {
        $ranking[] = array("Username"=>$dados->Username, "Tempo"=>$dados->Tempo, "Batalhas"=>$dados->Batalhas, "Pontos"=>$dados->Pontos);
    }

    echo json_encode($ranking);
    $conn = null;
?>