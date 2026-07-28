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

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img style="width: 400px; height: 400px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">Tên sản phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
            <hr>
            <h4 class="mt-3">Giá tiền: <small><?= $sanPham['gia_san_pham'] ?></small></h4>
            <h4 class="mt-3">Giá khuyến mãi: <small><?= $sanPham['gia_khuyen_mai'] ?></small></h4>
            <h4 class="mt-3">Số lượng: <small><?= $sanPham['so_luong'] ?></small></h4>
            <h4 class="mt-3">Lượt xem: <small><?= $sanPham['luot_xem'] ?></small></h4>
            <h4 class="mt-3">Ngày nhập: <small><?= $sanPham['ngay_nhap'] ?></small></h4>
            <h4 class="mt-3">Danh mục: <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
            <h4 class="mt-3">Trạng thái: <small><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h4>
            <h4 class="mt-3">Mô tả: <small><?= $sanPham['mo_ta'] ?></small></h4>
            <!-- <h4>Available Colors</h4>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-default text-center active">
                <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                Green
                <br>
                <i class="fas fa-circle fa-2x text-green"></i>
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                Blue
                <br>
                <i class="fas fa-circle fa-2x text-blue"></i>
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                Purple
                <br>
                <i class="fas fa-circle fa-2x text-purple"></i>
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                Red
                <br>
                <i class="fas fa-circle fa-2x text-red"></i>
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                Orange
                <br>
                <i class="fas fa-circle fa-2x text-orange"></i>
              </label>
            </div>

            <h4 class="mt-3">Size <small>Please select one</small></h4>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                <span class="text-xl">S</span>
                <br>
                Small
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                <span class="text-xl">M</span>
                <br>
                Medium
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                <span class="text-xl">L</span>
                <br>
                Large
              </label>
              <label class="btn btn-default text-center">
                <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                <span class="text-xl">XL</span>
                <br>
                Xtra-Large
              </label>
            </div> -->


          </div>
        </div>
       
        <ul class="nav nav-tabs row mt-4" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Bình luận của sản phẩm</button>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>tên người bình luận</th>
                      <th>Nội dung</th>
                      <th>Ngày đăng</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Nguyễn Duy Mạnh</td>
                      <td>Sản phẩm hơi cũ</td>
                      <td>20/04/2024</td>
                      <td>
                        <div class="btn-group">
                          <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                          <a href="#"><button class="btn btn-danger">Xóa</button></a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Lê Đức Hòa</td>
                      <td>Sản phẩm hơi xấu</td>
                      <td>20/04/2023</td>
                      <td>
                        <div class="btn-group">
                          <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                          <a href="#"><button class="btn btn-danger">Xóa</button></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
          </div>


        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function() {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>

</html>