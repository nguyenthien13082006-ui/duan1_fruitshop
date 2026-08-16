<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<?php
if (!isset($chiTietGioHang) || !is_array($chiTietGioHang)) {
    $chiTietGioHang = [];
}
?>

<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                        <th class="pro-title">Tên sản phẩm</th>
                                        <th class="pro-price">Giá</th>
                                        <th class="pro-quantity">Số lượng</th>
                                        <th class="pro-quantity">Đơn vị</th>
                                        <th class="pro-subtotal">Tổng tiền</th>
                                        <th class="pro-remove">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tongGioHang = 0;
                                    foreach ($chiTietGioHang as $sanPham):
                                        $gia = $sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham'];
                                        $tongtien = $gia * $sanPham['so_luong'];
                                        $tongGioHang += $tongtien;
                                    ?>
                                        <tr>
                                            <td class="pro-thumbnail">
                                                <img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" />
                                            </td>
                                            <td class="pro-title"><?= $sanPham['ten_san_pham'] ?></td>
                                            <td class="pro-price"><?= formatPrice($gia) . 'đ' ?></td>
                                            <td class="pro-quantity">
                                                <div class="d-flex align-items-center" style="gap:4px">
                                                    <!-- Nút giảm -->
                                                    <?php if ($sanPham['so_luong'] > 1): ?>
                                                        <form action="<?= BASE_URL ?>?act=cap-nhat-gio-hang" method="post">
                                                            <input type="hidden" name="so_luong[<?= $sanPham['san_pham_id'] ?>]" value="<?= $sanPham['so_luong'] - 1 ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                                        </form>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-outline-secondary" disabled>-</button>
                                                    <?php endif; ?>

                                                    <span style="min-width:30px;text-align:center"><?= $sanPham['so_luong'] ?></span>

                                                    <!-- Nút tăng -->
                                                    <form action="<?= BASE_URL ?>?act=cap-nhat-gio-hang" method="post">
                                                        <input type="hidden" name="so_luong[<?= $sanPham['san_pham_id'] ?>]" value="<?= $sanPham['so_luong'] + 1 ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="pro-quantity"><?= htmlspecialchars($sanPham['don_vi_tinh'] ?? 'kg') ?></td>
                                            <td class="pro-subtotal"><?= formatPrice($tongtien) . 'đ' ?></td>
                                            <td class="pro-remove">
                                                <a href="<?= BASE_URL ?>?act=xoa-gio-hang&id_san_pham=<?= $sanPham['san_pham_id'] ?>"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng đơn hàng</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng tiền sản phẩm</td>
                                            <td><?= formatPrice($tongGioHang) . 'đ' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Vận chuyển</td>
                                            <td>30.000đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng thanh toán</td>
                                            <td class="total-amount"><?= formatPrice($tongGioHang + 30000) . 'đ' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Tiến hành đặt hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>