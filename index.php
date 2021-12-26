<?php
  include "config/helper.php";
  $h = new Helper();
  $url = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
  $page = $url[0] == "" ? "home" : $url[0];
  $get_data_limit = 0;
  $role = $h->checkLog() ? $h->user()['role'] : "guest";
  $avpg = [];
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
  $get_data_limit_1 = ["dashboard","customer","home","booking"];
  $get_data_limit_2 = ["booking-list","customer-area"];
  if(in_array($page,$get_data_limit_1)){
    $get_data_limit = 1;
  }else if(in_array($page,$get_data_limit_2)){
    $get_data_limit = 2;
  }
  $folder = ["config","components","assets"];
  include "components/head.php";
  if (!file_exists("pages/{$page}.php") || count($url) > $get_data_limit || !in_array($page,$avpg) || in_array($page,$folder)) {
    include "pages/404.php";
  }else{
    include "pages/{$page}.php";
  }
  include "components/foot.php";
?>