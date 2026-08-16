<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<?php
if (!isset($listSanPham) || !is_array($listSanPham)) {
    $listSanPham = [];
}
if (!isset($listDanhMuc) || !is_array($listDanhMuc)) {
    $listDanhMuc = [];
}
?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-first mb-4">
                    <aside class="sidebar-widget">
                        <div class="card p-3 mb-4">
                            <h4 class="mb-3">Danh mục sản phẩm</h4>
                            <ul class="list-unstyled category-list">
                                <?php foreach ($listDanhMuc as $dm): ?>
                                    <li class="mb-2">
                                        <a href="<?= BASE_URL . '?act=products&danh_muc_id=' . $dm['id'] ?>" class="text-dark">
                                            <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="card p-3 mb-4">
                            <h4 class="mb-3">Bộ lọc nhanh</h4>
                            <form method="GET" action="">
                                <input type="hidden" name="act" value="products">
                                <div class="mb-3">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tìm sản phẩm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <select name="danh_muc_id" class="form-control">
                                        <option value="">-- Tất cả danh mục --</option>
                                        <?php foreach ($listDanhMuc as $dm): ?>
                                            <option value="<?= $dm['id'] ?>" <?= (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] == $dm['id']) ? 'selected' : '' ?> >
                                                <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Lọc ngay</button>
                            </form>
                        </div>

                        <div class="card p-3">
                            <h4 class="mb-3">Sản phẩm nổi bật</h4>
                            <ul class="list-unstyled mb-0">
                                <?php foreach (array_slice($listSanPham, 0, 5) as $sanPham): ?>
                                    <li class="mb-3">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" class="d-flex align-items-center text-dark">
                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>" style="width:60px;height:60px;object-fit:cover;border-radius:6px;margin-right:12px;">
                                            <div>
                                                <div><?= htmlspecialchars($sanPham['ten_san_pham']) ?></div>
                                                <div class="text-muted" style="font-size:13px;"><?= formatPrice($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham']) ?>đ</div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-9">
                    <div class="card p-3 mb-4">
                        <form method="GET" action="" class="row gy-2 gx-2 align-items-end">
                            <input type="hidden" name="act" value="products">
                            <div class="col-md-6">
                                <label class="form-label">Tìm kiếm</label>
                                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Danh mục</label>
                                <select name="danh_muc_id" class="form-control">
                                    <option value="">-- Tất cả danh mục --</option>
                                    <?php foreach ($listDanhMuc as $dm): ?>
                                        <option value="<?= $dm['id'] ?>" <?= (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] == $dm['id']) ? 'selected' : '' ?> >
                                            <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark w-100">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>

                    <div class="shop-product-wrapper">
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <?php if (empty($listSanPham)): ?>
                                <div class="col-12 text-center py-5">
                                    <p>Không tìm thấy sản phẩm nào.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($listSanPham as $sanPham): ?>
                                    <div class="col-md-4 col-sm-6 mb-4">
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $interval = $ngayHienTai->diff($ngayNhap);
                                                    if ($interval->days <= 7): ?>
                                                        <div class="product-label new"><span>Mới</span></div>
                                                    <?php endif; ?>
                                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                                        <div class="product-label discount"><span>Giảm giá</span></div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="cart-hover">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" class="btn btn-cart">Xem chi tiết</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                                    </a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php else: ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>
<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>