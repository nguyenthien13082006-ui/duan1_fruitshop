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

      <!-- THỐNG KÊ TỔNG QUAN -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= number_format($tongSanPham) ?></h3>
              <p>Tổng số sản phẩm</p>
            </div>
            <div class="icon"><i class="fas fa-apple-alt"></i></div>
            <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= number_format($tongDanhMuc) ?></h3>
              <p>Tổng số danh mục</p>
            </div>
            <div class="icon"><i class="fas fa-th-large"></i></div>
            <a href="<?= BASE_URL_ADMIN . '?act=danh-muc' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= number_format($tongDonHang) ?></h3>
              <p>Tổng số đơn hàng</p>
            </div>
            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= number_format(count($khachHangs)) ?></h3>
              <p>Tổng số khách hàng</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.THỐNG KÊ TỔNG QUAN -->

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

          <!-- SẢN PHẨM SẮP HẾT HÀNG -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Sản phẩm sắp hết hàng</h3>

              <div class="card-tools">
                <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-tool btn-sm">
                  <i class="fas fa-external-link-alt"></i>
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
                        <?php $tonKho = (int)($sanPham['so_luong'] ?? 0); ?>
                        <span class="badge <?= $tonKho == 0 ? 'badge-danger' : ($tonKho <= 20 ? 'badge-warning' : 'badge-success') ?>">
                          <?= $tonKho ?>
                        </span>
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
        
        <!-- SẢN PHẨM BÁN CHẠY -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Sản phẩm bán chạy nhất</h3>
              <div class="card-tools">
                <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-tool btn-sm">
                  <i class="fas fa-external-link-alt"></i>
                </a>
              </div>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>Sản phẩm</th>
                    <th>Đã bán</th>
                    <th>Doanh thu</th>
                    <th>Đánh giá</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($topSanPhamBanChay)) : ?>
                    <?php foreach ($topSanPhamBanChay as $sp) : ?>
                      <tr>
                        <td>
                          <img src="<?= BASE_URL . ($sp['hinh_anh'] ?? '') ?>" class="img-circle img-size-32 mr-2">
                          <?= htmlspecialchars($sp['ten_san_pham'] ?? '') ?>
                        </td>
                        <td><?= number_format((int)($sp['sold_qty'] ?? 0)) ?></td>
                        <td><?= number_format((int)($sp['revenue'] ?? 0)) ?>đ</td>
                        <td>
                          <span style="white-space: nowrap;"><?= renderStarRating($sp['avg_rating'] ?? 0) ?></span>
                          <small class="text-muted">(<?= (int)($sp['so_luot_danh_gia'] ?? 0) ?>)</small>
                        </td>
                        <td>
                          <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . (int)$sp['id'] ?>" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="5" class="text-center">Chưa có dữ liệu bán hàng</td>
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

              <div class="position-relative mb-4">
                <canvas id="yearly-sales-chart" height="120"></canvas>
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

<?php
// Chuẩn bị dữ liệu cho biểu đồ từ controller
$dayLabels = [];
$dayData = [];
if (!empty($doanhThuNgay)) {
    foreach ($doanhThuNgay as $r) {
        $dayLabels[] = $r['day'];
        $dayData[] = (int)$r['revenue'];
    }
}

$monthLabels = [];
$monthData = [];
if (!empty($doanhThuThang)) {
    foreach ($doanhThuThang as $r) {
        $monthLabels[] = $r['month'];
        $monthData[] = (int)$r['revenue'];
    }
}

$yearLabels = [];
$yearData = [];
if (!empty($doanhThuNam)) {
    foreach ($doanhThuNam as $r) {
        $yearLabels[] = $r['year'];
        $yearData[] = (int)$r['revenue'];
    }
}
?>

<script>
  (function() {
    var dayLabels = <?= json_encode($dayLabels) ?>;
    var dayData = <?= json_encode($dayData) ?>;
    var monthLabels = <?= json_encode($monthLabels) ?>;
    var monthData = <?= json_encode($monthData) ?>;
    var yearLabels = <?= json_encode($yearLabels) ?>;
    var yearData = <?= json_encode($yearData) ?>;

    function makeLineChart(ctxId, labels, data, label, color) {
      var ctx = document.getElementById(ctxId);
      if (!ctx) return;
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: label,
            borderColor: color,
            data: data,
            fill: false
          }]
        },
        options: { responsive: true, maintainAspectRatio: false }
      });
    }

    makeLineChart('visitors-chart', dayLabels, dayData, 'Doanh thu (7 ngày)', '#007bff');
    makeLineChart('sales-chart', monthLabels, monthData, 'Doanh thu theo tháng', '#28a745');
    makeLineChart('yearly-sales-chart', yearLabels, yearData, 'Doanh thu theo năm', '#6c757d');
  })();
</script>

</body>

</html>