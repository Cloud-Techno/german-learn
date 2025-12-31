# Veritabanı Kurulumu - Detaylı Adımlar

## phpMyAdmin'de Yapılacaklar

### 1️⃣ Veritabanını Seçin
- Sol menüden **`u350527250_germanDB`** veritabanını seçin
- Eğer yoksa, önce Hostinger kontrol panelinden oluşturun

### 2️⃣ SQL Dosyasını Import Edin

**Yöntem 1: Import Sekmesi (Önerilen)**
1. Üst menüden **"Import"** sekmesine tıklayın
2. **"Choose File"** butonuna tıklayın
3. `schema.sql` dosyasını seçin
4. **"Partial import"** seçeneğini işaretleyin (eğer hata alırsanız)
5. **"Go"** butonuna tıklayın
6. İşlem tamamlanana kadar bekleyin

**Yöntem 2: SQL Sekmesi (Manuel)**
1. Üst menüden **"SQL"** sekmesine tıklayın
2. `schema.sql` dosyasının içeriğini kopyalayın
3. SQL sorgu kutusuna yapıştırın
4. **İLK SATIRLARI ATLAYIN** (CREATE DATABASE ve USE komutlarını)
5. Sadece tablo oluşturma komutlarını çalıştırın
6. **"Go"** butonuna tıklayın

### 3️⃣ Tabloları Kontrol Edin

Aşağıdaki tabloların oluşturulduğundan emin olun:

- ✅ `languages` (5 dil kaydı olmalı)
- ✅ `grammar_levels` (A1-C1 seviyeleri)
- ✅ `grammar_topics` (boş olabilir)
- ✅ `grammar_contents` (boş olabilir)
- ✅ `word_levels` (A1-B1 ve B2-C1)
- ✅ `words` (boş olabilir)
- ✅ `word_translations` (boş olabilir)
- ✅ `examples` (boş olabilir)
- ✅ `ads_positions` (9 reklam pozisyonu olmalı)
- ✅ `menu_items` (8 menü öğesi olmalı)
- ✅ `menu_item_translations` (40 çeviri olmalı)

### 4️⃣ İlk Kontroller

**languages tablosunu kontrol edin:**
```sql
SELECT * FROM languages;
```
5 kayıt görmelisiniz (de, en, tr, pl, ru)

**menu_items tablosunu kontrol edin:**
```sql
SELECT * FROM menu_items;
```
8 kayıt görmelisiniz

**ads_positions tablosunu kontrol edin:**
```sql
SELECT * FROM ads_positions;
```
9 kayıt görmelisiniz

## ⚠️ Önemli Notlar

1. **CREATE DATABASE komutunu atlayın**: Veritabanı zaten Hostinger'da oluşturulmuş, sadece tabloları oluşturmanız yeterli

2. **Karakter Seti**: Tüm tablolar `utf8mb4_unicode_ci` karakter seti ile oluşturulmalı

3. **Hata Alırsanız**: 
   - Tablolar zaten varsa, önce silin veya `DROP TABLE IF EXISTS` kullanın
   - Foreign key hataları alırsanız, tabloları sırayla oluşturun

4. **Test Verisi**: Şu an veritabanı sadece yapısal tabloları (languages, menu_items, ads_positions) içeriyor. İçerikleri (grammar, words) sonra ekleyeceksiniz.

## ✅ Kurulum Başarılı mı?

Tüm tablolar oluşturulduysa, artık web siteniz çalışmaya hazır! 

Ana sayfayı açarak test edin: `https://yourdomain.com/tr/`
