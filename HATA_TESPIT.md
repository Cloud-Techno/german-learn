# 🔍 Hata Tespit Rehberi

Domain: **seagreen-cattle-719277.hostingersite.com**

## ✅ Test Adımları (Sırayla)

### 1. PHP Bilgilerini Kontrol Et
Tarayıcıda açın:
```
https://seagreen-cattle-719277.hostingersite.com/info.php
```
- PHP çalışıyorsa phpinfo() sayfası görünmeli
- Eğer hata veriyorsa, PHP yüklü değil veya dosya yüklenmemiş

### 2. Config Dosyalarını Test Et
Tarayıcıda açın:
```
https://seagreen-cattle-719277.hostingersite.com/test-config.php
```
- Tüm config değerlerinin doğru yüklendiğini kontrol edin
- Eksik veya hatalı değerler varsa listelenir

### 3. Veritabanı Bağlantısını Test Et
Tarayıcıda açın:
```
https://seagreen-cattle-719277.hostingersite.com/test-db.php
```
- Veritabanı bağlantısı test edilir
- Tablolar listelenir
- Hata varsa detaylı mesaj gösterilir

### 4. Index.php Yapısını Test Et
Tarayıcıda açın:
```
https://seagreen-cattle-719277.hostingersite.com/test-index.php
```
- Routing ve autoloader test edilir
- Hatalar gösterilir

### 5. Ana Sayfayı Test Et
Tarayıcıda açın:
```
https://seagreen-cattle-719277.hostingersite.com/index.php
```
veya
```
https://seagreen-cattle-719277.hostingersite.com/
```

## 🔧 Yaygın Hatalar ve Çözümleri

### Hata 1: 404 Not Found
**Sebep**: .htaccess çalışmıyor veya dosyalar yanlış yerde

**Çözüm**:
1. `.htaccess` dosyasının `public_html` klasöründe olduğundan emin olun
2. Hostinger panelinde "Apache mod_rewrite" aktif mi kontrol edin
3. Dosya yapısını kontrol edin

### Hata 2: 500 Internal Server Error
**Sebep**: PHP hatası veya dosya izinleri

**Çözüm**:
1. `info.php` dosyasını açarak PHP'nin çalıştığını kontrol edin
2. `test-config.php` ve `test-db.php` ile hataları görün
3. Dosya izinlerini kontrol edin (klasörler: 755, dosyalar: 644)

### Hata 3: Database Connection Error
**Sebep**: Veritabanı bilgileri yanlış veya veritabanı yok

**Çözüm**:
1. `test-db.php` ile test edin
2. Hostinger phpMyAdmin'de veritabanının var olduğunu kontrol edin
3. `config/config.php` dosyasındaki bilgileri kontrol edin:
   - DB_HOST (genellikle `localhost` ama farklı olabilir)
   - DB_NAME: `u350527250_germanDB`
   - DB_USER: `u350527250_fates`
   - DB_PASS: `Ankara0607.-`

### Hata 4: Blank Page (Beyaz Sayfa)
**Sebep**: Fatal error veya output buffering sorunu

**Çözüm**:
1. `config/config.php` dosyasında `APP_DEBUG = true` yapın (test için)
2. Error log'larına bakın (Hostinger panelinden)
3. `test-index.php` ile test edin

## 📁 Dosya Yapısı Kontrolü

Hostinger File Manager'da şu yapı olmalı:

```
public_html/
  ├── .htaccess
  ├── index.php (public/index.php'den kopyalanmalı)
  ├── test-db.php
  ├── test-config.php
  ├── test-index.php
  ├── info.php
  ├── app/
  │   ├── Controllers/
  │   ├── Core/
  │   ├── Models/
  │   └── Views/
  ├── config/
  │   ├── config.php
  │   └── database.php
  └── public/
      └── assets/
```

**VEYA** (Eğer public_html direkt public/ klasörü ise):

```
public_html/ (public klasörünün içeriği)
  ├── .htaccess
  ├── index.php
  ├── assets/
  ├── test-db.php
  ...
app/
config/
database/
```

## ⚠️ Önemli Notlar

1. **Test dosyalarını silin**: Güvenlik için test dosyalarını (`test-*.php`, `info.php`) kullanımdan sonra silin!

2. **APP_DEBUG**: Test sırasında `true`, production'da `false` olmalı

3. **Dosya İzinleri**:
   - Klasörler: 755 veya 750
   - PHP dosyaları: 644 veya 600
   - .htaccess: 644

4. **Error Log'ları**: Hostinger panelinden PHP error log'larını kontrol edin

## 🎯 Sonraki Adımlar

1. Yukarıdaki test dosyalarını sırayla çalıştırın
2. Hataları not edin
3. Hata mesajlarını paylaşın, birlikte çözelim
