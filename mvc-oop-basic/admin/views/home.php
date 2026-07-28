<?php require './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Báo cáo thống kê</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- KHÁCH TRUY CẬP -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Khách truy cập cửa hàng</h3>

              </div>
            </div>

            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg"><?= number_format(count($khachHangs)) ?></span>
                  <span>Lượng khách truy cập theo thời gian</span>
                </p>

                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> <?= $tiLeKhachHang ?>%
                  </span>
                  <span class="text-muted">Tỉ lệ khách hàng / đơn hàng</span>
                </p>
              </div>

              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Tuần này
                </span>
                <span>
                  <i class="fas fa-square text-gray"></i> Tuần trước
                </span>
              </div>
            </div>
          </div>

          <!-- SẢN PHẨM -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Sản phẩm</h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">

                <thead>
                  <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>

                <tbody>

                  <?php foreach ($topSanPham as $sanPham) : ?>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL . ($sanPham['hinh_anh'] ?? '') ?>"
                          class="img-circle img-size-32 mr-2">

                        <?= htmlspecialchars($sanPham['ten_san_pham'] ?? 'Sản phẩm') ?>
                      </td>

                      <td>
                        <?= number_format((float)($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham'] ?? 0)) ?>đ
                      </td>

                      <td>
                        <?= (int)($sanPham['so_luong'] ?? 0) ?>
                      </td>

                      <td>
                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . (int)$sanPham['id'] ?>" class="text-muted">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>

                    </tr>
                  <?php endforeach; ?>

                  <?php if (empty($topSanPham)) : ?>
                    <tr>
                      <td colspan="4" class="text-center">
                        Chưa có dữ liệu sản phẩm
                      </td>
                    </tr>
                  <?php endif; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- DOANH THU -->
        <div class="col-lg-6">

          <div class="card">
            <div class="card-header border-0">

              <div class="d-flex justify-content-between">
                <h3 class="card-title">Doanh thu</h3>

              </div>

            </div>

            <div class="card-body">

              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">
                    <?= number_format($tongDoanhThu) ?>đ
                  </span>
                  <span>Doanh thu theo thời gian</span>
                </p>

                <p class="ml-auto d-flex flex-column text-right">

                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> <?= $tiLeChotDon ?>%
                  </span>

                  <span class="text-muted">
                    Tỉ lệ đơn hoàn thành
                  </span>

                </p>
              </div>

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">

                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Năm nay
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Năm trước
                </span>

              </div>

            </div>
          </div>


          <!-- TỔNG QUAN -->
          <div class="card">

            <div class="card-header border-0">
              <h3 class="card-title">Tổng quan cửa hàng</h3>

              <div class="card-tools">

                <a href="#" class="btn btn-sm btn-tool">
                  <i class="fas fa-download"></i>
                </a>

                <a href="#" class="btn btn-sm btn-tool">
                  <i class="fas fa-bars"></i>
                </a>

              </div>

            </div>

            <div class="card-body">

              <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                <p class="text-success text-xl">
                  <i class="ion ion-ios-refresh-empty"></i>
                </p>

                <p class="d-flex flex-column text-right">

                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-success"></i>
                    <?= $tiLeChotDon ?>%
                  </span>

                  <span class="text-muted">
                    TỈ LỆ CHUYỂN ĐỔI
                  </span>

                </p>

              </div>


              <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                <p class="text-warning text-xl">
                  <i class="ion ion-ios-cart-outline"></i>
                </p>

                <p class="d-flex flex-column text-right">

                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-warning"></i>
                    <?= number_format(count($donHangs)) ?>
                  </span>

                  <span class="text-muted">
                    ĐƠN HÀNG
                  </span>

                </p>

              </div>


              <div class="d-flex justify-content-between align-items-center mb-0">

                <p class="text-danger text-xl">
                  <i class="ion ion-ios-people-outline"></i>
                </p>

                <p class="d-flex flex-column text-right">

                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-danger"></i>
                    <?= number_format(count($khachHangs)) ?>
                  </span>

                  <span class="text-muted">
                    KHÁCH HÀNG
                  </span>

                </p>

              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include './views/layout/footer.php'; ?>

<script src="./assets/plugins/chart.js/Chart.min.js"></script>

<script>
  $(function() {

    var visitorsCtx = document.getElementById('visitors-chart');
    var salesCtx = document.getElementById('sales-chart');

    if (visitorsCtx) {

      new Chart(visitorsCtx, {

        type: 'line',

        data: {

          labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'CN'],

          datasets: [

            {
              label: 'Tuần này',
              borderColor: '#007bff',
              data: [120, 150, 170, 140, 180, 210, 190],
              fill: false
            },

            {
              label: 'Tuần trước',
              borderColor: '#ced4da',
              data: [100, 120, 130, 110, 150, 160, 155],
              fill: false
            }

          ]

        },

        options: {
          responsive: true,
          maintainAspectRatio: false
        }

      });

    }


    if (salesCtx) {

      new Chart(salesCtx, {

        type: 'line',

        data: {

          labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],

          datasets: [

            {
              label: 'Năm nay',
              borderColor: '#007bff',
              data: [12, 19, 14, 17, 22, 25],
              fill: false
            },

            {
              label: 'Năm trước',
              borderColor: '#6c757d',
              data: [10, 13, 11, 15, 18, 20],
              fill: false
            }

          ]

        },

        options: {
          responsive: true,
          maintainAspectRatio: false
        }

      });

    }

  });
</script>

</body>

</html>