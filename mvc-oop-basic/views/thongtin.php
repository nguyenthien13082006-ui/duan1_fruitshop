<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<main>

    <!-- breadcrumb -->
    <div class="breadcrumb-area">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                </li>
                <li>Tài khoản</li>
            </ul>
        </div>
    </div>

    <!-- main -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">

                    <!-- LEFT -->
                    <!-- <div class="col-lg-6">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">

                                <h6>Thông tin nhanh</h6>

                                <table class="table">
                                    <tr>
                                        <td>Avatar</td>
                                        <td>
                                            <img src="<?= BASE_URL . $user['anh_dai_dien'] ?>"
                                                width="60"
                                                class="rounded-circle"
                                                onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td><?= $user['email'] ?></td>
                                    </tr>

                                    <tr>
                                        <td>Trạng thái</td>
                                        <td>
                                            <span class="badge bg-success">Hoạt động</span>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                            <a href="<?= BASE_URL . '?act=lich_su_mua_hang' ?>"
                                class="btn btn-sqr d-block">
                                Xem đơn hàng
                            </a>
                        </div>
                    </div> -->
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="<?= BASE_URL . '?act=dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                                <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-cart-arrow-down"></i>
                                    Orders</a>
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-credit-card"></i>
                                    Payment
                                    Method</a>
                                <a href="<?= BASE_URL . '?act=thong-tin-ca-nhan' ?>"><i class="fa fa-user"></i> Account
                                    Details</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- RIGHT -->

                        <div class="col-lg-9">
                            <div class="myaccount-content">
                                <h5>Account Details</h5>

                                <div class="account-details-form">
                                    <form action="<?= BASE_URL . '?act=update-profile' ?>" method="post">

                                        <?php
                                        $parts = explode(' ', $user['ho_ten']);
                                        $first = $parts[0] ?? '';
                                        $last = implode(' ', array_slice($parts, 1));
                                        ?>


                                        <div class="single-input-item">
                                            <label class="required">Display Name</label>
                                            <input type="text" name="ho_ten"
                                                placeholder="Display Name"
                                                value="<?= $user['ho_ten'] ?>" />
                                        </div>

                                        <div class="single-input-item">
                                            <label class="required">Email Address</label>
                                            <input type="email" name="email"
                                                value="<?= $user['email'] ?>" readonly />
                                        </div>

                                        <div class="single-input-item">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="so_dien_thoai"
                                                value="<?= $user['so_dien_thoai'] ?? '' ?>" />
                                        </div>

                                        <div class="single-input-item">
                                            <label>Địa chỉ</label>
                                            <input type="text" name="dia_chi"
                                                value="<?= $user['dia_chi'] ?? '' ?>" />
                                        </div>

                                        <fieldset>
                                            <legend>Đổi mật khẩu</legend>

                                            <div class="single-input-item">
                                                <label>Mật khẩu hiện tại</label>
                                                <input type="password" name="current_password"
                                                    placeholder="Current Password" />
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label>Mật khẩu mới</label>
                                                        <input type="password" name="new_password"
                                                            placeholder="New Password" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label>Xác nhận mật khẩu</label>
                                                        <input type="password" name="confirm_password"
                                                            placeholder="Confirm Password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- ALERT -->
                                        <?php if (isset($_SESSION['success'])): ?>
                                            <div class="alert alert-success">
                                                <?= $_SESSION['success'];
                                                unset($_SESSION['success']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['error'])): ?>
                                            <div class="alert alert-danger">
                                                <?= $_SESSION['error'];
                                                unset($_SESSION['error']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="single-input-item">
                                            <button class="btn btn-sqr">Save Changes</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</main>

<!-- Modernizer JS -->
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<!-- slick Slider JS -->
<script src="assets/js/plugins/slick.min.js"></script>
<!-- Countdown JS -->
<script src="assets/js/plugins/countdown.min.js"></script>
<!-- Nice Select JS -->
<script src="assets/js/plugins/nice-select.min.js"></script>
<!-- jquery UI JS -->
<script src="assets/js/plugins/jqueryui.min.js"></script>
<!-- Image zoom JS -->
<script src="assets/js/plugins/image-zoom.min.js"></script>
<!-- Images loaded JS -->
<script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
<!-- mail-chimp active js -->
<script src="assets/js/plugins/ajaxchimp.js"></script>
<!-- contact form dynamic js -->
<script src="assets/js/plugins/ajax-mail.js"></script>
<!-- google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
<!-- google map active js -->
<script src="assets/js/plugins/google-map.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>