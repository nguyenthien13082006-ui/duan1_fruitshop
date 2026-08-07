<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách liên hệ</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngày gửi</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listLienHe as $key => $item): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= htmlspecialchars($item['ho_ten']) ?></td>
                                            <td><?= htmlspecialchars($item['email']) ?></td>
                                            <td><?= htmlspecialchars($item['so_dien_thoai']) ?></td>
                                            <td><?= htmlspecialchars($item['tieu_de']) ?></td>
                                            <td><?= $item['created_at'] ?></td>
                                            <td><?= htmlspecialchars($item['trang_thai'] ?? 'Chưa xử lý') ?></td>
                                            <td>
                                                <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-lien-he&id=' . $item['id'] ?>" class="btn btn-primary btn-sm">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngày gửi</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
