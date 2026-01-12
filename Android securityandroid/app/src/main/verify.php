<?php
include "db.php";

$token = $_GET['token'] ?? '';
$stmt = $conn->prepare(
  "UPDATE users SET is_verified=1, verified_at=NOW(), verify_token=NULL
   WHERE verify_token=?"
);
$stmt->bind_param("s",$token);
$stmt->execute();

if($stmt->affected_rows===1){
  echo "Akaunti imethibitishwa. Ingia sasa.";
} else {
  echo "Link si sahihi au tayari imethibitishwa.";
}
