<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<?php
if (!isset($listSanPham) || !is_array($listSanPham)) {
    $listSanPham = [];
}
?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/banner3.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/banner2.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/banner5.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
        </div>
    </section>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ</h6>
                            <p>Hỗ trợ 27/07</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn tiền</h6>
                            <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán</h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->


    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Hoa quả tươi ngon</h2>
                        <p class="sub-title">Sản phẩm được chọn lọc mỗi ngày</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">


                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $interval = $ngayHienTai->diff($ngayNhap);
                                                    if ($interval->days <= 7) {

                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <div class="cart-hover">
                                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST" style="display: inline-block; margin-bottom: 5px;">
                                                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                        <input type="hidden" name="so_luong" value="1">
                                                        <button type="submit" class="btn btn-cart">Thêm vào giỏ</button>
                                                    </form>
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" class="btn btn-cart">Xem chi tiết</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">

                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="ratings d-flex justify-content-center align-items-center mt-2" style="font-size: 13px;">
                                                    <div class="me-1">
                                                        <?= renderStarRating($sanPham['avg_rating'] ?? 0) ?>
                                                    </div>
                                                    <span class="text-muted">(<?= number_format((float)($sanPham['avg_rating'] ?? 0), 1) ?>/5)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php endforeach ?>
                                </div>
                            </div>

                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- product banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/banner4.jpg" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/banner5.png" alt="product banner">
                        </a>

                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- product banner statistics area end -->

    <!-- featured product area start -->
    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm nổi bật</h2>
                        <p class="sub-title">Mỗi loại hoa quả đều tươi mới và đầy dinh dưỡng.</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                        <?php foreach ($listSanPham as $sanPham): ?>
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="">
                                        <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="">
                                    </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngayHienTai = new DateTime();
                                        $interval = $ngayHienTai->diff($ngayNhap);
                                        if ($interval->days <= 7) {
                                        ?>
                                            <div class="product-label new">
                                                <span>Mới</span>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                            <div class="product-label discount">
                                                <span>Giảm giá</span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="cart-hover">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" class="btn btn-cart">Xem chi tiết</a>
                                        <br>
                                        <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST" style="display: inline-block; margin-bottom: 5px;">
                                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                            <input type="hidden" name="so_luong" value="1">
                                            <button type="submit" class="btn btn-cart">Thêm vào giỏ</button>
                                        </form>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <h6 class="product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                            <?= $sanPham['ten_san_pham'] ?>
                                        </a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                            <span class="price-old">
                                                <del><?= formatPrice($sanPham['gia_san_pham']) ?>đ</del>
                                            </span>
                                        <?php } else { ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                        <?php } ?>
                                    </div>
                                    <div class="ratings d-flex justify-content-center align-items-center mt-2" style="font-size: 13px;">
                                        <div class="me-1">
                                            <?= renderStarRating($sanPham['avg_rating'] ?? 0) ?>
                                        </div>
                                        <span class="text-muted">(<?= number_format((float)($sanPham['avg_rating'] ?? 0), 1) ?>/5)</span>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->

    <!-- testimonial area end -->

    <!-- group product start -->
    <section class="group-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="group-product-banner">
                        <figure class="banner-statistics">
                            <a href="#">
                                <img src="assets/slider5.jpg" alt="product banner">
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Sản phẩm bán chạy</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">

                                <?php foreach ($listSanPham as $sanPham): ?>

                                    <div class="group-slide-item">
                                        <div class="group-item">

                                            <div class="group-item-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="">
                                                </a>
                                            </div>

                                            <div class="group-item-desc">
                                                <h5 class="group-product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                        <?= $sanPham['ten_san_pham'] ?>
                                                    </a>
                                                </h5>

                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                                        <span class="price-old">
                                                            <del><?= formatPrice($sanPham['gia_san_pham']) ?>đ</del>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="ratings d-flex justify-content-center align-items-center mt-2" style="font-size: 13px;">
                                                    <div class="me-1">
                                                        <?= renderStarRating($sanPham['avg_rating'] ?? 0) ?>
                                                    </div>
                                                    <span class="text-muted">(<?= number_format((float)($sanPham['avg_rating'] ?? 0), 1) ?>/5)</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                <?php endforeach ?>

                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Sản phẩm giảm giá</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">

                                <?php foreach ($listSanPham as $sanPham): ?>

                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>

                                        <div class="group-slide-item">
                                            <div class="group-item">

                                                <div class="group-item-thumb">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="">
                                                    </a>
                                                </div>

                                                <div class="group-item-desc">
                                                    <h5 class="group-product-name">
                                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                            <?= $sanPham['ten_san_pham'] ?>
                                                        </a>
                                                    </h5>

                                                    <div class="price-box">
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                                        <span class="price-old">
                                                            <del><?= formatPrice($sanPham['gia_san_pham']) ?>đ</del>
                                                        </span>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    <?php } ?>

                                <?php endforeach ?>

                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- group product end -->

    <!-- latest blog area start -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Tin tức</h2>
                        <p class="sub-title">Đây là những bài đăng tin tức mới nhất</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="<?= BASE_URL . '?act=tin-tuc' ?>">
                                    <img src="assets/tin1.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>26/03/2026 | <a href="#">Fruit Shop</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Bí quyết chọn hoa quả nhập khẩu tươi ngon, an toàn</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>">
                                    <img src="assets/tin2.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>26/03/2026 | <a href="#">Fruit Shop</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Tuần lễ trái cây tươi nhập khẩu - Ưu đãi chỉ từ 59K</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>">
                                    <img src="assets/tin3.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>26/03/2026 | <a href="#">Fruit Shop</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Đại hội trái cây - Giảm giá đến 50% các loại quả nhập khẩu</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="<?= BASE_URL . '?act=tin-tuc' ?>">
                                    <img src="assets/tin4.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>26/03/2026 | <a href="#">Fruit Shop</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Nông trại tươi xanh: Rau củ quả sạch, chăm chút tận tay</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>">
                                    <img src="assets/tin5.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>26/03/2026 | <a href="#">Fruit Shop</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>">Ưu đãi giảm đến 29% - Miễn phí vận chuyển hoa quả tươi</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest blog area end -->

    <!-- brand logo area start -->

    <!-- brand logo area end -->
</main>




<!-- offcanvas mini cart start -->




<?php require_once 'layout/miniCart.php'; ?>
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php'; ?>