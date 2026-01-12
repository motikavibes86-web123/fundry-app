<?php
$ip = $_SERVER['REMOTE_ADDR'];
$_SESSION['hits'][$ip] = ($_SESSION['hits'][$ip] ?? 0) + 1;
if($_SESSION['hits'][$ip] > 10){
  die("Jaribu tena baadae");
}
