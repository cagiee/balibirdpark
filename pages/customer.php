<div class="admin-body">
  <?php include "./components/sidenav.php"; ?>
  <div class="content">
    <div class="topnav">
      <div class="left">
        <h4>Customer</h4>
      </div>
    </div>
    <div class="container">
      <!-- <?= md5("nicolatesla") ?> -->
      <table class="data-table" id="table-customer">
        <thead>
          <tr>
            <td>Username <i class="fa fa-sort"></i></td>
            <td>Booked <i class="fa fa-sort"></i></td>
            <td>Email <i class="fa fa-sort"></i></td>
            <td>Phone <i class="fa fa-sort"></i></td>
            <td>Status <i class="fa fa-sort"></i></td>
            <td>Description <i class="fa fa-sort"></i></td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $q = $h->s("*","user","role='customer'");
            while ($data = $h->f($q)) {
              ?>
                <tr>
                  <td><?= $data['username'] ?></td>
                  <td><?= $h->sc("*","booking","customer_id='{$data['user_id']}'") ?></td>
                  <td><?= $data['email'] ?></td>
                  <td><?= $data['phone'] ?></td>
                  <td><span class="data-status <?= $data['status'] ?>"><?= $data['status'] ?></span></td>
                  <td><?= $data['description'] == "" ? '-' :  "<button class='btn-desc' onclick='Swal.fire(`Description`,`{$data['description']}`)'>View</button>" ?></td>
                  <td>
                    <?php
                      if($data['status'] == "safe"){
                        ?>
                          <button class="btn-ban">Ban</button>
                        <?php
                      }else{
                        ?>
                          <button class="btn-unban">Unban</button>
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