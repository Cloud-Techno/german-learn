<section class="page-header">
    <div class="container">
        <h1>Almanca Kelime Öğrenme</h1>
        <p>Seviye bazlı kelime listeleri ile Almanca kelime dağarcığınızı geliştirin</p>
    </div>
</section>

<section class="word-levels-section">
    <div class="container">
        <div class="levels-list">
            <?php foreach ($levels as $level): ?>
                <div class="level-item">
                    <div class="level-header">
                        <span class="level-code"><?php echo htmlspecialchars($level['code']); ?></span>
                        <h2><?php echo htmlspecialchars($level['name']); ?></h2>
                    </div>
                    <?php if ($level['description']): ?>
                        <p class="level-description"><?php echo htmlspecialchars($level['description']); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo LanguageManager::url('words/level/' . $level['code']); ?>" class="btn btn-primary">
                        Kelimeleri Gör →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
