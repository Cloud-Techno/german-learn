<?php
// In-content ad position
$ad = null;
foreach ($adPositions as $adPos) {
    if ($adPos['position_code'] === 'in-content-top' || $adPos['position_code'] === 'in-content-middle') {
        $ad = $adPos;
        break;
    }
}

if ($ad && $ad['is_active']):
?>
<div class="ad-container ad-in-content">
    <!-- Google AdSense Ad Unit -->
    <ins class="adsbygoogle"
         style="display:block; text-align:center;"
         data-ad-layout="in-article"
         data-ad-format="fluid"
         data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
         data-ad-slot="<?php echo htmlspecialchars($ad['ad_code'] ?? '1234567890'); ?>"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<?php endif; ?>
