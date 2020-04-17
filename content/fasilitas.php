<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Profil SMK Negeri 4 Batam</a>';

$utama = '
<b>Fasilitas Utama</b>
I. Ruang Standar Mata pelajaran Normatif<br><br>
II. Ruang Standar Mata pelajaran Adaptif<br><br>
III. Ruang Praktik:<br><br>
'.' '.' => Lab. KKPI<br><br>
		=> Lab. Teknik Kimia Industri<br><br>
<b>Fasilitas Pendukung</b>
Lapangan Parkir<br><br>
Lapangan Volley<br><br>
Hotspots<br><br>
Kantin<br><br>
Ruang standar OSIS<br><br>
Ruang standar BP/BK<br><br>
Musholla<br><br>

';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>

    