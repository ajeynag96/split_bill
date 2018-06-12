<?php

  $url = $_SERVER['REQUEST_URI'];
  $requestParams = explode("/",$url);

  try{
  $dbCredentials = array('username' => 'epiz_22220010','password' => 'ajeynag');
  $conn = new PDO("mysql:host=sql107.epizy.com;dbname=epiz_22220010_splitbill",$dbCredentials['username'],$dbCredentials['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  if($requestParams[2] === "send"){
      $getPending = $conn->prepare('SELECT SUM(Amount) FROM `Transaction` WHERE Payer = :Payer');
      $getPending->execute(array(
           "Payer" => $requestParams[3]
      ));
      echo $getPending->fetch()[0];
  }else if($requestParams[2] === "receive"){
      $getDue = $conn->prepare('SELECT SUM(Amount) FROM `Transaction` WHERE Payee = :Payee');
      $getDue->execute(array(
           "Payee" => $requestParams[3]
      ));
      echo $getDue->fetch()[0];
  }
}catch(Exception $e){
    echo $e->getMessage();
}

 ?>