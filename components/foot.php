<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js" integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/animation.gsap.js"></script>
<script src="<?= $h->base_url ?>assets/js/script.js"></script>
<?php
    $list = ["dashboard","customer","booking-list"];
    if(in_array($page,$list)){
      ?><script src="<?= $h->base_url ?>assets/js/admin.js"></script><?php
    }
  ?>

</body>
</html>