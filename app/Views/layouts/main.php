<!DOCTYPE html>
<html lang="<?php echo $currentLanguage; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php
    // Meta tags
    $metaTitle = $metaTitle ?? $pageTitle ?? APP_NAME;
    $metaDescription = $metaDescription ?? 'Almanca öğrenmeye başla! Ücretsiz gramer dersleri, kelime öğrenme ve sınav hazırlık materyalleri.';
    $metaKeywords = $metaKeywords ?? 'almanca, german, öğren, learn, gramer, grammar, kelime, word';
    ?>
    
    <title><?php echo htmlspecialchars($metaTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords); ?>">
    <meta name="author" content="<?php echo APP_NAME; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo BASE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($metaTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo BASE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($metaTitle); ?>">
    <meta property="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    
    <!-- Hreflang tags for SEO -->
    <?php echo LanguageManager::getHreflangTags(); ?>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo BASE_URL . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Schema.org structured data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "<?php echo APP_NAME; ?>",
        "description": "<?php echo htmlspecialchars($metaDescription); ?>",
        "url": "<?php echo BASE_URL; ?>",
        "inLanguage": "<?php echo $currentLanguage; ?>",
        "educationalUse": "LearningResource"
    }
    </script>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/main.css">
    
    <!-- Preconnect to Google AdSense (for performance) -->
    <link rel="preconnect" href="https://pagead2.googlesyndication.com">
    <link rel="dns-prefetch" href="https://pagead2.googlesyndication.com">
</head>
<body>
    <?php
    // Include header
    partial('header', [
        'currentLanguage' => $currentLanguage,
        'languageData' => $languageData,
        'supportedLanguages' => $supportedLanguages,
        'menuItems' => $menuItems ?? []
    ]);
    ?>
    
    <main id="main-content">
        <?php echo $content; ?>
    </main>
    
    <?php
    // Include footer
    partial('footer', [
        'currentLanguage' => $currentLanguage
    ]);
    ?>
    
    <!-- JavaScript -->
    <script src="<?php echo BASE_URL; ?>/assets/js/main.js" defer></script>
    
    <!-- Google AdSense (add your publisher ID) -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>
</body>
</html>
