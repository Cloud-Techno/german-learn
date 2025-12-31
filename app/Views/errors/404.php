<!DOCTYPE html>
<html lang="<?php echo LanguageManager::getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Sayfa Bulunamadı</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/main.css">
</head>
<body>
    <div class="error-page">
        <div class="container">
            <h1>404</h1>
            <h2>Sayfa Bulunamadı</h2>
            <p>Aradığınız sayfa mevcut değil veya taşınmış olabilir.</p>
            <a href="<?php echo LanguageManager::url(''); ?>" class="btn btn-primary">Ana Sayfaya Dön</a>
        </div>
    </div>
</body>
</html>
