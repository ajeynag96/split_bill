<?php
  $url = $_SERVER['REQUEST_URI'];
  $requestParams = explode("/",$url);

  $userName = $requestParams[2];
  $password = $requestParams[3];

  try{
  $dbCredentials = array('username' => 'epiz_22220010','password' => 'ajeynag');
  $conn = new PDO("mysql:host=sql107.epizy.com;dbname=epiz_22220010_splitbill",$dbCredentials['username'],$dbCredentials['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);   
  $retrievePassword = $conn->prepare('SELECT Password FROM Login WHERE EmailId = :Email');
       $retrievePassword->execute(array(
         "Email" => $userName
       ));
 
  $retreivedPassword = $retrievePassword->fetch(PDO::FETCH_ASSOC)['Password'];

  if($password === $retreivedPassword){
    echo "SUCCESS";
  }else{
    echo "FAILURE";
  }
}catch(Exception $e){
  echo $e->getMessage();

}
exit();
?>