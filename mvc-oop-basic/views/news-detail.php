<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main class="news-detail-page">
    <div class="container section-padding">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>" class="btn btn-secondary btn-back-news">&larr; Quay lại tin tức</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <article class="news-detail-card">
                    <div class="news-detail__cover">
                        <img src="<?= BASE_URL . $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                    </div>
                    <div class="news-detail__content">
                        <span class="news-card__tag">Tin tức</span>
                        <h1><?= htmlspecialchars($article['title']) ?></h1>
                        <div class="news-card__meta news-card__meta--detail">
                            <span><i class="fa fa-calendar"></i> <?= htmlspecialchars($article['date']) ?></span>
                            <span><i class="fa fa-user"></i> Fruit Shop</span>
                        </div>
                        <p class="news-detail__excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
                        <div class="news-detail__body">
                            <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
                        </div>
                    </div>
                </article>
            </div>

            <aside class="col-lg-4">
                <div class="news-sidebar-card">
                    <h5>Bài viết khác</h5>
                    <ul>
                        <?php foreach ($this->getNewsArticles() as $related): ?>
                            <?php if ($related['slug'] !== $article['slug']): ?>
                                <li>
                                    <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($related['slug']) ?>"><?= htmlspecialchars($related['title']) ?></a>
                                    <span><?= htmlspecialchars($related['date']) ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>
<?php require_once 'layout/footer.php'; ?>