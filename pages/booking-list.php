<div class="admin-body" id="booking-list-page">
  <?php include "./components/loading.php"; ?>
  <?php include "./components/sidenav.php"; ?>
  <div class="content">
    <div class="topnav">
      <div class="left">
        <h4>Booking List</h4>
      </div>
    </div>
    <div class="container">
      <div class="data-filter">
        <div class="data-filter-items <?= !isset($url[1]) ? 'selected' : '' ?>">
          <a href="<?= $h->base_url ?>booking-list">All</a>
        </div>
        <div class="data-filter-items <?= $url[1] == 'today' ? 'selected' : '' ?>">
          <a href="<?= $h->base_url ?>booking-list/today">Today</a>
        </div>
        <div class="data-filter-items <?= $url[1] == 'paid' ? 'selected' : '' ?>">
          <a href="<?= $h->base_url ?>booking-list/paid">Paid</a>
        </div>
        <div class="data-filter-items <?= $url[1] == 'actived' ? 'selected' : '' ?>">
          <a href="<?= $h->base_url ?>booking-list/actived">Actived</a>
        </div>
      </div>
      <table class="data-table" id="table-customer">
        <thead>
          <tr>
            <td>ID <i class="fa fa-sort"></i></td>
            <td>Customer <i class="fa fa-sort"></i></td>
            <td>Package <i class="fa fa-sort"></i></td>
            <td>Pax <i class="fa fa-sort"></i></td>
            <td>Date <i class="fa fa-sort"></i></td>
            <td>Status <i class="fa fa-sort"></i></td>
            <td>Payment</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $cond = "1='1'";
            @$status = $url[1] ?? "";
            $status_list = ["today","paid","actived"];
            if(!in_array($status,$status_list) && count($url) > 1){
              header("location:{$h->base_url}booking-list");
            }else{
              if ($status == "today") {
                $date = getdate();
                $cond = "booking_date='{$date['year']}-{$date['mon']}-{$date['mday']}'";
              }else if($status == "paid" || $status == "actived"){
                $cond = "booking_status='{$status}'";
              }
            }
            $q = $h->s("*","booking",$cond);
            while ($data = $h->f($q)) {
              $customer = $h->sf("*","user","user_id='{$data['customer_id']}'");
              ?>
                <tr>
                  <td><?= $data['booking_id'] ?></td>
                  <td><?= $customer['username'] ?></td>
                  <td><span class="data-status <?= $data['package'] ?>"><?= $data['package'] ?></span></td>
                  <td>
                    <?= $data['adult'] > 0 ? "<i class='data-icon fa fa-child'></i> {$data['adult']}" : '' ?>
                    <?= $data['adult'] > 0 && $data['child'] > 0 ? " + " : '' ?>
                    <?= $data['child'] > 0 ? "<i class='data-icon fa fa-baby'></i> {$data['child']}" : '' ?>
                  </td>
                  <td><?= ($data['booking_date']) ?></td>
                  <td><span class="data-status <?= $data['booking_status'] ?>"><?= $data['booking_status'] ?></span></td>
                  <td>
                    <button class="btn-detail-payment" data-method="<?= $data['payment_method'] ?>" data-price="<?= $data['booking_price'] ?>" data-date="<?= $data['payment_date'] ?>">View</button></td>
                  <td>
                    <?php
                      if($data['booking_status'] == "paid"){
                        ?>
                          <button class="btn-active" data-id="<?= $data['booking_id'] ?>" data-name="<?= $customer['username'] ?>">Active</button>
                        <?php
                      }else{
                        ?>
                          <button class="btn-actived">Active</button>
                        <?php
                      }
                    ?>
                  </td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
  $(function () {
    $('#table-customer').DataTable();
  })
</script>