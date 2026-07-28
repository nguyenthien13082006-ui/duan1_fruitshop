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
                <li>Báo cáo thống kê</li>
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
                                <a href="<?= BASE_URL . '?act=dashboard' ?>"><i class="fa fa-bar-chart"></i> Báo cáo thống kê</a>
                                <a href="<?= BASE_URL . '?act=lich_su_mua_hang' ?>"><i class="fa fa-cart-arrow-down"></i>
                                    Đơn hàng</a>
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-credit-card"></i>
                                    Thanh toán</a>
                                <a href="<?= BASE_URL . '?act=thong-tin-ca-nhan' ?>"><i class="fa fa-user"></i> Tài khoản
                                </a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- RIGHT -->

                        <div class="col-lg-9">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                <div class="myaccount-content">
                                    <h5>Báo cáo thống kê</h5>
                                    <div class="welcome">
                                        <p>Xin chào, <strong><?= htmlspecialchars($user['ho_ten'] ?? $user['email']) ?></strong>.
                                            <a href="<?= BASE_URL . '?act=logout' ?>" class="logout">Đăng xuất</a>
                                        </p>
                                    </div>

                                    <p class="mb-4">Tại đây bạn có thể theo dõi nhanh đơn hàng, giỏ hàng và thông tin tài
                                        khoản của mình.</p>

                                    <div class="row">
                                        <div class="col-md-6 col-xl-3 mb-4">
                                            <div class="border p-3 text-center h-100">
                                                <h6 class="mb-2">Tổng đơn hàng</h6>
                                                <h4><?= $soDonHang ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 mb-4">
                                            <div class="border p-3 text-center h-100">
                                                <h6 class="mb-2">Đơn đang xử lý</h6>
                                                <h4><?= $soDonChoXuLy ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 mb-4">
                                            <div class="border p-3 text-center h-100">
                                                <h6 class="mb-2">Sản phẩm trong giỏ</h6>
                                                <h4><?= $soSanPhamTrongGio ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 mb-4">
                                            <div class="border p-3 text-center h-100">
                                                <h6 class="mb-2">Tổng chi tiêu</h6>
                                                <h4><?= formatPrice($tongChiTieu) ?>đ</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="mt-3 mb-3">Đơn hàng gần đây</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Mã đơn</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($donGanDay)) : ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">Bạn chưa có đơn hàng nào.</td>
                                                    </tr>
                                                <?php else : ?>
                                                    <?php foreach ($donGanDay as $don) : ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($don['ma_don_hang'] ?? '---') ?></td>
                                                            <td><?= htmlspecialchars($don['ngay_dat'] ?? '---') ?></td>
                                                            <td><?= formatPrice($don['tong_tien'] ?? 0) ?>đ</td>
                                                            <?php $trangThaiId = (int)($don['trang_thai_id'] ?? 0); ?>
                                                            <td><?= htmlspecialchars($trangThaiDonHang[$trangThaiId] ?? 'Chưa rõ') ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h6 class="mt-4 mb-3">Bình luận của tôi</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Nội dung</th>
                                                    <th>Ngày đăng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($binhLuans)) : ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">Bạn chưa có bình luận nào.</td>
                                                    </tr>
                                                <?php else : ?>
                                                    <?php foreach ($binhLuans as $bl) : ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($bl['ten_san_pham']) ?></td>
                                                            <td><?= htmlspecialchars($bl['noi_dung']) ?></td>
                                                            <td><?= htmlspecialchars($bl['ngay_dang']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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