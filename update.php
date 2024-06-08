<?php
  $host = 'localhost';
  $dbname = 'dbname';
  $username = 'dbuserm';
  $password = 'password';
  
  try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      //echo "Conectado ao Banco de Dados $dbname em $host com Sucesso. ";
      $Username = $_POST['Username'];
      $Email = $_POST['Email'];
      $Senha = $_POST['Senha'];
      $Tempo = $_POST['Tempo'];
      $Batalhas = $_POST['Batalhas'];
      $Pontos = $_POST['Pontos'];
      $sql_verifica = "SELECT * FROM users WHERE Username = :USERNAME";
      $stmt_verifica = $conn->prepare($sql_verifica);
      $stmt_verifica->bindParam(':USERNAME', $Username);
      $stmt_verifica->execute();
      if ($stmt_verifica->rowCount() > 0) {
        $sql = "UPDATE users SET Tempo=:TEMPO, Batalhas=:BATALHAS, Pontos=:PONTOS WHERE Username=:USERNAME";
        $update_statement = $conn->prepare($sql);
        $update_statement->bindParam(':USERNAME', $Username);
        $update_statement->bindParam(':TEMPO', $Tempo);
        $update_statement->bindParam(':BATALHAS', $Batalhas);
        $update_statement->bindParam(':PONTOS', $Pontos);
        if ($update_statement->execute()) {
            echo json_encode(array("1"=>"RANKING_ATUALIZADO"));
        } else {
            echo json_encode(array("2"=>"RANKING_ERRO"));
        }
      }
      $conn = null;
  } catch (PDOException $pe) {
      die("Não foi possível se conectar ao banco de dados $dbname :" . $pe >getMessage());
  }
?>