<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<style>
    .section-gallery {
        padding: 80px 0;
        background: #fff;
    }

    .divider-gold {
        width: 50px;
        height: 3px;
        background: #c8a96e;
        margin: 0 auto 16px;
    }

    .section-gallery .section-head {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-gallery .section-head h2 {
        font-size: 36px;
        font-weight: 800;
        color: #1a1a1a;
    }

    .section-gallery .section-head h2 span {
        color: #c8a96e;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto auto;
        gap: 12px;
    }

    .gallery-item {
        overflow: hidden;
        border-radius: 4px;
        position: relative;
    }

    .gallery-item.large {
        grid-row: span 2;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .gallery-item:not(.large) img {
        height: 220px;
    }

    .gallery-item.large img {
        height: 452px;
    }

    .gallery-item:hover img {
        transform: scale(1.06);
    }

    .gallery-item .overlay {
        position: absolute;
        inset: 0;
        background: rgba(26, 26, 26, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .gallery-item:hover .overlay {
        opacity: 1;
    }

    .gallery-item .overlay span {
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
</style>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- about us area start -->
    <section class="about-us section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="about-thumb">
                        <img src="assets/img/gioithieu/about-fruit-shop.png" alt="Fruit Shop - hoa quả tươi ngon">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-content">
                        <h2 class="about-title">FRUIT SHOP</h2>
                        <h5 class="about-sub-title">
                            Fruit Shop mang đến những loại hoa quả tươi ngon, sạch và chất lượng cao để mỗi bữa ăn của bạn thêm ngọt ngào và bổ dưỡng.
                        </h5>
                        <p>Chúng tôi luôn chọn lọc các loại hoa quả từ nguồn cung cấp uy tín, đảm bảo tươi mới, thơm ngon và an toàn cho sức khỏe.</p>
                        <p>Từ dưa hấu, táo, nho, cam cho đến các loại hoa quả theo mùa, Fruit Shop luôn sẵn sàng phục vụ gia đình bạn mọi lúc.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us area end -->

    <!-- choosing area start -->
    <div class="choosing-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Vì sao chọn Fruit Shop</h2>
                        <p>Những lý do khiến hàng nghìn khách hàng tin tưởng và quay lại</p>
                    </div>
                </div>
            </div>
            <div class="row mbn-30">
                <div class="col-lg-4 col-md-4">
                    <div class="single-choose-item text-center mb-30">
                        <i class="fa fa-globe"></i>
                        <h4>Chất lượng cao</h4>
                        <p>Hoa quả được kiểm định nghiêm ngặt, chọn lọc từ nguồn uy tín, tươi ngon và an toàn.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-choose-item text-center mb-30">
                        <i class="fa fa-plane"></i>
                        <h4>Giao hàng nhanh</h4>
                        <p>Giao hàng toàn quốc trong 24–48 giờ, hỗ trợ đổi trả linh hoạt.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-choose-item text-center mb-30">
                        <i class="fa fa-comments"></i>
                        <h4>Hỗ trợ tận tâm</h4>
                        <p>Tư vấn chọn hoa quả theo nhu cầu nhanh chóng, hỗ trợ trước & sau mua hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- choosing area end -->

    <!-- featured products area start -->
    <section class="section-gallery">
        <div class="container">
            <div class="section-head">
                <div class="divider-gold"></div>
                <h2>Sản phẩm <span>nổi bật</span></h2>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item large">
                    <img src="assets/img/gioithieu/gallery-dia-trai-cay.png" alt="Đĩa trái cây nghệ thuật">
                    <div class="overlay"><span>Đĩa Trái Cây Nghệ Thuật</span></div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/gioithieu/gallery-xoai-cat.jpg" alt="Xoài cát">
                    <div class="overlay"><span>Xoài Cát</span></div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/gioithieu/gallery-tao-do.jpg" alt="Táo đỏ cao cấp">
                    <div class="overlay"><span>Táo Đỏ Cao Cấp</span></div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/gioithieu/gallery-tao-envy.jpg" alt="Táo Envy">
                    <div class="overlay"><span>Táo Envy</span></div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/gioithieu/gallery-set-trai-cay.png" alt="Set trái cây tiệc">
                    <div class="overlay"><span>Set Trái Cây Tiệc</span></div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured products area end -->
</main>


<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>