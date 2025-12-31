<section class="page-header">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo LanguageManager::url(''); ?>">Ana Sayfa</a> / 
            <a href="<?php echo LanguageManager::url('grammar'); ?>">Gramer</a> / 
            <span><?php echo htmlspecialchars($level['name']); ?></span>
        </nav>
        <h1><?php echo htmlspecialchars($level['name']); ?> - Gramer Konuları</h1>
        <?php if ($level['description']): ?>
            <p><?php echo htmlspecialchars($level['description']); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="topics-section">
    <div class="container">
        <?php if (empty($topics)): ?>
            <div class="empty-state">
                <p>Bu seviye için henüz konu eklenmemiş.</p>
            </div>
        <?php else: ?>
            <div class="topics-grid">
                <?php foreach ($topics as $topic): ?>
                    <article class="topic-card">
                        <h3>
                            <a href="<?php echo LanguageManager::url('grammar/' . $level['code'] . '/' . $topic['slug']); ?>">
                                <!-- Topic title will come from grammar_contents table -->
                                <?php echo htmlspecialchars($topic['slug']); ?>
                            </a>
                        </h3>
                        <?php if (isset($topic['content_count']) && $topic['content_count'] > 0): ?>
                            <span class="topic-meta">İçerik mevcut</span>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
