CREATE TABLE sehirler (
    sehir_id   INT(5) PRIMARY KEY,
    sehir_adi  VARCHAR2(45)
);

CREATE TABLE universiteler (
    uni_id    INT(5) PRIMARY KEY,
    uni_adi   VARCHAR2(60),
    sehir_id  INT(5),
    FOREIGN KEY ( sehir_id )
        REFERENCES sehirler ( sehir_id )
);

CREATE TABLE bolumler (
    program_id   INT(11) PRIMARY KEY,
    program_adi  VARCHAR2(100),
    uni_id       INT(5),
    FOREIGN KEY ( uni_id )
        REFERENCES universiteler ( uni_id )
);

CREATE TABLE kacinci_tercih (
    program_id       INT(11),
    tercih_sirasi    INT(11),
    yerlesen_sayisi  INT(11),
    FOREIGN KEY ( program_id )
        REFERENCES bolumler ( program_id )
);

CREATE TABLE geldikleri_iller (
    program_id       INT(11),
    sehir_id         INT(5),
    yerlesen_sayisi  INT(11),
    FOREIGN KEY ( program_id )
        REFERENCES bolumler ( program_id ),
    FOREIGN KEY ( sehir_id )
        REFERENCES sehirler ( sehir_id )
);

CREATE TABLE universite_tercihleri (
    program_id          INT(11),
    tercih_eden_sayisi  INT(11),
    FOREIGN KEY ( program_id )
        REFERENCES bolumler ( program_id )
);

CREATE TABLE genel_bilgiler (
    program_id                 INT(11),
    fakulte_adi                VARCHAR2(50),
    puan_turu                  VARCHAR2(11),
    burs_turu                  VARCHAR2(50),
    genel_kontenjan            INT(11),
    okul_birincisi_kontenjani  INT(11),
    toplam_yerlesen            INT(11),
    bos_kontenjan              INT(11),
    ilk_yerlesme_orani         DECIMAL(5,2),
  yerlesip_kayit_yaptirmayan INT(11),
  ek_yerlesen INT(11),
  ort_obp DECIMAL(6,3),
  ort_diploma_notu DECIMAL(4, 2), 
  FOREIGN KEY ( program_id ) 
        REFERENCES bolumler ( program_id ) 
);