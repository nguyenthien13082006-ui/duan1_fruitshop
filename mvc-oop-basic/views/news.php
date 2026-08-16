<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main class="news-page">
    <div class="container section-padding">
        <div class="row align-items-center mb-4">
            <div class="col-12">
                <div class="news-page__header">
                    <span class="news-page__badge">Fruit Shop</span>
                    <h1>Tin tức & Cẩm nang</h1>
                    <p>Cập nhật kiến thức, mẹo chọn mua và cách bảo quản trái cây tươi ngon mỗi ngày.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($articles as $article): ?>
                    <article class="news-card">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>" class="news-card__image-wrap">
                                    <img src="<?= BASE_URL . $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="news-card__body">
                                    <span class="news-card__tag">Mẹo chọn mua</span>
                                    <h3 class="news-card__title">
                                        <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>"><?= htmlspecialchars($article['title']) ?></a>
                                    </h3>
                                    <div class="news-card__meta">
                                        <span><i class="fa fa-calendar"></i> <?= htmlspecialchars($article['date']) ?></span>
                                        <span><i class="fa fa-user"></i> Fruit Shop</span>
                                    </div>
                                    <p class="news-card__excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
                                    <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($article['slug']) ?>" class="news-card__btn">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="news-pagination mt-4">
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
                <div class="news-sidebar-card">
                    <h5>Bài viết nổi bật</h5>
                    <p>Các nội dung được chọn lọc, hữu ích cho cách bảo quản và chọn mua trái cây.</p>
                    <ul>
                        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
                            <li>
                                <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="news-sidebar-card">
                    <h5>Bài viết mới nhất</h5>
                    <p>Các tin vừa đăng, cập nhật hàng đầu cho khách hàng.</p>
                    <ul>
                        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
                            <li>
                                <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a>
                                <span><?= htmlspecialchars($a['date']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php require_once 'layout/footer.php'; ?>
