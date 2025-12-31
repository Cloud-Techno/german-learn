<section class="page-header">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo LanguageManager::url(''); ?>">Ana Sayfa</a> / 
            <a href="<?php echo LanguageManager::url('grammar'); ?>">Gramer</a> / 
            <a href="<?php echo LanguageManager::url('grammar/' . $level['code']); ?>"><?php echo htmlspecialchars($level['name']); ?></a> / 
            <span><?php echo htmlspecialchars($content['title']); ?></span>
        </nav>
        <h1><?php echo htmlspecialchars($content['title']); ?></h1>
    </div>
</section>

<article class="content-article">
    <div class="container">
        <div class="article-wrapper">
            <div class="article-main">
                <?php if ($content['description']): ?>
                    <p class="article-intro"><?php echo nl2br(htmlspecialchars($content['description'])); ?></p>
                <?php endif; ?>
                
                <?php
                // First in-content ad (after intro)
                partial('ads/in-content', ['adPositions' => $adPositions]);
                ?>
                
                <div class="article-content">
                    <?php echo $content['content']; ?>
                </div>
                
                <?php if (!empty($examples)): ?>
                    <section class="examples-section">
                        <h2>Örnekler</h2>
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
                
                <?php
                // Second in-content ad (before end)
                partial('ads/in-content', ['adPositions' => $adPositions]);
                ?>
            </div>
            
            <?php
            // Sidebar ad
            partial('ads/sidebar', ['adPositions' => $adPositions]);
            ?>
        </div>
    </div>
</article>
