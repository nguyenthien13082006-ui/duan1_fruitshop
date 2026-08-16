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
                    <h1>Quản lý tài khoản quản trị viên</h1>
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
                            <h3 class="card-title">Thêm tài khoản quản trị</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= BASE_URL_ADMIN . '?act=them-quan-tri' ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" class="form-control" name="ho_ten" placeholder="Nhập họ tên" value="<?= $_SESSION['old_data']['ho_ten'] ?? '' ?>">
                                    <?php if(isset($_SESSION['error']['ho_ten'])){?>
                                        <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Nhập email" value="<?= $_SESSION['old_data']['email'] ?? '' ?>">
                                    <?php if(isset($_SESSION['error']['email'])){?>
                                        <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="so_dien_thoai" placeholder="Nhập số điện thoại" value="<?= $_SESSION['old_data']['so_dien_thoai'] ?? '' ?>">
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu">
                                    <?php if(isset($_SESSION['error']['mat_khau'])){?>
                                        <p class="text-danger"><?= $_SESSION['error']['mat_khau'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái tài khoản</label>
                                    <select id="inputStatus" name="trang_thai" class="form-control custom-select">
                                        <option value="1" <?= (($_SESSION['old_data']['trang_thai'] ?? 1) == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="2" <?= (($_SESSION['old_data']['trang_thai'] ?? 1) == 2) ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <?php if(isset($_SESSION['error']['trang_thai'])){?>
                                        <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>
                                    <?php } ?>
                                </div>

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