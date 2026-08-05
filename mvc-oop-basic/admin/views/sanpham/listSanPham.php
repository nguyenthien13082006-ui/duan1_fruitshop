<!-- header -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý danh sách sản phẩm</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
              <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
          <?php endif; ?>
          <div class="card">
            <div class="card-header">
              <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham' ?>">
                <button class="btn btn-success">Thêm sản phẩm</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Giá KM</th>
                    <th>Tồn kho</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp</th>
                    <th>Xuất xứ</th>
                    <th>Đơn vị</th>
                    <th>Tình trạng kho</th>
                    <th>Trạng thái bán</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listSanPham as $key => $sanPham): ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $sanPham['ma_san_pham'] ?? ('SP' . str_pad($sanPham['id'], 4, '0', STR_PAD_LEFT)) ?></td>
                      <td><?= $sanPham['ten_san_pham'] ?></td>
                      <td>
                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px;" alt=""
                          onerror="this.onerror=null; this.src='https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482887opc/anh-mo-ta.png'">
                      </td>
                      <td><?= number_format($sanPham['gia_san_pham']) ?>đ</td>
                      <td><?= $sanPham['gia_khuyen_mai'] ? number_format($sanPham['gia_khuyen_mai']) . 'đ' : '—' ?></td>
                      <td>
                        <form action="<?= BASE_URL_ADMIN . '?act=cap-nhat-so-luong' ?>" method="POST" class="form-inline" style="flex-wrap: nowrap;">
                          <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                          <input type="number" name="so_luong" min="0" value="<?= $sanPham['so_luong'] ?>" style="width: 70px;" class="form-control form-control-sm mr-1">
                          <button type="submit" class="btn btn-sm btn-outline-primary" title="Cập nhật tồn kho"><i class="fas fa-sync-alt"></i></button>
                        </form>
                      </td>
                      <td><?= $sanPham['ten_danh_muc'] ?></td>
                      <td><?= $sanPham['ten_nha_cung_cap'] ?? '' ?></td>
                      <td><?= $sanPham['xuat_xu'] ?? '' ?></td>
                      <td><?= $sanPham['don_vi_tinh'] ?? 'kg' ?></td>
                      <td>
                        <?php if ((int)$sanPham['so_luong'] > 0): ?>
                          <span class="badge badge-success">Còn hàng</span>
                        <?php else: ?>
                          <span class="badge badge-danger">Hết hàng</span>
                        <?php endif; ?>
                      </td>
                      <td><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán'; ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                            <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                            <button class="btn btn-warning"><i class="fas fa-cogs"></i></button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=xoa-san-pham&id_san_pham=' . $sanPham['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                          </a>
                        </div>

                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Giá KM</th>
                    <th>Tồn kho</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp</th>
                    <th>Xuất xứ</th>
                    <th>Đơn vị</th>
                    <th>Tình trạng kho</th>
                    <th>Trạng thái bán</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer -->

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->
</body>

</html>