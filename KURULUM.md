# Hostinger Kurulum Rehberi

## 📋 Veritabanı Kurulumu (phpMyAdmin)

### Adım 1: phpMyAdmin'e Giriş
1. Hostinger kontrol panelinde **"phpMyAdmin"** butonuna tıklayın
2. Veritabanı kullanıcı adı ve şifrenizle giriş yapın

### Adım 2: Veritabanını Seçin
1. Sol tarafta **`u350527250_germanDB`** veritabanını seçin
2. Eğer veritabanı yoksa, Hostinger kontrol panelinden oluşturun

### Adım 3: SQL Dosyasını Import Edin
1. Üst menüden **"Import"** sekmesine tıklayın
2. **"Choose File"** butonuna tıklayın
3. `database/schema.sql` dosyasını seçin
4. **"Go"** veya **"Import"** butonuna tıklayın
5. Tüm tabloların başarıyla oluşturulduğunu kontrol edin

### Adım 4: Kontrol
1. Sol tarafta veritabanı altında şu tabloları görmelisiniz:
   - `languages`
   - `grammar_levels`
   - `grammar_topics`
   - `grammar_contents`
   - `words`
   - `word_translations`
   - `examples`
   - `ads_positions`
   - `menu_items`
   - `menu_item_translations`

## 🔒 Güvenlik Önlemleri

### 1. Dosya İzinleri
Hostinger File Manager'dan şu klasörlerin izinlerini kontrol edin:
- `config/` klasörü: **755** veya **750**
- `config/config.php` ve `config/database.php` dosyaları: **644** veya **600**

### 2. .htaccess Koruması
- `.htaccess` dosyası zaten config dosyalarını koruyacak şekilde yapılandırıldı
- `config/.htaccess` dosyası config klasörünü tamamen web erişiminden korur

### 3. Git Güvenliği
- `config/config.php` ve `config/database.php` `.gitignore` dosyasına eklendi
- Bu dosyalar Git'e commit edilmeyecek

### 4. Production Kontrolleri
✅ `APP_DEBUG = false` (config.php'de)
✅ `error_reporting(0)` aktif
✅ Şifreler doğrudan kodda (production'da ideal değil ama çalışır)
✅ Session güvenlik ayarları aktif

## 📁 Dosya Yükleme (FileZilla/FTP)

### Hostinger'a Dosya Yükleme
1. FTP bilgilerinizi Hostinger'dan alın
2. FileZilla veya benzeri FTP client ile bağlanın
3. Dosyaları `public_html` klasörüne yükleyin:
   - Tüm proje dosyalarını yükleyin
   - `.htaccess` dosyasını mutlaka yükleyin
   - `config/` klasörünü yükleyin (şifreler içerir, dikkatli olun)

### Önemli: Config Dosyaları
- `config/config.php` ve `config/database.php` dosyaları **zaten şifrelerinizle doldurulmuş durumda**
- Bu dosyaları doğrudan yükleyebilirsiniz
- **ASLA bu dosyaları public repository'ye commit etmeyin!**

## 🌐 Domain ve URL Ayarları

1. Domain'iniz Hostinger'da zaten ayarlanmış olmalı
2. `config/config.php` içindeki `BASE_URL` otomatik algılanacak
3. Eğer alt klasörde kurulum yapıyorsanız, `.htaccess`'teki `RewriteBase` ayarını kontrol edin

## ✅ Son Kontroller

Kurulum sonrası kontrol listesi:

- [ ] Veritabanı bağlantısı çalışıyor mu?
- [ ] Ana sayfa açılıyor mu? (`https://yourdomain.com/tr/`)
- [ ] Dil değiştirme çalışıyor mu?
- [ ] Menü görünüyor mu?
- [ ] Config dosyaları web'den erişilemiyor mu? (test: `https://yourdomain.com/config/config.php` → 403 hatası almalısınız)
- [ ] Google AdSense ID'leri eklendi mi? (Layout dosyalarında)

## 🚨 Sorun Giderme

### Veritabanı Bağlantı Hatası
- Hostinger'da host genellikle `localhost` değil, özel bir host olabilir
- Hostinger kontrol panelinde MySQL host bilgisini kontrol edin
- `config/config.php` ve `config/database.php` dosyalarında `DB_HOST` değerini güncelleyin

### 500 Internal Server Error
- `.htaccess` dosyası yüklendi mi kontrol edin
- Dosya izinlerini kontrol edin
- PHP error log'larına bakın (Hostinger panelinden)

### Sayfa Bulunamadı (404)
- `.htaccess` dosyasının varlığını kontrol edin
- `mod_rewrite` Apache modülünün aktif olduğundan emin olun
- Hostinger'da URL Rewriting'in aktif olduğundan emin olun

## 📞 Destek

Sorun yaşarsanız:
1. PHP error log'larını kontrol edin
2. Veritabanı bağlantısını test edin
3. Dosya izinlerini kontrol edin
