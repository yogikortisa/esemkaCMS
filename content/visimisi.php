<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Visi dan Misi</a>';

$utama = '<b>Visi SMK Negeri 4 Batam</b>
<p>Terwujudnya lembaga diklat yang menghasilkan sumber daya manusia yang handal, mandiri berwawasan regional dan Global.</p>
		  <b>Misi SMK Negeri 4 Batam</b>
<p>Mengembangkan kurikulum implementatif bertaraf Nasional dan Internasional.
Mengambangkan potensi peserta didik melalui kegiatan pengembangan diri.
Mewujudkan layanan prima dalam pengolahan sekolah.
Meningkatkan mutu sumber daya manusia melalui diklat dan peningkatan jenjang pendidikan.</p>';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>