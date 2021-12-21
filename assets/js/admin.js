const xml = new XMLHttpRequest();
const do_url = window.location.origin + "/config/?do=";
$("#sign-out").click(function(){
  xml.open(`post`,`${do_url}sign-out`,true);
  xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
  xml.send("do=sign-out");
  xml.onreadystatechange = function() {
    if(xml.readyState == 4 && xml.status == 200){
      let response = JSON.parse(xml.responseText);
      if(response.status == "OK")
        location.href = window.location.origin;
      else
        alert("Opss! Something wrong please try again.");
    }
  }
})