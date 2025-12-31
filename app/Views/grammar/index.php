<?php
$content = ob_get_clean();
ob_start();
?>

<section class="page-header">
    <div class="container">
        <h1>Almanca Gramer Dersleri</h1>
        <p>CEFR seviyelerine göre düzenlenmiş kapsamlı gramer konuları</p>
    </div>
</section>

<section class="grammar-levels-section">
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
                    <a href="<?php echo LanguageManager::url('grammar/' . $level['code']); ?>" class="btn btn-primary">
                        Konuları Gör →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
