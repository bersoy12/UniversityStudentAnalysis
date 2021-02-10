# YÖK Atlas Analizleri

### Proje Amacı

[YÖK Atlas](http://www.github.com) websitesinden beslenerek 

1. Veri madenciliği
2. Verilerin düzenlenmesi
3. Veritabanı modellenmesi
4. Verilerin veritabanına aktarılması
5. Veri analizi yapılması

### Cevap Aranan Sorular

- Hangi ilden kaç öğrenci kazandı?
- Hangi liseden hangi illere yerleşildi?
- Üniversitelerin bölümlerine yerleşenlerin il ve lise bazlı analizi

### Tablolar

| sehirler | |
| --- | --- |
| sehir_id | sehir_adi |

| bolumler | | |
| --- | --- | --- |
| program_id | program_adi | uni_id |

| universiteler | | |
| --- | --- | --- |
| uni_id | uni_adi | sehir_id |

| genel_bilgiler | | | | | | | | | | | | | | | |
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| program_id | fakulte_adi | puan_turu | burs_turu | genel_kontenjan | okul_birincisi_kontenjani | toplam_kontenjan | genel_kontenjana_yerlesen | okul_birincisi_kontenjanina_yerlesen | toplam_yerlesen | bos_kontenjan | ilk_yerlesme_orani | kayit_yaptirmayan | ek_yerlesen | ortalama_obp | ort_diploma_notu |

| universite_tercihleri | |
| --- | --- |
| program_id | tercih_eden_sayisi |

| kacinci_tercih | | |
| --- | --- | --- |
| program_id | tercih_sirasi | yerlesen_sayisi |

| geldikleri_liseler | | | |
| --- | --- | --- | --- |
| program_id | lise_adi | yeni_mezun | onceki_donem |

| geldikleri_iller | | |
| --- | --- | --- |
| program_id | sehir_id | yerlesen_sayisi |

### Kullanılan Araçlar

- [PHP Simple HTML DOM Parser](https://simplehtmldom.sourceforge.io)
    - Web sayfasındaki tag'li verilerin toplanmasını sağlayan bir kütüphane
- [AMPPS](http://www.ampps.com)
    - Verilerin CSV dosyasına kaydedilmesinde ve daha sonra düzenlenmiş verilerin Veritabanına aktarılmasında kullanılmıştır.
- Microsoft Excel
    - Verilerin düzenlenmesi amacıyla kullanılmıştır.