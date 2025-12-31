# German Learn Platform

Production-ready, scalable, multi-language German learning platform with SEO optimization and Google Ads integration.

## 🎯 Özellikler

- **5 Dilli Destek**: Almanca, İngilizce, Türkçe, Lehçe, Rusça
- **URL Bazlı Dil Yönetimi**: `/tr/`, `/en/`, `/de/`, `/pl/`, `/ru/`
- **SEO Optimizasyonu**: Meta tags, hreflang, schema.org, sitemap
- **Google AdSense Entegrasyonu**: Reklam alanları optimize edilmiş
- **MVC Mimarisi**: Temiz, ölçeklenebilir kod yapısı
- **Dinamik İçerik**: Tüm içerikler veritabanından gelir
- **Mobile-First Tasarım**: Responsive, minimalist arayüz
- **Performance Odaklı**: Core Web Vitals optimizasyonu

## 📋 Gereksinimler

- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Apache mod_rewrite (veya Nginx)
- PDO MySQL extension

## 🚀 Kurulum

### 1. Dosyaları Yükleyin

Proje dosyalarını web sunucunuzun root dizinine yükleyin.

### 2. Veritabanını Oluşturun

```bash
mysql -u root -p < database/schema.sql
```

Veya phpMyAdmin üzerinden `database/schema.sql` dosyasını import edin.

### 3. Yapılandırma

`config/config.php` dosyasında veritabanı ayarlarını yapın:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'german_learn');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

Veya `.env` mantığı ile environment variables kullanabilirsiniz (Hostinger'da `$_ENV` desteği varsa).

### 4. .htaccess Ayarları

Apache kullanıyorsanız `.htaccess` dosyası hazır. Nginx kullanıyorsanız, aşağıdaki rewrite kurallarını ekleyin:

```nginx
location / {
    try_files $uri $uri/ /public/index.php?$query_string;
}
```

### 5. Klasör İzinleri

```bash
chmod 755 app/
chmod 755 public/
chmod 644 .htaccess
```

### 6. Google AdSense Entegrasyonu

`app/Views/layouts/main.php` ve ad partial dosyalarında (`app/Views/partials/ads/*.php`) Google AdSense Publisher ID'nizi ve Ad Slot ID'lerinizi güncelleyin:

```php
data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
data-ad-slot="1234567890"
```

## 📁 Proje Yapısı

```
german-Learn/
├── app/
│   ├── Controllers/      # Controller sınıfları
│   ├── Core/            # Çekirdek sınıflar (Router, Database, View, etc.)
│   ├── Models/          # Model sınıfları
│   └── Views/           # View dosyaları
│       ├── layouts/     # Layout şablonları
│       ├── partials/    # Partial view'lar (header, footer, ads)
│       └── [controller]/ # Controller view'ları
├── config/              # Yapılandırma dosyaları
├── database/            # Veritabanı şemaları
├── public/              # Public erişilebilir dosyalar
│   ├── assets/         # CSS, JS, images
│   ├── index.php       # Entry point
│   └── robots.txt
└── .htaccess           # Apache yapılandırması
```

## 🗄️ Veritabanı Yapısı

- `languages` - Desteklenen diller
- `grammar_levels` - Gramer seviyeleri (A1-C1)
- `grammar_topics` - Gramer konuları
- `grammar_contents` - Gramer içerikleri (çok dilli)
- `words` - Almanca kelimeler
- `word_translations` - Kelime çevirileri (çok dilli)
- `examples` - Örnek cümleler
- `ads_positions` - Reklam pozisyonları
- `menu_items` - Menü öğeleri
- `menu_item_translations` - Menü çevirileri

## 🌍 Dil Sistemi

Dil sistemi URL bazlı çalışır:

- `/tr/` - Türkçe
- `/en/` - İngilizce
- `/de/` - Almanca
- `/pl/` - Lehçe
- `/ru/` - Rusça

Yeni dil eklemek için:

1. `config/config.php` içinde `SUPPORTED_LANGUAGES` dizisine ekleyin
2. `languages` tablosuna kayıt ekleyin
3. İçerikleri çevirin

## 📝 İçerik Ekleme

### Gramer Konusu Ekleme

```sql
-- 1. Topic ekle
INSERT INTO grammar_topics (level_id, slug, sort_order) VALUES (1, 'artikel', 1);

-- 2. İçerik ekle (her dil için)
INSERT INTO grammar_contents (topic_id, language_code, title, content, meta_title, meta_description) 
VALUES (1, 'tr', 'Artikel (Artikel)', '<p>İçerik...</p>', 'Meta Title', 'Meta Description');
```

### Kelime Ekleme

```sql
-- 1. Kelime ekle
INSERT INTO words (word_level_id, german_word, article, word_type, difficulty) 
VALUES (1, 'Haus', 'das', 'noun', 5);

-- 2. Çeviri ekle (her dil için)
INSERT INTO word_translations (word_id, language_code, translation) 
VALUES (1, 'tr', 'ev');
```

## 💰 Reklam Yönetimi

Reklam pozisyonları `ads_positions` tablosundan yönetilir:

```sql
-- Reklam pozisyonu ekle/düzenle
UPDATE ads_positions 
SET ad_code = '1234567890', is_active = 1 
WHERE position_code = 'above-fold' AND page_type = 'home';
```

Reklam pozisyon kodları:
- `above-fold` - Sayfa üstü
- `in-content-top` - İçerik başında
- `in-content-middle` - İçerik ortasında
- `sidebar-sticky` - Yan çubuk (sticky)
- `mobile-top` - Mobil üst
- `footer` - Alt kısım

## 🔍 SEO

- Meta tags otomatik oluşturulur
- Hreflang tags tüm diller için
- Schema.org structured data
- Sitemap: `/sitemap.php`
- Robots.txt: `/robots.txt`

## 🎨 Özelleştirme

### Tema Renkleri

`public/assets/css/main.css` dosyasındaki CSS değişkenlerini düzenleyin:

```css
:root {
    --color-primary: #2563eb;
    --color-secondary: #64748b;
    /* ... */
}
```

### Menü Öğeleri

Menü öğeleri `menu_items` ve `menu_item_translations` tablolarından yönetilir.

## 📊 Performans

- CSS ve JS minification önerilir (production'da)
- Gzip compression (.htaccess'te aktif)
- Browser caching (.htaccess'te aktif)
- Lazy loading için hazır yapı
- CLS (Cumulative Layout Shift) önleme için ad container'ları optimize edildi

## 🔒 Güvenlik

- PDO prepared statements
- XSS koruması (htmlspecialchars)
- CSRF token (ileride eklenecek)
- Security headers (.htaccess)
- SQL injection koruması

## 📱 Mobil Optimizasyon

- Mobile-first CSS yaklaşımı
- Responsive grid sistemi
- Touch-friendly button sizes
- Mobile menu toggle

## 🚧 Gelecek Özellikler

- Admin panel
- Kullanıcı sistemi
- Premium içerik
- Öğrenme ilerleme takibi
- Quiz ve test sistemi

## 📄 Lisans

Bu proje özel bir projedir.

## 🤝 Katkıda Bulunma

Production ortamında dikkatli olun. Değişikliklerden önce test edin.

## 📞 Destek

Sorularınız için issue açabilirsiniz.

---

**Not**: Google AdSense Publisher ID ve Ad Slot ID'lerini production'a çıkmadan önce mutlaka güncelleyin!
