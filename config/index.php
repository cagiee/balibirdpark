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
        if($user = $h->sf("*","user","user_id='$usr' AND password='$psw'") ?? []){
          if($user['status'] == "safe"){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['password'] = $user['password'];
            $response = array("status"=>"OK","message"=>"Signed In!","role" => $h->user()['role']);
          }else{
            $response = array("status" => "ERROR", "message" => "Your account was banned. Reason: {$user['description']}");
          }
        }
        $response = $h->sc("*","user","user_id='$usr' AND password='$psw'") > 0 ? $response : array("status"=>"ERROR","message"=>"Incorrect username or password!");
      }
      echo json_encode($response);
      break;
    
    case 'sign-out':
      session_destroy();
      $response = array("status" => "OK");
      echo json_encode($response);
      break;
    case 'sign-up':
      extract($_POST);
      $usr = $h->e($usr);
      $psw = md5($h->e($psw));
      $id = md5($usr);
      $q = false;
      if($h->sc("*","user","username='$usr' AND role='customer'") > 0){
        $message = "Username already taken. please use another username";
      }else if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9_]+$/', $usr)) {
        $message = "Username is invalid! username only can contain alhphanumeric and underscore (_)";
      }else if ($h->sc("*","user","email='$eml' AND role='customer'") > 0) {
        $message = "The email address is already registered. please use another email address";
      }else{
        $q = $h->i("user","'$id','$eml','$psw','$usr','$phn','customer','safe',''");
        $message = $q ? "Signed Up" : "Something wrong with the system. Try again later.";
      }
      $status = $q ? "SUCCESS" : "ERROR";
      $response = array("status" => $status, "message" => $message);
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
      $payment_method_list = ["paypal","bca","bri","bni"];
      $booking_price = $child * $child_price + $adult * $adult_price;
      if($date == "" || !in_array($payment_method, $payment_method_list)){
        $response = array("status" => "ERROR", "message" => "Some strange data was found in the process. Please use our system well");
      }else{
        $id = $h->generateKey();
        $q = $h->i("booking","'$id','$package','$child','$adult','{$h->user()['user_id']}','$date','$booking_price','$payment_method',now(),'paid'");
        $status = $q ? "OK" : "ERROR";
        $message = $q ? "Booking succesfully" : "Something wrong with the system. Try again later.";
        $response = array("status" => $status, "message" => $message);
      }
      echo json_encode($response);
      break;
    case 'update-profile':
      extract($_POST);
      $q = $h->u("user","email='$email',phone='$phone'","user_id='{$h->user()['user_id']}' AND role='customer'");
      $status = $q ? "OK" : "ERROR";
      $message = $q ? "Profile updated" : "There are some problems with the system, please try again later";
      $response = array("status" => $status,"message" =>$message);
      echo json_encode($response);
      break;
    case 'change-password':
      extract($_POST);
      $psw_old = md5($psw_old);
      $psw_new = md5($psw_new);
      if ($psw_old == $h->user()['password']) {
        $q = $h->u("user","password='{$psw_new}'","user_id='{$h->user()['user_id']}' AND role='customer'");
        $_SESSION['password'] = $q ? $psw_new : $_SESSION['password'];
        $status = $q ? "OK" : "ERROR";
        $message = $q ? "Password changed" : "Something wrong in the system! Please try again later";
      }else{
        $status = "ERROR";
        $message = "Wrong old password";
      }
      $response = array("status" => $status,"message" => $message);
      echo json_encode($response);
      break;
    // ===== END CUSTOMER =====

    // ===== ADMIN =====
    case 'ban-customer':
      extract($_POST);
      $user_status = !isset($reason) ? "safe" : "banned";
      @$description = !isset($reason) ? "" : $reason;
      $q = $h->u("user","status='$user_status',description='$description'","role='customer' AND user_id='$id'");
      $status = $q ? "OK" : "ERROR";
      $response = array("status" => $status,"user_status" => $q);
      echo json_encode($response);
      break;
    case 'active-booking':
      extract($_POST);
      $q = $h->u("booking","booking_status='actived'","booking_id='$id'");
      $status = $q ? "OK" : "ERROR";
      $message = $q ? "Booking actived" : "Activing booking failed";
      $response = array("status" => $status,"message" => $message);
      echo json_encode($response);
      break;
    case 'change-customer-password':
      extract($_POST);
      $password = md5($password);
      $q = $h->u("user","password='$password'","role='customer' AND user_id='$id'");
      $status = $q ? "OK" : "ERROR";
      $message = $q ? "Password changed" : "Something wrong in the system! Please try again later";
      $response = array("status" => $status,"message" => $message);
      echo json_encode($response);
      break;
    // ===== END ADMIN =====
    default:
      # code...
      break;
  }

?>