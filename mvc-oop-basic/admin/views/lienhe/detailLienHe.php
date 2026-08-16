<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết liên hệ</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khách liên hệ</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Tên:</strong> <?= htmlspecialchars($lienHe['ho_ten']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($lienHe['email']) ?></p>
                            <p><strong>Điện thoại:</strong> <?= htmlspecialchars($lienHe['so_dien_thoai']) ?></p>
                            <p><strong>Tiêu đề:</strong> <?= htmlspecialchars($lienHe['tieu_de']) ?></p>
                            <p><strong>Nội dung:</strong></p>
                            <p><?= nl2br(htmlspecialchars($lienHe['noi_dung'])) ?></p>
                            <p><strong>Ngày gửi:</strong> <?= $lienHe['created_at'] ?></p>
                            <p><strong>Trạng thái:</strong> <?= htmlspecialchars($lienHe['trang_thai'] ?? 'Chưa xử lý') ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Phản hồi</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=phan-hoi-lien-he' ?>" method="post">
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $lienHe['id'] ?>">
                                <div class="form-group">
                                    <label for="phan_hoi">Nội dung phản hồi</label>
                                    <textarea class="form-control" id="phan_hoi" name="phan_hoi" rows="6"><?= htmlspecialchars($lienHe['phan_hoi'] ?? '') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" id="trang_thai" name="trang_thai">
                                        <option value="Chưa xử lý" <?= ($lienHe['trang_thai'] ?? '') === 'Chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                                        <option value="Đã trả lời" <?= ($lienHe['trang_thai'] ?? '') === 'Đã trả lời' ? 'selected' : '' ?>>Đã trả lời</option>
                                        <option value="Đã đóng" <?= ($lienHe['trang_thai'] ?? '') === 'Đã đóng' ? 'selected' : '' ?>>Đã đóng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Lưu phản hồi</button>
                                <a href="<?= BASE_URL_ADMIN . '?act=lien-he' ?>" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
</body>
</html>
