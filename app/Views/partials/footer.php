<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php echo APP_NAME; ?></h3>
                <p>Almanca öğrenmek için kapsamlı ve ücretsiz kaynaklar.</p>
            </div>
            
            <div class="footer-section">
                <h4>Hızlı Linkler</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo LanguageManager::url('grammar'); ?>">Gramer</a></li>
                    <li><a href="<?php echo LanguageManager::url('words'); ?>">Kelimeler</a></li>
                    <li><a href="<?php echo LanguageManager::url('exams/preparation'); ?>">Sınav Hazırlık</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Diller</h4>
                <ul class="footer-links">
                    <?php foreach ($supportedLanguages as $code => $lang): ?>
                        <li>
                            <a href="<?php 
                                $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
                                $newPath = preg_replace('/^\/' . preg_quote($currentLanguage, '/') . '/', '/' . $code, $currentPath);
                                echo BASE_URL . $newPath;
                            ?>">
                                <?php echo $lang['flag'] . ' ' . htmlspecialchars($lang['native']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>

<?php
// Footer ad
if (isset($adPositions)) {
    partial('ads/footer', ['adPositions' => $adPositions]);
}
?>
