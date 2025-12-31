<section class="page-header">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo LanguageManager::url(''); ?>">Ana Sayfa</a> / 
            <a href="<?php echo LanguageManager::url('words'); ?>">Kelimeler</a> / 
            <span><?php echo htmlspecialchars($word['german_word']); ?></span>
        </nav>
        <h1>
            <?php if ($word['article']): ?>
                <span class="word-article"><?php echo htmlspecialchars($word['article']); ?></span>
            <?php endif; ?>
            <?php echo htmlspecialchars($word['german_word']); ?>
        </h1>
    </div>
</section>

<article class="word-detail-article">
    <div class="container">
        <div class="article-wrapper">
            <div class="article-main">
                <div class="word-info">
                    <?php if ($word['word_type']): ?>
                        <span class="word-type-badge"><?php echo htmlspecialchars($word['word_type']); ?></span>
                    <?php endif; ?>
                    <?php if ($word['translation']): ?>
                        <h2 class="word-translation-main"><?php echo htmlspecialchars($word['translation']); ?></h2>
                    <?php endif; ?>
                    <?php if ($word['usage_note']): ?>
                        <p class="word-usage-note"><?php echo nl2br(htmlspecialchars($word['usage_note'])); ?></p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($translations)): ?>
                    <section class="translations-section">
                        <h2>Diğer Dillerdeki Çeviriler</h2>
                        <div class="translations-grid">
                            <?php foreach ($translations as $trans): ?>
                                <div class="translation-item">
                                    <span class="trans-lang"><?php echo strtoupper($trans['language_code']); ?></span>
                                    <span class="trans-text"><?php echo htmlspecialchars($trans['translation']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <?php if (!empty($examples)): ?>
                    <section class="examples-section">
                        <h2>Örnek Cümleler</h2>
                        <div class="examples-list">
                            <?php foreach ($examples as $example): ?>
                                <div class="example-item">
                                    <div class="example-text">
                                        <strong><?php echo htmlspecialchars($example['example_text']); ?></strong>
                                    </div>
                                    <?php if ($example['translation']): ?>
                                        <div class="example-translation">
                                            <?php echo htmlspecialchars($example['translation']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
            
            <?php
            // Sidebar ad
            partial('ads/sidebar', ['adPositions' => $adPositions]);
            ?>
        </div>
    </div>
</article>
