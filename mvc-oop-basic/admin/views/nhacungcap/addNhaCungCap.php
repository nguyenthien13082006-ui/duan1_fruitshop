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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm nhà cung cấp</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= BASE_URL_ADMIN . '?act=them-nha-cung-cap' ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" name="ten_nha_cung_cap" placeholder="Nhập tên nhà cung cấp">
                                    <?php if (isset($errors['ten_nha_cung_cap'])) { ?>
                                        <p class="text-danger"><?= $errors['ten_nha_cung_cap'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="dia_chi" placeholder="Nhập địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="so_dien_thoai" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="mo_ta" class="form-control" placeholder="Nhập mô tả"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
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
