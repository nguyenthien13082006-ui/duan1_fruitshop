<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=products' ?>">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container section-padding">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4" style="font-size:32px; font-weight:700;">Thông tin sản phẩm<br><?= htmlspecialchars($sanPham['ten_san_pham']) ?></h1>
            </div>

            <div class="col-lg-8">
                <div class="mb-4 text-center">
                    <img src="<?= productImageUrl($listAnhSanPham[0]['link_hinh_anh'] ?? $sanPham['hinh_anh']) ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>" style="max-width:100%; height:auto; display:inline-block; border-radius:4px;">
                </div>

                <section class="mb-4">
                    <h3>Giới thiệu</h3>
                    <p>
                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?> là một sản phẩm thuộc nhóm <strong><?= htmlspecialchars($sanPham['ten_danh_muc'] ?? 'Sản phẩm') ?></strong>.
                        Sản phẩm được lựa chọn kỹ từ nguồn cung cấp uy tín và xử lý bảo quản đảm bảo độ tươi ngon khi đến tay người tiêu dùng. <?= nl2br(htmlspecialchars($sanPham['mo_ta'] ?? '')) ?>
                    </p>
                </section>

                <?php
                $ngayNhapDate = !empty($sanPham['ngay_nhap']) ? new DateTime($sanPham['ngay_nhap']) : new DateTime('today');
                $ngayHetHanDuKien = (clone $ngayNhapDate)->modify('+10 day');
                $today = new DateTime('today');
                $soNgayConLai = (int) $today->diff($ngayHetHanDuKien)->days;

                if ($soNgayConLai >= 7) {
                    $trangThai = 'Tồn kho';
                } elseif ($soNgayConLai >= 3) {
                    $trangThai = 'Còn tươi';
                } else {
                    $trangThai = 'Mới nhập';
                }
                ?>
                <section class="mb-4">
                    <h3>Đặc điểm</h3>
                    <ul>
                        <li><strong>Xuất xứ:</strong> <?= htmlspecialchars($sanPham['xuat_xu'] ?? 'Chưa cập nhật') ?></li>
                        <li><strong>Số lượng còn:</strong> <?= (int)($sanPham['so_luong'] ?? 0) ?> <?= htmlspecialchars($sanPham['don_vi_tinh'] ?? 'kg') ?></li>
                        <li><strong>Ngày nhập:</strong> <?= htmlspecialchars($sanPham['ngay_nhap'] ?? 'Chưa cập nhật') ?></li>
                        <li><strong>Ngày hết hạn dự kiến:</strong> <?= $ngayHetHanDuKien->format('d/m/Y') ?></li>
                        <li><strong>Số ngày còn lại:</strong> <?= $soNgayConLai ?> ngày</li>
                        <li><strong>Trạng thái:</strong> <?= $trangThai ?></li>
                        <li><strong>Hình thức:</strong> Trái tươi, chín tự nhiên, kích thước và màu sắc phụ thuộc theo đợt thu hoạch</li>
                        <li><strong>Hương vị:</strong> Vị ngọt thanh, thơm đặc trưng phù hợp ăn tươi hoặc chế biến</li>
                        <li><strong>Lưu ý:</strong> Sản phẩm dễ hư nếu để nơi nóng ẩm — nên bảo quản lạnh khi có thể</li>
                    </ul>
                </section>

                <section class="mb-4">
                    <h3>Sử dụng và bảo quản</h3>
                    <p>
                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?> thường được sử dụng trực tiếp. Đây là một loại trái cây nhạy cảm, nên ăn ngay sau khi mua để giữ được độ tươi ngon.
                    </p>
                    <p>
                        Để bảo quản tốt nhất, khi mua về nên giữ <?= htmlspecialchars($sanPham['ten_san_pham']) ?> ở nhiệt độ từ 0 đến 4°C. Nếu để bên ngoài ở điều kiện phòng bình thường, không quá 30 phút thì sản phẩm sẽ dễ mềm, mất độ giòn và không ngon khi ăn.
                    </p>
                    <p>
                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?> được bán nhiều tại các cửa hàng hoa quả nhập khẩu. Bạn nên chọn cửa hàng uy tín để mua được sản phẩm chuẩn, tươi ngon và an toàn.
                    </p>
                </section>

                <section class="mb-4">
                    <h3>Giá trị dinh dưỡng</h3>
                    <p>
                        Thông thường, 100g <?= htmlspecialchars($sanPham['ten_san_pham']) ?> cung cấp khoảng 35-60 kcal, nhiều vitamin C và khoáng chất thiết yếu. Hàm lượng cụ thể phụ thuộc vào loại và độ chín của quả.
                        Sản phẩm phù hợp để bổ sung năng lượng nhẹ, vitamin cho trẻ em và người lớn.
                    </p>
                    <p class="mb-0"><em>Lưu ý:</em> Nếu bạn muốn, có thể thêm thông số dinh dưỡng chi tiết trong phần mô tả sản phẩm trên trang quản trị.</p>
                </section>

                <section class="mb-4">
                    <h3>Hệ thống cửa hàng hoa quả nhập khẩu fruit_shop</h3>
                    <p>
                        Hệ thống cửa hàng hoa quả nhập khẩu fruit_shop là một địa chỉ uy tín tại Hà Nội cung cấp cho quý khách những trái cây tươi ngon nhất cùng nhiều loại hoa quả nhập khẩu và hoa quả vùng miền khác.
                    </p>
                    <p>
                        Khách hàng đến với fruit_shop sẽ được nhân viên tư vấn và chăm sóc nhiệt tình. Nếu khách hàng không hài lòng về chất lượng sản phẩm, có thể gọi đến hotline hoặc để lại thông tin trên trang <a href="<?= BASE_URL . '?act=products' ?>">trang sản phẩm</a> để được hỗ trợ đổi trả sản phẩm, hoặc đến bất kỳ cửa hàng nào gần nhất để đổi trả.
                    </p>
                </section>

                <section class="mb-4">
                    <h3>Lý do khách hàng nên mua hàng tại hệ thống cửa hàng hoa quả nhập khẩu fruit_shop</h3>
                    <ul>
                        <li>Giao hàng tận nơi theo yêu cầu khách hàng. Miễn phí vận chuyển nội thành Hà Nội với mỗi hóa đơn trên 500.000đ. Khách nhận hàng không ưng có thể trả lại cho nhân viên giao hàng.</li>
                        <li>Trái cây luôn được đảm bảo nguồn gốc xuất xứ. Mỗi loại hoa quả được fruit_shop cung cấp đều có giấy chứng nhận nguồn gốc xuất xứ.</li>
                        <li>Trái cây không hóa chất, đảm bảo vệ sinh an toàn thực phẩm. fruit_shop là một trong những đơn vị được cấp giấy chứng nhận vệ sinh an toàn thực phẩm và cam kết trái cây sạch 100% đến khách hàng.</li>
                        <li>Được nếm thử sản phẩm trước khi mua.</li>
                        <li>Đa dạng sản phẩm và dịch vụ cung cấp.</li>
                        <li>Thái độ phục vụ thân thiện, đảm bảo mang đến sự hài lòng cho mỗi khách hàng.</li>
                        <li>Hệ thống kho lạnh đạt chuẩn để bảo quản hoa quả giữ được độ tươi ngon nhất.</li>
                    </ul>
                </section>

                <!-- Reviews and comments -->
                <section class="product-reviews">
                    <h3>Bình luận và đánh giá (<?= count($listBinhLuan) ?>)</h3>
                    <div class="mb-3">
                        <?= renderStarRating($sanPham['avg_rating'] ?? 0) ?> <span class="text-muted"><?= number_format((float)($sanPham['avg_rating'] ?? 0),1) ?>/5 (<?= (int)($sanPham['so_luot_danh_gia'] ?? 0) ?> lượt đánh giá)</span>
                    </div>

                    <?php foreach ($listBinhLuan as $binhLuan): ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img src="<?= $binhLuan['anh_dai_dien'] ?>" alt="" style="width:48px;height:48px;border-radius:50%;object-fit:cover;margin-right:12px;">
                                    <div>
                                        <strong><?= htmlspecialchars($binhLuan['ho_ten']) ?></strong>
                                        <div class="text-muted" style="font-size:12px;"><?= $binhLuan['ngay_dang'] ?></div>
                                        <p class="mt-2 mb-0"><?= nl2br(htmlspecialchars($binhLuan['noi_dung'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (isset($_SESSION['user_client'])): ?>
                        <form action="<?= BASE_URL . '?act=post-danh-gia' ?>" method="POST" class="mt-3 border rounded p-3">
                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                            <div class="mb-2">
                                <label>Đánh giá sao</label>
                                <select name="so_sao" class="form-control" required>
                                    <option value="">-- Chọn số sao --</option>
                                    <option value="5">5 sao - Rất hài lòng</option>
                                    <option value="4">4 sao - Hài lòng</option>
                                    <option value="3">3 sao - Bình thường</option>
                                    <option value="2">2 sao - Không hài lòng</option>
                                    <option value="1">1 sao - Rất không hài lòng</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Nhận xét (tùy chọn)</label>
                                <textarea name="noi_dung" class="form-control" rows="3" placeholder="Bạn thích sản phẩm này vì sao?"></textarea>
                            </div>
                            <button class="btn btn-warning">Gửi đánh giá</button>
                        </form>

                        <form action="<?= BASE_URL . '?act=post-binh-luan' ?>" method="POST" class="mt-3">
                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                            <div class="mb-2">
                                <label>Nội dung bình luận</label>
                                <textarea name="noi_dung" class="form-control" required></textarea>
                            </div>
                            <button class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    <?php else: ?>
                        <p class="text-muted">Vui lòng <a href="<?= BASE_URL . '?act=login' ?>">đăng nhập</a> để bình luận và đánh giá.</p>
                    <?php endif; ?>
                </section>

            </div>

            <aside class="col-lg-4">
                <div class="card mb-3 p-3">
                    <h4>Giá</h4>
                    <div class="price">
                        <?php if ($sanPham['gia_khuyen_mai']) { ?>
                            <div style="font-size:20px;color:#d9534f;"><strong><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</strong></div>
                            <div style="text-decoration:line-through;color:#999;"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</div>
                        <?php } else { ?>
                            <div style="font-size:20px;color:#333;"><strong><?= formatPrice($sanPham['gia_san_pham']) ?>đ</strong></div>
                        <?php } ?>
                    </div>
                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST" class="mt-3">
                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                        <div class="mb-2">
                            <label>Số lượng</label>
                            <div class="input-group">
                                <input type="number" name="so_luong" value="1" min="1" max="<?= (int)($sanPham['so_luong'] ?? 0) ?>" class="form-control">
                                <span class="input-group-text"><?= htmlspecialchars($sanPham['don_vi_tinh'] ?? 'kg') ?></span>
                            </div>
                        </div>
                        <button class="btn btn-cart2">Thêm vào giỏ</button>
                    </form>
                </div>

                <div class="card p-3">
                    <h5>Thông tin nhanh</h5>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Mã sản phẩm:</strong> <?= htmlspecialchars($sanPham['ma_san_pham'] ?? ('SP' . str_pad($sanPham['id'], 4, '0', STR_PAD_LEFT))) ?></li>
                        <li><strong>Danh mục:</strong> <?= htmlspecialchars($sanPham['ten_danh_muc']) ?></li>
                        <li><strong>Nhà cung cấp:</strong> <?= htmlspecialchars($sanPham['ten_nha_cung_cap'] ?? 'Chưa cập nhật') ?></li>
                        <li><strong>Ngày nhập:</strong> <?= htmlspecialchars($sanPham['ngay_nhap']) ?></li>
                        <li><strong>Ngày hết hạn dự kiến:</strong> <?= $ngayHetHanDuKien->format('d/m/Y') ?></li>
                        <li><strong>Còn lại:</strong> <?= $soNgayConLai ?> ngày</li>
                        <li><strong>Trạng thái:</strong> <span class="text-success"><strong><?= $trangThai ?></strong></span></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                        <p class="sub-title"></p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
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
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>
<!-- offcanvas mini cart start -->

<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php'; ?>