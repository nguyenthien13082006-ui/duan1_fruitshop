<!-- Header -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- Sidebar -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý nhà cung cấp</h1>
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
              <a href="<?= BASE_URL_ADMIN . '?act=form-them-nha-cung-cap' ?>">
                <button class="btn btn-success">Thêm nhà cung cấp</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($listNhaCungCap) && is_array($listNhaCungCap)): ?>
                    <?php foreach ($listNhaCungCap as $key => $nhaCungCap): ?>
                      <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $nhaCungCap['ten_nha_cung_cap'] ?></td>
                        <td><?= $nhaCungCap['dia_chi'] ?></td>
                        <td><?= $nhaCungCap['so_dien_thoai'] ?></td>
                        <td><?= $nhaCungCap['mo_ta'] ?></td>
                        <td>
                          <a href="<?= BASE_URL_ADMIN . '?act=form-sua-nha-cung-cap&id_nha_cung_cap=' . $nhaCungCap['id'] ?>">
                            <button class="btn btn-warning">Sửa</button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=xoa-nha-cung-cap&id_nha_cung_cap=' . $nhaCungCap['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà cung cấp này?')">
                            <button class="btn btn-danger">Xóa</button>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Mô tả</th>
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
  });
</script>
</body>
</html>
