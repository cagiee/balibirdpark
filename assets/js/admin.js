const xml = new XMLHttpRequest();
const do_url = window.location.origin + "/config/?do=";
$("#sign-out").click(function () {
  Swal.fire({
    icon: "warning",
    title: "WARNING",
    text: "Are you want to sign out?",
    showCancelButton: true,
    confirmButtonText: "Sign Out"
  }).then((result) => {
    if(result.isConfirmed){
      xml.open(`post`, `${do_url}sign-out`, true);
      xml.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      xml.send("do=sign-out");
      xml.onreadystatechange = function () {
        if (xml.readyState == 4 && xml.status == 200) {
          let response = JSON.parse(xml.responseText);
          if (response.status == "OK")
            location.href = window.location.origin;
          else
            alert("Opss! Something wrong please try again.");
        }
      }
    }
  })
})
$(".btn-ban").click(function () {
  let id = $(this).attr('data-id');
  let name = $(this).attr('data-name');
  Swal.fire({
    icon: "warning",
    title: "WARNING",
    text: `Are you sure you want to ban "${name}" ?`,
    showCancelButton: true,
    confirmButtonText: "Ban",
    confirmButtonColor: "#e92f2f"
  }).then(async (result) => {
    if (result.isConfirmed) {
      const {
        value: reason
      } = await Swal.fire({
        input: 'textarea',
        inputLabel: 'Ban Reason',
        inputPlaceholder: 'Type your reason here...',
        inputAttributes: {
          'aria-label': 'Type your reason here'
        },
        showCancelButton: true
      })
      if (reason) {
        xml.open(`post`, `${do_url}ban-customer`, true);
        xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        xml.send(`reason=${reason}&id=${id}`);
        xml.onreadystatechange = function () {
          if (xml.readyState == 4 && xml.status == 200) {
            let response = JSON.parse(xml.responseText);
            if (response.status == "OK") {
              location.reload();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Something wrong in the system! Please try again later"
              })
            }
          }
        }
      }
    }
  })
})
$(".btn-unban").click(function () {
  let id = $(this).attr('data-id');
  let name = $(this).attr('data-name');
  Swal.fire({
    icon: "warning",
    title: "WARNING",
    text: `Are you sure you want to unban "${name}" ?`,
    showCancelButton: true,
    confirmButtonText: "Ban",
    confirmButtonColor: "#e92f2f"
  }).then(async (result) => {
    if (result.isConfirmed) {
      xml.open(`post`, `${do_url}ban-customer`, true);
      xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
      xml.send(`id=${id}`);
      xml.onreadystatechange = function () {
        if (xml.readyState == 4 && xml.status == 200) {
          let response = JSON.parse(xml.responseText);
          if (response.status == "OK") {
            location.reload();
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Something wrong in the system! Please try again later"
            })
          }
        }
      }
    }
  })
})
function formatRupiah(num) {
  var reverse = num.toString().split('').reverse().join('');
  var rupiah = reverse.match(/\d{1,3}/g);
  rupiah = rupiah.join(',').split('').reverse().join('');
  return rupiah;
}
$(".btn-detail-payment").click(function () {
  let method = $(this).attr("data-method");
  let price = $(this).attr("data-price");
  let date = $(this).attr("data-date");
  Swal.fire({
    imageUrl: `${window.location.origin}/assets/img/${method}.png`,
    imageHeight: 36,
    imageAlt: "Loading image...",
    html: `<b>RP ${formatRupiah(price)}</b> has been paid with <b style="text-transform:uppercase;">${method}</b><br/>on <b>${date}</b>`
  })
})
$(".btn-active").click(function () {
  let id = $(this).attr("data-id");
  let username = $(this).attr("data-name");
  if (id && username) {
    Swal.fire({
      icon: 'warning',
      title: 'WARNING',
      html: `Active Booking with ID <b>${id}</b> with customer named <b>${username}</b>?`,
      showCancelButton: true,
      confirmButtonText: "Confirm"
    }).then((result) => {
      if(result.isConfirmed){
        $("#loading-screen").show();
        xml.open(`post`,`${do_url}active-booking`,true);
        xml.setRequestHeader('content-type','application/x-www-form-urlencoded');
        xml.send(`id=${id}`);
        xml.onreadystatechange = function () {
          if(xml.readyState == 4 && xml.status == 200){
            let response = JSON.parse(xml.responseText);
            if(response.status == "OK"){
              setTimeout(() => {
                location.reload();
              }, 1500);
            }else{
              $("#loading-screen").hide();
              Swal.fire({
                icon: "error",
                title: "ERROR",
                text: response.message
              })
            }
          }
        }
      }
    })
  }
})
$(".btn-change-password").click(async function () {
  let id = $(this).attr("data-id");
  let name = $(this).attr("data-name");
  const {
    value: password
  } = await Swal.fire({
    input: 'password',
    inputLabel: `Change Password for ${name}`,
    inputPlaceholder: 'Type new password here...',
    inputAttributes: {
      'aria-label': 'Type new password here'
    },
    showCancelButton: true
  })
  if (password) {
    xml.open(`post`, `${do_url}change-customer-password`, true);
    xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xml.send(`id=${id}&password=${password}`);
    xml.onreadystatechange = function () {
      if (xml.readyState == 4 && xml.status == 200) {
        let response = JSON.parse(xml.responseText);
        if (response.status == "OK") {
          location.reload();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message
          })
        }
      }
    }
  }
})