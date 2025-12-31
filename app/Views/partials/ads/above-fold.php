<?php
// Above-the-fold ad position
$ad = null;
foreach ($adPositions as $adPos) {
    if ($adPos['position_code'] === 'above-fold') {
        $ad = $adPos;
        break;
    }
}

if ($ad && $ad['is_active']):
?>
<div class="ad-container ad-above-fold">
    <!-- Google AdSense Ad Unit -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
         data-ad-slot="<?php echo htmlspecialchars($ad['ad_code'] ?? '1234567890'); ?>"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<?php endif; ?>
