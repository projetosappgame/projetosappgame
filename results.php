<?php
    
  $host = 'localhost';
  $dbname = 'dbname';
  $username = 'dbuserm';
  $password = 'password';
  
  try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      //echo "Conectado ao Banco de Dados $dbname em $host com Sucesso. ";
      
      $Username = $_POST['Username'];
      
      $sql = "SELECT Username, Tempo, Batalhas, Pontos FROM users WHERE Username = :USERNAME";
      
      $stmt_result = $conn->prepare($sql);
      
      $stmt_result->bindParam(':USERNAME', $Username);
      
      $stmt_result->execute();
      
      $arquivo = "#temp$@_$Username%&.ncb";
      
      while ($dados = $stmt_result->fetch(PDO::FETCH_OBJ)) {
        $conteudo = "[1=,$dados->Tempo],[2=,$dados->Batalhas],[3=,$dados->Pontos&]";
        file_put_contents($arquivo, $conteudo); 
        echo "OK";
        fclose($arquivo);
        break;
      }
      
      $conn = null;

  } catch (PDOException $pe) {
      die("Não foi possível se conectar ao banco de dados $dbname :" . $pe >getMessage());
  }

?>