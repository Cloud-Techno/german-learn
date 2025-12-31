<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="<?php echo LanguageManager::url(''); ?>">
                    <h1><?php echo APP_NAME; ?></h1>
                </a>
            </div>
            
            <nav class="main-nav" id="main-nav">
                <ul class="nav-list">
                    <?php foreach ($menuItems as $item): ?>
                        <li class="nav-item">
                            <a href="<?php echo LanguageManager::url($item['route']); ?>" class="nav-link">
                                <?php echo htmlspecialchars($item['label'] ?? $item['slug']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            
            <div class="language-switcher">
                <button class="lang-toggle" id="lang-toggle" aria-label="Change language">
                    <span class="lang-flag"><?php echo $languageData['flag']; ?></span>
                    <span class="lang-code"><?php echo strtoupper($currentLanguage); ?></span>
                </button>
                <ul class="lang-dropdown" id="lang-dropdown">
                    <?php foreach ($supportedLanguages as $code => $lang): ?>
                        <?php if ($code !== $currentLanguage): ?>
                            <li>
                                <a href="<?php 
                                    $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
                                    $newPath = preg_replace('/^\/' . preg_quote($currentLanguage, '/') . '/', '/' . $code, $currentPath);
                                    echo BASE_URL . $newPath;
                                ?>" class="lang-option">
                                    <span class="lang-flag"><?php echo $lang['flag']; ?></span>
                                    <span class="lang-name"><?php echo htmlspecialchars($lang['native']); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<?php
// Above-the-fold ad (homepage only)
if (isset($pageType) && $pageType === 'home' && isset($adPositions)) {
    partial('ads/above-fold', ['adPositions' => $adPositions]);
}
?>
