var [child, adult, child_price, adult_price, package] = [0, 1, 50000, 100000, "indonesian"];

$(".package-items").click(function () {
  $(".package-items").removeClass("active");
  $(this).addClass("active");
  let id = $(this).attr("id");
  package = id;
  let top = id == "balinese" || id == "indonesian" ? 0 : 50;
  let left = id == "balinese" || id == "overseas" ? 0 : 50;
  $("#package-bg").css("top", `${top}%`);
  $("#package-bg").css("left", `${left}%`);
  switch (id) {
    case 'balinese':
      child_price = 35000;
      adult_price = 75000;
      break;

    case 'indonesian':
      child_price = 50000;
      adult_price = 100000;
      break;

    case 'overseas':
      child_price = 125000;
      adult_price = 250000;
      break;

    case 'vip':
      child_price = 475000;
      adult_price = 750000;
      break;

    default:
      break;
  }
  refreshPrice();
})
$(".add").click(function () {
  let el = $(this).prev()[0];
  let num = parseInt($(el).val());
  $(el).val(num + 1);
  if ($(el).attr("name") == "child")
    child++;
  else if ($(el).attr("name") == "adult")
    adult++;
  refreshPrice();
})
$(".rmv").click(function () {
  let el = $(this).next()[0];
  let num = parseInt($(el).val());
  if (num > 0) {
    $(el).val(num - 1);
    if ($(el).attr("name") == "child")
      child--;
    else if ($(el).attr("name") == "adult")
      adult--;
  } else {
    $(el).val(0);
  }
  refreshPrice();
})
$(".age").on('input', function (e) {
  let el = $(e.target);
  if ($(el).val() < 0 || isNaN($(el).val()) || $(el).val() == "") {
    if ($(el).val() < 0 || isNaN($(el).val()))
      $(el).val(0);
    if ($(el).attr("name") == "child")
      child = 0;
    else if ($(el).attr("name") == "adult")
      adult = 0;
  } else {
    if ($(el).attr("name") == "child")
      child = $(el).val();
    else if ($(el).attr("name") == "adult")
      adult = $(el).val();
  }
  refreshPrice();
})
$(".age").on('focus', function (e) {
  let el = $(e.target);
  if ($(el).val() == 0) {
    $(el).val(null);
  }
})
$(".age").on('blur', function (e) {
  let el = $(e.target);
  if ($(el).val() == "") {
    $(el).val(0);
    if ($(el).attr("name") == "child")
      child = 0;
    else if ($(el).attr("name") == "adult")
      adult = 0;
  } else {
    if ($(el).attr("name") == "child")
      child = $(el).val();
    else if ($(el).attr("name") == "adult")
      adult = $(el).val();
  }
  refreshPrice();
})
// Booking Date
$(function () {
  var today = new Date();
  var dd = today.getDate() + 1;
  var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }

  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("date").setAttribute("min", today);

  
  var tday = new Date();
  tday.setDate(tday.getDate() + 28)
  var d = tday.getDate();
  var m = tday.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
  var y = tday.getFullYear();
  if (d < 10) {
    d = '0' + d
  }
  if (m < 10) {
    m = '0' + m
  }

  tday = y + '-' + m + '-' + d;
  document.getElementById("date").setAttribute("max", tday);
  refreshPrice();
})

function formatRupiah(num) {
  var reverse = num.toString().split('').reverse().join('');
  var rupiah = reverse.match(/\d{1,3}/g);
  rupiah = rupiah.join(',').split('').reverse().join('');
  return rupiah;
}

