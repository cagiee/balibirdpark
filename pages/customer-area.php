<?php include "./components/loading.php"; ?>
<div class="container">
  <div class="heading">
    <a href="<?= $h->base_url ?>"><img src="<?= "{$h->img_url}logo.png" ?>" alt=""></a>
    <h4>Customer Area</h4>
  </div>
  <div class="box">
    <div class="left">
      <div>
        <img class="background" src="<?= $h->img_url ?>customer-area-bg.jpg" alt="">
        <img class="profile" src="<?= $h->img_url ?>profile.png" alt="">
        <div id="pp-box">
          <div id="profile">
            <h4 class="left-title">Profile</h4>
            <div class="input-group-float">
              <i class="fad fa-user"></i>
              <input type="text" autocomplete="off" value="<?= $h->user()['username'] ?>" placeholder="Username" readonly>
            </div>
            <div class="input-group-float">
              <i class="fad fa-envelope"></i>
              <input type="text" id="profile-email" autocomplete="off" value="<?= $h->user()['email'] ?>" placeholder="Email">
            </div>
            <div class="input-group-float">
              <i class="fad fa-phone"></i>
              <input type="text" id="profile-phone" autocomplete="off" value="<?= $h->user()['phone'] ?>" placeholder="Phone">
            </div>
            <div id="profile-button">
              <div id="set-1">
                <button id="btn-cp">Change Password</button>
                <button id="btn-so">Sign Out</button>
              </div>
              <div id="set-2" style="display: none;">
                <button id="btn-sc">Save Change</button>
                <button id="btn-cl-1">Cancel</button>
              </div>
            </div>
          </div>
          <div id="change-password" style="display: none;">
            <h4 class="left-title">Change Password</h4>
            <div class="input-group-float">
              <i class="fad fa-lock"></i>
              <input type="password" autocomplete="off" id="psw_old" placeholder="Old Password">
            </div>
            <div class="input-group-float">
              <i class="fad fa-lock"></i>
              <input type="password" autocomplete="off" id="psw_new" placeholder="New Password">
            </div>
            <div class="input-group-float">
              <i class="fad fa-lock"></i>
              <input type="password" autocomplete="off" id="psw_cfm" placeholder="Confirm Password">
            </div>
            <div id="change-password-button">
              <button id="btn-ch">Change</button>
              <button id="btn-cl-2">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="right">
      <h4 class="title">My Booking</h4>
      <div class="booking-filter">
        <a href="<?= $h->base_url ?>customer-area/"><div class="filter-items <?= !isset($url[1]) ? "active" : ""?>">All</div></a>
        <a href="<?= $h->base_url ?>customer-area/paid"><div class="filter-items <?= $url[1] == "paid" ? "active" : ""?>">Paid</div></a>
        <a href="<?= $h->base_url ?>customer-area/actived"><div class="filter-items <?= $url[1] == "actived" ? "active" : ""?>">Actived</div></a>
      </div>
      <div class="booking-data">
        <?php
          if(!isset($url[1]))
            $cond = "1='1'";
          else if($url[1] == "paid")
            $cond = "booking_status = 'paid'";
          else if($url[1] == "actived")
            $cond = "booking_status = 'actived'";
          $q = $h->s("*","booking","customer_id='{$h->user()['user_id']}' AND $cond");
          while ($data = $h->f($q)) {
            if ($data['package'] == "balinese") {
              $icon = "feather-alt";
            }else if ($data['package'] == "indonesian") {
              $icon = "crow";
            }else if ($data['package'] == "overseas") {
              $icon = "dove";
            }else if ($data['package'] == "vip") {
              $icon = "crown";
            }
            ?>
              <div class="data-items">
                <div class="data-head">
                  <div class="left">
                    <i class="data-icon fa fa-<?= $icon ?>"></i>
                    <h4 class="data-package">Package <?= $data['package'] ?></h4>
                    <h4 class="data-status <?= $data['booking_status'] ?>"><?= $data['booking_status'] ?></h4>
                  </div>
                  <div class="right">
                    <h4 class="data-paid-date">RP <?= number_format($data['booking_price']) ?> Paid on <?= $data['payment_date'] ?></h4>
                  </div>
                </div>
                <div class="data-body">
                  <h4 class="data-id">ID. <?= $data['booking_id'] ?></h4>
                  <h4 class="data-pax">
                    <?= $data['adult'] > 0 ? '<i class="fad fa-child"></i> Adult x '.$data['adult'] : ""  ?> 
                    <?= $data['adult'] > 0 && $data['child'] > 0 ? '&nbsp;+&nbsp;' : ''; ?>
                    <?= $data['child'] > 0 ? '<i class="fad fa-baby"></i> Child x '.$data['child'] : ""  ?> 
                  <h4 class="data-date"><i class="fad fa-calendar"></i> <?= $h->fdate($data['booking_date']) ?></h4>
                  <h4 class="data-loc"><i class="fad fa-map-marker-alt"></i> Bali Bird Park</h4>
                </div>
              </div>
            <?php
          }
        ?>
        <div class="data-items-empty">
          <a href="booking"><button>Booking Now</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const [email,phone] = ["<?= $h->user()["email"] ?>","<?= $h->user()["phone"] ?>"];
</script>
<script src="<?= $h->base_url ?>assets/js/customer-area.js"></script>