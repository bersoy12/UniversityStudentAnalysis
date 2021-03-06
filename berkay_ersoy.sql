DROP DATABASE IF EXISTS berkay_ersoy;
CREATE DATABASE IF NOT EXISTS berkay_ersoy DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE berkay_ersoy;

CREATE TABLE IF NOT EXISTS bolumler (
  program_id int(11) NOT NULL,
  program_adi varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  uni_id int(5) DEFAULT NULL,
  PRIMARY KEY (program_id),
  KEY uni_id (uni_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS geldikleri_iller (
  program_id int(11),
  sehir_id int(5),
  yerlesen_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id),
  KEY sehir_id (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS geldikleri_liseler (
  program_id int(11) DEFAULT NULL,
  lise_adi varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  yeni_mezun int(11) DEFAULT NULL,
  onceki_donem int(11) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS genel_bilgiler;
CREATE TABLE IF NOT EXISTS genel_bilgiler (
  program_id int(11) DEFAULT NULL,
  fakulte_adi varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  puan_turu varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  burs_turu varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  genel_kontenjan int(11) DEFAULT NULL,
  okul_birincisi_kontenjani int(11) DEFAULT NULL,
  toplam_kontenjan int(11) DEFAULT NULL,
  genel_kontenjana_yerlesen int(11) DEFAULT NULL,
  okul_birincisi_kontenjanina_yerlesen int(11) DEFAULT NULL,
  toplam_yerlesen int(11) DEFAULT NULL,
  bos_kontenjan int(11) DEFAULT NULL,
  ilk_yerlesme_orani decimal(5,2) DEFAULT NULL,
  kayit_yaptirmayan int(11) DEFAULT NULL,
  ek_yerlesen int(11) DEFAULT NULL,
  ortalama_obp decimal(6,3) DEFAULT NULL,
  ort_diploma_notu decimal(4,2) DEFAULT NULL,
  KEY genel_bilgiler_ibfk_1 (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS kacinci_tercih;
CREATE TABLE IF NOT EXISTS kacinci_tercih (
  program_id int(11) DEFAULT NULL,
  tercih_sirasi int(11) DEFAULT NULL,
  yerlesen_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS sehirler (
  sehir_id int(5) NOT NULL,
  sehir_adi varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS universiteler (
  uni_id int(5) NOT NULL,
  uni_adi varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  sehir_id int(5) DEFAULT NULL,
  PRIMARY KEY (uni_id),
  KEY sehir_id (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS universite_tercihleri (
  program_id int(11),
  tercih_eden_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE bolumler
  ADD CONSTRAINT bolumler_ibfk_1 FOREIGN KEY (uni_id) REFERENCES universiteler (uni_id);

ALTER TABLE geldikleri_iller
  ADD CONSTRAINT geldikleri_iller_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id),
  ADD CONSTRAINT geldikleri_iller_ibfk_2 FOREIGN KEY (sehir_id) REFERENCES sehirler (sehir_id);

ALTER TABLE geldikleri_liseler
  ADD CONSTRAINT geldikleri_liseler_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

ALTER TABLE genel_bilgiler
  ADD CONSTRAINT genel_bilgiler_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

ALTER TABLE kacinci_tercih
  ADD CONSTRAINT kacinci_tercih_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

ALTER TABLE universiteler
  ADD CONSTRAINT universiteler_ibfk_1 FOREIGN KEY (sehir_id) REFERENCES sehirler (sehir_id);

ALTER TABLE universite_tercihleri
  ADD CONSTRAINT universite_tercihleri_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);