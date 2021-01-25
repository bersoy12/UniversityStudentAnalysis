SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS berkay_ersoy DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE berkay_ersoy;

DROP TABLE IF EXISTS bolumler;
CREATE TABLE IF NOT EXISTS bolumler (
  program_id int(11) NOT NULL,
  program_adi varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  uni_id int(5) DEFAULT NULL,
  PRIMARY KEY (program_id),
  KEY uni_id (uni_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS geldikleri_iller;
CREATE TABLE IF NOT EXISTS geldikleri_iller (
  program_id int(11) DEFAULT NULL,
  sehir_id int(5) DEFAULT NULL,
  yerlesen_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id),
  KEY sehir_id (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS genel_bilgiler;
CREATE TABLE IF NOT EXISTS genel_bilgiler (
  program_id int(11) DEFAULT NULL,
  fakulte_adi varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  puan_turu varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  burs_turu varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  genel_kontenjan int(11) DEFAULT NULL,
  okul_birincisi_kontenjani int(11) DEFAULT NULL,
  toplam_yerlesen int(11) DEFAULT NULL,
  bos_kontenjan int(11) DEFAULT NULL,
  ilk_yerlesme_orani decimal(5,2) DEFAULT NULL,
  yerlesip_kayit_yaptirmayan int(11) DEFAULT NULL,
  ek_yerlesen int(11) DEFAULT NULL,
  ort_obp decimal(6,3) DEFAULT NULL,
  ort_diploma_notu decimal(4,2) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS kacinci_tercih;
CREATE TABLE IF NOT EXISTS kacinci_tercih (
  program_id int(11) DEFAULT NULL,
  tercih_sirasi int(11) DEFAULT NULL,
  yerlesen_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS sehirler;
CREATE TABLE IF NOT EXISTS sehirler (
  sehir_id int(5) NOT NULL,
  sehir_adi varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS universiteler;
CREATE TABLE IF NOT EXISTS universiteler (
  uni_id int(5) NOT NULL,
  uni_adi varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  sehir_id int(5) DEFAULT NULL,
  PRIMARY KEY (uni_id),
  KEY sehir_id (sehir_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS universite_tercihleri;
CREATE TABLE IF NOT EXISTS universite_tercihleri (
  program_id int(11) DEFAULT NULL,
  tercih_eden_sayisi int(11) DEFAULT NULL,
  KEY program_id (program_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE bolumler
  ADD CONSTRAINT bolumler_ibfk_1 FOREIGN KEY (uni_id) REFERENCES universiteler (uni_id);

ALTER TABLE geldikleri_iller
  ADD CONSTRAINT geldikleri_iller_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id),
  ADD CONSTRAINT geldikleri_iller_ibfk_2 FOREIGN KEY (sehir_id) REFERENCES sehirler (sehir_id);

ALTER TABLE genel_bilgiler
  ADD CONSTRAINT genel_bilgiler_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

ALTER TABLE kacinci_tercih
  ADD CONSTRAINT kacinci_tercih_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

ALTER TABLE universiteler
  ADD CONSTRAINT universiteler_ibfk_1 FOREIGN KEY (sehir_id) REFERENCES sehirler (sehir_id);

ALTER TABLE universite_tercihleri
  ADD CONSTRAINT universite_tercihleri_ibfk_1 FOREIGN KEY (program_id) REFERENCES bolumler (program_id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
