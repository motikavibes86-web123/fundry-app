<?php
include "db.php";
include "csrf.php";

$msg = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  csrf_check();
  $email = trim($_POST['email']);

  $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
  $stmt->bind_param("s",$email);
  $stmt->execute();
  $res = $stmt->get_result();

  if($res->num_rows === 1){
    $user = $res->fetch_assoc();
    $token = bin2hex(random_bytes(32));
    $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $upd = $conn->prepare("UPDATE users SET reset_token=?, reset_expire=? WHERE id=?");
    $upd->bind_param("ssi",$token,$expire,$user['id']);
    $upd->execute();

    $link = "https://yourdomain.com/reset.php?token=".$token;
    mail($email,"Motika Vibes Password Reset","Bonyeza kuthibitisha: ".$link);

    $msg = "Angalia email yako kupata link ya reset";
  } else {
    $msg = "Email haipo";
  }
}
?>
