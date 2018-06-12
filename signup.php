<?php
  try {
    $url = $_SERVER['REQUEST_URI'];
    $requestParams = explode("/",$url);

  $dbCredentials = array('username' => 'epiz_22220010','password' => 'ajeynag');
  $conn = new PDO("mysql:host=sql107.epizy.com;dbname=epiz_22220010_splitbill",$dbCredentials['username'],$dbCredentials['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $insertUser = $conn->prepare('INSERT INTO Login VALUES (:Email, :Password)');
    $insertUser->execute(array(
          "Email" => $requestParams[2],
          "Password" => $requestParams[3]
        ));
    echo "SUCCESS";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
?>