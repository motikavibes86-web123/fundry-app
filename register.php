<?php
include "db.php";

$msg = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $name  = trim($_POST["fullname"]);
  $email = trim($_POST["email"]);
  $pass  = $_POST["password"];
  $cpass = $_POST["confirm"];

  if(strlen($pass) < 6){
    $msg = "Password iwe angalau herufi 6";
  } elseif($pass !== $cpass){
    $msg = "Password hazifanani";
  } else {
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(fullname,email,password) VALUES(?,?,?)");
    $stmt->bind_param("sss",$name,$email,$hash);

    if($stmt->execute()){
      $_SESSION["user_id"] = $stmt->insert_id;
      $_SESSION["role"] = "user";
      header("Location: login.php");
      exit;
    } else {
      $msg = "Email tayari imesajiliwa";
    }
  }
}
?>
