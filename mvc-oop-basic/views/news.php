<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main>
    <div class="container section-padding">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Tin tức & Cẩm nang</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($articles as $article): ?>
                    <article class="mb-4 card p-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>" class="d-block">
                                    <img src="<?= BASE_URL . $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="card-title"><a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                                    <div class="text-muted mb-2">Ngày: <?= htmlspecialchars($article['date']) ?></div>
                                    <p class="card-text"><?= htmlspecialchars($article['excerpt']) ?></p>
                                    <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= BASE_URL . '?act=tin-tuc&page=' . max(1, $page - 1) ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($page === $i) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL . '?act=tin-tuc&page=' . $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= BASE_URL . '?act=tin-tuc&page=' . min($totalPages, $page + 1) ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>

            <aside class="col-lg-4">
                <div class="card p-3 mb-3">
                    <h5>Bài viết nổi bật</h5>
                    <p class="text-muted" style="font-size:14px; margin-bottom:12px;">Các nội dung được chọn lọc, hữu ích cho cách bảo quản và chọn mua trái cây.</p>
                    <ul class="list-unstyled mb-0">
                        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
                            <li><a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card p-3">
                    <h5>Bài viết mới nhất</h5>
                    <p class="text-muted" style="font-size:14px; margin-bottom:12px;">Các tin vừa đăng, cập nhật hàng đầu cho khách hàng.</p>
                    <ul class="list-unstyled mb-0">
                        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
                            <li class="mb-2">
                                <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a>
                                <div class="text-muted" style="font-size:12px"><?= htmlspecialchars($a['date']) ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php require_once 'layout/footer.php'; ?>