function refreshPrice() {

  if (package != "balinese" && package != "indonesian" && package != "overseas" && package != "vip") {
    location.reload();
  }

  $("#price-child").text(`RP ${formatRupiah(child_price)} / pax`);
  $("#price-adult").text(`RP ${formatRupiah(adult_price)} / pax`);
  $("#subtotal-child").text(`RP ${formatRupiah(child_price * child)}`);
  $("#subtotal-adult").text(`RP ${formatRupiah(adult_price * adult)}`);
  $("#grand-total").text(`RP ${formatRupiah(child_price * child + adult_price * adult)}`)
  $("#amount_child").text(child);
  $("#amount_adult").text(adult);
  if (child > 0)
    $("#child").show();
  else
    $("#child").hide();
  if (adult > 0)
    $("#adult").show();
  else
    $("#adult").hide();
  if (child > 0 && adult > 0)
    $("#apc").show();
  else
    $("#apc").hide();

  switch (package) {
    case 'balinese':
      child_price = 35000;
      adult_price = 75000;
      break;

    case 'indonesian':
      child_price = 50000;
      adult_price = 100000;
      break;

    case 'overseas':
      child_price = 125000;
      adult_price = 250000;
      break;

    case 'vip':
      child_price = 475000;
      adult_price = 750000;
      break;
  }
}

var base_url = window.location.origin;
var do_url = window.location.origin + "/config/?do=";
var xml = new XMLHttpRequest();

$(".payment-items").click(function () {
  $(".radio").removeClass("checked");
  let el = $(this).find(".radio")[0];
  $(el).addClass("checked");
})

function formatDate(value) {
  const month = [null, "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novermber", "December"];
  let y = value.split("-")[0];
  let m = month[parseInt(value.split("-")[1])];
  let d = value.split("-")[2];
  return `${d} ${m} ${y}`;
}

function modalPayment() {
  refreshPrice();
  if (package == "balinese" || package == "indonesian" || package == "overseas" || package == "vip") {
    if ($("#date").val() != "") {
      let icon;
      if (package == "balinese")
        icon = "feather-alt";
      else if (package == "indonesian")
        icon = "crow";
      else if (package == "overseas")
        icon = "dove";
      else if (package == "vip")
        icon = "crown";
      $("#modal-icon").removeClass("fa-question");
      $("#modal-icon").addClass(`fa-${icon}`);
      $("#modal-package").text(package);
      $("#modal-child").text(child);
      $("#modal-adult").text(adult);
      $("#modal-date").text(formatDate($("#date").val()));
      $("#modal-price").html(formatRupiah(child_price * child + adult_price * adult));
      $("#modal-payment").find(".void").toggleClass("animate__fadeIn");
      $("#modal-payment").find(".void").toggleClass("animate__fadeOut");
      $("#modal-payment").find(".modal-box").toggleClass("animate__bounceIn");
      $("#modal-payment").find(".modal-box").toggleClass("animate__bounceOut");
      let timeout = $("#modal-payment").css("display") == "flex" ? 500 : 0;
      let overflow = timeout == "500" ? "auto" : "hidden";
      $("html").css("overflow", overflow);
      setTimeout(() => {
        $("#modal-payment").toggle();
      }, timeout);
    }
  }
}

var modal_payment_is_closable = true;

$("#btn-confirm").click(function () {
  modalPayment();
})

$("#btn-modal-back").click(function () {
  modal_payment_is_closable ? modalPayment() : '';
})

$("#payment-void").click(function () {
  modal_payment_is_closable ? modalPayment() : '';
})

$("#btn-payment").click(function () {
  modal_payment_is_closable = false;
  $("#step-1").slideUp();
  $("#step-2").slideDown();
  setTimeout(() => {
    let date = $("#date").val();
    let data = `package=${package}&child=${child}&adult=${adult}&date=${date}`;
    xml.open(`post`, `${do_url}booking`, true);
    xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xml.send(data);
    xml.onreadystatechange = function () {
      if (xml.readyState == 4 && xml.status == 200) {
        let response = JSON.parse(xml.responseText);
        if (response.status == "OK") {
          $("#payment-icon").attr("img", `${base_url}/assets/img/success.gif`);
          $("#payment-status").text("Payment successful");
          setTimeout(() => {
            location.href = "customer-area";
          }, 2400);
        } else {
          $("#payment-status").text("Payment unsuccesful");
          location.href = "";
        }
      }
    }
  }, 1000);
})