<?php
  if(empty($_POST)){
    die();
  }
  
  include "helper.php";
  $h = new Helper();

  $do = $_GET['do'] ?? "";

  switch ($do) {

    // ===== USER SIGN =====
    case 'sign-in':
      $usr = $h->e($_POST["usr"]);
      $psw = $h->e($_POST["psw"]);
      [$response,$message] = "";
      if($usr == "" || $psw == ""){
        if($usr == ""){
          $message = "Username is empty!";
        }
        if($psw == ""){
          $message = "Password is empty!";
        }
        if($usr == "" && $psw == ""){
          $message = "Username and Password is empty!";
        }
        $response = array("status"=>"ERROR","message"=>$message);
      }else{
        $usr = md5($h->e($_POST["usr"]));
        $psw = md5($h->e($_POST["psw"]));
        $response = $h->sc("*","user","user_id='$usr' AND password='$psw'") > 0 ? array("status"=>"OK","message"=>"Signed In!","role" => $h->user()['role']) : array("status"=>"ERROR","message"=>"Incorrect username or password!");
        if($user = $h->sf("*","user","user_id='$usr' AND password='$psw'") ?? []){
          if($user['status'] == "safe"){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['password'] = $user['password'];
          }else{
            $response = array("status" => "ERROR", "message" => "Your account was banned. Reason: {$user['description']}");
          }
        }
      }
      echo json_encode($response);
      break;
    
    case 'sign-out':
      session_destroy();
      $response = array("status" => "OK");
      echo json_encode($response);
      break;
    // ===== END USER SIGN =====

    // ===== CUSTOMER =====
    case 'booking':
      extract($_POST);
      switch ($package) {
        case 'balinese':
          $child_price = 35000;
          $adult_price = 75000;
          break;
    
        case 'indonesian':
          $child_price = 50000;
          $adult_price = 100000;
          break;
    
        case 'overseas':
          $child_price = 125000;
          $adult_price = 250000;
          break;
    
        case 'vip':
          $child_price = 475000;
          $adult_price = 750000;
          break;
    
        default:
          break;
      }
      $booking_price = $child * $child_price + $adult * $adult_price;
      if($date != ""){
        $q = $h->i("booking","'','$package','$child','$adult','{$h->user()['user_id']}','$date','$booking_price',now(),'paid'");
        $status = $q ? "OK" : "ERROR";
        $message = $q ? "Booking succesfully" : "Something wrong with the system. Try again later.";
        $response = array("status" => $status, "message" => $message);
      }else{
        $response = array("status" => "ERROR", "message" => "Date is empty");
      }
      echo json_encode($response);
      break;
    // ===== END CUSTOMER =====
    default:
      # code...
      break;
  }

?>