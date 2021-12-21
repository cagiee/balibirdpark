<?php
  if (!isset($h)) {
    die();
  }
?>
<div class="sidenav">
  <img class="sidenav-bg" src="<?= $h->img_url ?>customer-area-bg.jpg" alt="">
  <div class="profile">
    <img class="sidenav-av" src="<?= $h->img_url ?>profile.png" alt="">
    <div>
      <div>
        <h4 class="username"><?= $h->user()['username'] ?></h4>
      </div>
      <div>
        <a id="sign-out">Sign out <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
  <div class="sidenav-content">
    <a href="dashboard">
      <div class="sidenav-items <?= $page == 'dashboard' ? 'active' : '' ?>">
        <i class="far fa-home"></i>
        <h4>Dashboard</h4>
      </div>
    </a>
    <a href="customer">
      <div class="sidenav-items <?= $page == 'customer' ? 'active' : '' ?>">
        <i class="far fa-users"></i>
        <h4>Customer</h4>
      </div>
    </a>
    <a href="booking-list">
      <div class="sidenav-items <?= $page == 'booking-list' ? 'active' : '' ?>">
        <i class="far fa-file-invoice"></i>
        <h4>Booking List</h4>
      </div>
    </a>
  </div>
</div>