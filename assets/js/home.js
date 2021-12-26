$(function () {
  if ($(window).scrollTop() < 400)
    $("#topnav").addClass("scroll-top");
  else
    $("#topnav").removeClass("scroll-top");
  $("#sign-in").click(function () {
    modalLogin();
  })
  $("#sign-up").click(function () {
    modalRegister();
  })
  $("#sign-in-void").click(function () {
    modalLogin();
  })
  $("#sign-up-void").click(function () {
    modalRegister();
  })
  $(".close-modal-login").click(function () {
    modalLogin();
  })
  $(".close-modal-register").click(function () {
    modalRegister();
  })
  $(".btn-activity").click(function () {
    let id = $(this).attr('data-id');
    let deg = "0";
    $(".activity-detail").slideUp();
    if ($(`#${id}`).css("display") == "none") {
      deg = "90";
      $(`#${id}`).slideDown();
      $(this).find(".fa").css("transform", `rotate(${deg}deg)`);
    }
  })
  $("#nav-activity").click(function () {
    $(window).scrollTop($("#activity").offset().top - 120);
  })
  $("#nav-price").click(function () {
    $(window).scrollTop($("#price").offset().top - 120);
  })
  $("#nav-maps").click(function () {
    $(window).scrollTop($("#maps").offset().top - 120);
  })
  $("#nav-home").click(function () {
    $(window).scrollTop(0);
  })
  $(".booking").click(function () {
    modalLogin();
  })
})

$(window).on('scroll', function () {
  for (let i = 0; i < $(".activity-detail").length; i++) {
    let el = $(".activity-detail")[i];
    if ($(el).css("display") != "none") {
      $(el).slideUp();
    }
  }
  $(".btn-activity").find(".fa").css("transform", `rotate(0deg)`);
  if ($(window).scrollTop() < 400){
    $("#topnav").addClass("scroll-top");
    $("#topnav-wrapper").css('background-color','transparent');
    $("#topnav-wrapper").css('box-shadow','none');
  }
  else{
    $("#topnav").removeClass("scroll-top");
    $("#topnav-wrapper").css('background-color','#fff');
    $("#topnav-wrapper").css('box-shadow','0px 0px 10px rgba(0,0,0,.1)');
  }
})

function modalLogin() {
  let delay = 0;
  if ($("#modal-register").css("display") == "flex") {
    modalRegister();
    delay = 500;
  }
  setTimeout(() => {
    $("#modal-login").find(".void").toggleClass("animate__fadeIn");
    $("#modal-login").find(".void").toggleClass("animate__fadeOut");
    $("#modal-login").find(".modal-box").toggleClass("animate__bounceIn");
    $("#modal-login").find(".modal-box").toggleClass("animate__bounceOut");
    let timeout = $("#modal-login").css("display") == "flex" ? 500 : 0;
    let overflow = timeout == "500" ? "auto" : "hidden";
    $("html").css("overflow", overflow);
    setTimeout(() => {
      $("#modal-login").toggle();
      let error = $("#modal-login").find(".error")[0];
      $(error).html(``);
    }, timeout);
  }, delay);
}

function modalRegister() {
  let delay = 0;
  if ($("#modal-login").css("display") == "flex") {
    modalLogin();
    delay = 500;
  }
  setTimeout(() => {
    $("#modal-register").find(".void").toggleClass("animate__fadeIn");
    $("#modal-register").find(".void").toggleClass("animate__fadeOut");
    $("#modal-register").find(".modal-box").toggleClass("animate__bounceIn");
    $("#modal-register").find(".modal-box").toggleClass("animate__bounceOut");
    let timeout = $("#modal-register").css("display") == "flex" ? 500 : 0;
    let overflow = timeout == "500" ? "auto" : "hidden";
    $("html").css("overflow", overflow);
    setTimeout(() => {
      $("#modal-register").toggle();
    }, timeout);
  }, delay);
}

// ======= AJAX =======

var do_url = window.location.origin + "/config/?do=";
var xml = new XMLHttpRequest();

