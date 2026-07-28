<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <?php
                        $tongTien = 0;

                        if (!empty($chiTietGioHang)):
                            foreach ($chiTietGioHang as $sanPham):
                                $gia = $sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham'];
                                $tong = $gia * $sanPham['so_luong'];
                                $tongTien += $tong;
                        ?>
                                <li class="minicart-item">
                                    <div class="minicart-thumb">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['san_pham_id']; ?>">
                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="">
                                        </a>
                                    </div>

                                    <div class="minicart-content">
                                        <h3 class="product-name">
                                            <a href="#">
                                                <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                            </a>
                                        </h3>
                                        <p>
                                            <span class="cart-quantity">
                                                <?= $sanPham['so_luong'] ?> <strong>&times;</strong>
                                            </span>
                                            <span class="cart-price"><?= formatPrice($gia) ?>đ</span>
                                        </p>
                                    </div>

                                    <button class="minicart-remove">
                                        <a href="<?= BASE_URL ?>?act=xoa-gio-hang&id_san_pham=<?= $sanPham['san_pham_id'] ?>">
                                            <i class="pe-7s-close"></i>
                                        </a>
                                    </button>
                                </li>
                            <?php
                            endforeach;
                        else:
                            ?>
                            <li>Giỏ hàng trống</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li class="total">
                            <span>Tổng tiền</span>
                            <span><strong><?= formatPrice($tongTien) ?>đ</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="<?= BASE_URL ?>?act=gio-hang"><i class="fa fa-shopping-cart"></i>Xem giỏ hàng</a>
                    <a href="<?= BASE_URL ?>?act=thanh-toan"><i class="fa fa-share"></i>Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->