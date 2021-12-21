<div class="container">
  <form method="post" action="javascript:void(0)">
    <div class="left">
      <div class="heading">
        <a href="<?= $h->base_url ?>"><img src="<?= "{$h->img_url}logo-w-text.png" ?>" alt=""></a>
        <h4>Booking</h4>
      </div>
      <div class="input-group">
        <h4 class="label">Select Package</h4>
        <div id="package">
          <div id="package-bg"></div>
          <div class="package-items" id="balinese">
            <i class="fa fa-feather-alt"></i> Balinese
          </div>
          <div class="package-items active" id="indonesian">
            <i class="fa fa-crow"></i> Indonesian
          </div>
          <div class="package-items" id="overseas">
            <i class="fa fa-dove"></i> Overseas
          </div>
          <div class="package-items" id="vip">
            <i class="fa fa-crown"></i> VIP
          </div>
        </div>
      </div>
      <div class="booking-box">
        
        <div class="input-group">
          <h4 class="label">Child <small>(3 - 12)</small></h4>
          <div class="input-wrapper">
            <div class="rmv"><i class="fa fa-minus"></i></div>
            <input type="text" class="age" min="0" value="0" name="child" autocomplete="off">
            <div class="add"><i class="fa fa-plus"></i></div>
          </div>
        </div>
    
        <div class="input-group">
          <h4 class="label">Adult <small>(13+)</small></h4>
          <div class="input-wrapper">
            <div class="rmv"><i class="fa fa-minus"></i></div>
            <input type="text" class="age" min="1" value="1" name="adult" autocomplete="off">
            <div class="add"><i class="fa fa-plus"></i></div>
          </div>
        </div>
    
        <div class="input-group">
          <h4 class="label">Date</h4>
          <div class="input-wrapper">
            <input id="date" type="date" autocomplete="off" required>
          </div>
        </div>
    
      </div>
      <div class="input-group">
        <h4 class="label">Booking</h4>
        <div class="payment-box">
          <div>
            <i class="fa fa-baby"></i>
            <h4 class="title">Child</h4>
            <h4 class="note" id="price-child">RP ??? / pax</h4>
            <h4 class="price" id="subtotal-child">RP ???</h4>
          </div>
          <div>
            <i class="fa fa-child"></i>
            <h4 class="title">Adult</h4>
            <h4 class="note" id="price-adult">RP ??? / pax</h4>
            <h4 class="price" id="subtotal-adult">RP ???</h4>
          </div>
          <div>
            <i class="fa fa-dollar-sign"></i>
            <h4 class="title">Grand Total</h4>
            <h4 class="note"><span id="child" style="display: none;"><span id="amount_child">???</span> Child</span><span id="apc"> + </span><span id="adult"><span id="amount_adult">???</span> Adult</span></h4>
            <h4 class="price" id="grand-total">RP ???</h4>
          </div>
        </div>
        <button type="submit" id="btn-confirm">Confirm</button>
      </div>
    </div>
  </form>
  <div style="background: url(<?= $h->img_url ?>booking.jpg) center; background-size: cover;">
  </div>
</div>
<div class="modal animate__animated" id="modal-payment" style="display: none;">
  <div class="modal-box animate__animated animate__bounceOut">
    <div id="step-1">
      <h4 class="modal-heading">Pay<span>ment</span></h4>
      <p>Booking Summary</p>
      <div class="booking-summary">
        <div class="data-head">
          <div class="top">
            <i class="data-icon fa fa-question" id="modal-icon"></i>
            <h4 class="data-package">Package <span id="modal-package" style="text-transform: capitalize;">???</span></h4>
          </div>
        </div>
        <div class="data-body">
          <h4 class="data-pax"><i class="fa fa-child"></i> Adult x <span id="modal-adult">???</span> &nbsp;+&nbsp; <i class="fa fa-baby"></i> Child x <span id="modal-child">???</span></h4>
          <h4 class="data-date"><i class="fa fa-calendar"></i> <span id="modal-date">???</span></h4>
          <h4 class="data-loc"><i class="fa fa-map-marker-alt"></i> Bali Bird Park</h4>
          <h4 class="data-price">RP <span id="modal-price">???</span></h4>
        </div>
      </div>
      <p>Select your payment method</p>
      <div class="payment-method">
        <div class="payment-items">
          <div class="radio checked"></div>
          <img src="<?= $h->img_url ?>paypal.png" alt="">
        </div>
        <div class="payment-items">
          <div class="radio"></div>
          <img src="<?= $h->img_url ?>bca.png" alt="">
        </div>
        <div class="payment-items">
          <div class="radio"></div>
          <img src="<?= $h->img_url ?>bri.png" alt="">
        </div>
        <div class="payment-items">
          <div class="radio"></div>
          <img src="<?= $h->img_url ?>bni.png" alt="">
        </div>
      </div>
      <button class="btn-modal io-green" id="btn-modal-back">
        <span>Back</span>
      </button>
      <button class="btn-modal green" id="btn-payment">
        <span>Finish and Pay</span>
        <img src="<?= $h->img_url ?>loading-input.gif"/>
      </button>
    </div>
    <div id="step-2" style="display: none;">
      <img id="payment-icon" src="<?= $h->img_url ?>payment.gif" alt="">
      <h4 id="payment-status">Payment in process</h4>
    </div>
  </div>
  <div id="payment-void" class="void animate__animated animate__fadeOut"></div>
</div>

<script src="<?= $h->base_url ?>assets/js/booking.js"></script>