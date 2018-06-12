<?php

 $url = $_SERVER['REQUEST_URI'];
 $requestParams = explode("/",$url);

 $dbCredentials = array('username' => 'epiz_22220010','password' => 'ajeynag');
  $conn = new PDO("mysql:host=sql107.epizy.com;dbname=epiz_22220010_splitbill",$dbCredentials['username'],$dbCredentials['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
try{

 if($requestParams[2] === "create"){
    $createGroup = $conn->prepare("INSERT INTO `Group` VALUES (null, :GroupName)");
    $createGroup->execute(array(
        "GroupName" => $requestParams[3]
    ));
    echo $conn->lastInsertId();
 }else if($requestParams[2] === "add"){
    $addUser = $conn->prepare("INSERT INTO `GroupUser` VALUES (:GroupId, :EmailId)");
    $addUser->execute(array(
       "GroupId" => $requestParams[3],
       "EmailId" => $requestParams[4]
   ));
   
 }else if($requestParams[2] === "get"){
    $getGroups = $conn->prepare("SELECT GroupName,GroupId FROM `Group` WHERE GroupId IN (SELECT GroupId FROM GroupUser WHERE UserEmail = :UserEmail)");
   $getGroups->execute(array(
       "UserEmail" => $requestParams[3]
   ));
   echo json_encode($getGroups->fetchAll(PDO::FETCH_ASSOC));
 }else if($requestParams[2] === "name"){
   $getEmailIds = $conn->prepare("SELECT UserEmail FROM `GroupUser` WHERE GroupId IN (SELECT GroupId FROM `Group` WHERE GroupName = :GroupName)");
   $getEmailIds->execute(array(
       "GroupName" => $requestParams[3]
   ));
   echo json_encode($getEmailIds->fetchAll(PDO::FETCH_COLUMN, 0));
 }
}catch(Exception $e){
   echo $e->getMessage();
}

 ?>