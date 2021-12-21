<?php
  include "config/helper.php";
  $h = new Helper();
  $url = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
  $page = $url[0] == "" ? "home" : $url[0];
  $role = $h->checkLog() ? $h->user()['role'] : "guest";
  switch ($role) {
    case 'admin':
      $avpg = ["dashboard","customer","booking-list"];
      $page = $url[0] == "" ? "dashboard" : $url[0];
      break;

    case 'guest':
      $avpg = ["home"];
      break;

    case 'customer':
      $avpg = ["home","booking","customer-area"];
      break;
    
    default:
      # code...
      break;
  }
  $folder = ["config","components","assets"];
  include "components/head.php";
  if (!file_exists("pages/{$page}.php") || !in_array($page,$avpg) || in_array($page,$folder)) {
    include "pages/404.php";
  }else{
    include "pages/{$page}.php";
  }
  include "components/foot.php";
?>