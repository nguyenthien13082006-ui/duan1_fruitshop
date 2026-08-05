<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main>
    <div class="container section-padding">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Tin tức</h1>
                <div class="mb-3">
                    <a href="<?= BASE_URL . '?act=tin-tuc' ?>" class="btn btn-secondary">&larr; Quay lại tin tức</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <article class="card p-3 mb-4">
                    <img src="<?= BASE_URL . $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>" style="width:100%;height:auto;object-fit:cover;margin-bottom:24px;">
                    <h1><?= htmlspecialchars($article['title']) ?></h1>
                    <div class="text-muted mb-3">Ngày: <?= htmlspecialchars($article['date']) ?></div>
                    <p class="lead"><?= htmlspecialchars($article['excerpt']) ?></p>
                    <div class="content">
                        <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
                    </div>
                </article>
            </div>

            <aside class="col-lg-4">
                <div class="card p-3 mb-3">
                    <h5>Bài viết khác</h5>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($this->getNewsArticles() as $related): ?>
                            <?php if ($related['slug'] !== $article['slug']): ?>
                                <li class="mb-3">
                                    <a href="<?= BASE_URL . '?act=tin-tuc-chi-tiet&slug=' . urlencode($related['slug']) ?>"><?= htmlspecialchars($related['title']) ?></a>
                                    <div class="text-muted" style="font-size:12px"><?= htmlspecialchars($related['date']) ?></div>
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