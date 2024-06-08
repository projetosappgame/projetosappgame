<?php
  $host = 'localhost';
  $dbname = 'dbname';
  $username = 'dbuserm';
  $password = 'password';
  
  try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      //echo "Conectado ao Banco de Dados $dbname em $host com Sucesso. ";
      $Username = $_POST['Username'];
      $Senha = $_POST['Senha'];

      $sql_verifica = "SELECT * FROM users WHERE Username = :USERNAME LIMIT 1";
      $stmt_verifica = $conn->prepare($sql_verifica);
      $stmt_verifica->bindParam(':USERNAME', $Username);
      $stmt_verifica->execute();
 
      $dados = $stmt_verifica->fetch(PDO::FETCH_OBJ);
      
      if(password_verify($Senha, $dados->Senha)) {
        $sql="DELETE FROM users WHERE Username=:USERNAME";
        $delete_statement = $conn->prepare($sql);
        $delete_statement->bindParam(':USERNAME', $Username);
        if ($delete_statement->execute()) {
          echo json_encode(array("1"=>"DELETAR_OK"));
        }
        else {
            echo json_encode(array("2"=>"DELETAR_ERRO"));
        }
      }
      else {
        echo json_encode(array("3"=>"DELETAR_INVALIDO"));  
      }
 
      $conn = null;
    } catch (PDOException $pe) {
      die("Não foi possível se conectar ao banco de dados $dbname :" . $pe >getMessage());
  }
?>