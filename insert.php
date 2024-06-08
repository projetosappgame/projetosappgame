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
      $sql_verifica = "SELECT * FROM users WHERE Username = :USERNAME OR Email = :EMAIL";
      $stmt_verifica = $conn->prepare($sql_verifica);
      $stmt_verifica->bindParam(':USERNAME', $Username);
      $stmt_verifica->bindParam(':EMAIL', $Email);
      $stmt_verifica->execute();
      if ($stmt_verifica->rowCount() > 0) {
        echo json_encode(array("1"=>"REGISTRO_DUPLICADO"));
      }
      else {
        $SenhaCriptografada = password_hash($Senha, PASSWORD_DEFAULT);
        $Senha = $SenhaCriptografada;
        $insert_statement = $conn->prepare("INSERT INTO users (Username, Email, Senha, Tempo, Batalhas, Pontos) VALUES (:USERNAME, :EMAIL, :SENHA, :TEMPO, :BATALHAS, :PONTOS)");
        $insert_statement->bindParam(':USERNAME', $Username);
        $insert_statement->bindParam(':EMAIL', $Email);
        $insert_statement->bindParam(':SENHA', $Senha);
        $insert_statement->bindParam(':TEMPO', $Tempo);
        $insert_statement->bindParam(':BATALHAS', $Batalhas);
        $insert_statement->bindParam(':PONTOS', $Pontos);
        if ($insert_statement->execute()) {
        echo json_encode(array("2"=>"REGISTRO_OK"));
        } else {
            echo json_encode(array("3"=>"REGISTRO_ERRO"));
        }
      }
      $conn = null;
  } catch (PDOException $pe) {
      die("Não foi possível se conectar ao banco de dados $dbname :" . $pe >getMessage());
  }

?>