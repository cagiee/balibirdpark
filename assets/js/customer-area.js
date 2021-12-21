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
$("#btn-cl").click(function() {
  $("#btn-cp").click();
})
const xml = new XMLHttpRequest();
const do_url = window.location.origin + "/config/?do=";
$("#btn-so").click(function(){
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
})