<?php
class Helper{
  public $con;
  public $base_url;
  public $do_url;
  public $img_url;
  public $user = [];
  
  // function
  function __construct(){
    @$this->con = mysqli_connect("localhost","root","","balibirdpark");
    $this->base_url="http://{$_SERVER['HTTP_HOST']}/";
    $this->do_url="http://{$_SERVER['HTTP_HOST']}/config/?do=";
    $this->img_url="http://{$_SERVER['HTTP_HOST']}/assets/img/";
    if (!$this->con) {
      echo "<h2>Error Connecting Database!</h2>";
      die();
    }else{
      session_start();
    }
  }

  public function checkLog()
  {
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
      return $this->sc("*","user","user_id='{$_SESSION['user_id']}'") > 0;
    else
      return false;
  }

  public function user()
  {
    $user = $this->checkLog() ? $this->sf("*","user","user_id='{$_SESSION['user_id']}' AND password='{$_SESSION['password']}'") : ["role" => "guest"];
    return $user;
  }

  public function fdate($value)
  {
    $month = [null, "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novermber", "December"];
    $y = explode("-",$value)[0];
    $m = $month[(int)explode("-",$value)[1]];
    $d = explode("-",$value)[2];
    return "{$d} {$m} {$y}";
  }

  public function s($field,$table,$cond="1='1'"){
    $query = mysqli_query($this->con,"SELECT {$field} FROM {$table} WHERE {$cond}");
    return $query;}

  public function c($query){
    $result = mysqli_num_rows($query);
    return $result;}

  public function sc($field,$table,$cond="1='1'"){
    $query = mysqli_query($this->con,"SELECT {$field} FROM {$table} WHERE {$cond}");
    $result = mysqli_num_rows($query);
    return $result;}

  public function sf($field,$table,$cond="1='1'"){
    $query = mysqli_query($this->con,"SELECT {$field} FROM {$table} WHERE {$cond}");
    $result = mysqli_fetch_assoc($query);
    return $result;}

  public function f($query){
    $result = mysqli_fetch_assoc($query);
    return $result;}

  public function i($table,$val){
    $query = mysqli_query($this->con,"INSERT INTO {$table} VALUES ({$val})");
    return $query;}

  public function d($table,$cond){
    $query = mysqli_query($this->con,"DELETE FROM {$table} WHERE {$cond}");
    return $query;}

  public function u($table,$val,$cond){
    $query = mysqli_query($this->con,"UPDATE {$table} SET {$val} WHERE {$cond}");
    return $query;}

  public function e($val)
  {
    $result = mysqli_real_escape_string($this->con,$val);
    return $result;
  }
  // end function
}