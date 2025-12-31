# 🌐 Ana Sayfa ve Site Erişim Rehberi

## 📍 Ana Sayfa URL'leri

Sitenizin ana sayfasına erişmek için aşağıdaki URL'leri kullanabilirsiniz:

### Varsayılan Dil (Türkçe)
```
https://yourdomain.com/tr/
```
veya sadece
```
https://yourdomain.com/
```
(Dil belirtilmezse varsayılan dil Türkçe yüklenir)

### Diğer Diller
- **İngilizce**: `https://yourdomain.com/en/`
- **Almanca**: `https://yourdomain.com/de/`
- **Lehçe**: `https://yourdomain.com/pl/`
- **Rusça**: `https://yourdomain.com/ru/`

## 📁 Dosya Yapısı

### Entry Point (Giriş Noktası)
```
public/index.php  ← Bu dosya tüm istekleri karşılar
```

### Ana Sayfa Controller
```
app/Controllers/HomeController.php  ← Ana sayfa mantığı
```

### Ana Sayfa View (Görünüm)
```
app/Views/home/index.php  ← Ana sayfa HTML içeriği
```

## 🔧 Hostinger'a Yükleme Şekilleri

### Yöntem 1: Public Klasörünü Doğrudan Yüklemek (Önerilen)

Eğer dosyaları şu şekilde yüklerseniz:
```
public_html/
  ├── index.php
  ├── assets/
  ├── robots.txt
  └── .htaccess
app/
config/
database/
```

`.htaccess` dosyasında şu satırı düzenlemeniz gerekir:
```apache
RewriteRule ^(.*)$ index.php [QSA,L]
```
(`public/` kısmını kaldırın)

### Yöntem 2: Tüm Projeyi Yüklemek (Mevcut Yapı)

Eğer tüm projeyi şu şekilde yüklerseniz:
```
public_html/
  ├── app/
  ├── config/
  ├── database/
  ├── public/
  │   ├── index.php
  │   ├── assets/
  │   └── .htaccess
  └── .htaccess (root)
```

`.htaccess` dosyası şu anki haliyle çalışır (değişiklik gerekmez).

## ✅ Test Adımları

1. **Dosyaları Hostinger'a yükleyin**
2. **Veritabanını import edin** (phpMyAdmin'den)
3. **Tarayıcıda açın**: `https://yourdomain.com/tr/`

## 🎯 Beklenen Görünüm

Ana sayfada göreceğiniz:
- ✅ Site başlığı ve logosu
- ✅ Ana navigasyon menüsü (Gramer, Kelimeler, vb.)
- ✅ Dil seçici (TR, EN, DE, PL, RU)
- ✅ Hero section (Almanca Öğrenmeye Başla)
- ✅ Özellik kartları (Gramer, Kelimeler, Günlük Konuşmalar, Sınav Hazırlık)
- ✅ Seviye kartları (A1, A2, B1, B2, C1)

## ⚠️ Sorun Giderme

### 404 Hatası Alıyorsanız
- `.htaccess` dosyasının yüklendiğinden emin olun
- Apache `mod_rewrite` modülünün aktif olduğunu kontrol edin
- Hostinger panelinde URL Rewriting'in açık olduğunu kontrol edin

### 500 Internal Server Error
- `config/config.php` dosyasındaki veritabanı bilgilerini kontrol edin
- Dosya izinlerini kontrol edin (755 klasörler, 644 dosyalar)
- PHP error log'larına bakın

### Veritabanı Bağlantı Hatası
- Veritabanı adı, kullanıcı adı ve şifrenin doğru olduğundan emin olun
- Hostinger'da MySQL host bilgisini kontrol edin (genellikle `localhost` ama farklı olabilir)

## 📝 Notlar

- **Varsayılan dil**: Türkçe (`tr`)
- **Dil değiştirme**: Üst menüdeki dil seçici ile yapılır
- **SEO**: Her dil için ayrı URL'ler var (`/tr/`, `/en/`, vb.)
- **Sitemap**: `https://yourdomain.com/sitemap.php`
