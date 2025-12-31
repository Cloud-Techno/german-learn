<?php
// Footer ad position
$ad = null;
foreach ($adPositions as $adPos) {
    if ($adPos['position_code'] === 'footer') {
        $ad = $adPos;
        break;
    }
}

if ($ad && $ad['is_active']):
?>
<div class="ad-container ad-footer">
    <!-- Google AdSense Ad Unit -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
         data-ad-slot="<?php echo htmlspecialchars($ad['ad_code'] ?? '1234567890'); ?>"
         data-ad-format="horizontal"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<?php endif; ?>
