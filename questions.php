<?php
  include('connect.php');

  try {
    $conn = new PDO("mysql:host=localhost;dbname=database", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = $conn->prepare("SELECT * FROM ds_cau_hoi ORDER BY RAND() LIMIT 5");
    $sql->execute();
    
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results, JSON_UNESCAPED_UNICODE);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>