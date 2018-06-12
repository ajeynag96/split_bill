<?php

  $url = $_SERVER['REQUEST_URI'];
  $requestParams = explode("/",$url);

  try{
  $dbCredentials = array('username' => 'epiz_22220010','password' => 'ajeynag');
  $conn = new PDO("mysql:host=sql107.epizy.com;dbname=epiz_22220010_splitbill",$dbCredentials['username'],$dbCredentials['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);   
  $addTransaction = $conn->prepare('INSERT INTO `Transaction` VALUES (:Payee, :Payer, :Amount, :Description)');
       $addTransaction->execute(array(
         "Payee" => $requestParams[2],
         "Payer" => $requestParams[3],
         "Amount" => $requestParams[4],
         "Description"=> $requestParams[5]
       ));
  echo "SUCCESS";
}catch(Exception $e){
  echo "FAILURE";

}

 ?>