<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Tujuan SMK Negeri 4 Batam</a>';

$utama = '=> Menghasilkan lulusan yang kompeten<br><br>
		  => Meningkatkan kualitas proses belajar mengajar berbasis kompetensi<br><br>
		  => Menyiapkan peserta didik agar mampu mengembangkan sikap profesional, mampu beradaptasi terhadap lingkungan, gigih dalam berkompetisi berdisiplin dan ulet<br><br>
		  => Adanya konsistensi pelaksanaan aktifitas kendali mutu dan jaminan mutu sekolah<br><br>
		  => Meningkatkan kesejahteraan warga sekolah.';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>