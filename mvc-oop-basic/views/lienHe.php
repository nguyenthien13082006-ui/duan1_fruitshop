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
                <li>Liên hệ</li>
            </ul>
        </div>
    </div>

    <!-- main -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <!-- My Account Tab Menu Start -->
                    <div class="contact-area section-padding pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="contact-message">
                                        <h4 class="contact-title">Gửi câu hỏi cho chúng tôi</h4>
                                        <form id="contact-form" action="<?= BASE_URL ?>?act=post-lien-he" method="post" class="contact-form">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="first_name" placeholder="Name *" type="text" required>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="phone" placeholder="Phone *" type="text" required>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="email_address" placeholder="Email *" type="text" required>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="contact_subject" placeholder="Subject *" type="text">
                                                </div>
                                                <div class="col-12">
                                                    <div class="contact2-textarea text-center">
                                                        <textarea placeholder="Message *" name="message" class="form-control2" required=""></textarea>
                                                    </div>
                                                    <div class="contact-btn">
                                                        <button class="btn btn-sqr" type="submit">Gửi   </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <p class="form-messege"></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-info">
                                        <h4 class="contact-title">Liên hệ với Fruit Shop</h4>
                                        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn chọn hoa quả tươi ngon, đặt hàng nhanh chóng và giao tận nơi.</p>
                                        <ul>
                                            <li><i class="fa fa-fax"></i> Địa chỉ: 13 Trịnh Văn Bô, Hà Nội</li>
                                            <li><i class="fa fa-phone"></i> Email: support@fruitshop.com</li>
                                            <li><i class="fa fa-envelope-o"></i> Hotline: 0900 123 456</li>
                                        </ul>
                                        <div class="working-time">
                                            <h6>Giờ làm việc</h6>
                                            <p><span>Thứ 2 – Chủ nhật:</span>08:00 – 22:00</p>
                                        </div>
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