function switchButtonLoading(id, action) {
  let btn = $(`#${id}`);
  let txt = $(btn).find("span")[0];
  let img = $(btn).find("img")[0];
  if (action == "show") {
    $(txt).hide();
    $(img).show();
    $("#btn-sign-in").attr("disabled", "true");
  } else if (action == "hide") {
    $(txt).show();
    $(img).hide();
    $("#btn-sign-in").removeAttr("disabled");
  }
}

$("#btn-sign-in").click(function () {
  switchButtonLoading("btn-sign-in", "show");
  xml.open('post', `${do_url}sign-in`, true);
  xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

  let usr = $("#usr").val();
  let psw = $("#psw").val();

  xml.send(`usr=${usr}&psw=${psw}`);
  xml.onreadystatechange = function () {
    let error = $("#modal-login").find(".error")[0];
    if (xml.readyState == 4 && xml.status == 200) {
      console.log(xml.responseText);
      let response = JSON.parse(xml.responseText)
      if (response.status == 'OK') {
        $(error).html(``);
        location.href = response.role == "customer" ? "customer-area" : "";
      } else {
        $(error).addClass("animate__fadeIn");
        $(error).html(`<i class="fa fa-exclamation-circle"></i> ${response.message}`);
        switchButtonLoading("btn-sign-in", "hide");
      }
    }
  }
})

$("#btn-sign-up").click(function () {
  let usr = $("#up_usr").val();
  let phn = $("#phn").val();
  let eml = $("#eml").val();
  let psw = $("#up_psw").val();
  let cfpsw = $("#cfpsw").val();
  loading = false;

  let error = $("#modal-register").find(".error")[0];

  if (usr == "" || phn == "" || eml == "" || psw == "" || cfpsw == "") {
    $(error).addClass("animate__fadeIn");
    $(error).html(`<i class="fa fa-exclamation-circle"></i> Please fill in all fields to sign up`);
  } else if(isNaN(phn)){
    $(error).addClass("animate__fadeIn");
    $(error).html(`<i class="fa fa-exclamation-circle"></i> Phone number require numberic only!`);
  } else if(!ValidateEmail(eml)){
    $(error).addClass("animate__fadeIn");
    $(error).html(`<i class="fa fa-exclamation-circle"></i> Invalid email!`);
  } else if(psw.length < 8 || psw.length > 16){
    $(error).addClass("animate__fadeIn");
    $(error).html(`<i class="fa fa-exclamation-circle"></i> Password length must be in 8 - 16 character!`);
  } else if(psw != cfpsw){
    $(error).addClass("animate__fadeIn");
    $(error).html(`<i class="fa fa-exclamation-circle"></i> Confirm password doesn't match!`);
  } else {
    switchButtonLoading("btn-sign-up", "show");
    xml.open('post', `${do_url}sign-up`, true);
    xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xml.send(`usr=${usr}&psw=${psw}&phn=${phn}&eml=${eml}`);
    xml.onreadystatechange = function () {
      if (xml.readyState == 4 && xml.status == 200) {
        let response = JSON.parse(xml.responseText);
        if (response.status == "SUCCESS") {
          $(error).hide();
          loading = true;
          $("#usr").val(usr);
          $("#psw").val(psw);
          $("#btn-sign-in").click();
        } else {
          switchButtonLoading("btn-sign-up", "hide");
          $(error).addClass("animate__fadeIn");
          $(error).html(`<i class="fa fa-exclamation-circle"></i> ${response.message}!`);
        }
      }
    }
  }
})

$('#up_usr').keyup(function (e) {
  if ((e.which < 65 && e.which != 8) || e.which > 90 || e.which == 32) {
    return false;
  }
});
$("#up_usr").on('input', function () {
  $(this).val($(this).val().replace(/[^\w\s]+/g, ''));
  $(this).val($(this).val().replace(" ", ''));
})

function ValidateEmail(value) {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (value.match(mailformat)) {
    return true;
  } else {
    return false;
  }
}

$(function () {
  let width = ($(window).width());
  let url = window.location.origin;
  let el = $(".person")[0];
  if(width < 1024){
    $(el).attr("src",`${url}/assets/img/banner-bird.png`);
    $(el).css("width","400px");
    $(el).css("margin-top","140px");
  }else{
    $(el).attr("src",`${url}/assets/img/banner-bird-text.png`);
  }
})