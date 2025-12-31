<section class="page-header">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo LanguageManager::url(''); ?>">Ana Sayfa</a> / 
            <a href="<?php echo LanguageManager::url('words'); ?>">Kelimeler</a> / 
            <span><?php echo htmlspecialchars($level['name']); ?></span>
        </nav>
        <h1><?php echo htmlspecialchars($level['name']); ?> Kelimeler</h1>
        <p>Toplam <?php echo $totalWords; ?> kelime</p>
    </div>
</section>

<section class="words-section">
    <div class="container">
        <?php if (empty($words)): ?>
            <div class="empty-state">
                <p>Bu seviye için henüz kelime eklenmemiş.</p>
            </div>
        <?php else: ?>
            <div class="words-list">
                <?php foreach ($words as $word): ?>
                    <div class="word-item">
                        <div class="word-header">
                            <?php if ($word['article']): ?>
                                <span class="word-article"><?php echo htmlspecialchars($word['article']); ?></span>
                            <?php endif; ?>
                            <h3 class="word-german"><?php echo htmlspecialchars($word['german_word']); ?></h3>
                            <?php if ($word['word_type']): ?>
                                <span class="word-type"><?php echo htmlspecialchars($word['word_type']); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($word['translation']): ?>
                            <p class="word-translation"><?php echo htmlspecialchars($word['translation']); ?></p>
                        <?php endif; ?>
                        <?php if ($word['usage_note']): ?>
                            <p class="word-usage"><?php echo htmlspecialchars($word['usage_note']); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo LanguageManager::url('words/detail/' . $word['id']); ?>" class="word-link">
                            Detayları Gör →
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>" class="pagination-link">← Önceki</a>
                    <?php endif; ?>
                    
                    <span class="pagination-info">
                        Sayfa <?php echo $page; ?> / <?php echo $totalPages; ?>
                    </span>
                    
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>" class="pagination-link">Sonraki →</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
