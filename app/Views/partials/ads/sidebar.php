<?php
// Sidebar sticky ad position
$ad = null;
foreach ($adPositions as $adPos) {
    if ($adPos['position_code'] === 'sidebar-sticky') {
        $ad = $adPos;
        break;
    }
}

if ($ad && $ad['is_active']):
?>
<aside class="ad-sidebar ad-sticky">
    <div class="ad-container">
        <!-- Google AdSense Ad Unit -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
             data-ad-slot="<?php echo htmlspecialchars($ad['ad_code'] ?? '1234567890'); ?>"
             data-ad-format="vertical"
             data-full-width-responsive="false"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
</aside>
<?php endif; ?>
