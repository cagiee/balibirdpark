  <div id="topnav" class="scroll-top">
    <div id="box">
      <div class="left">
        <a id="nav-home"><img class="nav-logo" src="<?= "{$h->img_url}logo-w-text.png "?>" alt=""></a>
      </div>
      <div class="right">
        <div class="topnav-items">
          <a id="nav-activity">Activity</a>
        </div>
        <div class="topnav-items">
          <a id="nav-price">Price</a>
        </div>
        <div class="topnav-items">
          <a id="nav-maps">Maps</a>
        </div>
        <?php
          if(!$h->checkLog()){
            ?>
              <div class="topnav-items">
                <a id="sign-in">Sign In</a>
              </div>
              <div class="topnav-items">
                <a id="sign-up" class="sign-up">Sign Up</a>
              </div>
            <?php
          }else{
            ?>
              <div class="topnav-items">
                <a href="customer-area" class="nav-user">
                  <?= $h->user()['username'] ?>
                  <img width="24px" style="margin-left: 8px;" src="<?= $h->img_url."profile.png" ?>"/>
                </a>
              </div>
            <?php
          }
        ?>
      </div>
    </div>
  </div>
  <section id="banner">
    <div class="container">
      <img src="<?= "{$h->img_url}banner-bg.jpg "?>" alt="" class="hill">
      <img src="<?= "{$h->img_url}banner-bird-text.png "?>" alt="" class="person">
    </div>
  </section>
  <section id="content">
    <div class="container">
      <video width="100%" autoplay muted loop controls>
        <source src="<?= "{$h->base_url}assets/video/balibirdpark.mp4" ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video> 
      <div id="activity">
        <h2 class="section-heading">Activ<span>ities</span></h2>
        <div class="activity-list">
          <div class="activity-items" style="background: url(<?= "{$h->img_url}act01.jpg" ?>);background-size: cover;">
            <h1 class="activity-heading">Bali Rainforest</h1>
            <div class="activity-detail" id="act1">
              <p>
                <i class="fa fa-clock"></i> 10:30 & 16:00
              </p>
              <p>
                Marvel at our free flight show featuring macaws, storks, cockatoos and other birds as they soar through the sky - an amazing opportunity to see so many different birds in one environment.
              </p>
            </div>
            <button class="btn-activity" data-id="act1">Read More</button>
          </div>
          <div class="activity-items" style="background: url(<?= "{$h->img_url}act02.jpg" ?>);background-size: cover;">
            <h1 class="activity-heading">Lory Feeding</h1>
            <div class="activity-detail" id="act2">
              <p>
                <i class="fa fa-clock"></i> 10:30 & 16:00
              </p>
              <p>
                Marvel at our free flight show featuring macaws, storks, cockatoos and other birds as they soar through the sky - an amazing opportunity to see so many different birds in one environment.
              </p>
            </div>
            <button class="btn-activity" data-id="act2">Read More</button>
          </div>
          <div class="activity-items" style="background: url(<?= "{$h->img_url}act03.jpg" ?>);background-size: cover;">
            <h1 class="activity-heading">4D Theater</h1>
            <div class="activity-detail" id="act3">
              <p>
                <i class="fa fa-clock"></i> 10:30 & 16:00
              </p>
              <p>
                Marvel at our free flight show featuring macaws, storks, cockatoos and other birds as they soar through the sky - an amazing opportunity to see so many different birds in one environment.
              </p>
            </div>
            <button class="btn-activity" data-id="act3">Read More</button>
          </div>
          <div class="activity-items" style="background: url(<?= "{$h->img_url}act04.jpg" ?>);background-size: cover;">
            <h1 class="activity-heading">Pelican Feeding</h1>
            <div class="activity-detail" id="act4">
              <p>
                <i class="fa fa-clock"></i> 10:30 & 16:00
              </p>
              <p>
                Marvel at our free flight show featuring macaws, storks, cockatoos and other birds as they soar through the sky - an amazing opportunity to see so many different birds in one environment.
              </p>
            </div>
            <button class="btn-activity" data-id="act4">Read More</button>
          </div>
        </div>
      </div>
      <div id="price">
        <h2 class="section-heading">Pr<span>ice</span></h2>
        <div class="box">
          <div class="price-list">
            <i class="fa fa-feather-alt"></i>
            <h4 class="name">Balinese</h4>
            <h4>Enterance Ticket</h4>
            <h4>All bird shows & Activity</h4>
            <h4>Government tax & service charge</h4>
            <h4>&nbsp;</h4>
            <h4>Child: RP 35,000</h4>
            <h4>Adult: RP 70,000</h4>
            <a <?= $h->user()['role'] == "customer" ? 'href="booking"' : 'class="booking"'; ?>><button class="btn-price">Book Now</button></a>
          </div>
          <div class="price-list">
            <i class="fa fa-crow"></i>
            <h4 class="name">Indonesian</h4>
            <h4>Enterance Ticket</h4>
            <h4>All bird shows & Activity</h4>
            <h4>Government tax & service charge</h4>
            <h4>&nbsp;</h4>
            <h4>Child: RP 50,000</h4>
            <h4>Adult: RP 100,000</h4>
            <a <?= $h->user()['role'] == "customer" ? 'href="booking"' : 'class="booking"'; ?>><button class="btn-price">Book Now</button></a>
          </div>
          <div class="price-list">
            <i class="fa fa-dove"></i>
            <h4 class="name">Overseas</h4>
            <h4>Enterance Ticket</h4>
            <h4>All bird shows & Activity</h4>
            <h4>Government tax & service charge</h4>
            <h4>&nbsp;</h4>
            <h4>Child: RP 125,000</h4>
            <h4>Adult: RP 250,000</h4>
            <a <?= $h->user()['role'] == "customer" ? 'href="booking"' : 'class="booking"'; ?>><button class="btn-price">Book Now</button></a>
          </div>
          <div class="price-list">
            <i class="fa fa-crown"></i>
            <h4 class="name">VIP</h4>
            <h4>Enterance Ticket</h4>
            <h4>All bird shows & Activity</h4>
            <h4>All you can eat & Request 4D Movie</h4>
            <h4>&nbsp;</h4>
            <h4>Child: RP 475,000</h4>
            <h4>Adult: RP 750,000</h4>
            <a <?= $h->user()['role'] == "customer" ? 'href="booking"' : 'class="booking"'; ?>><button class="btn-price">Book Now</button></a>
          </div>
        </div>
      </div>
      <div id="maps">
        <h2 class="section-heading">Map<span>s</span></h2>
        <div class="box">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26482.63219242577!2d115.2428034391827!3d-8.600645558101974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23e4efac54c0f%3A0x5f8920acf656382c!2sBali%20Bird%20Park!5e0!3m2!1sen!2sid!4v1639461687872!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <div id="social-media">
        <h2 class="section-heading">Social <span>Media</span></h2>
        <div class="box">
          <div class="social-media-list">
            <i class="fab fa-facebook-square" style="color: blue;"></i>
            <h4>Facebook</h4>
            <h5>Bali Bird Park</h5>
          </div>
          <div class="social-media-list">
            <i class="fab fa-instagram" style="color: rgb(240, 15, 202);"></i>
            <h4>Instagram</h4>
            <h5>@balibirdparkofficial</h5>
          </div>
          <div class="social-media-list">
            <i class="fab fa-twitter" style="color: rgb(13, 201, 201);"></i>
            <h4>Twitter</h4>
            <h5>@balibirdpark</h5>
          </div>
          <div class="social-media-list">
            <i class="fab fa-youtube" style="color: red;"></i>
            <h4>Youtube</h4>
            <h5>Bali Bird Park</h5>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <p>Copyright&copy; <?= date("Y") ?> &nbsp;Cagie Mustika,&nbsp; All Right Reserved.</p>
    </div>
  </section>
  <div class="modal animate__animated" id="modal-login" style="display: none;">
    <div class="modal-box animate__animated animate__bounceOut">
      <form method="post" action="javascript:void(0)">
        <i class="fa fa-times close-modal close-modal-login"></i>
        <h4 class="modal-heading">Sign <span>In</span></h4>
        <div class="input-group-float animate__animated">
          <i class="fa fa-user"></i>
          <input type="text" autocomplete="off" name="usr" id="usr" placeholder="Username">
        </div>
        <div class="input-group-float animate__animated">
          <i class="fa fa-lock"></i>
          <input type="password" autocomplete="off" name="psw" id="psw" placeholder="Password">
        </div>
        <p>
          Create account? <a onclick="modalRegister()">Sign Up</a>
        </p>
        <p class="error animate__animated">
          
        </p>
        <button class="btn-modal green" id="btn-sign-in">
          <span>Sign In</span>
          <img src="<?= $h->img_url ?>loading-input.gif"/>
        </button>
      </form>
    </div>
    <div id="sign-in-void" class="void animate__animated animate__fadeOut"></div>
  </div>
  <div class="modal" id="modal-register" style="display: none;">
    <div class="modal-box animate__animated animate__bounceOut">
      <i class="fa fa-times close-modal-register"></i>
      <h4 class="modal-heading">Sign <span>Up</span></h4>
      <div class="input-group-float">
        <i class="fa fa-user"></i>
        <input type="text" autocomplete="off" name="usr" placeholder="Username">
      </div>
      <div class="input-group-float">
        <i class="fa fa-phone"></i>
        <input type="text" autocomplete="off" name="phn" placeholder="Phone">
      </div>
      <div class="input-group-float">
        <i class="fa fa-envelope"></i>
        <input type="text" autocomplete="off" name="eml" placeholder="Email">
      </div>
      <div class="input-group-float">
        <i class="fa fa-lock"></i>
        <input type="password" autocomplete="off" name="psw" placeholder="New password">
      </div>
      <div class="input-group-float">
        <i class="fa fa-lock"></i>
        <input type="password" autocomplete="off" name="psw" placeholder="Confirm password">
      </div>
      <p>
        Already have an account? <a onclick="modalLogin()">Sign In</a>
      </p>
      <button class="btn-modal green" id="btn-sign-up">Sign Up</button>
    </div>
    <div id="sign-up-void" class="void animate__animated animate__fadeOut"></div>
  </div>
  <script src="<?= "{$h->base_url}assets/js/home.js" ?>"></script>