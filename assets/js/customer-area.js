$("#btn-cp").click(function() {
  if($("#profile").css("display") != "none"){
    $("#profile").slideToggle();
    setTimeout(() => {
      $("#change-password").css("display") == $("#profile").css("display") ? $("#change-password").slideToggle() : '';
    }, 500);
  }else{
    $("#change-password").slideToggle();
    setTimeout(() => {
      $("#profile").slideToggle();
    }, 500);
  }
});
$("#btn-cl-2").click(function() {
  $("#btn-cp").click();
})
const xml = new XMLHttpRequest();
const do_url = window.location.origin + "/config/?do=";
$("#btn-so").click(function(){
  Swal.fire({
    icon: "warning",
    title: "WARNING",
    text: "Are you want to sign out?",
    showCancelButton: true,
    confirmButtonText: "Sign Out"
  }).then((result) => {
    if(result.isConfirmed){
      xml.open(`post`,`${do_url}sign-out`,true);
      xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
      xml.send("do=sign-out");
      xml.onreadystatechange = function() {
        if(xml.readyState == 4 && xml.status == 200){
          let response = JSON.parse(xml.responseText);
          if(response.status == "OK")
            location.href=window.location.origin;
          else
            alert("Opss! Something wrong please try again.");
        }
      }
    }
  })
})
$("#profile-email").on("input",function () {
  $("#set-1").slideUp(250);
  setTimeout(() => {
    $("#set-2").slideDown();
  }, 250);
})
$("#btn").click(function () {
  Swal.fire({
    icon: "success",
    title: "berhasil",
    text: "asdjaskd"
  })
})
$("#profile-phone").on("input",function () {
  $("#set-1").slideUp(250);
  setTimeout(() => {
    $("#set-2").slideDown();
  }, 250);
})
$("#btn-cl-1").click(function () {
  $("#profile-email").val(email);
  $("#profile-phone").val(phone);
  $("#set-2").slideUp(250);
  setTimeout(() => {
    $("#set-1").slideDown();
  }, 250);
})
$("#btn-sc").click(function () {
  $("#loading-screen").show();
  let new_email = $("#profile-email").val();
  let new_phone = $("#profile-phone").val();
  xml.open(`post`,`${do_url}update-profile`,true);
  xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
  xml.send(`email=${new_email}&phone=${new_phone}`);
  xml.onreadystatechange = function () {
    if(xml.readyState == 4 && xml.status == 200){
      $("#loading-screen").hide();
      let response = JSON.parse(xml.responseText);
      Swal.fire({
        icon: response.status == "OK" ? "success" : "error",
        title: response.status == "OK" ? "SUCCESS" : "ERROR",
        text: response.message
      }).then(() => {
        if(response.status == "OK"){
          location.reload();
        }
      })
    }
  }
})
$("#btn-ch").click(function () {
  let psw_old = $("#psw_old").val();
  let psw_new = $("#psw_new").val();
  let psw_cfm = $("#psw_cfm").val();
  let warning_message = "";
  if(psw_old == "" || psw_new == "" || psw_cfm == ""){
    warning_message = "Please fill all form before change password";
  }else if(psw_new != psw_cfm){
    warning_message = "Confirm password doesn't match with your new password!";
  }else if(psw_new.length < 8 || psw_new.length > 16 || psw_new.match(/^[0-9a-zA-Z]+$/) == null){
    warning_message = "New password is invalid! Please use min. 8 character and max. 16 character without special character (only number and alphabet)";
  }else{
    warning_message = "";
  }
  
  if(warning_message != ""){
    Swal.fire({
      icon: "warning",
      title: "WARNING",
      text: warning_message
    }).then(() => {
      if (psw_old == "")
        $("#psw_old").focus();
      else if (psw_new == "")
        $("#psw_new").focus();
      else if (psw_cfm == "")
        $("#psw_cfm").focus();
    })
  }
  else{
    $("#loading-screen").show();
    xml.open(`post`,`${do_url}change-password`,true);
    xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xml.send(`psw_old=${psw_old}&psw_new=${psw_new}&psw_cfm=${psw_cfm}`);
    xml.onreadystatechange = function () {
      if(xml.readyState == 4 && xml.status == 200){
        $("#loading-screen").hide();
        let response = JSON.parse(xml.responseText);
        console.log(response);
        Swal.fire({
          icon: response.status == "OK" ? "success" : "error",
          title: response.status == "OK" ? "SUCCESS" : "ERROR",
          text: response.message
        }).then(() => {
          if(response.status == "OK"){
            location.reload();
          }else{
            $("#psw_old").val("");
            $("#psw_old").focus();
          }
        })
      }
    }
  }
})