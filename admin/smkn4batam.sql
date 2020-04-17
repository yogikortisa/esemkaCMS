-- File untuk membuat database
-- Buat database bernama smkn4batam
-- Hapus jika sudah ada
-- Developed by Yogi Kortisa
-- Contact: yogi@hack-id.us

DROP DATABASE IF EXISTS smkn4batam;
CREATE DATABASE smkn4batam;

-- Aktifkan database nya!
USE smkn4batam;

-- Buat tabel admin
CREATE TABLE admin
(
	username varchar(17) not null primary key,
	password varchar(17) not null
);

-- Buat tabel bukutamu
-- Kolom id_bt bersifat auto_increment artinya otomatis bertambah satu ketika dilakukan UPDATE pada tabel
CREATE TABLE bukutamu
(
	id_bt int(4) not null auto_increment primary key,
	tgl_post varchar(20) not null,
	nama varchar(30) not null,
	email varchar(30) not null,
	komentar varchar(144) not null
);

-- Buat tabel member
CREATE TABLE member
(
	username varchar(17) not null primary key,
	password varchar(17) not null,
	nama varchar(30) not null,
	email varchar(30) not null,
	alamat varchar(100) not null,
	kode_post int(7) not null,
	kota varchar(20) not null
);

-- Buat tabel news
CREATE TABLE news
(
	id_berita int(4) not null auto_increment primary key,
	jdl_berita varchar(50) not null,
	isi_berita text not null,
	tgl_berita varchar(12) not null
);

-- Buat tabel kontak
CREATE TABLE kontak
(
	id_kontak int(4) not null auto_increment primary key,
	nama varchar(30) not null,
	email varchar(30) not null,
	subject varchar(30) not null,
	isi varchar(140) not null
);
-- Masukkan username dan password untuk admin
INSERT INTO admin VALUES ('admin', 'smkn4batam');