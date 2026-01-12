<?php
include "db.php";
include "csrf.php";

$token = $_GET['token'] ?? '';
$msg = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  csrf_check();
  $password = $_POST['password'];
  $confirm  = $_POST['confirm'];
  $token    = $_POST['token'];

  if($password !== $confirm){
    $msg = "Password hazifanani";
  } elseif(strlen($password)<6){
    $msg = "Password angalau herufi 6";
  } else {
    $hash = password_hash($password,PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expire=NULL WHERE reset_token=? AND reset_expire>NOW()");
    $stmt->bind_param("ss",$hash,$token);
    $stmt->execute();

    if($stmt->affected_rows===1){
      $msg = "Password imebadilishwa. <a href='login.html'>Ingia sasa</a>";
    } else {
      $msg = "Token si sahihi au imetokea muda wake";
    }
  }
}
?>
