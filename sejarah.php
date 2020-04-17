<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Sejarah SMK Negeri 4 Batam</a>';

$utama = 'SMK Negeri 4 Batam berdiri pada tahun 2008 berdasar pada SK. Pendirian KPTS.28/HK/I/2008 tanggal 23 April 2008. Berdiri di atas
lahan 10.125,70 meter persegi sesuai PL. Tanah: 115/AT.2/WIL.III/IV/2006 tanggal 13 April2008, di lokasi Tiban II Sekupang Kelurahan
Patam Lestari Kecamatan Sekupang Batam dengan dua program studi keahlian :<br />
I. Teknik Kimia (Kimia Industri)<br />
II. Teknik Komputer dan Informatika (Rekayasa Perangkat Lunak)<br /><br />
   Dengan daya tampung siswa dengan sasaran jumlah peserta didik pada tahun pelaran 2008/2009 mencapai 172 siswa dan daya tampung 
tahun pelajaran 2009/2010 sebanyak 180 siswa dan daya tampung tahun pelajaran 2010/2011 sebanyak 180 siswa.<br /><br />

SMK Negeri 4 Batam memiliki core bisnis, yakni dalam Kompetensi Keahlian meliputi :<br />
I. Kimia Industri (kode 053)<br />
II. Rekayasa Perangkat Lunak (kode 070)<br />
Pengembangan Unit Produksi, meliputi :<br /><br />
I. Kimia Industri<br />
II. Rekayasa Perangkat Lunak<br />
III. Kewirausahaan<br />';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>