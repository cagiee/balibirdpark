<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= "{$h->base_url}assets/img/favicon.ico" ?>" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="<?= "{$h->base_url}assets/css/style.css" ?>">
  <?php
    $list = ["dashboard","customer","booking-list"];
    if(in_array($page,$list)){
      ?><link rel="stylesheet" href="<?= "{$h->base_url}assets/css/admin.css" ?>"><?php
    }
    $list = ["home","booking","customer-area","dashboard"];
    if(in_array($page,$list)){
      ?><link rel="stylesheet" href="<?= "{$h->base_url}assets/css/{$page}.css" ?>"><?php
    }
  ?>
  <title>Bali Bird Park</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>