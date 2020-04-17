<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Jurusan</a>';

$utama = '<b>Rekayasa Perangkat Lunak</b><br>
		<b>Kimi Industri</b><br>
		<b>Animasi</b>';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>