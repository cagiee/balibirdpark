<div class="container">
  <div class="heading">
    <a href="<?= $h->base_url ?>"><img src="<?= "{$h->img_url}logo.png" ?>" alt=""></a>
    <h4>Customer Area</h4>
  </div>
  <div class="box">
    <div class="left">
      <div>
        <img class="background" src="./assets/img/customer-area-bg.jpg" alt="">
        <img class="profile" src="./assets/img/profile.png" alt="">
        <div id="pp-box">
          <div id="profile">
            <h4 class="left-title">Profile</h4>
            <div class="input-group-float">
              <i class="fa fa-user"></i>
              <input type="text" autocomplete="off" name="usr" value="<?= $h->user()['username'] ?>" placeholder="Username" readonly>
            </div>
            <div class="input-group-float">
              <i class="fa fa-envelope"></i>
              <input type="text" autocomplete="off" name="eml" value="<?= $h->user()['email'] ?>" placeholder="Email">
            </div>
            <div class="input-group-float">
              <i class="fa fa-phone"></i>
              <input type="text" autocomplete="off" name="phn" value="<?= $h->user()['phone'] ?>" placeholder="Phone">
            </div>
            <div id="profile-button">
              <div id="set-1">
                <button id="btn-cp">Change Password</button>
                <button id="btn-so">Sign Out</button>
              </div>
            </div>
          </div>
          <div id="change-password" style="display: none;">
            <h4 class="left-title">Change Password</h4>
            <div class="input-group-float">
              <i class="fa fa-lock"></i>
              <input type="password" autocomplete="off" name="psw_old" placeholder="Old Password">
            </div>
            <div class="input-group-float">
              <i class="fa fa-lock"></i>
              <input type="password" autocomplete="off" name="psw_new" placeholder="New Password">
            </div>
            <div class="input-group-float">
              <i class="fa fa-lock"></i>
              <input type="password" autocomplete="off" name="psw_cfm" placeholder="Confirm Password">
            </div>
            <div id="change-password-button">
              <button id="btn-cl">Cancel</button>
              <button id="btn-ch">Change</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="right">
      <h4 class="title">My Booking</h4>
      <div class="booking-data">
        <?php
          $q = $h->s("*","booking","customer_id='{$h->user()['user_id']}'");
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
                    <?= $data['adult'] > 0 ? '<i class="fa fa-child"></i> Adult x '.$data['adult'] : ""  ?> 
                    <?= $data['adult'] > 0 && $data['child'] > 0 ? '&nbsp;+&nbsp;' : ''; ?>
                    <?= $data['child'] > 0 ? '<i class="fa fa-baby"></i> Child x '.$data['child'] : ""  ?> 
                  <h4 class="data-date"><i class="fa fa-calendar"></i> <?= $h->fdate($data['booking_date']) ?></h4>
                  <h4 class="data-loc"><i class="fa fa-map-marker-alt"></i> Bali Bird Park</h4>
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
<script src="./assets/js/customer-area.js"></script>